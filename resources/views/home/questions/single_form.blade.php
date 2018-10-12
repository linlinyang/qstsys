
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
		<label class="label">选项一</label>
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
		<label class="label">选项二</label>
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
		<label class="label">选项三</label>
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
		<label class="label">选项四</label>
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