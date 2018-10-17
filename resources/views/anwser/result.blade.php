@extends('common.base')

@section('title','试卷结果')

@section('header')
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/anwser.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/score-detail.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('public/css/result.css') }}">
@endsection

@section('main')

<div class="main">
	
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
				此题得分：{{ $qst['getScore'] }}
			</div>
		</div>
	</div>
	@endforeach

	<div class="score">
		<p>{{$info->score}}分</p>
	</div>

</div>

<div class="save-btn">
	<span>保存试卷</span>
</div>

<!-- 
<div class="result"></div> -->

<script type="text/javascript" src="{{ URL::asset('public/js/html2canvas.js') }}"></script>
<script type="text/javascript" src="{{ url('public/js/canvas2image.js') }}"></script>
<script type="text/javascript">
	$(function(){

		var $main = $(".main"),
			width = $main.width(),
			height = $main.height(),
			canvas = document.createElement('canvas'),
			scale = 2;

		canvas.width = width * scale;
		canvas.height = height * scale;
		canvas.getContext("2d").scale(scale, scale);

		html2canvas($main[0],{
			scale: scale,
			canvas: canvas,
			logging: false,
			width: width,
			height: height
		}).then(function(canvas){
			var img = Canvas2Image.convertToJPEG(canvas, canvas.width, canvas.height);
			$(".save-btn").click(function(){

				saveImg(img.src,'考试结果.png');

			});
		});

		function saveImg(data,filename){
			var save_link=document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
            save_link.href=data;
            save_link.download=filename;
            var event=document.createEvent('MouseEvents');
            event.initMouseEvent('click',true,false,window,0,0,0,0,0,false,false,false,false,0,null);
            save_link.dispatchEvent(event);
		}

	});
</script>

@endsection