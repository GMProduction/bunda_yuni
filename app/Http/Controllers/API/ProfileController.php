<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        if (request()->isMethod('POST')){
            return $this->update();
        }
        return User::find(auth()->id());
    }

    public function update()
    {
        $field = request()->validate(
            [
                'nama'     => 'required',
                'no_hp'    => 'required',
                'alamat'   => 'required',
                'username' => 'required',
            ]
        );
        $user1 = User::where([['username', '=', $field['username']],['id','!=',auth()->id()]])->first();
        if ($user1) {
            return response()->json(
                [
                    'msg' => 'Username sudah digunakan',
                ],
                201
            );
        }
        $user = User::find(auth()->id());
        $user->update($field);

        return $user;

    }

}
