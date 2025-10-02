<?php

namespace App\Http\Controllers\Telkominfra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Perjalanan;
use App\Models\PerjalananData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\Telkominfra\FileTelkominfraController;

class DataTelkominfraController extends Controller
{

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_perjalanan' => 'nullable|string|max:255', 
                'nama_pengguna' => 'required|string|max:255', 
                'nama_tempat' => 'required|string|max:255', 
                'nmf_file' => 'required|file|mimes:txt,nmf|max:51200',
                'status' => 'required|in:Before,After',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $tempUniqueFileName = null;
        $idPerjalananInput = $validatedData['id_perjalanan'] ?? '';
        $folderPath = 'uploads/perjalanan';
        $destinationPath = public_path($folderPath);
        $fileExtension = $request->file('nmf_file')->getClientOriginalExtension();

        try {
            $idPerjalananStore = ($idPerjalananInput == '') ? Str::uuid()->toString() : $idPerjalananInput;

            $file = $request->file('nmf_file');
            $tempUniqueFileName = $idPerjalananStore . '.' . $fileExtension;
            $file->move($destinationPath, $tempUniqueFileName); 
            $oldPath = $destinationPath . DIRECTORY_SEPARATOR . $tempUniqueFileName; 
            
            $parser = new FileTelkominfraController();
            $nmfHeaderData = $parser->parseNmfHeader($oldPath); 
            $nmfTimes = $parser->extractNmfTimes($oldPath); 
            $perangkat = $nmfHeaderData['perangkat'] ?? 'Unknown Device';
            
            $finalIdPerjalanan = null;

            if (!empty($idPerjalananInput) && Perjalanan::where('id_perjalanan', $idPerjalananInput)->exists()) {
                $finalIdPerjalanan = $idPerjalananInput;
            }

            if (empty($finalIdPerjalanan)) {
                $finalIdPerjalanan = $idPerjalananStore;
            }

            $results = DB::transaction(function () use ($validatedData, $finalIdPerjalanan, $perangkat, $tempUniqueFileName, $nmfTimes) {
                $perjalanan = Perjalanan::firstOrNew(['id_perjalanan' => $finalIdPerjalanan]);

                if (!$perjalanan->exists) {
                    $perjalanan->nama_pengguna = $validatedData['nama_pengguna'];
                    $perjalanan->nama_tempat = $validatedData['nama_tempat'];
                    $perjalanan->save();
                }
                
                $perjalananData = PerjalananData::create([
                    'perjalanan_id' => $perjalanan->id, 
                    'perangkat' => $perangkat,
                    'file_nmf' => $tempUniqueFileName,
                    'status' => $validatedData['status'],
                    'timestamp_mulai' => $nmfTimes['timestamp_mulai'],
                    'timestamp_selesai' => $nmfTimes['timestamp_selesai'],
                ]);

                return [
                    'perjalanan' => $perjalanan,
                    'perjalananData' => $perjalananData
                ];
            });

            $perjalanan = $results['perjalanan'];
            $perjalananData = $results['perjalananData'];
            $perjalananId = $perjalanan->id;

            $finalFileName = $perjalananData->id . '_' . $perjalanan->id_perjalanan . '.' . $fileExtension;
            $newPath = $destinationPath . DIRECTORY_SEPARATOR . $finalFileName;
            
            if (File::exists($oldPath)) {
                File::move($oldPath, $newPath);
                $perjalananData->file_nmf = $finalFileName;
                $perjalananData->save();
            } else {
                Log::warning("File temporer hilang setelah commit DB: " . $oldPath);
            }

            return redirect()->route('telkominfra.show', $perjalananId)
                ->with('success', 'Data log berhasil ditambahkan. File: ' . $finalFileName . ' di Perjalanan ID Sesi: ' . $perjalanan->id_perjalanan);

        } catch (\Exception $e) {
            $fileToDeletePath = public_path($folderPath . DIRECTORY_SEPARATOR . $tempUniqueFileName);
            if ($tempUniqueFileName && File::exists($fileToDeletePath)) {
                File::delete($fileToDeletePath);
            }
            
            Log::error("Gagal memproses unggahan file:", [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);
            
            return redirect()->back()->with('error', 'Gagal memproses data. Pesan: ' . $e->getMessage())->withInput();
        }
    }

     /**
     * Update data sesi perjalanan (nama_pengguna dan nama_tempat).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id ID dari Perjalanan yang akan diupdate.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_pengguna' => 'required|string|max:255',
                'nama_tempat' => 'required|string|max:255',
            ], [
                'nama_pengguna.required' => 'Nama Pengguna wajib diisi.',
                'nama_tempat.required' => 'Nama Tempat/Lokasi wajib diisi.',
            ]);
            $perjalanan = Perjalanan::findOrFail($id);

            $perjalanan->nama_pengguna = $request->nama_pengguna;
            $perjalanan->nama_tempat = $request->nama_tempat;
            $perjalanan->save();
            Log::info("Perjalanan ID: {$id} berhasil diperbarui.");

            return redirect()->route('telkominfra.show', $perjalanan->id)
                             ->with('success', 'Detail Perjalanan (Nama Pengguna & Lokasi) berhasil diperbarui.');

        } catch (ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->errors())
                             ->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui perjalanan ID: ' . $id . '. Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui data. Terjadi kesalahan server.');
        }
    }

    /**
     * Hapus sesi perjalanan dan data terkait (PerjalananData dan file log).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perjalanan = null;
        try {
            $perjalanan = Perjalanan::findOrFail($id);
            Log::info("Mencoba menghapus Perjalanan ID: {$id}");

            DB::transaction(function () use ($perjalanan) {
                $basePath = public_path('uploads/perjalanan/');
                $perjalananDatas = PerjalananData::where('perjalanan_id', $perjalanan->id)->get(); 
                
                if ($perjalananDatas->isNotEmpty()) { 
                    foreach ($perjalananDatas as $dataItem) {
                        if ($dataItem->file_nmf && File::exists($basePath . $dataItem->file_nmf)) {
                            File::delete($basePath . $dataItem->file_nmf);
                            Log::debug('File NMF dihapus: ' . $dataItem->file_nmf);
                        }
                        
                        if ($dataItem->file_gpx && File::exists($basePath . $dataItem->file_gpx)) {
                            File::delete($basePath . $dataItem->file_gpx);
                            Log::debug('File GPX dihapus: ' . $dataItem->file_gpx);
                        }
                    }
                } else {
                    Log::warning('Tidak ada data log PerjalananData yang ditemukan untuk ID Perjalanan: ' . $perjalanan->id);
                }

                $deletedLogCount = PerjalananData::where('perjalanan_id', $perjalanan->id)->delete();
                Log::info("Data log PerjalananData berhasil dihapus. Jumlah baris: {$deletedLogCount}");

                $perjalanan->delete();
                Log::info('Sesi Perjalanan utama berhasil dihapus.');
            });

            return redirect()->route('telkominfra.index')->with('success', 'Sesi Drive Test dan semua data (termasuk file log) berhasil dihapus!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("Percobaan hapus gagal: Perjalanan ID {$id} tidak ditemukan.");
            return redirect()->route('telkominfra.index')->with('error', 'Data yang ingin dihapus tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus perjalanan ID: ' . $id . '. Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('telkominfra.index')->with('error', 'Gagal menghapus data. Terjadi kesalahan server. Detail error dicatat.');
        }
    }

    /**
     * Hapus satu data log (PerjalananData) dan file terkait.
     * Metode ini dipanggil oleh route 'perjalananData.destroy'.
     *
     * @param  int  $id ID dari PerjalananData yang akan dihapus.
     * @return \Illuminate\Http\Response
     */
    public function destroyPerjalananData($id)
    {
        $perjalananData = null;
        try {
            $perjalananData = PerjalananData::findOrFail($id);
            Log::info("Mencoba menghapus satu log PerjalananData ID: {$id}");

            $perjalananId = $perjalananData->perjalanan_id;
            DB::transaction(function () use ($perjalananData) {
                $basePath = public_path('uploads/perjalanan/');

                if ($perjalananData->file_nmf && File::exists($basePath . $perjalananData->file_nmf)) {
                    File::delete($basePath . $perjalananData->file_nmf);
                    Log::debug('File NMF dihapus: ' . $perjalananData->file_nmf);
                }
                
                if ($perjalananData->file_gpx && File::exists($basePath . $perjalananData->file_gpx)) {
                    File::delete($basePath . $perjalananData->file_gpx);
                    Log::debug('File GPX dihapus: ' . $perjalananData->file_gpx);
                }

                $perjalananData->delete();
                Log::info('Satu data log PerjalananData berhasil dihapus.');
            });

            return redirect()->route('telkominfra.show', $perjalananId)->with('success', 'Satu log data dan file terkait berhasil dihapus!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("Percobaan hapus log gagal: PerjalananData ID {$id} tidak ditemukan.");
            return redirect()->route('telkominfra.index')->with('error', 'Log data yang ingin dihapus tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus log data ID: ' . $id . '. Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Gagal menghapus log data. Terjadi kesalahan server. Detail error dicatat.');
        }
    }
}