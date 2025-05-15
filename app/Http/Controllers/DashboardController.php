<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalCeramah;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $today;
    protected $nowTime;
    protected $startOfWeek;
    protected $endOfWeek;
    protected $startOfNextWeek;
    protected $endOfNextWeek;
    protected $startOfLastWeek;
    protected $endOfLastWeek;
    protected $jadwalHariIni;
    protected $jadwalBelumTerlaksanaCount;
    protected $jadwalSudahTerlaksanaCount;
    protected $totalJadwalCount;
    protected $jadwalMingguIni;
    protected $jadwalMingguDepan;
    protected $jadwalMingguSelanjutnya;
    protected $jadwalSudahTerlaksana;

    public function __construct()
    {
        $this->jadwal();
    }

    public function jadwal()
    {
        $now = Carbon::now();
        $this->today = $now->toDateString();
        $this->nowTime = $now->toTimeString();

        $this->startOfWeek = $now->startOfWeek()->format('Y-m-d');
        $this->endOfWeek = $now->endOfWeek()->format('Y-m-d');

        $nextWeek = $now->copy()->addWeek();
        $this->startOfNextWeek = $nextWeek->startOfWeek()->format('Y-m-d');
        $this->endOfNextWeek = $nextWeek->endOfWeek()->format('Y-m-d');

        $lastWeek = $now->copy()->subWeek();
        $this->startOfLastWeek = $lastWeek->startOfWeek()->format('Y-m-d');
        $this->endOfLastWeek = $lastWeek->endOfWeek()->format('Y-m-d');

        $this->jadwalHariIni = JadwalCeramah::where('tanggal_ceramah', $this->today)
            ->orderBy('jam_mulai')
            ->get();

        $this->jadwalBelumTerlaksanaCount = JadwalCeramah::where('tanggal_ceramah', '>=', $this->today)->count();
        $this->jadwalSudahTerlaksanaCount = JadwalCeramah::where('tanggal_ceramah', '<', $this->today)->count();
        $this->totalJadwalCount = JadwalCeramah::count();

        $this->jadwalMingguIni = JadwalCeramah::whereBetween('tanggal_ceramah', [$this->startOfWeek, $this->endOfWeek])
            ->orderByDesc('tanggal_ceramah')
            ->orderByDesc('jam_mulai')
            ->get();

        $this->jadwalMingguDepan = JadwalCeramah::whereBetween('tanggal_ceramah', [$this->startOfNextWeek, $this->endOfNextWeek])
            ->orderByDesc('tanggal_ceramah')
            ->orderByDesc('jam_mulai')
            ->get();

        $this->jadwalMingguSelanjutnya = JadwalCeramah::where('tanggal_ceramah', '>', $this->endOfNextWeek)
            ->orderByDesc('tanggal_ceramah')
            ->orderByDesc('jam_mulai')
            ->paginate(9);

        $this->jadwalSudahTerlaksana = JadwalCeramah::where(function ($query) {
            $query->where('tanggal_ceramah', '<', $this->today)
                ->orWhere(function ($q) {
                    $q->where('tanggal_ceramah', $this->today)
                        ->where('jam_mulai', '<=', $this->nowTime);
                });
        })
            ->orderByDesc('tanggal_ceramah')
            ->orderByDesc('jam_mulai')
            ->paginate(10);
    }

    public function index()
    {
        return view('dashboard', [
            'jadwalBelumTerlaksanaCount' => $this->jadwalBelumTerlaksanaCount,
            'jadwalSudahTerlaksanaCount' => $this->jadwalSudahTerlaksanaCount,
            'totalJadwalCount' => $this->totalJadwalCount,
            'jadwalMingguIni' => $this->jadwalMingguIni,
            'jadwalMingguDepan' => $this->jadwalMingguDepan,
            'jadwalMingguSelanjutnya' => $this->jadwalMingguSelanjutnya,
            'jadwalSudahTerlaksana' => $this->jadwalSudahTerlaksana,
            'jadwalHariIni' => $this->jadwalHariIni,
        ]);
    }

    
    public function user()
    {
        return view('user-interface', [
            'jadwalBelumTerlaksanaCount' => $this->jadwalBelumTerlaksanaCount,
            'jadwalSudahTerlaksanaCount' => $this->jadwalSudahTerlaksanaCount,
            'totalJadwalCount' => $this->totalJadwalCount,
            'jadwalMingguIni' => $this->jadwalMingguIni,
            'jadwalMingguDepan' => $this->jadwalMingguDepan,
            'jadwalMingguSelanjutnya' => $this->jadwalMingguSelanjutnya,
            'jadwalSudahTerlaksana' => $this->jadwalSudahTerlaksana,
            'jadwalHariIni' => $this->jadwalHariIni,
        ]);
    }
}