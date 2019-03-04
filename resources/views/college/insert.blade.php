
<div class="address-nav">
	<a href="{{ url('college') }}">学院管理</a>
	<span> / 添加学院</span>
</div>

<div class="panel">
	<div class="panel-header">
		<span class="title">添加学院</span>
	</div>
	<div class="panel-body">

	<form action="{{ url('college/add') }}" method="post" id="question" enctype="multipart/form-data" class="form">
		
		<div class="form-group">
			<label class="label">学院名称<span class="require">*</span></label>
			<div class="fill">
				<input type="text" name="name" placeholder="请输入学院名称" class="form-control" value="{{ old('name') }}">
			</div>
		</div>

		<div class="form-group">
			<label class="label">排序序号</label>
			<div class="fill">
				<input type="text" name="order" placeholder="请输入排序序号" class="form-control" value="{{ old('order') }}">
			</div>
		</div>

		<div class="form-group">
			{!! csrf_field() !!}
			<input type="submit" name="submit" class="btn submit" value="确认添加">
		</div>
	</form>

	</div>
</div>

@if (session('success') || $errors->any())

	<div class="model tips">
		<div class="message {{ session('success') ? 'sucess' : 'error' }}">
			<div class="icon iconfont">
				<i class="icon-check-circle"></i>
			</div>
			<div class="content">
				<p class="msg">{{ session('success') ? session('success') : $errors->all()[0] }}</p>
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
