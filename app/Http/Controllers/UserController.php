<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
     */
    public function index()
    {
        if (\request()->isMethod('POST')){
            return $this->create();
        }
        $user = User::all();
        return view('admin.user', ['sidebar' => 'user', 'user' => $user]);
    }

    /**
     * @return array|string
     */
    public function create()
    {
        //
        $field = \request()->validate(
            [
                'nama'     => 'required',
                'username' => 'required',
                'role'     => 'required',
                'no_hp'     => 'required',
                'alamat'     => 'required',
            ]
        );
        $fieldPassword = \request()->validate([
            'password' => 'required|confirmed',
        ]);

        if (\request('id')){
            $cekUsername = User::where([['username', '=', \request('username')], ['id', '!=', \request('id')]])->first();
            if ($cekUsername) {
                return \request()->validate(
                    [
                        'username' => 'required|string|unique:users,username',
                    ]
                );
            }
            if (strpos($fieldPassword['password'], '*') === false) {
                $password = Hash::make($fieldPassword['password']);
                Arr::set($field, 'password', $password);
            }
            $user = User::find(\request('id'));
            $user->update($field);
        }else{
            \request()->validate(
                [
                    'username' => 'required|string|unique:users,username',
                ]
            );
            $user     = new User();
            $password = Hash::make($fieldPassword['password']);
            Arr::set($field, 'password', $password);
            $user->create($field);
        }

        return 'berhasil';
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
     * @param $id
     *
     * @return string
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        return 'success';
    }
}
