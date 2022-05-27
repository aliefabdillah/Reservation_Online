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
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alertAdmin', 'Anda Harus Login Terlebih Dahulu!');
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
                    Session::put('adminLogin',TRUE);

                    // ceritanya redirect ke landing dulu
                    return redirect()->route('showOrder');
                }
                else{
                    return redirect()->route('adminSignIn')->with('alertAdmin','Password, Salah !');
                }
            }
            else{
                return redirect()->route('adminSignIn')->with('alertAdmin','Email Belum Terdaftar!');
            }
        }else {
            if (empty($request->email) && empty($request->password)) {
                return redirect()->route('adminSignIn')->with('alertAdmin','Email atau Password Tidak Boleh Kosong!');
            }
            elseif (empty($request->email)) {
                return redirect()->route('adminSignIn')->with('alertAdmin','Email Tidak Boleh Kosong!');
            }
            elseif (empty($request->password)) {
                return redirect()->route('adminSignIn')->with('alertAdmin','Password Tidak Boleh Kosong!');
            }
        }
    }

    public function adminLogout(){
        Session::flush();
        return redirect()->route('adminSignIn')->with('alertAdmin','Anda Telah Logout!');
    }

}
