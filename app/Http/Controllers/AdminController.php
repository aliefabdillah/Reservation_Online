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
            // ceritanya pake landing page dlu karena ui table tempat duduk nya blom jadi
            return view('landing');
        }
    }
    
    public function adminSignIn(){
        return view('form.adminSignIn');
    }

    public function adminSignInPost(Request $request){

        $email = $request->email;
        $password = md5($request->password);

        $data = Admin::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if($password == $data->password){
                Session::put('nama',$data->nama);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect()->route('showTmptDuduk');
            }
            else{
                return redirect()->route('adminSignIn')->with('alert','Password, Salah !');
            }
        }
        else{
            return redirect()->route('adminSignIn')->with('alert','Email Belum Terdaftar!');
        }
    }
    
}
