<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showMenu(){
        $makanan = Menu::where('jenis', 'makanan')->get();
        $minuman = Menu::where('jenis', 'minuman')->get();
        dd($makanan, $minuman);
        return view('', compact($makanan, $minuman));
    }
}
