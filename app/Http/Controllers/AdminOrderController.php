<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login Terlebih Dahulu!');
        }
    }

    // menampilkan tabel daftar orderan
    public function showOrder()
    {
        if (!Session::get('adminLogin')) {
            return redirect()->route('adminSignIn')->with('alert', 'Anda Harus Login!');
        }
        else {
            // redirect ke view tabel tempat duduk
            $data_orders = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
                            ->join('seats', 'seats.id', '=', 'orders.seat_id')
                            ->get(['orders.*', 'customers.nama', 'customers.telp', 'seats.nama AS kode_seat']);
            return view('admin.tabelOrder', ['data_orders' => $data_orders]);
        }
    }

    // hapus data seat dari db
    public function deleteOrder($id)
    {
        Order::destroy($id);
        OrderMenu::where('order_id',$id)->delete();
        return redirect()->route('showOrder')->with('pesan',"Menghapus Dafter Order berhasil");
    }
}