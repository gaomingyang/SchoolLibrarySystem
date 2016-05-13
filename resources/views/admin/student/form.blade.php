<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
	<label for="grade_id" class="control-label col-md-2">所在班级</label>
	<div class="col-md-2">
		<select name="grade_id" id="" class="form-control">
			<option value="">班级</option>
			@foreach($grades as $grade)
			<option value="{{$grade->id}}"
			@if(isset($student) )
				@if($student->grade_id == $grade->id)
					selected
				@endif
			@endif
				 >{{$grade->name}}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="form-group">
	<label for="name" class="control-label col-md-2">学生姓名</label>
	<div class="col-md-4">
		<input type="text" class="form-control" name="name" placeholder="" maxlength="10" value="{{ isset($student->name) ? $student->name : '' }}">
	</div>
</div>

<div class="form-group">
	<label for="gender" class="control-label col-md-2">性别</label>
	<div class="col-md-4">
		<label class="radio-inline"><input type="radio" name="gender" value="1"
			@if(isset($student) && $student->gender == 1 ) checked @endif>男</label>&nbsp;&nbsp;
		<label class="radio-inline"><input type="radio" name="gender" value="2"
			@if(isset($student) && $student->gender == 2 ) checked @endif>女</label>
		&nbsp;&nbsp;
	</div>
</div>
