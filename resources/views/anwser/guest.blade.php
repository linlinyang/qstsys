@extends('../common.base')

@section('title', '登录')

@section('header')
	<link rel="stylesheet" type="text/css" href="./public/css/guest.css">
@endsection

@section('main')

	<div class="model">
		<div class="login">
			<div class="login-header">
				<div class="bg-title">
					<div class="logo">
						<span class="px-logo-1"></span><span class="px-logo-2"></span><span class="px-logo-3"></span><span class="px-logo-4"></span><span class="px-logo-5"></span><span class="px-logo-6"></span><span class="px-logo-7"></span><span class="px-logo-8"></span><span class="px-logo-9"></span>
					</div>
					<span>华科在线考试</span>
				</div>
				<div class="sm-title">
					<span>公平、公正、公开</span>
				</div>
			</div>
			<form action="./guest" method="post" class="login-content">
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-user"></i>
					</div>
					<input type="text" name="uname" class="form-control" placeholder="姓名" value="{{ old('uname') }}">
				</fieldset>
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-idcard"></i>
					</div>
					<input type="text" name="schoolnum" class="form-control" placeholder="学号" value="{{ old('schoolnum') }}">
				</fieldset>
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-block"></i>
					</div>
					<input type="text" name="department" class="form-control" placeholder="院系" value="{{ old('department') }}">
				</fieldset>
				<fieldset class="form-group">
					<div class="icon iconfont">
						<i class="icon-quanxianshenpi"></i>
					</div>
					<div class="control-box">
						<label class="radio-box">
							<input type="radio" name="usertype" value="1" checked='true'>学生
						</label>
						<label class="radio-box">
							<input type="radio" name="usertype" value="2">老师
						</label>
					</div>
				</fieldset>
				<fieldset class="form-group clear">
					<input type="text" name="checkcode" class="form-control checkcode" placeholder="请输入验证码" value="">
					<div class="imgcode">
						<img src="{{ url('imgcode?r='.time()) }}" alt="点击切换验证码">
					</div>
				</fieldset>

				{!! csrf_field() !!}
				<button class="submit" type="submit">开始答题</button>
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

<script type="text/javascript">
	
	$(function(){

		$(".imgcode").click(function(){

			var url = "{{ url('imgcode?r=') }}" + Math.random();
			$(this).children('img').attr('src',url);

		});

	});

</script>

@endsection



