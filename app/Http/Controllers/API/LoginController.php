<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $field = \request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );
        $user  = User::where('username', '=', $field['username'])->first();

        if (!$user || !Hash::check($field['password'], $user->password)) {
            return response()->json(
                [
                    'msg' => 'Login gagal',
                ],
                401
            );
        } else {
            $user->tokens()->delete();
            $token = $user->createToken(request('username'))->plainTextToken;
            $user->update(
                [
                    'token' => $token,
                ]
            );

            return response()->json(
                [
                    'status' => 200,
                    'data'   => [
                        'token' => $token,
                    ],
                ]
            );
        }
    }

    public function register()
    {
        $field = \request()->validate(
            [
                'username' => 'required',
                'nama'     => 'required',
                'password' => 'required',
                'alamat'   => 'required',
                'no_hp'    => 'required',
                'role'     => 'required',
            ]
        );
        if (!\request('id')) {
            $user1 = User::where('username', '=', $field['username'])->first();
            if ($user1) {
                return response()->json(
                    [
                        'msg' => 'Username sudah digunakan',
                    ],
                    201
                );
            }
            Arr::set($field, 'password', Hash::make($field['password']));
            $user = User::create($field);
            if ($field['role'] != 'admin') {
                $token = $user->createToken($field['role'], [$field['role']])->plainTextToken;
                $user->update(['token' => $token]);

                return response()->json(
                    [
                        'status' => 200,
                        'data'   => [
                            'token' => $token,
                            'role'  => $user->role,
                        ],
                    ]
                );
            }

            return 'berhasil';
        }

        Arr::forget($field, 'password');
        if (strpos(request('password'), '*') === false) {
            Arr::set($field, 'password', Hash::make(request('password')));
        }
        $user = User::find(\request('id'));
        $user->update($field);

        return 'berhasil';
    }
}
