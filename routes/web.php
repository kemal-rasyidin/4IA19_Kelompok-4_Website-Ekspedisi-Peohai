<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEntryController;
use App\Http\Controllers\FinanceEntryController;
use App\Http\Controllers\EntryPeriodController;
use App\Http\Controllers\StatusEntryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AnalyticsDashboardController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\TariffSimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('entry_periods', EntryPeriodController::class)->middleware(['auth', 'verified']);

Route::resource('entry_periods.finance_entries', FinanceEntryController::class)
    ->parameters(['finance_entries' => 'entry'])
    ->names('finance.entries')
    ->except(['create', 'store', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('entry_periods.marketing', MarketingController::class)
    ->parameters(['marketing' => 'entry'])
    ->names('marketing.entries')
    ->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(AdminEntryController::class)->group(function () {
        Route::get('entry_periods/{entry_period}/admin_entries/export', 'export')
            ->name('admin.entries.export');
        Route::get('entry_periods/{entry_period}/admin_entries/import', 'importForm')
            ->name('admin.entries.import.form');
        Route::post('entry_periods/{entry_period}/admin_entries/import', 'import')
            ->name('admin.entries.import');
        Route::delete('entry_periods/{entry_period}/admin_entries/bulk-destroy', 'bulkDestroy')
            ->name('admin.entries.bulkDestroy');
    });

    Route::resource('entry_periods.admin_entries', AdminEntryController::class)
        ->parameters(['admin_entries' => 'entry'])
        ->names('admin.entries');
});

Route::resource('entry_periods.status_entries', StatusEntryController::class)
    ->parameters(['status_entries' => 'entry'])
    ->names('status.entries')
    ->except(['create', 'store', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('admin/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(PartnerController::class)->group(function () {
        Route::get('partners/export', 'export')
            ->name('partners.export');
        Route::delete('partners/bulk-destroy', 'bulkDestroy')
            ->name('partners.bulkDestroy');
    });

    Route::resource('partners', PartnerController::class);
});

Route::delete('partners/bulk-destroy', [PartnerController::class, 'bulkDestroy'])
    ->name('partners.bulkDestroy')
    ->middleware(['auth', 'verified']);
Route::resource('partners', PartnerController::class)->middleware(['auth', 'verified']);

Route::delete('cities/bulk-destroy', [CityController::class, 'bulkDestroy'])
    ->name('cities.bulkDestroy')
    ->middleware(['auth', 'verified']);
Route::resource('cities', CityController::class)->middleware(['auth', 'verified']);

Route::get('/lacak', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/lacak/cari', [TrackingController::class, 'search'])->name('tracking.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/analytics_dashboard', [AnalyticsDashboardController::class, 'index'])->name('analytics_dashboard');
});

Route::get('/simulasi-tarif', [TariffSimulationController::class, 'index'])->name('tariff.simulation');
Route::post('/simulasi-tarif', [TariffSimulationController::class, 'simulate'])->name('tariff.simulate');

require __DIR__ . '/auth.php';
