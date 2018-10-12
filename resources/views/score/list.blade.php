
<div class="panel">
	<div class="panel-header">
		<span class="title">考生答题列表</span>
	</div>
	<div class="panel-body">
		<div class="search-box">
			<button class="form-control search-btn btn">
				<i class="iconfont icon-search"></i>
				搜索
			</button>
			<input type="text" name="title" placeholder="题目搜索" class="form-control" value="">
		</div>

		<table class="table">
			<thead>
				<tr>
					<th>考生</th>
					<th>学号</th>
					<th>院系</th>
					<th>分数</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($lists as $std)
				<tr>
					<td>{{$std->uname}}</td>
					<td>{{$std->schoolnum}}</td>
					<td>{{$std->department}}</td>
					<td>
						@if($std->score)
							{{$std->score}}
						@else
							0
						@endif
					</td>
					<td>
						<a href="{{url('score/detail?gid=').$std->id}}" class="btn btn-primary">详情</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$lists->links()}}
	</div>
</div>

<script type="text/javascript">
	$(function(){

		$(".panel .search-btn").click(function(){
			var val = $.trim($(this).next().val()),
				url = '{{ url("score") }}';
			if(!val){
				location.replace(url);
				return ;
			}
			
			location.replace(url+'?search='+val);
		});

	});
</script>

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