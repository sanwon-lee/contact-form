<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::middleware('auth')->get('/admin', function () {
    return view('admin.index');
});
