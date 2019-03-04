<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class College extends Model
{
    public static function getList($url = 'college',$keywords = '',$page = 1,$size = 10){
    	return DB::table('qst_question_college')
    			->where([
    				['is_deleted','=',0],
    				['name','like','%'.$keywords.'%']
    			])
    			->orderBy('order','desc')
    			->orderBy('id','asc')
    			->paginate($size)
    			->withPath($url);
    }

    public static function insertData($name,$order = 1){
    	$order = empty($order) ? 1 : $order;
    	return DB::table('qst_question_college')
    			->insertGetId([
    				'name' => $name,
    				'order' => $order
    			]);
    }

    public static function getCollegeById($cid){
    	return DB::table('qst_question_college')
    			->where('id','=',$cid)
    			->first();
    }

    public static function updateCollege($cid,$name,$order = 1){
    	$order = empty($order) ? 1 : $order;
    	return DB::table('qst_question_college')
    			->where('id','=',$cid)
    			->update([
    				'name' => $name,
    				'order' => $order
    			]);
    }

    public static function deleteCollege($cids){
    	foreach($cids as $cid){
    		DB::table('qst_question_college')
    			->where('id','=',$cid)
    			->update([
    				'is_deleted' => 1,
    			]);
		}
    }
}
