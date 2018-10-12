<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Setting extends Authenticatable
{

    public static function getInfo(){
        return DB::table('qst_admin_info')
                ->first();
    }

    public static function validateCount($uname,$passwd){
        return DB::table('qst_admin_info')
                    ->where('uname','=',$uname)
                    ->first()
                    ->passwd === md5($passwd);
    }

    public static function updateCount($uname,$passwd){
        return DB::table('qst_admin_info')
                    ->where('uname','=',$uname)
                    ->update([
                        'passwd' => md5($passwd),
                        'updated_at' => time()
                    ]);
    }

    public static function updateOther($request){
        return DB::table('qst_admin_info')
                    ->update([
                        'totalnum' => $request->totalnum,
                        'examtime' => $request->examtime,
                        'updated_at' => time()
                    ]);
    }

}
