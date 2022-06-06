<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminMenuController extends Controller
{
    public function __construct()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }

    // menampilkan tabel Makanan
    public function showMakanan()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            $foods = Menu::all()->where('jenis','makanan');
            // redirect ke view tabel makanan
            return view('admin.tabelMakanan', ['foods' => $foods]);
        }
    }

    // menampilkan tabel Minuman
    public function showMinuman()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            $drinks = Menu::all()->where('jenis','minuman');
            // redirect ke view tabel minuman
            return view('admin.tabelMinuman', ['drinks' => $drinks]);
        }
    }

    public function searchMenu(Request $request, $kategori)
    {
        $result = Menu::select('*')
                ->where('nama', 'like', "%{$request->search}%")
                ->where('jenis', $kategori)
                ->orwhere('harga', 'like', "%{$request->search}%")
                ->orWhere('stok', 'like', "%{$request->search}%")
                ->get();
        
        if ($kategori == 'makanan') {
            return view('admin.tabelMakanan', ['foods' => $result]);
        }
        else {
            return view('admin.tabelMinuman', ['drinks' => $result]);
        }
    }

    // insert data menu ke database
    public function addMenu(Request $request, $kategori)
    {
        // ambil dan validasi data dari form
        $validateData = $request->validate([
            'nama'          => 'required|regex:/^[a-zA-Z]+$/u|unique:menus',
            'harga'         => 'required|numeric',
            'stok'         => 'required|numeric',

        ]);

        $data = new Menu();
        $data->nama = $validateData['nama'];
        $data->jenis = $kategori;
        $data->harga = $validateData['harga'];
        $data->stok = $validateData['stok'];
        $data->save();
        
        if ($kategori == 'makanan') {
            return redirect()->route('showMakanan')->with('pesan',"Penambahan data berhasil");
        }
        else {
            return redirect()->route('showMinuman')->with('pesan',"Penambahan data berhasil");
        }
    }

    // update data menu
    public function editMenu(Request $request, $kategori)
    {
        $data_update = Menu::find($request->id);
        // ambil dan validasi data dari form
        $validateData = $request->validate([
            'nama'          => 'required|regex:/^[\pL\s\-]+$/u',
            'harga'         => 'required|numeric',
            'stok'         => 'required|numeric',

        ]);

        $data_update->nama = $validateData['nama'];
        $data_update->harga = $validateData['harga'];
        $data_update->stok = $validateData['stok'];
        $data_update->save();

        if ($kategori == 'makanan') {
            return redirect()->route('showMakanan')->with('pesan',"Update data Menu {$request->namaMenu} berhasil");
        }else{
            return redirect()->route('showMinuman')->with('pesan',"Update data Menu {$request->namaMenu} berhasil");
        }
    }

    // hapus data menu dari db
    public function deleteMenu($id)
    {
        $data = Menu::find($id);
        $nama_menu = $data->nama;
        $kategori = $data->jenis;
        Menu::destroy($id);

        if ($kategori == 'makanan') {
            return redirect()->route('showMakanan')->with('pesan',"Menghapus Menu {$nama_menu} berhasil");
        }
        else {
            return redirect()->route('showMinuman')->with('pesan',"Menghapus Menu {$nama_menu} berhasil");
        }
    }

}
