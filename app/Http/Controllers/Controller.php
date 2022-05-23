<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function landing()
    {
        return view('landing');
    }
    
    public function formTmptDuduk()
    {
        return view('formTmptDuduk');
    }

    public function submitTmptDuduk()
    {
        # upload data pesanan tempat duduk ke database

        // menampilkan view menu
        return view('menu');
    }

    public function submitMenu()
    {
        # upload data menu yang dipilih ke database

        // menampilkan view invoice
        return view('invoice');
    }

    public function validationSucces()
    {
        return view('validationSucces');
    }
    
    public function validationFailed()
    {
        return view('validationFailed');
    }

}
