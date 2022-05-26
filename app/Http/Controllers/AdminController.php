<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }
    
    // menampilkan tabel tempat duduk
    public function showOrder()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel tempat duduk
            return view('admin.tabelOrder');
        }
    }

    // menampilkan tabel tempat duduk
    public function showTmptDuduk()
    {
        if (!Session::get('login')) {
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
                 ->where('is_available', 1);
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

    // menampilkan tabel Makanan
    public function showMakanan()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel makanan
            return view('admin.tabelMakanan');
        }
    }

    // menampilkan tabel Minuman
    public function showMinuman()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel minuman
            return view('admin.tabelMinuman');
        }
    }

    public function adminSignIn(){
        return view('form.adminSignIn');
    }

    public function adminSignInPost(Request $request){

        if (!empty($request->email) && !empty($request->password) ) {
            $email = $request->email;
            $password = md5($request->password);

            $data = Admin::where('email',$email)->first();
            if($data){ //apakah email tersebut ada atau tidak
                if($password == $data->password){
                    Session::put('id', $data->id);
                    Session::put('nama',$data->nama);
                    Session::put('email',$data->email);
                    Session::put('level', 'admin');
                    Session::put('login',TRUE);

                    // ceritanya redirect ke landing dulu
                    return redirect()->route('showOrder');
                }
                else{
                    return redirect()->route('adminSignIn')->with('alert','Password, Salah !');
                }
            }
            else{
                return redirect()->route('adminSignIn')->with('alert','Email Belum Terdaftar!');
            }
        }else {
            if (empty($request->email) && empty($request->password)) {
                return redirect()->route('adminSignIn')->with('alert','Email atau Password Tidak Boleh Kosong!');
            }
            elseif (empty($request->email)) {
                return redirect()->route('adminSignIn')->with('alert','Email Tidak Boleh Kosong!');
            }
            elseif (empty($request->password)) {
                return redirect()->route('adminSignIn')->with('alert','Password Tidak Boleh Kosong!');
            }
        }
    }

    public function adminLogout(){
        Session::flush();
        return redirect()->route('adminSignIn')->with('alert','Anda Telah Logout!');
    }

}
