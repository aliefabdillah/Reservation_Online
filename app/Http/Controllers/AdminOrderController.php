<?php

namespace App\Http\Controllers;

use App\Models\Seat;
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
            $data_orders = Order::orderBy('orders.waktu_reservasi','ASC')->join('customers', 'customers.id', '=', 'orders.customer_id')
                            ->join('seats', 'seats.id', '=', 'orders.seat_id')
                            ->join('transactions', 'transactions.order_id', '=', 'orders.id')
                            ->leftJoin('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                            ->get(['orders.*', 'customers.nama', 'seats.nama AS kode_seat', 'transaction_details.sisa', 'transaction_details.payment_status']);
            return view('admin.tabelOrder', ['data_orders' => $data_orders]);
        }
    }

    public function searchOrder(Request $request)
    {
        $result = Order::where('orders.id', 'like', "%{$request->search}%")->orderBy('orders.waktu_reservasi','ASC')
                        ->join('customers', 'customers.id', '=', 'orders.customer_id')
                        ->join('seats', 'seats.id', '=', 'orders.seat_id')
                        ->join('transactions', 'transactions.order_id', '=', 'orders.id')
                        ->leftJoin('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->get(['orders.*', 'customers.nama', 'seats.nama AS kode_seat', 'transaction_details.sisa', 'transaction_details.payment_status']);
        
        return view('admin.tabelOrder', ['data_orders' => $result]);
    }

    // hapus data seat dari db
    public function changeStatusOrder(Request $request)
    {
        // ganti status orderan
        $data_order = Order::find($request->idOrder);
        $data_order->order_status = $request->status;
        $data_order->save();

        // jika status orderan di batalkan atau tidak ada
        if ($request->status == 4 || $request->status == 5) {
            $data_orderMenu = OrderMenu::where('order_id', $request->idOrder)->get();
            foreach($data_orderMenu as $orderMenu){
                Menu::where('id', $orderMenu->menu_id)->increment('stok', $orderMenu->jumlah_pesan);
            }
        }

        if ($request->status == 3) {
            $seat = Seat::find($data_order->seat_id);
            $seat->is_available = 1;
            $seat->save();
        }
        
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