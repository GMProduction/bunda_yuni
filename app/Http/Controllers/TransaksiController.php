<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class TransaksiController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trans = Transaksi::with(['user_all'])->get();
        return view('admin.transaksi', ['sidebar' => 'transaksi', 'data' => $trans]);
    }

    public function getData(){
        return Transaksi::with('user_all')->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function detail($id){
        $trans = Transaksi::with(['user_all','cart.barangs_all'])->find($id);
        return $trans;
    }

    public function changeStatus($id){
        $status = \request('status');

        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'status' => $status
        ]);
        return 'berhasil';
    }

    public function changeStatusPayment($id){
        $status = \request('status');

        $transaksi = Transaksi::findOrFail($id);
        $field = [
            'status_pembayaran' => $status
        ];
        if ($status == 6){
            $image = $transaksi->image;
            if ($image && file_exists(public_path().$image)){
                unlink(public_path().$image);
            }

            Arr::set($field, 'image',null);
        }

        $transaksi->update($field);
        return 'berhasil';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function cetakLaporan($id)
    // {
    //     $pdf = App::make('dompdf.wrapper');
    //     $pdf->loadHTML('<h1>Test</h1>');
    //     return $pdf->stream();
    // }

    public function cetakLaporan()
    {

        return $this->dataTransaksi();
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML($this->dataTransaksi())->setPaper('f4', 'potrait');
//
//        return $pdf->stream();
    }

    public function dataTransaksi()
    {

        $trans = Transaksi::with(['user','cart.barangs']);
        $start = \request('start');
        $end = \request('end');
        if (\request('start')){
            $trans = $trans->whereBetween('created_at', ["$start 00:00:00", "$end 23:59:59"]);
        }
        $trans = $trans->get();
        return view('admin/laporanpesanan',['data' => $trans]);
    }
}
