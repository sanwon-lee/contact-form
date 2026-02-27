<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'create'])->name('contacts.create');
Route::post('confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::get('thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

Route::middleware('auth')->group(function () {
    Route::get('admin', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('search', [ContactController::class, 'index'])->name('contacts.search');
    Route::post('reset', [ContactController::class, 'index'])->name('contacts.reset');
    Route::delete('delete/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('export', [ContactController::class, 'export'])->name('contacts.export');
});
