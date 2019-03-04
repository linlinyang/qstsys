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

        $totalNum = self::getTotalNum();
    	$questions = self::getRandQuestions($totalNum);
    	$rdQids = [];
    	foreach($questions as $row){
    		$rdQids[] = $row->id;
    	}

    	$insertData = [
    		'uname' => $request->uname,
    		'schoolnum' => $request->schoolnum,
    		'department' => $request->department,
    		'starttime' => time(),
    		'questions' => implode(',',$rdQids),
            'usertype' => $request->usertype
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
        $average = self::getAverage();
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
    			'score' => $score * $average
    		]);
    }

    public static function getResult(int $guestid,$charts){
        $info = DB::table('qst_question_guest')
                    ->where([
                        ['isover','=',1],
                        ['id','=',$guestid]
                    ])
                    ->first();

        if(empty($info)){
            return null;
        }

        $average = self::getAverage();

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
                'optionids' => $optionids,
                'getScore' => $question->res == $qstAndOpts[1] ? $average : 0
            ];
        }
        $info->result = $result;
        return $info;
    }

    public static function getTotalNum(){
        return DB::table('qst_admin_info')
                    ->select('totalnum')
                    ->first()
                    ->totalnum;
    }

    public static function getExamTime(){
        return DB::table('qst_admin_info')
                    ->select('examtime')
                    ->first()
                    ->examtime;
    }

    public static function getAverage(){
        return 100 / self::getTotalNum();
    }

    public static function getColleges(){
        return DB::table('qst_question_college')
                ->where('is_deleted','=',0)
                ->get();
    }

}
