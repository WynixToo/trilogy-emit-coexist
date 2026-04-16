<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/auth/login');
})->name('home');

Route::get('/auth/login', function(){
    return view('login');
});

Route::post('/login',[\App\Http\Controllers\UserController::class,'login'])->name('login');
Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout'])->name('logout');
Route::get('/announcement-list',[\App\Http\Controllers\AnnouncementController::class,'index'])->name('announcement-list');
