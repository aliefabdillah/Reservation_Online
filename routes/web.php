<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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
Route::post('/testPayment', [OrderController::class, 'makeInvoice'])->name('check');
Route::get('/testPayment', function (){
    return view('test');
});
Route::get('/{transaction}', [TransactionDetailController::class, 'show']);

/* USER */
// NAVBAR BUTTON logout
Route::get('/user/logout', [CustomerController::class,'customerLogout'])->name('customerLogout');           //route logout pada navbar customer dan akan meredirect ke form login

//landing page
Route::get('/', [Controller::class,'landing'])->name('landing');                                            //route landing page

// tampil pilihan tempat duduk
Route::get('/user/tempatDuduk', [SeatController::class,'formTmptDuduk'])->name('tmptDuduk');                //route tempat duduk

// login
Route::get('/user/signIn', [LoginController::class,'signIn'])->name('signIn');                              //route menampilkan form sign in

Route::post('/user/signIn', [LoginController::class,'signInSubmit'])->name('submit.signIn');                //route melakukan proses login saat menekan tombol

Route::get('/user/register', [LoginController::class,'register'])->name('register');                        //route menampilkan form register

Route::post('/user/register', [LoginController::class,'submitDataRegister'])->name('submit.register');        //submit form register

// submit form tempat duduk
Route::post('/user/tempatDuduk', [SeatController::class,'submitTmptDuduk'])->name('submit.tempatDuduk');              //route ketika menekan submit data tempat duduk

// Menu
Route::get('/user/menu', [MenuController::class,'menu'])->name('menu');                                     //route menampilkan view menu

Route::post('/user/menu', [MenuController::class,'submitMenu'])->name('submit.menu');                       //route ketika menekan tombol checkout pada menu

// tampilkan view invoice 
Route::post('/user/invoice', [Controller::class,'invoice'])->name('invoice');                               //submit/checkout form menu dan menampilkan invoice

// Validation
Route::get('/user/validation', [Controller::class,'validationSucces'])->name('validation');                 //tampil validation succes

Route::get('/user/validation', [Controller::class,'validationFailed'])->name('validation');                 //tampil validation failed


/* ADMIN */
// Login Page
Route::get('/admin/signIn', [AdminController::class,'adminSignIn'])->name('adminSignIn');                   //route menampilkan form sign in untuk admin

// Submit Login dan tampilkan form berhasil login
Route::post('/admin/signIn', [AdminController::class,'adminSignInPost'])->name('signInPost');               //route untuk tombol submit login dan cek session

// Logout dari tampilan admin
Route::get('/admin/logout', [AdminController::class,'adminLogout'])->name('adminLogout');

// Menampilkan tabel Reservasi
Route::get('/admin/daftarOrder', [AdminController::class,'showOrder'])->name('showOrder');                                                  //route menampilkan Tabel Daftar Reservasi

// Menampilkan tabel Tempat duduk
Route::get('/admin/daftarTempatDuduk', [AdminController::class,'showTmptDuduk'])->name('showTmptDuduk');                                    //route menampilkan Tabel Tempat Duduk untuk Admin

// Fitur Pencarian Pada View Tempat Duduk
Route::get('/admin/daftarTempatDuduk/cari', [AdminController::class,'searchSeat'])->name('searchSeat');                                    //route menampilkan Tabel Tempat Duduk untuk Admin

// CRUD SEAT
Route::post('/admin/daftarTempatDuduk', [AdminController::class,'storeSeat'])->name('addSeat');                                             //route menambahkan data tempat duduk baru ke database

Route::put('/admin/daftarTempatDuduk/{seatId}', [AdminController::class,'updateStatusSeat'])->name('updateStatusSeat');                   //route menambahkan data tempat duduk baru ke database

Route::put('/admin/daftarTempatDuduk', [AdminController::class,'editSeat'])->name('editSeat');                             //route edit data seat

Route::delete('/admin/daftarTempatDuduk/{seatId}', [AdminController::class,'deleteSeat'])->name('deleteSeat');                   //route menghapus data seat dari database

// Menampilkan tabel Makanan
Route::get('/admin/makanan', [AdminController::class,'showMakanan'])->name('showMakanan');                      //route menampilkan tabel makanan 

// Menampilkan tabel Minuman
Route::get('/admin/minuman', [AdminController::class,'showMinuman'])->name('showMinuman');                      //route menampilkan tabel minuman
