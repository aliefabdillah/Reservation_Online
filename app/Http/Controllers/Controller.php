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

    public function submitMenu()
    {
        # upload data menu yang dipilih ke database

        // menampilkan view invoice
        return view('invoice');
    }
}
