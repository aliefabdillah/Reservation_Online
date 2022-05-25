<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const CREATED_AT = 'ts_dibuat';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
