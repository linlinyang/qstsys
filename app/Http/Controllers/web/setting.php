<?php 

	namespace App\http\Controllers\web;

	use Illuminate\Foundation\Bus\DispatchesJobs;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Foundation\Validation\ValidatesRequests;
	use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
	use Illuminate\Http\Request;
	use Validator;
	use Illuminate\Support\Facades\DB;
	use App\models\Setting as MDSetting;

	class Setting extends BaseController{

		public function index($name = 'index'){
			$info = MDSetting::getInfo();
			return view('setting/index',compact('info'))
					->with('_name',$name);
		}

		public function postCount(Request $request){
			$validator = $this->validateCount($request);

			if($validator->fails()){
				return back()
						->withErrors($validator)
						->withInput();
			}

			if(!MDSetting::validateCount($request->uname,$request->old_passwd)){
				return back()
						->withErrors(['您输入的原密码不正确']);
			}
			

			$res = MDSetting::updateCount($request->uname,$request->old_passwd);

			if($res){
				return back()
						->with('success','账号修改成功！');
			}else{
				return back()
						->withError(['修改失败，请联系管理员']);
			}

		}

		public function postOther(Request $request){
			$validator = $this->validateOther($request);

			if($validator->fails()){
				return back()
						->withErrors($validator)
						->withInput();
			}

			$res = MDSetting::updateOther($request);
			if($res){
				return back()
						->with('success','修改成功！');
			}else{
				return back()
						->withError(['修改失败，请联系管理员']);
			}

		}

		protected function validateCount(Request $request){
			return $this->validate($request->all(),[
	            'uname' => 'required',
	            'passwd' => 'required|min:6',

	        ], [
	            'uname.required' => '请输入账号名',
	            'passwd.required' => '请输入密码',
	            'passwd.min:6' => '请输入规范的密码'
	        ]);
		}

		protected function validateOther(Request $request){
			return $this->validate($request->all(),[
	            'totalnum' => 'required',
	            'examtime' => 'required'
	        ], [
	            'totalnum.required' => '请输入题目数',
	            'examtime.required' => '请输入考试时间'
	        ]);
		}

		protected function validateSetting(Request $request){
			return $this->validate($request->all(),[
	            'uname' => 'required',
	            'passwd' => 'required|min:6',
	            'totalnum' => 'required',
	            'examtime' => 'required'
	        ], [
	            'uname.required' => '请输入账号名',
	            'passwd.required' => '请输入密码',
	            'passwd.min:6' => '请输入规范的密码',
	            'totalnum.required' => '请输入题目数',
	            'examtime.required' => '请输入考试时间'
	        ]);
		}

	    protected function validate(array $request,Array $rule,Array $message){
	        return Validator::make($request,$rule,$message);
	    }

		public function getVerifyCode(Request $request){
			return captcha();
		}

	}


 ?>