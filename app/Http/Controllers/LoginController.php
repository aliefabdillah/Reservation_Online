<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function signIn()
    {
        return view('form.signIn');
    }

    public function register()
    {
        return view('form.register');
    }

    public function submitDataRegister()
    {
        // create ke database data pemesan


        // menampilkan register dan status pendaftaran
        return view('form.register');
    }
}
