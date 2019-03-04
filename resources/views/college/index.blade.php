@extends('../common.base')

@section('title', '题库系统')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('public/css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/setting-default.css') }}">
@if ($_name === 'insert')
	<link rel="stylesheet" href="{{ URL::asset('public/css/college-insert.css') }}">
@elseif ($_name === 'detail')
	<link rel="stylesheet" href="{{ URL::asset('public/css/college-insert.css') }}">
@else
	<link rel="stylesheet" href="{{ URL::asset('public/css/question-list.css') }}">
@endif
@endsection

@section('main')

	@include('common.header')

	<div class="main clear">
		
		@include('common.menus', ['tabIndex' => 'college'])

		<section class="cont-box">
			@if ($_name === 'insert')
				@include('college.insert')
			@elseif ($_name === 'detail')
				@include('college.detail',compact('college'))
			@else
				@include('college.list',compact('total','list','page'))
			@endif
		</section>

	</div>

@endsection