@extends('layouts.admin')

@section('content')
@include('common.flash')
<h2 class="sub-header">已毕业学生</h2>
<p>共{{$number}}人</p>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>姓名</th>
				<th>性别</th>
				<th>曾在班级</th>
				<th>毕业时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
                <td><a href="/admin/student/{{$student->id}}">{{$student->name}}</a></td>
                <td>{{$student->gendername()}}</td>
				<td>{{$student->squad->name}}</td>
                <td>{{$student->graduated_at}}</td>
                <td>
                    <a href="#" title="取消毕业状态，恢复到所在的班级">恢复</a>
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
</div>
@endsection
