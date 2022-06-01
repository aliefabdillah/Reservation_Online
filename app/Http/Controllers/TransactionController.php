<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function validationStatus($status)
    {
        return view('checkoutValidation', ['status' => $status]);
    }
}
