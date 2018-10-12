<?php 

	namespace App\http\Controllers\web;

	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Http\Request;
	use Validator;
	use Illuminate\Support\Facades\DB;
	use App\Models\Score as ScoreModel;

	class Score extends BaseController{

		public function index($name = 'index',Request $request){
	        switch ($name) {
	            case 'index':
	                $search = trim(@$request->search);
	                $search = empty($search) ? '' : $search;
	                $page = empty($request->page) ? 1 : $request->page;
	                $lists = ScoreModel::list('score',$search,$page);
	                $handlers = compact('lists','search');
	                break;
	            case 'detail':
	            	$charts = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	            	$gid = @$request->gid;
	            	$info = ScoreModel::getResult($gid,$charts);
	            	if(empty($info)){
	            		return view('score/index')
	            				->with('_name',$name)
	            				->withErrors(['您选择的学生不存在，请重新选择']);
	            	}
	            	$handlers = compact('info','charts');
	            	break;
	            default :
	                $view = view('score/index');
	                break;
	        }
	        return view('score/index',$handlers)
	        		->with('_name',$name);
		}

	}


 ?>