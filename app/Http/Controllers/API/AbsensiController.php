<?php

namespace App\Http\Controllers\API;

use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class AbsensiController
{
    public function index(){
        if (request()->isMethod('POST')){
            return $this->create();
        }
        $absen = Absensi::where('user_id','=',auth()->id())->get();
        return $absen;
    }

    public function create(){
        $now = date('md');
        $nowDate = date('d F Y H:i:s');
        $absen = Absensi::where([['user_id','=',auth()->id()],[DB::raw("(DATE_FORMAT(created_at,'%m%d'))"),'=', $now],['pulang','=',null]])->first();
//        $absen = Absensi::select()->where([['user_id','=',auth()->id()],['pulang','=',null]])->first();
        if ($absen){
            $absen->update([
                'pulang' => date("Y-m-d H:i:s")
            ]);
            return response()->json(
                [
                    'msg' => "Berhasil absen pulang, $nowDate",
                ],
                200
            );
        }else{
            $absen = new Absensi();
            $absen->create([
                'user_id' => auth()->id(),
                'masuk' => date("Y-m-d H:i:s")
            ]);
            return response()->json(
                [
                    'msg' => "Berhasil absen masuk, $nowDate",
                ],
                200
            );
        }

    }

}
