<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function customerLogout(){
        Session::flush();
        return redirect()->route('tmptDuduk');
    }
}
