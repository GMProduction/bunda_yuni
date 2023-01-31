<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BarangController extends CustomController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function index()
    {
        if (\request()->isMethod('POST')){
            return $this->create();
        }
        $data = Barang::all();

        return view('admin.barang', ['sidebar' => 'barang', 'data' => $data]);
    }

    /**
     * @return string
     */
    public function create()
    {
        //
        $field = \request()->validate(
            [
                'nama'  => 'required',
                'harga' => 'required',
                'kategori' => 'required'
            ]
        );
        $foto = \request('image');

        if ($foto) {
            $image     = $this->generateImageName('image');
            $stringImg = '/images/barang/'.$image;
            $this->uploadImage('image', $image, 'imageBarang');
            Arr::set($field, 'image', $stringImg);
        }
        if (\request('description')){
            Arr::set($field, 'description', \request('description'));

        }
        if (\request('id')) {
            $barang = Barang::find(\request('id'));
            $barang->update($field);
        } else {
            $barang = new Barang();
            $barang->create($field);
        }

        return 'berhasil';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
