@if (!$errors->any())

<div class="address-nav">
	<a href="{{ url('score') }}">答题管理</a>
	<span> / 答题详情</span>
</div>
<div class="panel">
	<div class="panel-header">
		学生： {{$info->uname}}
	</div>
	<div class="panel-body">
		
		@foreach ($info->result as $key => $qst)
		<div class="form-group">
			<label class="label">第{{ $key + 1 }}题：{{ $qst['question']->title }}
				@if (count(explode(',',$qst['question']->res)) > 1)
				<span class="required">（多选）</span>
				@endif
			</label>
			<div class="options">
				@foreach ($qst['options'] as $index => $opt)
				<div class="option 
					@if (in_array($opt->id,$qst['checked']))
						checked
					@endif
				">
					<div class="
						{{ count(explode(',',$qst['question']->res)) > 1 ? 'checkbox' : 'radiobox'}}
							select 
					">
						<i class="iconfont icon-check"></i>
					</div>
					<div class="num">{{$charts[$index]}}： </div>
					<div class="cont">
						@if ($opt->title)
						<div class="wdsbox">{{ $opt->title }}</div>
						@endif
						@if ($opt->thumb)
						<div class="imgbox">
							<img src="{{ url(substr($opt->thumb,1)) }}" >
						</div>
						@endif
					</div>
				</div>
				@endforeach
				<div class="correct">
					正确答案：{{ implode('，',$qst['correct']) }}
				</div>
			</div>
		</div>
		@endforeach

		<div class="score">
			<p>{{$info->score*10}}分</p>
		</div>
		
	</div>
</div>

@else

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
			location.replace('{{url("score")}}');
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
	
	

</script>