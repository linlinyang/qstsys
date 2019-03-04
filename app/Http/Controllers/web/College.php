<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\College as DMCollege;
use Validator;

class College extends Controller
{
    public function Index(Request $request){
		$inputs = $request->all();

		$page = empty($inputs['page']) ? 1 : $inputs['page'];
    	$search = empty($inputs['search']) ? '' : $inputs['search'];
    	$list = DMCollege::getList('college',$search,$page);

    	return view('college/index',compact('search','list','page'))
    			->with('_name','list');
    }

    public function insert(Request $request){
    	$validator = $this->validateInsert($request);

    	if($validator->fails()){
    		return back()
                    ->withErrors($validator)
                    ->withInput();
    	}
    	
    	$insertid = DMCollege::insertData($request->name,$request->order);

    	if(empty($insertid)){
    		return back()
    				->withErrors(['添加学院失败，请联系管理员'])
    				->withInput();
    	}
    	return redirect()
    			->action('web\College@detail',[
    				'cid' => $insertid,
    			])
    			->with('success','添加学院成功');
    }

    public function detail(Request $request){
    	$cid = $request->cid;

    	$college = DMCollege::getCollegeById($request->cid);
    	return view('college/index',compact('college'))
    			->with('_name','detail');
    }

    public function detailUpdate(Request $request){
    	$res = DMCollege::updateCollege($request->cid,$request->name,$request->order);
    	if(empty($res)){
    		return back()
    				->withErrors(['更新学院失败，请联系管理员'])
    				->withInput();
    	}
    	return redirect()
    			->action('web\College@detail',[
    				'cid' => $request->cid,
    			])
    			->with('success','修改学院成功');
    }

    public function delete(Request $request){
    	$cid = $request->cid;
    	$cids = explode(',',$cid);
    	DMCollege::deleteCollege($cids);
    	return redirect()
    			->action('web\College@index',[
    				'page' => $request->page,
    				'search' => $request->search
    			])
    			->with('success','删除学院成功');
    }

    private function validateInsert(Request $request){
        return Validator::make($request->all(),[
            'name' => 'required',
            'order' => 'nullable|numeric'
        ],[
            'name.required' => '请输入学院名称',
            'order.numeric' => '请输入正确的排序序号1'
        ]);
    }
}
