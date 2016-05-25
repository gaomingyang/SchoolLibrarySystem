@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h3>增加管理员账号</h3>
</div>

<form action="{{ url('/admin/user') }}" method="post" class="form-horizontal">
	@include('admin.user.form')
	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>确定
            </button>
        </div>
    </div>

</form>
@endsection

