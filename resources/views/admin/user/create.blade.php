@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h3>{{ trans('user.create_title') }}</h3>
</div>

<form action="{{ url('/admin/user') }}" method="post" class="form-horizontal">
	@include('admin.user.form')
	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>{{ trans('common.submit')}}
            </button>
        </div>
    </div>

</form>
@endsection
