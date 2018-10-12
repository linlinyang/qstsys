<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Score extends Authenticatable
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
        return DB::table('qst_question_guest')
                    ->where('isover','=',1)
                    ->orderBy('starttime','desc')
                    ->paginate($size);
    }

    private static function listSearch($keywords,$size,$page){
        $items = DB::select('select * from qst_question_guest where isover=1 and CONCAT_WS(",",uname,schoolnum,department) like "%'.$keywords.'%" order by starttime desc');
        $total = count($items);
        $pages = array_slice($items,($page - 1)*$size,$size);

        return new LengthAwarePaginator($pages,$total,$size);
    }


    public static function getGuest(int $guestid){
        return DB::table('qst_question_guest')
                    ->where([
                        ['isover','=',1],
                        ['id','=',$guestid]
                    ])
                    ->first();
    }

    public static function getResult(int $guestid,$charts){
        $info = DB::table('qst_question_guest')
                    ->where([
                        ['isover','=',1],
                        ['id','=',$guestid]
                    ])
                    ->first();

        $options = explode('|',$info->options);
        $result = [];
        foreach($options as $qst){
            $qstAndOpts = explode('_=',$qst);
            $question = DB::table('qst_question_list')
                        ->where([
                            ['isdeleted','=',0],
                            ['id','=',$qstAndOpts[0]]
                        ])
                        ->first();
            $options = DB::table('qst_question_anwser')
                        ->where([
                            ['isdeleted','=',0],
                            ['qid','=',$qstAndOpts[0]]
                        ])
                        ->get();
            $optionids = [];
            foreach($options as $key => $opt){
                $optionids[$opt->id] = $charts[$key];
            }
            $res = explode(',',$question->res);
            $correct = [];
            foreach($res as $cor){
                $correct[] = $optionids[$cor];
            }
            $result[] = [
                'question' => $question,
                'options' => $options,
                'checked' => explode(',',$qstAndOpts[1]),
                'correct' => $correct,
                'optionids' => $optionids
            ];
        }
        $info->result = $result;
        return $info;
    }

}
