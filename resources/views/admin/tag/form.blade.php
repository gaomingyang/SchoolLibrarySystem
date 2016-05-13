<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">标签名</label>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<input type="text" class="form-control" name="name" placeholder="标签名"  value="{{ isset($tag->name) ? $tag->name : '' }}">
	</div>
</div>
