<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">所属年级</label>
	<div class="col-xs-12 col-sm-4 col-md-4">
		<select class="form-control" name="">
            <option value="">年级</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">班级名称</label>
	<div class="col-xs-12 col-sm-4 col-md-4">
		<input type="text" class="form-control" name="name" placeholder="班级名称"  value="{{ isset($grade->name) ? $grade->name : '' }}">
	</div>
</div>
