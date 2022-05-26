<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function formTmptDuduk()
    {
        return view('v_testSeat');
    }

    public function submitTmptDuduk(Request $request)
    {
        # upload data pesanan tempat duduk view menu
        if (!empty($request->waktu) && !empty($request->tempatDuduk)) {
            $waktu = $request->waktu;
            $nama_tempatDuduk = $request->tempatDuduk;
            
            $tempatDuduk = Seat::where('nama',$nama_tempatDuduk)->first();
            if ($tempatDuduk) {
                # data menu nya
                $makanan = Menu::where('jenis', 'makanan')->get();
                $minuman = Menu::where('jenis', 'minuman')->get();
        
                // menampilkan view menu
                return view('menu', compact($makanan, $minuman, "waktu", "tempatDuduk"));
            }
            else {
                return redirect()->route('tmptDuduk')->with('alert','Kode Tempat Duduk Salah!');
            }
        }
        else {
            if (empty($request->waktu) && empty($request->tempatDuduk)) {
                return redirect()->route('tmptDuduk')->with('alert','Waktu Kedatangan atau Tempat Duduk Tidak Boleh Kosong!');
            }
            elseif (empty($request->waktu)) {
                return redirect()->route('tmptDuduk')->with('alert','Waktu Kedatangan Tidak Boleh Kosong!');
            }
            elseif (empty($request->tempatDuduk)) {
                return redirect()->route('tmptDuduk')->with('alert','Tempat Duduk Tidak Boleh Kosong!');
            }
        }

    }
}
