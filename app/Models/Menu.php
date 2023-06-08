<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'stok',
        'foto',
        // atribut lain yang diizinkan untuk pengisian massal
    ];
    
    protected $guarded = [];

    public function order(){
        return $this->belongsToMany(Order::class, "order_menus");
    }
}
