<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class UserInfo extends Authenticatable
{
    use Notifiable;

    protected $table = 'qst_admin_info';
    protected $primaryKey = "id";
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uname', 'passwd',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passwd', 'remember_token',
    ];

    public static function checkLogin($uname,$passwd){

        $info = DB::table('qst_admin_info')
                    ->select('passwd')
                    ->where('uname','=',$uname)
                    ->first();

        $savedPasswd = $info->passwd;

        return $savedPasswd === md5($passwd);
    }

    public static function saveLoginState(){

        session([
            'isLogin' => true,
            'loginTime' => time()
        ]);

    }

}
