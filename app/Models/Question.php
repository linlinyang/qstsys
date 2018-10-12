<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Question extends Authenticatable
{

    public static function list($url = 'home',$keywords = '',$page = 1,$size = 10){
        if(empty($keywords)){
            $lists =  self::listDefault($size);
        }else{
            $lists = self::listSearch($keywords,$size,$page)
                        ->appends(['search' => $keywords]);
        }
        return $lists->withPath($url);
    }

    private static function listDefault($size){
        return DB::table('qst_question_list')
                    ->where('isdeleted','=',0)
                    ->orderBy('createtime','desc')
                    ->paginate($size);
    }

    private static function listSearch($keywords,$size,$page){
        $items = DB::select('select * from (select list.*,CONCAT_WS(",",list.title,GROUP_CONCAT(asw.title)) as result from qst_question_list as list left join qst_question_anwser as asw on list.id=asw.qid where list.isdeleted=0 GROUP BY list.id) as tt where tt.result like "%'.$keywords.'%"');
        $total = count($items);
        $pages = array_slice($items,($page - 1)*$size,$size);

        return new LengthAwarePaginator($pages,$total,$size);
    }



}
