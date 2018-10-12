<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0,user-scalable=0" />
	<title>@yield('title','答题系统')</title>
	<style type="text/css">
		body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li, pre, form, fieldset, legend, button, input, textarea, th, td { margin:0; padding:0; } 
	    body, button, input, select, textarea { font:12px/1.5tahoma, arial, \5b8b\4f53; } 
	    h1, h2, h3, h4, h5, h6{ font-size:100%; } 
	    address, cite, dfn, em, var { font-style:normal; } 
	    code, kbd, pre, samp { font-family:couriernew, courier, monospace; } 
	    small{ font-size:12px; } 
	    ul, ol { list-style:none; } 
	    a { text-decoration:none; } 
	    a:hover { text-decoration:underline; } 
	    sup { vertical-align:text-top; } 
	    sub{ vertical-align:text-bottom; } 
	    legend { color:#000; } 
	    fieldset, img { border:0; } 
	    button, input, select, textarea { font-size:100%; } 
	    table { border-collapse:collapse; border-spacing:0; }
	    i{ font-style: normal; }
	</style>
	<link rel="stylesheet" href="{{ URL::asset('public/css/icons/iconfont.css') }}">
	<script
  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script>
	@section('header')
	@show
</head>
<body>
	
	@section('main')
	@show

</body>
</html>