<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }

    // menampilkan tabel daftar orderan
        public function showOrder()
        {
            if (!Session::get('adminLogin')) {
                return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
            }
            else {
                // redirect ke view tabel tempat duduk
                return view('admin.tabelOrder');
            }
        }
}