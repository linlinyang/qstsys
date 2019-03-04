
<aside class="menus">

	<a href="{{ url('home') }}" class="item {{ $tabIndex === 'home' ? 'active' : '' }}">
		<i class="icon-home iconfont"></i>
		<span>题库管理</span>
		<i class="icon-right iconfont"></i>
	</a>

	<!-- <a href="{{ url('score') }}" class="item {{ $tabIndex === 'score' ? 'active' : '' }}">
		<i class="icon-tiaoshi iconfont"></i>
		<span>答题管理</span>
		<i class="icon-right iconfont"></i>
	</a> -->

	<a href="{{ url('college') }}" class="item {{ $tabIndex === 'college' ? 'active' : '' }}">
		<i class="icon-tiaoshi iconfont"></i>
		<span>学院管理</span>
		<i class="icon-right iconfont"></i>
	</a>

	<a href="{{ url('setting') }}" class="item {{ $tabIndex === 'setting' ? 'active' : '' }}">
		<i class="icon-setting iconfont"></i>
		<span>系统设置</span>
		<i class="icon-right iconfont"></i>
	</a>

</aside>