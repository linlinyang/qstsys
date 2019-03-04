
<div class="panel">
	<div class="panel-header">
		<span class="title">学院列表</span>
		<a href="{{ url('college/add') }}" class="append btn">
			<i class="iconfont icon-jiahao"></i>
			<span>添加学院</span>
		</a>
	</div>
	<div class="panel-body">
		<div class="search-box">
			<button class="form-control search-btn btn">
				<i class="iconfont icon-search"></i>
				搜索
			</button>
			<input type="text" name="title" placeholder="题目学院" class="form-control" value="{{ $search }}">
		</div>

		<table class="table">
			<thead>
				<tr>
					<th width="30">
						<label class="customer-checkbox" title="全选/不全选" data-batch='true'>
							<input type="hidden" name="all" value="0">
							<i class="iconfont icon-check"></i>
						</label>
					</th>
					<th>序号</th>
					<th>学院</th>
					<th>排序</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($list as $key => $row)
				<tr>
					<td width="30">
						<label class="customer-checkbox" data-qstid='{{ $row->id }}'>
							<input type="hidden" name="ids" value="0">
							<i class="iconfont icon-check"></i>
						</label>
					</td>
					<td title="序号">{{ $key + 1 }}</td>
					<td>
						{{ $row->name }}
					</td>
					<td>{{ $row->order }}</td>
					<td>
						<a href="{{ action('web\College@detail',['cid' => $row->id]) }}" class="btn btn-primary" title="查看题目详情">
							<i class="iconfont icon-bianji">详情</i>
						</a>
						<a href="{{ action('web\College@delete',['cid' => $row->id,'page' => $page,'search' => $search]) }}" class="btn btn-error" title="删除选中题目" onclick="return confirm('此操作不可恢复，确认删除？');">
							<i class="iconfont icon-shanchu">删除</i>
						</a>
					</td>
				</tr>
				@endforeach
				<tr>
					<td class="delete-all btn" title="删除选中题目">删除</td>
					<td colspan="4">
						删除操作不可恢复，慎重操作
					</td>
				</tr>
			</tbody>
		</table>
		{{ $list->links() }}
	</div>
</div>

<script type="text/javascript">
	$(function(){

		$(".table").click(function(e){

			var $target = $(e.target);

			if($target.hasClass('customer-checkbox')){
				toggleCheckbox($target);
			}

			$checkbox = $target.parents('.customer-checkbox');
			if($checkbox.length > 0){
				toggleCheckbox($checkbox);
			}

			if($target.hasClass('delete-all')){
				batchDelete();
			}

		});

		$(".panel .search-btn").click(function(){
			var val = $.trim($(this).next().val()),
				url = '{{ url("college") }}';

			if(!val){
				location.replace(url);
				return ;
			}
			
			location.replace(url+'?search='+val);
		});

		function toggleCheckbox($checkbox,flag){

			if($checkbox.data('batch')){
				toggleCheckbox($(".customer-checkbox[data-batch!=true]"),!$checkbox.hasClass('active'));
			}
			if(flag !== undefined){
				flag 
					? $checkbox.addClass('active')
					: $checkbox.removeClass('active');
			}else{
				$checkbox.toggleClass('active');
			}

		}

		function batchDelete(){
			var qids = [];
			$("tbody .customer-checkbox.active").each(function(){
				qids.push($(this).data('qstid'));
			});
			if(qids.length === 0){
				alert('请选择要删除的题目');
				return ;
			}
			if(confirm('此操作不可恢复，确认删除？')){
				var url = '{{ url("college/delete") }}'+'?cid='+qids.join(',')+'&page='+getUrlParams('page')+'&search='+getUrlParams('search');
				location.replace(url);
			}
		}

		function getUrlParams(name){
			var search = decodeURIComponent(location.search),
				reg = new RegExp("[\?|\&]" + name + "=(.+)(\&*)");
				match = search.match(reg);
			return match ? match[1] : '';
		}

	});
</script>


@if (session('success') || $errors->any())

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
			var tipsEl = document.querySelector('.tips');

			tipsEl.style.display = 'none';
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