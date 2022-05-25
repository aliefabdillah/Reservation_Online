<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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

        # data menu nya
        $makanan = Menu::where('jenis', 'makanan')->get();
        $minuman = Menu::where('jenis', 'minuman')->get();

        // menampilkan view menu
        return view('menu', compact($makanan, $minuman /** nanti data seat tambah sini */));
    }
}
