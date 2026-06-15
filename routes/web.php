<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AdminUrlController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\UrlImportController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LandingController::class, 'index'])->name('home');

Route::get(
    '/developers',
    function () {
        return view('developers');
    }
)->name('developers');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','user_only'])->group(function () {

    Route::get('/dashboard', [UrlController::class, 'index'])->name('dashboard');
    Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
    Route::delete('/urls/{url}', [UrlController::class, 'destroy'])->name('urls.destroy');
    Route::get('/dashboard/data',[UrlController::class, 'data'])->name('dashboard.data');
    Route::get('/urls/{url}/edit',[UrlController::class, 'edit'])->name('urls.edit');
    Route::put('/urls/{url}',[UrlController::class, 'update'])->name('urls.update');
    Route::get('/urls/{url}/analytics',[UrlController::class, 'analytics'])->name('urls.analytics');
    

    Route::get('/qr/{url}', [QrCodeController::class, 'show'])->name('urls.qr');
    Route::get('/urls/{url}/qr/download',[QrCodeController::class, 'downloadQr'])->name('urls.qr.download');

    Route::post('/urls/import',[UrlImportController::class, 'store'])->name('urls.import');
    Route::get('/urls/sample-csv', [UrlImportController::class, 'sample'])->name('urls.sample');
});

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/',[AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users',[UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/data',[UserManagementController::class, 'data'])->name('users.data');
    Route::delete('/users/{user}',[UserManagementController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle-status',[UserManagementController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('/users/{user}',[UserManagementController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/urls/data',[UserManagementController::class, 'userUrlsData'])->name('users.urls.data');

    Route::get('/urls',[AdminUrlController::class, 'index'])->name('urls.index');
    Route::get('/urls/data',[AdminUrlController::class, 'data'])->name('urls.data');
    Route::patch('/urls/{url}/toggle-status',[AdminUrlController::class, 'toggleStatus'])->name('urls.toggle-status');
    Route::get('/urls/{url}/analytics',[AdminUrlController::class, 'analytics'])->name('urls.analytics');
    Route::get('/urls/{url}/analytics/data',[AdminUrlController::class, 'analyticsData'])->name('urls.analytics.data');

});

Route::middleware('auth')->group(function () {
    Route::get('/api-tokens',[ApiTokenController::class, 'index'])->name('api-tokens.index');
    Route::post('/api-tokens',[ApiTokenController::class, 'store'])->name('api-tokens.store');
    Route::delete('/api-tokens/{token}',[ApiTokenController::class, 'destroy'])->name('api-tokens.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{code}', [UrlController::class, 'redirect'])->name('redirect');
Route::get('/unlock/{url:short_code}',[UrlController::class, 'showPasswordForm'])->name('urls.unlock');
Route::post('/unlock/{url:short_code}',[UrlController::class, 'verifyPassword'])->name('urls.verify-password');