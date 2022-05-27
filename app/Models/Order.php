<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'waktu_reservasi',
        'customer_id',
        'seat_id'
    ];

    public function menus(){
        return $this->belongsToMany(Menu::class, "order_menus")->withPivot('jumlah_pesan', 'total_harga');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function seat(){
        return $this->belongsTo(Seat::class);
    }
}
