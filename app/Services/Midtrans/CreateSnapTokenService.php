<?php

namespace App\Services\Midtrans;

use App\Models\TransactionDetail;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
	protected $details;

	public function __construct($detailsId)
	{
		parent::__construct();

		$this->details = TransactionDetail::with(["transaction.order.menus", "transaction.order.customer", "transaction.order.seat"])->find($detailsId);
        // dd($this->details);
	}

	public function getSnapToken()
	{
        $item_details = collect($this->details->transaction->order->menus)->map(function ($item){
            return [
                'id' => $item->pivot->id,
                'price' => $item->harga,
                'quantity' => $item->pivot->jumlah_pesan,
                'name' => $item->nama
            ];
        });

        $item_details = array_merge($item_details->toArray(), [
            [
                "name" => "Seat ". $this->details->transaction->order->seat->nama,
                "price" =>  5000, // total fee,tax,discount of 300+200-100
                "quantity"=> 1,
                "id"=> $this->details->transaction->order->seat->id,
            ],
            [
                "name" => "Sisa Pembayaran",
                "price" =>  -($this->details->transaction->order->total_harga/2), // total fee,tax,discount of 300+200-100
                "quantity"=> 1,
                "id"=> "D01"
            ]
        ]);


		$params = [
			/**
			 * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
			 * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
			 * 'gross_amount' => merupakan total harga yang harus dibayar customer.
			 */
			'transaction_details' => [
				'order_id' => $this->details->number,
				'gross_amount' => $this->details->total_price,
			],
			/**
			 * 'item_details' bisa diisi dengan detail item dalam order.
			 * Umumnya, data ini diambil dari tabel `order_items`.
			 */
			'customer_details' => [
				// Key `customer_details` dapat diisi dengan data customer yang melakukan order.
				'first_name' => $this->details->transaction->order->customer->nama,
				'email' => $this->details->transaction->order->customer->email,
				'phone' => $this->details->transaction->order->customer->telp,
            ],
		];

        $params["item_details"] = $item_details;
		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}
