<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\HistoryLogController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/asset', function () {
    return view('asset', ['assets' => \App\Models\Asset::paginate(50)]);
})->middleware('auth');

Route::get('/history', [HistoryLogController::class, 'index'])->name('history.index')->middleware('auth');

Route::get('/maintenance/{year}/{month}/{day}', function ($year, $month, $day) {
    $maintenances = \App\Models\Maintenance::where('date', "{$year}-{$month}-{$day}")->get();
    $users = \App\Models\Asset::distinct('user')->pluck('user');
    return view('maintenance-day', compact('year', 'month', 'day', 'maintenances', 'users'));
})->middleware('auth');

Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store')->middleware('auth');

Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create')->middleware('auth');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store')->middleware('auth');
Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit')->middleware('auth');
Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update')->middleware('auth');
Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy')->middleware('auth');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
