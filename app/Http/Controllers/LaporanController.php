<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trans = Transaksi::with('user_all');
        $start = \request('start');
        $end = \request('end');
        if (\request('start')){
            $trans = $trans->whereBetween('created_at', ["$start 00:00:00", "$end 23:59:59"]);
        }
        $trans = $trans->get();
        return view('admin.laporan', ['sidebar' => 'laporan', 'data' => $trans]);
    }

    public function detail($id){
        $cart = Keranjang::with('barangs')->where('transaksi_id','=',$id)->get();
        return $cart;
    }
}
