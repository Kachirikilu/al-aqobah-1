<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JadwalCeramahController;
use App\Http\Controllers\DashboardController;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

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
