<form action="{{ url('setting/count') }}" method="post" enctype="multipart/form-data" id="count">

<div class="panel">
	
	<div class="panel-header">
		<span>账号设置</span>
	</div>
	<div class="panel-body">
		
			<div class="form-group">
				<label class="label">账号：</label>
				<div class="col">
					<input type="text" placeholder="请输入用户名" name="uname" class="form-control" value="{{ $info->uname }}" readonly="true">
				</div>
			</div>

			<div class="form-group">
				<label class="label">原始密码：</label>
				<div class="col">
					<input type="password" placeholder="请输入登录密码" class="form-control" name="old_passwd">
				</div>
			</div>

			<div class="form-group">
				<label class="label">新密码：</label>
				<div class="col">
					<input type="password" placeholder="请输入登录密码" class="form-control" name="passwd">
				</div>
			</div>

			<div class="form-group">
				{!! csrf_field() !!}
				<input type="submit" name="submit" class="btn submit" value="提交">
			</div>
			
	</div>

</div>

</form>

<form action="{{ url('setting/other') }}" method="post" enctype="multipart/form-data" id="other">

<div class="panel panel-primary">
	
	<div class="panel-header">
		<span>其他设置</span>
	</div>
	<div class="panel-body">

			<div class="form-group">
				<label class="label">考试题目：</label>
				<div class="col">
					<input type="text" placeholder="请输入考试题目数" class="form-control" name="totalnum" value="{{ $info->totalnum }}">
				</div>
				<div class="col">
					<span>（随机抽取的题目数，即考试题目数）</span>
				</div>
			</div>

			<div class="form-group">
				<label class="label">考试时间：</label>
				<div class="col">
					<input type="text" placeholder="请输入考试时间" class="form-control" name="examtime" value="{{ $info->examtime }}">
				</div>
				<div class="col">
					<span>（单位：秒）</span>
				</div>
			</div>

			<div class="form-group">
				{!! csrf_field() !!}
				<input type="submit" name="submit" class="btn submit" value="提交">
			</div>
			
	</div>

</div>

</form>

@include('common.message')