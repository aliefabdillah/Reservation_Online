<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminSeatController extends Controller
{
    public function __construct()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }

    // menampilkan tabel tempat duduk
    public function showTmptDuduk()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel tempat duduk
            $seats = Seat::all();
            return view('admin.tabelTmptDuduk', ['seats' => $seats]);
        }
    }

    // search data tempat duduk
    public function searchSeat(Request $request)
    {
        $result = Seat::when($request->search, function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->search}%")
                 ->where('is_available', 1)
                 ->orWhere('is_available', 0);
        })->paginate(5);

        return view('admin.tabelTmptDuduk', ['seats' => $result]);
    }

    /* ===== CRUD SEAT START ====== */
    // insert data tempat duduk ke database
    public function storeSeat(Request $request)
    {
        $kode_validate = $request->kodeSeat;

        $data = new Seat();
        $data->nama = $kode_validate;
        $data->save();

        return redirect()->route('showTmptDuduk')->with('pesan',"Penambahan data berhasil");
    }

    // update status seat
    public function updateStatusSeat($id)
    {
        $data = Seat::find($id);
        if ($data->is_available == 1) {
            $data->is_available = 0;
        }
        else {
            $data->is_available = 1;
        }
        $data->save();
        return redirect()->route('showTmptDuduk')->with('pesan',"Mengganti Status Seat {$data->nama} berhasil");
    }

    // update data seat
    public function editSeat(Request $request)
    {
        $kode_validate = $request->updateKodeSeat;
        $id = $request->updateIdSeat;
        $data_update = Seat::find($id);
        $data_update->nama = $kode_validate;
        $data_update->save();
        return redirect()->route('showTmptDuduk')->with('pesan',"Update data Seat {$kode_validate} berhasil");
    }

    // hapus data seat dari db
    public function deleteSeat($id)
    {
        $data = Seat::find($id);
        $kode_seat = $data->nama;
        Seat::destroy($id);
        return redirect()->route('showTmptDuduk')->with('pesan',"Menghapus Seat {$kode_seat} berhasil");
    }
    /* ===== CRUD SEAT END ====== */

}
