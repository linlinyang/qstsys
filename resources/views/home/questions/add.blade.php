
<div class="address-nav">
	<a href="{{ url('home') }}">题库管理</a>
	<span> / 添加题目</span>
</div>

<div class="panel">
	<div class="panel-header">
		<span class="title">添加题目</span>
	</div>
	<div class="panel-body">
		<div class="nav-tabs">
			<div class="item">
				<a href="#single">单个</a>
			</div>
			<div class="item">
				<a href="#batch">批量</a>
			</div>
		</div>

		<form action="{{ url('home/add') }}" method="post" id="question" enctype="multipart/form-data" class="form">
			<div class="single">
				<div class="form-group">
					<label class="label">题目<span class="require">*</span></label>
					<div class="fill">
						<input type="text" name="title" placeholder="请输入题目" class="form-control" value="{{ old('title') }}">
						<div class="option-add">
							<div class="form-control btn" title="添加选项"><i class="iconfont icon-jiahao"></i>添加选项</div>
						</div>

					</div>
				</div>
				<div class="options">
					<div class="form-group">
						<label class="label">选项1</label>
						<div class="fill">
							<i class="iconfont icon-edit-square"></i>
							<input type="text" name="item1" class="form-control" placeholder="请输入此选项内容" value="{{ old('item1') }}">
							<div class="checkbox" title="是否为正确答案">
								<input type="hidden" name="check1" value="{{ old('check1') == 1 ? 1 : 0 }}">
								<i class="iconfont icon-check icon"></i>
							</div>
						</div>
						<div class="upload">
							<input type="hidden" name="file1" class="rfile" value="{{ old('file1') }}">
							<div class="upload-btn" title="点击上传图片">
								<input type="file" name="file-btn" accept='image/png,image/jpg,image/jpeg' title="点击上传图片">
								<span>请选择图片</span>
							</div>
							<div class="preview">
								<div class="imgbox">
									@if (old('file1'))
									<img src="{{ old('file1') }}">
									@endif
									<div class="shadow"></div>
									<i class="iconfont icon-close remove-prev"></i>
								</div>
							</div>	
						</div>
						<div class="help-block">
							<span>图片大小不得超过3M,尺寸推荐正方形。如果不需要图片，请不要选择。选项内容和选项图片都为空则视为该选项废弃</span>
						</div>
					</div>
					<div class="form-group">
						<label class="label">选项2</label>
						<div class="fill">
							<i class="iconfont icon-edit-square"></i>
							<input type="text" name="item2" class="form-control" placeholder="请输入此选项内容" value="{{ old('item2') }}">
							<div class="checkbox" title="是否为正确答案">
								<input type="hidden" name="check2" value="{{ old('check2') == 1 ? 1 : 0 }}">
								<i class="iconfont icon-check icon"></i>
							</div>
						</div>
						<div class="upload">
							<input type="hidden" name="file2" class="rfile" value="{{ old('file2') }}">
							<div class="upload-btn" title="点击上传图片">
								<input type="file" name="file-btn" accept='image/png,image/jpg,image/jpeg' title="点击上传图片">
								<span>请选择图片</span>
							</div>
							<div class="preview">
								<div class="imgbox">
									@if (old('file2'))
									<img src="{{ old('file2') }}">
									@endif
									<div class="shadow"></div>
									<i class="iconfont icon-close remove-prev"></i>
								</div>
							</div>	
						</div>
						<div class="help-block">
							<span>图片大小不得超过3M,尺寸推荐正方形。如果不需要图片，请不要选择。选项内容和选项图片都为空则视为该选项废弃</span>
						</div>
					</div>
					<div class="form-group">
						<label class="label">选项3</label>
						<div class="fill">
							<i class="iconfont icon-edit-square"></i>
							<input type="text" name="item3" class="form-control" placeholder="请输入此选项内容" value="{{ old('item3') }}">
							<div class="checkbox" title="是否为正确答案">
								<input type="hidden" name="check3" value="{{ old('check3') == 1 ? 1 : 0 }}">
								<i class="iconfont icon-check icon"></i>
							</div>
						</div>
						<div class="upload">
							<input type="hidden" name="file3" class="rfile" value="{{ old('file3') }}">
							<div class="upload-btn" title="点击上传图片">
								<input type="file" name="file-btn" accept='image/png,image/jpg,image/jpeg' title="点击上传图片">
								<span>请选择图片</span>
							</div>
							<div class="preview">
								<div class="imgbox">
									@if (old('file3'))
									<img src="{{ old('file3') }}">
									@endif
									<div class="shadow"></div>
									<i class="iconfont icon-close remove-prev"></i>
								</div>
							</div>	
						</div>
						<div class="help-block">
							<span>图片大小不得超过3M,尺寸推荐正方形。如果不需要图片，请不要选择。选项内容和选项图片都为空则视为该选项废弃</span>
						</div>
					</div>
					<div class="form-group">
						<label class="label">选项4</label>
						<div class="fill">
							<i class="iconfont icon-edit-square"></i>
							<input type="text" name="item4" class="form-control" placeholder="请输入此选项内容" value="{{ old('item4') }}">
							<div class="checkbox" title="是否为正确答案">
								<input type="hidden" name="check4" value="{{ old('check4') == 1 ? 1 : 0 }}">
								<i class="iconfont icon-check icon"></i>
							</div>
						</div>
						<div class="upload">
							<input type="hidden" name="file4" class="rfile" value="{{ old('file4') }}">
							<div class="upload-btn" title="点击上传图片">
								<input type="file" name="file-btn" accept='image/png,image/jpg,image/jpeg' title="点击上传图片">
								<span>请选择图片</span>
							</div>
							<div class="preview">
								<div class="imgbox">
									@if (old('file4'))
									<img src="{{ old('file4') }}">
									@endif
									<div class="shadow"></div>
									<i class="iconfont icon-close remove-prev"></i>
								</div>
							</div>	
						</div>
						<div class="help-block">
							<span>图片大小不得超过3M,尺寸推荐正方形。如果不需要图片，请不要选择。选项内容和选项图片都为空则视为该选项废弃</span>
						</div>
					</div>
				</div>
			</div>

			<div class="batch">
				<div class="form-group">
					<label class="label">上传文件<span class="require">*</span></label>
					<div class="fill">
						<input type="text" readonly="true" class="form-control">
						<div class="add-btn btn">
							<input type="file" name="batch" accept=".csv,.xls,.xlsx">
							<span><i class="iconfont icon-upload"></i>选择文件</span>
						</div>
						<a href="{{ url('download/medule.zip') }}" target="_blank" class="download btn"><i class="iconfont icon-download"></i>下载模板</a>
					</div>
				</div>
			</div>

			<div class="form-group">
				{!! csrf_field() !!}
				<input type="submit" name="submit" class="btn submit" value="确认添加">
			</div>
		</form>

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

<script type="text/javascript">
	
	$(function(){

		$(window).on('hashchange',hashChange);
		hashChange();

		$(".form").click(function(e){
			var target = $(e.target);

			if(target.hasClass('remove-prev')){
				removePrev(target);
			}

			var $optionAdd = $(".form .option-add");
			if($optionAdd[0].contains(target[0])){
				addOption();
			}

			if(target.hasClass('checkbox')){
				toggleSelect(target);
			}
			var checkbox = target.parents('.checkbox');
			checkbox.length > 0 && toggleSelect(checkbox);

		});

		$(".form").change(function(e){
			var target = $(e.target);

			if(target.attr('name') === 'file-btn'){
				uploadImg(target);
			}

			if(target[0].getAttribute('name') === 'batch'){
				uploadBatchFile(target);
			}
		});

		$(".form .checkbox").each(function(){
			toggleSelect($(this),true);
		});

	});

	function toggleSelect($target,isInit){
		var $ipt = $target.children('input'),
			val = $.trim($ipt.val()),
			$icon = $target.children('i');

		if(isInit){
			$icon.css({
				opacity: val && val == 1 ? 1 : 0,
				visibility: val && val == 1 ? 'visible' : 'hidden'
			});
		}else{
			$icon.css({
				opacity: val && val == 1 ? 0 : 1,
				visibility: val && val == 1 ? 'hidden' : 'visible'
			});
		}

		!isInit && $ipt.val(val == 1 ? 0 : 1);
	}

	function removePrev($target){
		$target.parent().children('img').remove();
		var $thisUpload = $target.parents('.upload');
		$thisUpload.children('.rfile').val('');
		$thisUpload.find('.upload-btn input[name=file-btn]').remove();
		$thisUpload.children('.upload-btn').prepend('<input type="file" name="file-btn" accept="image/png,image/jpg,image/jpeg" title="点击上传图片">');

	}

	function uploadImg($target){
		var fileTag = $target[0];

		if(fileTag.files.length === 0){
			return ;
		}

		var oFile = fileTag.files[0];
		if(!/image\/(jpe?g|png)/g.test(oFile.type)){
			alert('请选择正确的图片格式');
			return ;
		}

		if(!FileReader){
			alert('您的浏览器不支持上传预览图片，请选择高版本浏览器');
			return ;
		}
		var reader = new FileReader();
		reader.onload = function(e){
			var imgSrc = e.target.result;

			var img = new Image();
			img.onload = function(){
				var $preview = $target.parent().siblings('.preview').children();
				$preview.children('img').remove();
				$preview.prepend(img);

				var base64 = compressImg(img,oFile.type);
				$target.parents('.upload').children('.rfile').val(base64);
			};
			img.src = imgSrc;
		}

		reader.readAsDataURL(oFile);
		reader = null;
	}

	function compressImg(img,type,$valEl){
		var width = img.width,
			height = img.height,
			quality = 1,
			canvas = document.createElement('canvas'),
			ctx = canvas.getContext('2d');
		canvas.width = width;
		canvas.height = height;
		ctx.drawImage(img,0,0,width,height);
		var base64 = canvas.toDataURL(type,quality);

		return base64;
	}

	function addOption(){

		var staticIndex = $(".form .options>.form-group").length;
		if(staticIndex > 20){
			alert('选项不能超过20个');
			return ;
		}

		var str = 
			'<div class="form-group">'+
				'<label class="label">选项' + ++staticIndex + '</label>'+
				'<div class="fill">'+
					'<i class="iconfont icon-edit-square" style="margin-right: 5px;"></i>'+
					'<input type="text" name="item' + staticIndex + '" class="form-control" placeholder="请输入此选项内容">'+
					'<div class="checkbox" title="是否为正确答案">'+
						'<input type="hidden" name="check' + staticIndex + '" value="0">'+
						'<i class="iconfont icon-check icon"></i>'+
					'</div>'+
				'</div>'+
				'<div class="upload">'+
					'<input type="hidden" name="file' + staticIndex + '" class="rfile">'+
					'<div class="upload-btn" title="点击上传图片">'+
						'<input type="file" name="file-btn" accept="image/png,image/jpg,image/jpeg" title="点击上传图片">'+
						'<span>请选择图片</span>'+
					'</div>'+
					'<div class="preview">'+
						'<div class="imgbox">'+
							'<div class="shadow"></div>'+
							'<i class="iconfont icon-close remove-prev"></i>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="help-block">'+
					'<span>图片大小不得超过3M,尺寸推荐正方形。如果不需要图片，请不要选择。选项内容和选项图片都为空则视为该选项废弃</span>'+
				'</div>'+
			'</div>';

		$(".form .options").append(str);

	}

	function uploadBatchFile($target){
		var oFiles = $target[0].files;
		if(oFiles.length == 0){
			return ;
		}
		var oFile = oFiles[0];

		$(".batch .fill>input").val(oFile.name || '');
	}

	function hashChange(){
		var hash = location.hash;
		if(hash === '#batch'){
			toBatch();
		}else{
			toSingle();
		}
	}

	function toSingle(){
		$(".nav-tabs .item").removeClass('active').eq(0).addClass('active');
		$(".batch").hide();
		$(".single").show();
	}

	function toBatch(){
		$(".nav-tabs .item").removeClass('active').eq(1).addClass('active');
		$(".batch").show();
		$(".single").hide();
	}

</script>