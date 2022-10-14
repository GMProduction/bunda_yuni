<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TransaksiController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trans = Transaksi::with('user')->get();
        return view('admin.transaksi', ['sidebar' => 'transaksi', 'data' => $trans]);
    }

    public function getData(){
        return Transaksi::with('user')->get();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function detail($id){
        $trans = Transaksi::with(['user','cart.barangs'])->find($id);
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
