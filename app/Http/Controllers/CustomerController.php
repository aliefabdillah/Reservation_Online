<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function adminLogout(){
        Session::flush();
        return redirect()->route('signIn')->with('alert','Anda Telah Logout!');
    }
}
