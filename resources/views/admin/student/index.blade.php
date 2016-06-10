@extends('layouts.admin')

@section('content')
@include('common.flash')
<h2 class="sub-header">学生列表</h2>
<p>
    <a href="/admin/student/create" class="btn btn-success">增加学生</a>
</p>
<div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/student/trashed" class="label label-default ">已删除</a>
	</div>
</div>
<p>已登记学生 {{$student_number}}人</p>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>班级</th>
				<th>姓名</th>
				<th>性别</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
				<td>
					{{$student->squad->name}}
				</td>
				<td><a href="/admin/student/{{$student->id}}">{{$student->name}}</a></td>
				<td>{{$student->gendername()}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
</div>
@endsection
