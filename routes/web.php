<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;

Route::get('/dashboard', function () {
    $assets_with_maintenance = \App\Models\Asset::whereNotNull('last_maintenance')
        ->get()
        ->map(function ($asset) {
            $asset->next_maintenance = $asset->last_maintenance->copy()->addMonths(6);
            return $asset;
        });
    return view('dashboard', compact('assets_with_maintenance'));
})->middleware('auth');
Route::get('/asset', function () {
    return view('asset', ['assets' => \App\Models\Asset::all()]);
})->middleware('auth');

Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create')->middleware('auth');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store')->middleware('auth');
Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit')->middleware('auth');
Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update')->middleware('auth');
Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy')->middleware('auth');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
