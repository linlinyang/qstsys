@extends('../common.base')

@section('title', '题库系统')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('public/css/home.css') }}">
@if ($_name === 'index')
	<link rel="stylesheet" href="{{ URL::asset('public/css/question-list.css') }}">
@elseif ($_name === 'detail')
	<link rel="stylesheet" href="{{ URL::asset('public/css/score-detail.css') }}">
@endif
@endsection

@section('main')

	@include('common.header')

	<div class="main clear">
		
		@include('common.menus', ['tabIndex' => 'score'])

		<section class="cont-box">
			@if ($_name === 'index')
				@include('score.list')
			@elseif ($_name === 'detail')
				@include('score.detail')
			@endif
		</section>

	</div>

@endsection