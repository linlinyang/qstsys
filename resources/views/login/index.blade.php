@extends('../common.base')

@section('title', '登录')

@section('header')
	<link rel="stylesheet" type="text/css" href="./public/css/login.css">
@endsection

@section('main')

	<div class="model">
		<div class="login">
			<div class="login-header">
				<div class="bg-title">
					<div class="logo">
						<span class="px-logo-1"></span><span class="px-logo-2"></span><span class="px-logo-3"></span><span class="px-logo-4"></span><span class="px-logo-5"></span><span class="px-logo-6"></span><span class="px-logo-7"></span><span class="px-logo-8"></span><span class="px-logo-9"></span>
					</div>
					<span>题库管理系统</span>
				</div>
				<div class="sm-title">
					<span>简介、灵活、强大</span>
				</div>
			</div>
			<form action="./login" method="post" class="login-content">
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-user"></i>
					</div>
					<input type="text" name="uname" class="form-control" placeholder="用户名" value="{{ old('uname') }}">
				</fieldset>
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-mima"></i>
					</div>
					<input type="password" name="passwd" class="form-control" placeholder="密码" value="{{ old('passwd') }}">
				</fieldset>

				{!! csrf_field() !!}
				<button class="submit" type="submit">登录</button>
			</form>
			<div class="login-footer">
				<span>题库管理系统 1.0.0</span>
			</div>
		</div>
	</div>
	
	@if ($errors->any())
		<div class="model tips">
			<div class="message error">
				<div class="icon iconfont">
					<i class="icon-error"></i>
				</div>
				<div class="content">
					<p class="msg">{{ $errors->all()[0] }}</p>
					<p class="counter">
						<span>3</span>秒后页面自动跳转
					</p>
					<a class="redirect" href="javascript:void(0)" onclick="hideTips()">返回</a>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function hideTips(){
				var tipsEl = document.querySelector('.tips');

				tipsEl.style.display = 'none';
			}
			(function(){

				var defaultSeconds = 3,
					secondsEl = document.querySelector('.counter span').firstChild,
					timer = setInterval(function(){
						if(defaultSeconds--){
							secondsEl.data = defaultSeconds;
						}else{
							clearInterval(timer);
							hideTips();
							secondsEl = null;
						}
					},1000);

			})();
		</script>
	@endif

@endsection


