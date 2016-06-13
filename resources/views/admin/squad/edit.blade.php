@extends('layouts.admin')


@section('content')
<div class="page-header">
    <h3>修改班级</h3>
</div>
<form action="{{ url('/admin/squad/'.$squad->id) }}" method="post" class="form-horizontal" >
    <input type="hidden" name="_method" value="put">
	@include('admin.squad.form')
	<div class="form-group" style="">
	    <div class="col-xs-12 col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2">
	    	<button class="btn btn-primary" type="submit">{{trans('common.submit')}}</button>
	    </div>
	</div>
</form>
@endsection
