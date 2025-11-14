<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSRFBasicController;
use App\Http\Controllers\SSRFBlindController;
use App\Http\Controllers\SSRFGopherController;
use App\Http\Controllers\SSRFDNSRebindingController;

// Main lab index
Route::get('/', function () {
    return view('index');
})->name('home');

// ============================================
// SSRF Lab 1: Basic SSRF
// ============================================
Route::prefix('ssrf/basic')->group(function () {
    Route::get('/', [SSRFBasicController::class, 'index'])->name('ssrf.basic');
    Route::post('/check-availability', [SSRFBasicController::class, 'checkAvailability'])->name('ssrf.basic.check');
    Route::get('/internal-flag', [SSRFBasicController::class, 'internalFlag'])->name('ssrf.basic.flag');
});

// ============================================
// SSRF Lab 2: Blind SSRF (Port Scanning)
// ============================================
Route::prefix('ssrf/blind')->group(function () {
    Route::get('/', [SSRFBlindController::class, 'index'])->name('ssrf.blind');
    Route::post('/check-availability', [SSRFBlindController::class, 'checkAvailability'])->name('ssrf.blind.check');
});

// ============================================
// SSRF Lab 3: DNS Rebinding
// ============================================
Route::prefix('ssrf/dns-rebinding')->group(function () {
    Route::get('/', [SSRFDNSRebindingController::class, 'index'])->name('ssrf.dns');
    Route::post('/check-availability', [SSRFDNSRebindingController::class, 'checkAvailability'])->name('ssrf.dns.check');
    Route::post('/fetch', [SSRFDNSRebindingController::class, 'fetchUrl'])->name('ssrf.dns.fetch');
});

// Internal endpoint (simulates internal service)
Route::get('/internal/flag', [SSRFDNSRebindingController::class, 'internelFlag'])->name('internal.flag');
