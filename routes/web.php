<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeatController;
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

/* USER */
//landing page 
Route::get('/', [Controller::class,'landing'])->name('landing');                                            //route landing page

// tempat duduk
Route::get('/user/tempatDuduk', [SeatController::class,'formTmptDuduk'])->name('tmptDuduk');                    //route tempat duduk

// login
Route::get('/user/signIn', [LoginController::class,'signIn'])->name('signIn');                              //route menampilkan form sign in

Route::post('/user/signIn', [LoginController::class,'signInSubmit'])->name('submit.signIn');                //route melakukan proses login saat menekan tombol

Route::get('/user/register', [LoginController::class,'register'])->name('register');                        //route menampilkan form register

Route::post('/user/register', [LoginController::class,'submitDataRegister'])->name('submit.register');        //submit form register

// tampil menu sekaligus upload data tempat duduk
Route::post('/user/menu', [SeatController::class,'submitTmptDuduk'])->name('menu');                               //route submit data tempat duduk sekaligus tampil form menu

// tampil invoice sekaligus upload data menu
Route::post('/user/invoice', [Controller::class,'submitMenu'])->name('invoice');                             //submit/checkout form menu dan menampilkan invoice

// Validation
Route::get('/user/validation', [Controller::class,'validationSucces'])->name('validation');                 //tampil validation succes

Route::get('/user/validation', [Controller::class,'validationFailed'])->name('validation');                 //tampil validation failed


/* ADMIN */
// Login Page
Route::get('/admin/signIn', [AdminController::class,'adminSignIn'])->name('adminSignIn');              //route menampilkan form sign in untuk admin

// Submit Login dan tampilkan form berhasil login
Route::post('/admin/signIn', [AdminController::class,'adminSignInPost'])->name('signInPost');              //route untuk tombol submit login dan cek session

// Menampilkan tabel Tempat duduk
Route::get('/admin/dataTmptDuduk', [AdminController::class,'showTmptDuduk'])->name('showTmptDuduk');              //route menampilkan form sign in untuk admin