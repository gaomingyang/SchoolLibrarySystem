<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">书名</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" name="name" placeholder="图书标题" maxlength="50" value="{{ isset($book->name) ? $book->name : '' }}" required>
		{!! ($errors->has('name') ? $errors->first('name') : '') !!}
		<p style="color:red;" class="name_warning"></p>
	</div>
</div>

<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">出版社</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" name="publisher" placeholder="出版社名称" maxlength="50" value="{{ isset($book->publisher) ? $book->publisher : '' }}">
		<font color="red">{{ $errors->first('publisher') }}</font>
	</div>
</div>

<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">作者</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" name="author" placeholder="作者名" maxlength="10" value="{{ isset($book->author) ? $book->author : '' }}">
		{!! ($errors->has('author') ? $errors->first('author') : '') !!}
	</div>
</div>

<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">分类</label>
	<div class="col-xs-12 col-sm-3 col-md-3">
		<!-- <input type="text" class="form-control" name="author" placeholder="作者名" maxlength="10" value="{{ isset($book->author) ? $book->author : '' }}"> -->
		<select class="form-control" name="category_id">
			<option value="0"
				@if(isset($book) && $book->category_id ==0  )
				selected
				@endif
			>未分类</option>
			@foreach($categories as $c)
			<option value="{{$c->id}}"
				@if( isset($book) && $book->category_id == $c->id )
				selected
				@endif>{{$c->name}}</option>
			@endforeach

		</select>
		{!! ($errors->has('category') ? $errors->first('category') : '') !!}
	</div>
</div>



<div class="form-group">
	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">标签</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" id="tags" name="tags" placeholder="回车确定"
	</div>
</div>

<div class="form-group">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<hr>
	</div>
</div>


<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">数目</label>
	<div class="col-xs-12 col-sm-2 col-md-2">
		<input type="number" class="form-control" name="number" placeholder="1" maxlength="10" value="{{ isset($book->number) ? $book->number : 1 }}">
	</div>
</div>

<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">位置</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" name="location" placeholder="" maxlength="10"  value="{{ isset($book->location) ? $book->location : '图书室' }}">
	</div>
</div>

<div class="form-group">
	<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">备注</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<textarea name="comment" id="" cols="30" rows="5" class="form-control">{{ isset($book->comment) ? $book->comment : '' }}</textarea>
	</div>
</div>

<!-- <div class="form-group">
	<label for="" class="control-label col-md-2">选择图像</label>
	<div class="col-md-6">
		<input type="file" name="photo" id="photo" />
	</div>
	<span class="path"></span>
</div> -->
