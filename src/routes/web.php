<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactController::class, 'create'])->name('contact.create');
Route::post('confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('back', [ContactController::class, 'back'])->name('contact.back');
Route::get('thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

Route::middleware('auth')->group(function () {
    Route::get('admin', [ContactController::class, 'index'])->name('contact.admin');
    Route::post('search', [ContactController::class, 'index'])->name('contact.search');
    Route::post('reset', [ContactController::class, 'index'])->name('contact.reset');
    Route::post('delete', [ContactController::class, 'destroy'])->name('contact.destroy');
});
