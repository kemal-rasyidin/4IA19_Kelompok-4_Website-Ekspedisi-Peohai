<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEntryDateController;
use App\Http\Controllers\AdminEntryDataController;
use App\Http\Controllers\AdminEntryController;
use App\Http\Controllers\FinanceEntryController;
use App\Http\Controllers\EntryPeriodController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/admin', function () {
//     return view('admin/home');
// });

Route::resource('entry_periods', EntryPeriodController::class)->middleware(['auth', 'verified']);

// Nested resource untuk Admin Entry
Route::resource('entry_periods.admin_entries', AdminEntryController::class)
    ->parameters(['admin_entries' => 'entry'])
    ->names('admin.entries')
    ->middleware(['auth', 'verified']);

// Nested resource untuk Finance Entry
Route::resource('entry_periods.finance_entries', FinanceEntryController::class)
    ->parameters(['finance_entries' => 'entry'])
    ->names('finance.entries')
    ->except(['create', 'store', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('admin/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/admin_entry_dates', AdminEntryDateController::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admin_entry_dates', AdminEntryDateController::class);
    Route::resource('admin_entry_dates.admin_entry_datas', AdminEntryDataController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
