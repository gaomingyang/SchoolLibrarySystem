@extends('layouts.admin')


@section('content')
<div class="page-header">
    <h3>增加学生</h3>
</div>
<form action="{{ url('/admin/student') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	@include('admin.student.form')
	<div class="form-group" style="">
	    <div class="col-md-offset-2 col-md-10">
	    	<button class="btn btn-primary" type="submit">确定</button>
	    </div>
	</div>
</form>
@endsection
