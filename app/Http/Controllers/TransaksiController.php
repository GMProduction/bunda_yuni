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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
