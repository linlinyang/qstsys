@extends('../common.base')

@section('title', '题库系统')

@section('header')
<link rel="stylesheet" href="{{ URL::asset('public/css/home.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/css/setting-default.css') }}">
@endsection

@section('main')

	@include('common.header')

	<div class="main clear">
		
		@include('common.menus', ['tabIndex' => 'setting'])

		<section class="cont-box">
			@include('setting.default')
		</section>

	</div>

@endsection