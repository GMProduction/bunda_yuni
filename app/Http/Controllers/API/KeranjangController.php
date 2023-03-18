<?php

namespace App\Http\Controllers\API;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

class KeranjangController
{

    public function index()
    {
        if (request()->isMethod('POST')) {
            return $this->create();
        }

        $cart = Keranjang::with('barangs')->where([['user_id', '=', auth()->id()], ['transaksi_id', null]])->get();

        $data = [];
        foreach ($cart as $c){
            if ($c->barangs){
                $data[] = $c;
            }
        }
        return $data;
    }

    public function create()
    {
        $field = request()->validate(
            [
                'qty'       => 'required',
                'barang_id' => 'required|exists:barangs,id',
                    'harga'     => 'required',
            ]
        );

        Arr::set($field, 'user_id', auth()->id());
        $total = $field['qty'] * $field['harga'];
        Arr::set($field, 'total', $total);

        if (request('id')) {
            $cart = Keranjang::find(request('id'));
            $cart->update($field);
        } else {
            $cart = new Keranjang();
            $cart->create($field);
        }

        return 'berhasil';
    }

    public function checkout()
    {

        $field = request()->validate(
            [
                'tanggal' => 'required',
                'jam' => 'required'
            ]
        );

        $date = new \DateTime($field['tanggal'].' '.$field['jam']);
        $keranjang   = Keranjang::with('barangs_all')->where([['user_id', '=', auth()->id()], ['transaksi_id', '=', null]])->get();

        foreach ($keranjang as $k){
            if ($k->barangs_all->deleted_at != null){
                Keranjang::destroy($k->id);
            }
        }

        $total       = Keranjang::where([['user_id', '=', auth()->id()], ['transaksi_id', '=', null]])->sum('total');

        $notransaksi = \date('ymdhis').auth()->id();
        Arr::set($field, 'total', $total);
        Arr::set($field, 'user_id', auth()->id());
        Arr::set($field, 'no_transaksi', $notransaksi);
        Arr::set($field, 'tanggal_pengiriman', $date->format('Y-m-d H:i:s'));
        $transaksi = new Transaksi();
        $trans     = $transaksi->create($field);
        foreach ($keranjang as $k) {
            $k->update(
                [
                    'transaksi_id' => $trans->id,
                ]
            );
        }

        return 'berhasil';
    }

}
