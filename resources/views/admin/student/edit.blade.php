@extends('layouts.admin')


@section('content')
<div class="page-header">
    <h3>修改学生信息</h3>
</div>

<form action="{{URL('/admin/student/'.$student->id)}}" method="POST" class="form-horizontal">
	<input type="hidden" name="_method" value="PUT">
	@include('admin.student.form')
	<div class="form-group" style="">
	    <div class="col-md-offset-2 col-md-10">
	    	<button class="btn btn-primary" type="submit">确定</button>
	    </div>
	</div>
</form>
@endsection
