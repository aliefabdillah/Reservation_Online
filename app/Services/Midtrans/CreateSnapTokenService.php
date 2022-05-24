<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
	protected $transaction;

	public function __construct($transaction)
	{
		parent::__construct();

		$this->transaction = $transaction;
	}

	public function getSnapToken()
	{
		$params = [
			/**
			 * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
			 * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
			 * 'gross_amount' => merupakan total harga yang harus dibayar customer.
			 */
			'transaction_details' => [
				'order_id' => $this->transaction->number,
				'gross_amount' => $this->transaction->total_price,
			],
			/**
			 * 'item_details' bisa diisi dengan detail item dalam order.
			 * Umumnya, data ini diambil dari tabel `order_items`.
			 */
			'item_details' => [
				[
					'id' => 1, // primary key produk
					'price' => '150000', // harga satuan produk
					'quantity' => 1, // kuantitas pembelian
					'name' => 'Ini Nama Makanan', // nama produk
				],
				[
					'id' => 2,
					'price' => '60000',
					'quantity' => 2,
					'name' => 'Ini Nama Minuman',
				],
				[
					'id' => 3,
					'price' => '15000',
					'quantity' => 1,
					'name' => 'reservasi',
				]
			],
			'customer_details' => [
				// Key `customer_details` dapat diisi dengan data customer yang melakukan order.
				'first_name' => 'Martin Mulyo Syahidin',
				'email' => 'mulyosyahidin95@gmail.com',
				'phone' => '081234567890',
			]
		];

		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}
