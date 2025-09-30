<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\JadwalCeramahController;
use App\Http\Controllers\Admin\JsonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\TelkominfraController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/proxy/jadwal-sholat', function (Request $request) {
//     $idKota = $request->query('idKota', '0816');
//     $today = $request->query('today', now()->format('Y-m-d'));

//     $response = Http::get("https://api.myquran.com/v2/sholat/jadwal/{$idKota}/{$today}");
//     return $response->json();
// });
Route::get('/api/jadwal-ceramahs', [JsonController::class, 'index']);
Route::get('/api/jadwal-ceramahs/{slug}', [JsonController::class, 'show']);


Route::get('/', [DashboardController::class, 'user'])->name('user');
Route::get('/schedules/show/{slug}', [JadwalCeramahController::class, 'show'])->name('admin.schedules.show');
Route::get('/iot/all-data/{id}', [ApiController::class, 'allData'])->name('admin.iot.allData');

Route::get('/telkominfra', [TelkominfraController::class, 'index'])->name('telkominfra.index');
Route::get('/telkominfra/{id}', [TelkominfraController::class, 'show'])->name('telkominfra.show');
Route::get('perjalanan/create', [TelkominfraController::class, 'create'])->name('perjalanan.create');
Route::post('perjalanan', [TelkominfraController::class, 'store'])->name('perjalanan.store');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('schedules', JadwalCeramahController::class)->names([
        'index' => 'admin.schedules.index',
        'create' => 'admin.schedules.create',
        'store' => 'admin.schedules.store',
        // 'show' => 'admin.schedules.show',
        'edit' => 'admin.schedules.edit',
        'update' => 'admin.schedules.update',
        'destroy' => 'admin.schedules.destroy',
    ]);

    Route::get('/esp32Cam', [ApiController::class, 'getData']);
    Route::get('/esp32Cam_motion', [ApiController::class, 'getMotion']);
});
