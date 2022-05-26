<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;


class LoginController extends BaseController
{
    public function signIn()
    {
        return view('form.signIn');
    }

    public function signInSubmit(Request $request)
    {
        if (!empty($request->email) && !empty($request->password) ) {
            $email = $request->email;
            $password = md5($request->password);

            $data = Customer::where('email',$email)->first();
            if($data){ //apakah email tersebut ada atau tidak
                if($password == $data->password){
                    Session::put('id', $data->id);
                    Session::put('nama',$data->nama);
                    Session::put('email',$data->email);
                    Session::put('level', 'customer');
                    Session::put('login',TRUE);

                    // setelah login akan redirect ke form tempat duduk
                    return redirect()->route('tmptDuduk');
                }
                else{
                    return redirect()->route('signIn')->with('alert','Password, Salah !');
                }
            }
            else{
                return redirect()->route('signIn')->with('alert','Email Belum Terdaftar!');
            }
        }else {
            if (empty($request->email) && empty($request->password)) {
                return redirect()->route('signIn')->with('alert','Email atau Password Tidak Boleh Kosong!');
            }
            elseif (empty($request->email)) {
                return redirect()->route('signIn')->with('alert','Email Tidak Boleh Kosong!');
            }
            elseif (empty($request->password)) {
                return redirect()->route('signIn')->with('alert','Password Tidak Boleh Kosong!');
            }
        }
    }

    public function register()
    {
        return view('form.register');
    }

    public function submitDataRegister(Request $request)
    {
        // ambil dan validasi data dari form
        $validateData = $request->validate([
            'nama'          => 'required|min:3',
            'telp'          => 'required|min:12|max:15',
            'alamat'        => 'required',
            'email'         => 'required|min:4|email|unique:customers',
            'password'      => 'required|min:8',

        ]);

        // create ke database data pemesan
        // Customer::create($validateData);
        $data = new Customer();
        $data->nama = $validateData['nama'];
        $data->telp = $validateData['telp'];
        $data->alamat = $validateData['alamat'];
        $data->email = $validateData['email'];
        $data->password = md5($validateData['password']);
        $data->save();

        // menampilkan register dan status pendaftaran
        return redirect()->route('signIn')->with('alert-success', 'Register Berhasil!');
    }




}
