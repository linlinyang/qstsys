<?php 

	namespace App\Http\Controllers\web;

	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Http\Request;
	use Validator;
	use Illuminate\Support\Facades\DB;
	use App\Models\Anwser as AswData;

	class Anwser extends BaseController{

		public function index(Request $request){
			$guestid = session('guestid');
			$expired = session('expired');
			$questions = AswData::idToRows($guestid);
			$examtime = AswData::getExamTime();
			$charts = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
			return view('anwser/index',compact('questions','charts','expired','examtime'));

		}

		public function post(Request $request){
			$guestid = session('guestid');
			$guestInfo = AswData::getGuest($guestid);
			if(empty($guestInfo)){
				return back()
					->withErrors(['您的试卷已提交或您还未登录您的账号']);
			}
			$examtime = AswData::getExamTime();
			if(time() - $guestInfo->starttime > $examtime + 60){
				return back()
					->withErrors(['您的试卷已超时，无法提交']);
			}
			$status = AswData::saveResult($request,$guestid);
			if($status){
				return back()
						->with('success','恭喜您，测试完成！');
			}

			return back()
					->withErrors(['测试失败，请检查测试网络环境']);
			
		}

		public function guest(){
			$colleges = AswData::getColleges();
			return view('anwser/guest',compact('colleges'));
		}

		public function guestLogin(Request $request){
			$validator = $this->validateLogin($request);

			if($validator->fails()){
	            return back()
	                    ->withErrors($validator)
	                    ->withInput();
	        }

	        $guestid = AswData::checkLogin($request);

	        session()->flush();
	        session([
	        	'guestid' => $guestid,
	        	'expired' => time() + 3600 * 2
	        ]);

	        return redirect('anwser');
		}

		protected function validateLogin(Request $request){
			return $this->validate($request->all(),[
	            'uname' => 'required',
	            'schoolnum' => 'required|allow_letter',
	            'department' => 'required',
	            'checkcode' => 'required|captcha',
	            'usertype' => 'required|integer'
	        ], [
	            'uname.required' => '请输入姓名',
	            'schoolnum.required' => '请输入学号',
	            'schoolnum.allow_letter' => '请输入规范的学号',
	            'department.required' => '请输入院系',
	            'checkcode.required' => '请输入验证码',
	            'checkcode.captcha' => '验证码输入错误，请重新输入',
	            'usertype.required' => '请选择您的身份',
	            'usertype.integer' => '您选择的身份类型不存在'
	        ]);
		}

	    protected function validate(array $request,Array $rule,Array $message){
	        return Validator::make($request,$rule,$message);
	    }

		public function getVerifyCode(Request $request){
			return captcha();
		}

		public function result(){
			$charts = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        	$guestid = session('guestid');
        	$info = AswData::getResult($guestid,$charts);
        	if(empty($info)){
        		return view('score/index')
        				->with('_name',$name)
        				->withErrors(['您选择的学生不存在，请重新选择']);
        	}

			return view('anwser/result',compact('info','charts'));
		}

	}


 ?>