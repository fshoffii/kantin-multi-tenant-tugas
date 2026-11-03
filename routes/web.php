<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard', ['user' => request()->user()]);
    })->name('dashboard');
});

require __DIR__.'/settings.php';
