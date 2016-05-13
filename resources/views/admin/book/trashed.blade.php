@extends('layouts.admin')



@section('content')
@include('common.flash')

<h2 class="sub-header">已删除图书</h2>

<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>书名</th>
			<th>出版社</th>
			<th>作者</th>
			<th>数目</th>
			<th>备注</th>
			<th>删除时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($books as $b)
		<tr>
			<td>{{$b->id}}</td>
			<td><a href="/admin/book/{{$b->id}}">{{$b->name}}</a></td>
			<td>{{$b->publisher}}</td>
			<td>{{$b->author}}</td>
			<td>{{$b->number}}</td>
			<td>{{$b->comment}}</td>
			<td>{{$b->deleted_at}}</td>
			<td><a href="#">恢复</a></td>
		</tr>
		@endforeach
	</tbody>
	</table>
</div> 
@endsection


