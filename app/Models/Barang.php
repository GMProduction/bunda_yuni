<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama',
        'image',
        'harga',
        'kategori',
        'description'
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
