<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeatController extends Controller
{
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
}
