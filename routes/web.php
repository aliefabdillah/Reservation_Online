<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', [Controller::class,'welcome'])->name('home.welcome');

Route::get('/signIn', [LoginController::class,'signIn'])->name('login.signIn');

Route::get('/register', [LoginController::class,'register'])->name('login.register');

Route::get('/end', [Controller::class,'checkoutValidation'])->name('end.validation');