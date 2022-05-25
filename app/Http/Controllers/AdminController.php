<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // menampilkan tabel tempat duduk
    public function showTmptDuduk()
    {
        if (!Session::get('login')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel tempat duduk
            return view('admin.tabelTmptDuduk');
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
                    return redirect()->route('showTmptDuduk');
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
