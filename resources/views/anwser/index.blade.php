@extends('common.base')

@section('title','试卷')

@section('header')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/anwser.css') }}">
@endsection

@section('main')

<div class="main">
	<div class="logo">
		<img src="{{ url('public/images/logo.png') }}">
	</div>
	<form action="./anwser" method="post" class="form" id="myform">
		
		@foreach ($questions as $key => $qst)
		<div class="form-group">
			<label class="label">{{ $key + 1 }}. {{$qst['qst']->title}}
				@if (count(explode(',',$qst['qst']->res)) > 1)
					<span class="special">（多选)</span>
				@endif
			</label>
			<input type="hidden" name="{{$qst['qst']->id}}_" value="">
			<div class="options">
				@foreach ($qst['options'] as $index => $option)
				<div class="item clearfix">
					<div class="
					@if (count(explode(',',$qst['qst']->res)) > 1)
						checkbox
					@else
						radiobox
					@endif
					select-box" data-aswid='{{$option->id}}'>
						<i class="iconfont icon-check"></i>
					</div>
					<span class="fl">{{$charts[$index]}}: </span>
					<div class="cont">
						@if ($option->title)
							<div class="wds">
								<span>{{ $option->title }}</span>
							</div>
						@endif
						@if ($option->thumb)
							<div class="imgbox" 
								@if ($option->title)
								title='{{ $option->title }}'
								@endif
							>
								<img src="{{ $option->thumb }}">
							</div>
						@endif
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endforeach

		
		<div class="form-group">
			{!! csrf_field() !!}
			<input type="submit" name="submit" class="btn submit" value="提交">
		</div>
	</form>

</div>

<div class="counter">
	<div class="cont">
		考试剩余时间:
		<span class="minute">30</span>
		分钟
		<span class="seconds">0</span>
		秒
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
				<p class="counter-time">
					<span>3</span>秒后页面自动跳转
				</p>
				<a class="redirect" href="javascript:void(0)" onclick="hideTips()">返回</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function hideTips(){
			/*var tipsEl = document.querySelector('.tips');

			tipsEl.style.display = 'none';*/

			location.replace('{{ session("success") ? url("anwser/result") : url("/guest") }}');
		}
		$(function(){

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

		});
	</script>

@endif

<script type="text/javascript">
	$(function(){

		var total = initTotal = sessionStorage.getItem('total_time');
		if(!total){
			sessionStorage.setItem('total_time',{{EXAMTIME}});
			total = initTotal = {{EXAMTIME}};
		}

		$("#myform .item").click(function(){
			var $selectBox = $(this).children('.select-box');
			if($selectBox.hasClass('checkbox')){
				$selectBox.toggleClass('check');
			}else if($selectBox.hasClass('radiobox') && !$selectBox.hasClass('check')){
				$(this).parent().find('.radiobox').removeClass('check');
				$selectBox.addClass('check');
			}

			var $valBox = $(this).parents('.form-group').children('input'),
				$checks = $(this).parent().find('.item .select-box.check'),
				res = [];

			$checks.each(function(){
				res.push($(this).data('aswid'));
			});

			$valBox.val(res.join(','));
		});

		var timer = setInterval(setTime,1000),
			minuteData = document.querySelector('.counter .minute').firstChild,
			secondData = document.querySelector('.counter .seconds').firstChild;
		function setTime(){
			if(--total <= 0){
				$(".counter .cont").html('考试结束，请在1分钟内提交试卷，否则答题作废');
				clearInterval(timer);
			}
			sessionStorage.setItem('total_time',total);
			if(total/initTotal <= 0.4){
				$(".counter .cont").css('background','rgba(137,123,46,0.9)');
			}
			if(total/initTotal <= 0.2){
				$(".counter .cont").css('background','rgba(176,64,64,0.9)');
			}
			minuteData.data = Math.floor( total / 60 );
			secondData.data = total % 60;
		}
		setTime();

	});

</script>

@endsection