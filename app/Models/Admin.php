<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'password',
        'telp',
        'alamat',
        // atribut lain yang diizinkan untuk pengisian massal
    ];
    use HasFactory;
}
