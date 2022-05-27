<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Seat;
use Carbon\Carbon;
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

            $tempatDuduk = Seat::select("id")->where('nama',$nama_tempatDuduk)->first()->id;
            if ($tempatDuduk) {
                # data menu nya
                $makanan = Menu::where('jenis', 'makanan')->get();
                $minuman = Menu::where('jenis', 'minuman')->get();

                // menampilkan view menu
                return view('testMenu', compact("makanan", "minuman", "waktu", "tempatDuduk"));
                // return view('menu', compact("makanan", "minuman", "waktu", "tempatDuduk"));
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
