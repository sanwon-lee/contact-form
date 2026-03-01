<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'create'])->name('contacts.create');
Route::post('confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

Route::middleware('auth')->group(function () {
    Route::get('admin', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('delete/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('export', [ContactController::class, 'export'])->name('contacts.export');

    // defined /search and /reset to meet the spec but not using them actually
    Route::get('search', [ContactController::class, 'index'])->name('contacts.search');
    Route::get('reset', fn() => redirect()->route('contacts.index'))->name('contacts.reset');
});
