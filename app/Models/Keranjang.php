<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaksi_id',
        'qty',
        'harga',
        'total',
        'barang_id'
    ];

    public function barangs(){
        return $this->belongsTo(Barang::class,'barang_id');
    }

    public function barangs_all(){
        return $this->belongsTo(Barang::class,'barang_id')->withTrashed();
    }
}
