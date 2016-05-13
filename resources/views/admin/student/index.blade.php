@extends('layouts.admin')

@section('content')
<h2 class="sub-header">学生列表</h2>
<p>已登记学生 {{$student_number}}人</p>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<!-- <th>ID</th> -->
				<th>班级</th>
				<th>姓名</th>
				<th>性别</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
				<!--<td>{{$student->id}}</td> -->
				<td>
					{{$student->grade->name}}
				</td>
				<td><a href="/admin/student/{{$student->id}}">{{$student->name}}</a></td>
				<td>
					@if($student->gender == 1) 男
					@elseif($student->gender == 2) 女
					@else 未填
					@endif
				</td>
				<td>
					<!-- <a href="">编辑</a>
					<a href="">删除</a> -->
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
</div>
@endsection
