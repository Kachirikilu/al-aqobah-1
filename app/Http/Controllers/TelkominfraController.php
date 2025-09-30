<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Perjalanan;
use App\Models\PengukuranSinyal; 
use Carbon\Carbon; // Digunakan untuk manipulasi timestamp

class TelkominfraController extends Controller
{
    /**
     * Tampilkan view input data.
     */

    public function index()
    {
        $visualData = DB::table('pengukuran_sinyal')
            ->join('titik_gps', function ($join) {
                $join->on('pengukuran_sinyal.perjalanan_id', '=', 'titik_gps.perjalanan_id')
                     ->on('pengukuran_sinyal.timestamp_waktu', '=', 'titik_gps.timestamp_waktu');
            })
            ->select(
                'titik_gps.latitude',
                'titik_gps.longitude',
                'pengukuran_sinyal.rsrp',
                'pengukuran_sinyal.rsrq',
                'pengukuran_sinyal.sinr',
                'pengukuran_sinyal.pci'
            )
            ->whereNotNull('pengukuran_sinyal.rsrq') 
            ->whereNotNull('pengukuran_sinyal.rsrp')
            ->get();
            
        return view('telkominfra', [
            'visualData' => $visualData,
        ]);
    }

    //  public function show(string $id) 
    // {
    //     $perjalananId = $id;


    //     $visualData = DB::table('pengukuran_sinyal')
    //         ->join('titik_gps', function ($join) {
    //             $join->on('pengukuran_sinyal.perjalanan_id', '=', 'titik_gps.perjalanan_id');
    //                 //  ->on('pengukuran_sinyal.timestamp_waktu', '=', 'titik_gps.timestamp_waktu');
    //         })
    //         ->select(
    //             'titik_gps.latitude',
    //             'titik_gps.longitude',
    //             'pengukuran_sinyal.rsrp',
    //             'pengukuran_sinyal.rsrq',
    //             'pengukuran_sinyal.sinr',
    //             'pengukuran_sinyal.pci'
    //         )
    //         // === TAMBAHAN KONDISI WHERE UNTUK FILTER ID TERTENTU ===
    //         ->where('pengukuran_sinyal.perjalanan_id', $perjalananId)
    //         // =======================================================
    //         ->whereNotNull('pengukuran_sinyal.rsrq') 
    //         ->whereNotNull('pengukuran_sinyal.rsrp')
    //         ->get();
            
    //     return view('telkominfra', [
    //         'visualData' => $visualData,
    //         // Opsional: kirim juga detail perjalanannya
    //         'perjalananDetail' => Perjalanan::find($perjalananId) 
    //     ]);
    // }

    public function show(string $id) 
{
    $perjalananId = $id;

    // hitung step untuk sampling
    $totalSinyal = DB::table('pengukuran_sinyal')
        ->where('perjalanan_id', $perjalananId)
        ->count();

    $totalGps = DB::table('titik_gps')
        ->where('perjalanan_id', $perjalananId)
        ->count();

    $stepSinyal = max(1, intval($totalSinyal / 50)); // ambil tiap n baris
    $stepGps    = max(1, intval($totalGps / 50));

    $visualData = DB::table('pengukuran_sinyal')
        ->join('titik_gps', function ($join) {
            $join->on('pengukuran_sinyal.perjalanan_id', '=', 'titik_gps.perjalanan_id');
        })
        ->select(
            'titik_gps.latitude',
            'titik_gps.longitude',
            'pengukuran_sinyal.rsrp',
            'pengukuran_sinyal.rsrq',
            'pengukuran_sinyal.sinr',
            'pengukuran_sinyal.pci'
        )
        ->where('pengukuran_sinyal.perjalanan_id', $perjalananId)
        ->whereNotNull('pengukuran_sinyal.rsrq') 
        ->whereNotNull('pengukuran_sinyal.rsrp')
        ->whereRaw("pengukuran_sinyal.id % $stepSinyal = 0") // sampling sinyal
        ->whereRaw("titik_gps.id % $stepGps = 0")             // sampling gps
        ->limit(50) // biar gak lebih dari 50
        ->get();

    return view('telkominfra', [
        'visualData' => $visualData,
        'perjalananDetail' => Perjalanan::find($perjalananId) 
    ]);
}


 public function store(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'gpx_file' => 'required|file|mimes:gpx,xml|max:10240',
            'nmf_file' => 'required|file|mimes:txt,nmf|max:51200',
        ]);

        $namaPengguna = $request->nama_pengguna;
        $gpxPath = $request->file('gpx_file')->getRealPath(); 
        $nmfPath = $request->file('nmf_file')->getRealPath();

        DB::beginTransaction();

        try {
            // 1. Parsing Header untuk data dasar
            $nmfHeaderData = $this->parseNmfHeader($nmfPath);

            // dd($nmfHeaderData);
            
            $idPerjalanan = $nmfHeaderData['id_perjalanan'] ?? Str::uuid();
            $perangkat = $nmfHeaderData['perangkat'] ?? 'Unknown Device';

            // 2. Simpan Data Sesi Utama
            $perjalanan = Perjalanan::create([
                'id_perjalanan' => $idPerjalanan,
                'nama_pengguna' => $namaPengguna,
                'perangkat' => $perangkat,
                'timestamp_mulai' => now(), 
            ]);
            
            $perjalananId = $perjalanan->id;

            // 3. Parsing dan Persiapan Data Massal
            $dataGPS = $this->parseGpxAndNmfGps($gpxPath, $nmfPath, $perjalananId);
            $dataSinyal = $this->parseNmfSinyal($nmfPath, $perjalananId);
            
            // dd($dataSinyal); // Debug: Periksa data yang akan dimasukkan


            // 4. Penyimpanan Massal (Batch Insert)
            if (!empty($dataGPS)) {
                DB::table('titik_gps')->insert($dataGPS);
            } else {
                \Log::warning("Batch Insert Titik GPS diabaikan: Array kosong.");
            }

            if (!empty($dataSinyal)) {
                DB::table('pengukuran_sinyal')->insert($dataSinyal);
            } else {
                 \Log::warning("Batch Insert Pengukuran Sinyal diabaikan: Array kosong.");
            }

            DB::commit();

            return redirect()->route('telkominfra.show', $perjalananId)->with('success', 'Data berhasil disimpan. Total GPS: ' . count($dataGPS) . ', Total Sinyal: ' . count($dataSinyal));

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Gagal memproses unggahan file:", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Gagal memproses data. Pesan: ' . $e->getMessage())->withInput();
        }
    }
    
    // ==========================================================
    // FUNGSI UTILITY PEMBACAAN FILE (CORE LOGIC)
    // ==========================================================

    /**
     * Membaca NMF untuk header dasar (Device, ID Perjalanan).
     * Menggunakan fopen/fgets untuk efisiensi.
     */
private function parseNmfHeader(string $nmfPath): array
{
    $perangkat = 'Unknown Device';
    $idPerjalanan = Str::uuid()->toString();

    if (($handle = fopen($nmfPath, "r")) !== FALSE) {
        while (($line = fgets($handle)) !== FALSE) {
            $line = trim($line);

            // Device name ada di #DN
            if (str_starts_with($line, '#DN')) {
                $parts = str_getcsv($line); // pecah CSV sesuai format NMF
                // $parts[3] berisi "samsung/SM-G973F,SAMSUNG"
                if (isset($parts[3])) {
                    $perangkat = trim($parts[3], '"');
                }
            }

            // ID perjalanan ada di #ID
            if (str_starts_with($line, '#ID')) {
                $parts = str_getcsv($line);
                if (isset($parts[3])) {
                    $idPerjalanan = trim($parts[3], '"');
                }
            }
        }
        fclose($handle);
    }

    return [
        'perangkat' => $perangkat,
        'id_perjalanan' => $idPerjalanan,
    ];
}

    
    /**
     * Membaca file GPX untuk koordinat dan waktu.
     */
    private function parseGpxAndNmfGps(string $gpxPath, string $nmfPath, int $perjalananId): array
    {
        $dataGPS = [];
        
        // --- 1. PARSING FILE GPX ---
        try {
            // Memuat file XML GPX
            $xml = simplexml_load_file($gpxPath);
            if ($xml === false) {
                 \Log::error("Gagal memuat file GPX.");
                 return [];
            }

            // Loop melalui setiap trkseg dan trkpt
            foreach ($xml->trk->trkseg->trkpt as $trkpt) {
                $lat = (float) $trkpt['lat'];
                $lon = (float) $trkpt['lon'];
                $time = (string) $trkpt->time; // Format 'YYYY-MM-DDTHH:MM:SS.sssZ'

                if ($lat !== 0.0 && $lon !== 0.0) {
                    $dataGPS[] = [
                        'perjalanan_id' => $perjalananId,
                        // Konversi format waktu ISO ke DateTime MySQL
                        'timestamp_waktu' => Carbon::parse($time)->toDateTimeString(), 
                        'latitude' => $lat,
                        'longitude' => $lon,
                        'altitude' => (float) $trkpt->ele, // Ambil elevasi
                        'sumber' => 'GPX',
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error saat parsing GPX:", ['message' => $e->getMessage()]);
        }
        
        // --- 2. (Opsional) PARSING FILE NMF UNTUK TITIK GPS NMF ---
        // Jika Anda ingin menggunakan titik GPS yang tercatat di NMF (misalnya, baris $POS), 
        // Anda perlu memanggil fungsi pembacaan NMF di sini dan menggabungkannya dengan $dataGPS.
        
        // Catatan: Biasanya, data GPX lebih akurat untuk koordinat yang berkelanjutan.

        return $dataGPS; 
    }

    /**
     * Membaca file NMF untuk data pengukuran sinyal (RSRP, RSRQ, PCI, dll.).
     * Menggunakan fopen/fgets untuk efisiensi.
     */
private function parseNmfSinyal(string $nmfPath, int $perjalananId): array
{
    $dataSinyal = [];
    $lineCount = 0;

    if (($handle = fopen($nmfPath, "r")) !== FALSE) {
        while (($line = fgets($handle)) !== FALSE) {
            $lineCount++;
            $line = trim($line);

            // Skip baris kosong atau metadata (header)
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            // Hanya proses baris CELLMEAS
            if (str_starts_with($line, 'CELLMEAS')) {
                $parts = str_getcsv($line); // lebih aman daripada explode

                try {
                    // === Perbaikan Timestamp ===
                $rawTime = $parts[1] ?? null;
                $timestamp = null;

                if ($rawTime && strlen($rawTime) === 14) { 
                    // format YYYYMMDDhhmmss
                    $timestamp = Carbon::createFromFormat('YmdHis', $rawTime)->toDateTimeString();
                } elseif ($rawTime && is_numeric($rawTime)) {
                    // format epoch (ms)
                    $timestamp = Carbon::createFromTimestampMs((int)$rawTime)->toDateTimeString();
                } elseif ($rawTime) {
                    try {
                        // format jam dengan millisecond (misalnya 09:14:49.401)
                        $timestamp = Carbon::createFromFormat('H:i:s.v', $rawTime)->toDateTimeString();
                    } catch (\Exception $e) {
                        \Log::warning("Format waktu tidak dikenali di baris $lineCount: ".$rawTime);
                    }
                }

                    // === Mapping field sesuai indeks ===
                    $dataSinyal[] = [
                        'perjalanan_id'    => $perjalananId,
                        'timestamp_waktu'  => $timestamp,
                        'teknologi'        => 'LTE',
                        'earfcn'           => (int)($parts[2] ?? null),
                        'pci'              => (int)($parts[3] ?? null),
                        'rsrp'             => (float)($parts[10] ?? null),
                        'rsrq'             => (float)($parts[11] ?? null),
                        'sinr'             => (float)($parts[12] ?? null),
                        'cell_id'          => $parts[7] ?? null,
                    ];
                } catch (\Exception $e) {
                    \Log::warning("Gagal parsing baris NMF ke-$lineCount", [
                        'line' => $line,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
        fclose($handle);
    }

    return $dataSinyal;
}



    public function edit(string $id) { /* ... */ }
    public function update(Request $request, string $id) { /* ... */ }
    public function destroy(string $id) { /* ... */ }
}