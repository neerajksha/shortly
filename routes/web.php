<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\QrCodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [UrlController::class, 'index'])
        ->name('dashboard');

    Route::post('/urls', [UrlController::class, 'store'])
        ->name('urls.store');

    Route::delete('/urls/{url}', [UrlController::class, 'destroy'])
        ->name('urls.destroy');

    Route::get(
        '/dashboard/data',
        [UrlController::class, 'data']
    )->name('dashboard.data');

    Route::get('/qr/{url}', [QrCodeController::class, 'show'])
        ->name('urls.qr');
    Route::get(
    '/urls/{url}/qr/download',
    [QrCodeController::class, 'downloadQr']
        )->name('urls.qr.download');

    Route::get(
        '/urls/{url}/analytics',
        [UrlController::class, 'analytics']
    )->name('urls.analytics');
});

require __DIR__.'/auth.php';

Route::get('/{code}', [UrlController::class, 'redirect'])
    ->name('redirect');