<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function show(TransactionDetail $transaction)
    {
        $snapToken = $transaction->snap_token;
        // dd($transaction);
        if (is_null($snapToken) || $transaction->payment_status == '3') {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($transaction);
            $snapToken = $midtrans->getSnapToken();

            $transaction->snap_token = $snapToken;
            $transaction->save();
        }

        return view('testPayment', compact('transaction', 'snapToken'));
    }
}
