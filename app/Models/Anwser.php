<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Anwser extends Authenticatable
{

    public static function getRandQuestions(int $num = 10){
        
    	return DB::table('qst_question_list')
    				->where('isdeleted','=',0)
    				->whereNotNull('res')
    				->inRandomOrder()
    				->skip(0)
    				->take($num)
    				->get();

    }

    private static function getQuestionsByGuestId(int $guestid){
    	return DB::table('qst_question_guest')
    			->select('questions')
    			->where('id','=',$guestid)
    			->first();
    }

    public static function idToRows(int $guestid){
    	$ids = self::getQuestionsByGuestId($guestid);

    	$questions = explode(',',$ids->questions);
    	$result = [];
    	foreach($questions as $qid){
    		$qst = DB::table('qst_question_list')
    					->where([
    						['isdeleted','=',0],
    						['id','=',$qid]
    					])
    					->first();
    		$options = DB::table('qst_question_anwser')
    					->where([
    						['isdeleted','=',0],
    						['qid','=',$qid]
    					])
    					->get();
    		$result[] = [
    			'qst' => $qst,
    			'options' => $options
    		];
    	}

    	return $result;
    }

    public static function getGuest(int $guestid){
        return DB::table('qst_question_guest')
                    ->where([
                        ['isover','=',0],
                        ['id','=',$guestid]
                    ])
                    ->first();
    }

    public static function checkLogin($request){

    	$questions = self::getRandQuestions();
    	$rdQids = [];
    	foreach($questions as $row){
    		$rdQids[] = $row->id;
    	}

    	$insertData = [
    		'uname' => $request->uname,
    		'schoolnum' => $request->schoolnum,
    		'department' => $request->department,
    		'starttime' => time(),
    		'questions' => implode(',',$rdQids)
    	];

    	return DB::table('qst_question_guest')
    		->insertGetId($insertData);

    }

    private static function checkAnwserByQid(int $qid,$res){
    	return DB::table('qst_question_list')
    		->where([
    			['id','=',$qid],
    			['isdeleted','=',0]
    		])
    		->select('res')
    		->first()
    		->res == $res;

    }

    public static function saveResult($request,$guestid){
    	$ids = self::getQuestionsByGuestId($guestid);
    	$questions = explode(',',$ids->questions);

    	$res = '';
    	$score = 0;
    	foreach($questions as $row){
    		$keyname = $row.'_';
    		$res .= $keyname . '=' . $request->$keyname . '|';
    		$score += self::checkAnwserByQid($row,$request->$keyname) ? 1 : 0;
    	}
    	$res = substr($res,0,-1);

    	return DB::table('qst_question_guest')
    		->where('id','=',$guestid)
    		->update([
    			'options' => $res,
    			'overtime' => time(),
    			'isover' => 1,
    			'score' => $score
    		]);
    }

}
