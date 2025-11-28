<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEntryController;
use App\Http\Controllers\FinanceEntryController;
use App\Http\Controllers\EntryPeriodController;
use App\Http\Controllers\StatusEntryController;
use App\Http\Controllers\LogisticSimulationController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('entry_periods', EntryPeriodController::class)->middleware(['auth', 'verified']);

Route::resource('entry_periods.admin_entries', AdminEntryController::class)
    ->parameters(['admin_entries' => 'entry'])
    ->names('admin.entries')
    ->middleware(['auth', 'verified']);

Route::resource('entry_periods.finance_entries', FinanceEntryController::class)
    ->parameters(['finance_entries' => 'entry'])
    ->names('finance.entries')
    ->except(['create', 'store', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('entry_periods.status_entries', StatusEntryController::class)
    ->parameters(['status_entries' => 'entry'])
    ->names('status.entries')
    ->except(['create', 'store', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/home', function () {
    return view('admin/home');
})->middleware(['auth', 'verified'])->name('home');

Route::resource('partners', PartnerController::class)->middleware(['auth', 'verified']);

Route::get('/simulasi', [LogisticSimulationController::class, 'index'])->name('logistic.simulation');
Route::post('/logistic/calculate', [LogisticSimulationController::class, 'calculate'])->name('logistic.calculate');

Route::get('/lacak', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/lacak/cari', [TrackingController::class, 'search'])->name('tracking.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'getAnalytics'])->name('dashboard.analytics');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');
});

require __DIR__ . '/auth.php';
