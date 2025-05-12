<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\JadwalCeramahController;
use App\Http\Controllers\Admin\APIController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/proxy/jadwal-sholat', function (Request $request) {
//     $idKota = $request->query('idKota', '0816');
//     $today = $request->query('today', now()->format('Y-m-d'));

//     $response = Http::get("https://api.myquran.com/v2/sholat/jadwal/{$idKota}/{$today}");
//     return $response->json();
// });
Route::get('/api/jadwal-ceramahs', [APIController::class, 'index']);
Route::get('/api/jadwal-ceramahs/{slug}', [APIController::class, 'show']);


Route::get('/', [DashboardController::class, 'user'])->name('user');
Route::get('/schedules/show/{slug}', [JadwalCeramahController::class, 'show'])->name('admin.schedules.show');

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

});
