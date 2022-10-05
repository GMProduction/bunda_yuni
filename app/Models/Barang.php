<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'image',
        'harga',
        'kategori',
    ];

    public function scopeFilter($query, $filter)
    {
        $query->when(
            $filter ?? false,
            function ($q, $filter) {
                return $q->where('kategori', $filter);
            }
        );
    }
}
