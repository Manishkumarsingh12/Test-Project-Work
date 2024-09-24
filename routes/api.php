<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::get('addPage', [PostController::class, 'addPage'])->name('addPage');
Route::get('loginPage', [PostController::class, 'loginPage'])->name('loginPage');
Route::get('Dashborad', [PostController::class, 'Dashborad'])->name('Dashborad');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('registration', [AuthController::class, 'registration'])->name('registration');