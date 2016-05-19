@extends('layouts.admin')

@section('content')
<h2 class="sub-header">管理员列表</h2>
<p>
    <a href="/admin/user/create" class="btn btn-success">增加管理员</a>
</p>
<div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/user/trashed" class="label label-default ">已删除</a>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>id</th>
				<th>姓名</th>
				<th>email</th>
                <th>操作</th>
			</tr>
		</thead>
		<tbody>

			@foreach($users as $u)
			<tr>
				<td>{{$u->id}}</td>
                <td>{{$u->name}}</td>
				<td>{{$u->email}}</td>
				<td>
					<a href="/admin/user/{{$u->id}}/edit" class="btn btn-xs btn-info">编辑</a>
                    <a href="#">删除</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection
