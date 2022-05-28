<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Menu;
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
                            ->join('transactions', 'transactions.order_id', '=', 'orders.id')
                            ->leftJoin('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                            ->get(['orders.*', 'customers.nama', 'seats.nama AS kode_seat', 'transaction_details.sisa', 'transaction_details.payment_status']);
            return view('admin.tabelOrder', ['data_orders' => $data_orders]);
        }
    }

    public function searchOrder(Request $request)
    {
        $result = Order::where('orders.id', 'like', "%{$request->search}%")
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->join('seats', 'seats.id', '=', 'orders.seat_id')
                        ->get(['orders.*', 'customers.nama', 'customers.telp', 'seats.nama AS kode_seat']);
        
        return view('admin.tabelOrder', ['data_orders' => $result]);
    }

    // hapus data seat dari db
    public function changeStatusOrder(Request $request)
    {
        $data_order = Order::find($request->idOrder);
        $data_order->order_status = $request->status;
        // print_r($request->idOrder);
        $data_order->save();
        return redirect()->route('showOrder')->with('pesan',"Update Status Order berhasil");
    }

    // hapus data seat dari db
    public function detailOrder($id)
    {
        $detailOrders = OrderMenu::where('order_menus.order_id', $id)
            ->join('menus', 'menus.id', '=', 'order_menus.menu_id')
            ->get(['order_menus.*', 'menus.nama', 'menus.harga']);
        // $res = compact('detailOrders');
        // print_r($res);
        return view('admin.detailOrderModal', ['detail_orders' => $detailOrders]);
    }
}