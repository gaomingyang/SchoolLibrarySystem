@extends('layouts.admin')

@section('content')
@include('common.flash')
<div class="page-header">
    <h3>系统设置</h3>
</div>
<form action="{{ url('/admin/system/1') }}" method="post" class="form-horizontal" >
	<input type="hidden" name="_method" value="PUT">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="form-group">
		<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">前台名称</label>
		<div class="col-xs-12 col-sm-4 col-md-4">
			<input type="text" class="form-control" name="front_name" placeholder="" maxlength="50" value="{{ isset($system->front_name) ? $system->front_name : config('system.front_name') }}" required>
			{!! ($errors->has('front_name') ? $errors->first('front_name') : '') !!}
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">后台名称</label>
		<div class="col-xs-12 col-sm-4 col-md-4">
			<input type="text" class="form-control" name="system_name" placeholder="" maxlength="50" value="{{ isset($system->system_name) ? $system->system_name : config('system.system_name') }}" required>
			{!! ($errors->has('system_name') ? $errors->first('system_name') : '') !!}
		</div>
	</div>

    <div class="form-group">
		<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">开放借书班级</label>
		<div class="col-xs-12 col-sm-1 col-md-1">
			勾选允许借书的班级。
		</div>
	</div>

	<div class="form-group">
		<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">每人最多可借</label>
		<div class="col-xs-12 col-sm-1 col-md-1">
			<input type="number" min="1" class="form-control" name="borrow_number_limit"  maxlength="2" value="{{ isset($system->borrow_number_limit) ? $system->borrow_number_limit : config('system.borrow_number_limit') }}" required>
			{!! ($errors->has('borrow_number_limit') ? $errors->first('borrow_number_limit') : '') !!}
		</div>
	</div>

	<div class="form-group">
		<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">最长借书天数</label>
		<div class="col-xs-12 col-sm-1 col-md-1">
			<input type="number" min="1" class="form-control" name="borrow_days_limit" placeholder="" maxlength="2" value="{{ isset($system->borrow_days_limit) ? $system->borrow_days_limit : config('system.borrow_days_limit') }}" required>
			{!! ($errors->has('borrow_days_limit') ? $errors->first('borrow_days_limit') : '') !!}
		</div>
	</div>

	<div class="form-group" style="">
	    <div class="col-xs-12 col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2">
	    	<button class="btn btn-primary" type="submit">确定</button>
	    </div>
	</div>
</form>

@endsection
