@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h3>个人信息修改</h3>
</div>
<form action="{{ url('/admin/user/'.$user->id) }}" method="post" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    @include('admin.user.form1')
	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>确定
            </button>
        </div>
    </div>
</form>

<div class="page-header">
    <h3>密码修改</h3>
</div>
<form action="{{ url('/admin/user/'.$user->id) }}" method="post" class="form-horizontal">
    <input type="hidden" name="_method" value="PUT">
    @include('admin.user.form2')
	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>确定
            </button>
        </div>
    </div>
</form>

@endsection
