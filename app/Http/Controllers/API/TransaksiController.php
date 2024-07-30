<?php

namespace App\Http\Controllers\API;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Support\Arr;

class TransaksiController extends CustomController
{

    /**
     * @return mixed
     */
    public function index()
    {
        return Transaksi::where('user_id', '=', auth()->id())->orderby('created_at', 'desc')->get();
    }

    public function detail($id)
    {
        $trans = Transaksi::with('cart.barangs_all')->find($id);
        return $trans;
    }

    public function terima($id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi == null) {
            return 'Pesanan tidak ditemukan';
        }

        if ($transaksi->status != 2) {
            return 'Pesanan belum dikirim';
        }
        $transaksi->update(
            [
                'status' => 3,
            ]
        );

        return 'berhasil';
    }

    public function uploadImg($id)
    {
        $field = \request()->validate(
            [
                'image' => 'required',
            ]
        );

        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->status != 1) {
            return response()->json(
                [
                    'message' => 'Pesanan tidak ditemukan',
                ]
            );
        }

        $image     = $this->generateImageName('image');
        $stringImg = '/images/pembayaran/' . $image;
        // \request()->$image->move(public_path('/images/pembayaran/'), $image);
        $this->uploadImage('image', $image, 'imagePembayaran');
        Arr::set($field, 'image', $stringImg);

        $transaksi->update(
            [
                'image' => $stringImg,
            ]
        );

        return 'berhasil';
    }
}
