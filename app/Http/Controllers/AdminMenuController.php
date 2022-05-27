<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }

    // menampilkan tabel Makanan
    public function showMakanan()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel makanan
            return view('admin.tabelMakanan');
        }
    }

    // menampilkan tabel Minuman
    public function showMinuman()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel minuman
            return view('admin.tabelMinuman');
        }
    }

}
