<?php

namespace App\Http\Controllers\web;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use Validator;

class Login extends BaseController
{

    private function validate(array $request,Array $rule,Array $message){
        return Validator::make($request,$rule,$message);
    }

    private function validateLogin(Request $request){
        return $this->validate($request->all(),[
            'uname' => 'required',
            'passwd' => 'required',
        ], [
            'uname.required' => '请输入账号',
            'passwd.required' => '请输入密码'
        ]);
    }

    public function login(Request $request){
        $validator = $this->validateLogin($request);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $canLogin = UserInfo::checkLogin($request->uname,$request->passwd);
        if($canLogin){
            UserInfo::saveLoginState();
            return redirect('home');
        }

        return redirect('login')
                ->withErrors(['账号和密码不匹配，请重新输入'])
                ->withInput();

    }

}
