<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_meja',
        'total',
        'no_transaksi',
        'user_id'
    ];

    public function cart(){
        return $this->hasMany(Keranjang::class,'transaksi_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
