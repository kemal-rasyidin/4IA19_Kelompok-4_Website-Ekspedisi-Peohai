<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEntryDateController;
use App\Http\Controllers\AdminEntryDataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::get('/admin', function () {
//     return view('admin/home');
// });

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
