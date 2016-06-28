@extends('layouts.admin')

@section('content')
<h2 class="sub-header">{{trans('user.list_title')}}</h2>
<p>
    <a href="/admin/user/create" class="btn btn-success">{{trans('common.create')}}</a>
</p>
<!-- <div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/user/trashed" class="label label-default ">{{trans('common.deleted')}}</a>
	</div>
</div> -->

<div class="table-responsive">
    @include('common.flash')
	<table class="table table-striped">
		<thead>
			<tr>
				<th>{{trans('user.name')}}</th>
				<th>{{trans('user.email')}}</th>
                <th>@lang('common.operation')</th>
			</tr>
		</thead>
		<tbody>

			@foreach($users as $u)
			<tr>
                <td>{{$u->name}}</td>
				<td>{{$u->email}}</td>
				<td>
					<a href="/admin/user/{{$u->id}}/edit" class="btn btn-xs btn-info">{{trans('common.edit')}}</a>
                    <a href="#d_{{$u->id}}" data-toggle="modal" class="btn btn-xs btn-danger" >{{trans('common.delete')}}</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@include('admin.user.deletes')
@endsection

@section('js')
<script src="{{ asset('js/dform.js') }}"></script>
@endsection
