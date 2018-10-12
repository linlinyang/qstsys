@extends('../common.base')

@section('title', '题库系统')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('public/css/home.css') }}">
@if ($_name === 'add')
	<link rel="stylesheet" href="{{ URL::asset('public/css/question-add.css') }}">
@elseif ($_name === 'detail')
	<link rel="stylesheet" href="{{ URL::asset('public/css/question-detail.css') }}">
@else
	<link rel="stylesheet" href="{{ URL::asset('public/css/question-list.css') }}">
@endif
@endsection

@section('main')

	@include('common.header')

	<div class="main clear">
		
		@include('common.menus', ['tabIndex' => 'home'])

		<section class="cont-box">

			@if ($_name === 'add')
				@include('home.questions.add')
			@elseif ($_name === 'detail')
				@include('home.questions.detail',compact('question','items'))
			@else
				@include('home.questions.list',compact('total','lists','pindex'))
			@endif

		</section>

	</div>

@endsection