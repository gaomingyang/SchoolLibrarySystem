@extends('layouts.admin')

@section('content')
@include('common.flash')
<h2 class="sub-header">已毕业学生</h2>
<div class="row">
	<div class="col-md-4">
		<div class="input-group">
			<input type="text" class="form-control" name="name" value="" placeholder="学生名">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" name="button">搜索</button>
			</span>
		</div>
	</div>
	<div class="col-md-2">
		<p class="form-control-static">共{{$number}}人</p>
	</div>
</div>

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
                    <a href="#gr_{{$student->id}}" class="btn btn-xs btn-success" data-toggle="modal" title="取消毕业状态，恢复到所在的班级">恢复</a>
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
</div>
@include('admin.student.rise.unrise');
@endsection


@section('js')
<script type="text/javascript">
	$('#myModal').modal();
</script>

@endsection
