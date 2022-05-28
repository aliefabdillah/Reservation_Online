<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_pembayaran' => "dp",
            'number',
            'total_price',
            'payment_status',
            'transaction_id',
            'sisa'
    ];

    protected $dates = ['ts_dibayar'];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
