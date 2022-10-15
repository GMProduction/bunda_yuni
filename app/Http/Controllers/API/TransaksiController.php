<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Arr;

class TransaksiController extends Controller
{

    /**
     * @return mixed
     */
    public function index(){
        return Transaksi::where('user_id','=',auth()->id())->get();
    }

    public function detail($id){
        $trans = Transaksi::with('cart.barangs')->find($id);
        return $trans;
    }

    public function terima($id){
        $transaksi = Transaksi::find($id);

        if ($transaksi == null){
            return 'Pesanan tidak ditemukan';
        }

        if ($transaksi->status != 2 ) {
            return 'Pesanan belum dikirim';
        }
        $transaksi->update([
            'status' => 3
        ]);
        return 'berhasil';
    }


}
