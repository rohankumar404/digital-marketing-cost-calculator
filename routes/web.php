<?php

use Illuminate\Support\Facades\Route;

// Main Landing Page (Calculator)
Route::get('/', function () {
    return view('calculator.index');
})->name('calculator');

// Dashboard (List user's calculations)
Route::get('/dashboard', function () {
    $calculations = auth()->user()->calculations()->latest()->get();
    return view('dashboard', compact('calculations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/calculations', [App\Http\Controllers\CalculationController::class, 'store'])->name('calculations.store');
Route::get('/calculations/{id}', [App\Http\Controllers\CalculationController::class, 'show'])->name('calculations.show');
Route::post('/calculations/{id}/proposal', [App\Http\Controllers\ProposalController::class, 'store'])->name('proposals.store');
Route::post('/leads', [App\Http\Controllers\LeadController::class, 'store'])->name('leads.store');

// Admin Routes
Route::prefix('admin')->middleware(['auth', App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('admin.users');
    Route::get('/leads', [App\Http\Controllers\Admin\AdminController::class, 'leads'])->name('admin.leads');
    Route::get('/leads/export', [App\Http\Controllers\Admin\AdminController::class, 'exportLeads'])->name('admin.leads.export');
    
    Route::get('/pricing', [App\Http\Controllers\PricingSettingController::class, 'index'])->name('admin.pricing.index');
    Route::patch('/pricing', [App\Http\Controllers\PricingSettingController::class, 'update'])->name('admin.pricing.update');

    Route::get('/settings', [App\Http\Controllers\Admin\GeneralSettingController::class, 'index'])->name('admin.settings.index');
    Route::patch('/settings', [App\Http\Controllers\Admin\GeneralSettingController::class, 'update'])->name('admin.settings.update');
    Route::post('/settings/currency', [App\Http\Controllers\Admin\GeneralSettingController::class, 'addCurrency'])->name('admin.settings.currency.add');
    Route::delete('/settings/currency/{id}', [App\Http\Controllers\Admin\GeneralSettingController::class, 'deleteCurrency'])->name('admin.settings.currency.delete');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// OTP Verification Routes
Route::get('/verify-email-code', [App\Http\Controllers\Auth\EmailVerificationController::class, 'show'])->name('verification.code');
Route::post('/verify-email-code', [App\Http\Controllers\Auth\EmailVerificationController::class, 'verify'])->name('verification.verify');

require __DIR__.'/auth.php';
