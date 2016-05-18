@extends('layouts.admin')



@section('content')
@include('common.flash')

<h2 class="sub-header">已删除学生</h2>
<p>{{$number}}人</p>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>班级</th>
				<th>姓名</th>
				<th>性别</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
				<td>
					{{$student->grade->name}}
				</td>
				<td><a href="/admin/student/{{$student->id}}">{{$student->name}}</a></td>
				<td> {{$student->gendername()}}</td>
				<td>
					<a href="/admin/student/{{$student->id}}/restore" class="btn btn-info btn-xs">恢复</a>
					<!-- <a href="" class="btn btn-danger btn-xs">彻底删除</a> -->
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
