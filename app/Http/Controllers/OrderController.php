<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Seat;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\InvoiceService;
use App\Services\Midtrans\CreateSnapTokenService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    public function checkout(Request $request){
        if(empty($request->menu)){
            return redirect()->back()->with('validate','Kode Tempat Duduk Salah!');
        }
        $order = Order::create([
            'waktu_reservasi' => Carbon::createFromFormat("H:i", $request->waktu),
            'order_status' => 0,
            'customer_id' => Session::get("id"),
            'seat_id' => $request->seat_id
        ]);
        $order->order_status = 1;
        $order->save();

        $seat = Seat::find($order->seat_id);
        $seat->is_available = 0;
        $seat->save();

        $qty = $request->qty;
        $total_harga_menu = 0;
        $menu = collect($request->menu)->map(function($item, $key) use ($qty, &$total_harga_menu, $order){
            $menuModel = Menu::find($item);
            $jumlah_pesan = $qty[$key];
            $total_harga_menu += $menuModel->harga*$jumlah_pesan;
            $items = [
                "jumlah_pesan" => $jumlah_pesan,
                "menu_id" => $item,
                "total_harga" => $menuModel->harga*$jumlah_pesan,
                "order_id" => $order->id,
            ];

            return $items;
        });

        OrderMenu::insert($menu->toArray());
        $order->total_harga = $total_harga_menu + 5000;
        $order->save();

        /* Mengurangi Stok Menu yang dipesan */
        $data_menu = OrderMenu::where('order_id', $order->id)->get();
        foreach($data_menu as $orderMenu){
            Menu::where('id', $orderMenu->menu_id)->decrement('stok', $orderMenu->jumlah_pesan);
        }

        $transaction = new Transaction([
            'order_id' => $order->id,
        ]);
        $transaction->save();
        $dp = $order->total_harga/2;
        $details = new TransactionDetail([
            'jenis_pembayaran' => "dp",
            'number' => InvoiceService::generateNumber(),
            'total_price' => $dp,
            'payment_status' => 1,
            'transaction_id' => $transaction->id,
            'sisa' => $order->total_harga-$dp
        ]);
        $details->save();
        $midtrans = new CreateSnapTokenService($details->id);
        $snapToken = $midtrans->getSnapToken($menu);
        $details->snap_token = $snapToken;
        $details->save();

        return redirect()->route('invoice', ['id'=>$details->id]);
    }

    public function showInvoice($id){
        $details = TransactionDetail::with("transaction")->find($id);
        return view('testPayment', compact('details'));
    }

    public function midtransNotification(Request $request){
        $tr = TransactionDetail::where("number", $request->order_id)->first();
        if($request->transaction_status == "settlement" || $request->transaction_status == "capture"){
            $tr->payment_status = 2;
            $tr->ts_dibayar = Carbon::now();
        }else{
            $tr->payment_status = 3;
        }
        $tr->save();
        return response()->json([
            'status'    => 200
        ],200);
    }
}
