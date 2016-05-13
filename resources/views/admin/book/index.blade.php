@extends('layouts.admin')


@section('content')
@include('common.flash')

<h2 class="sub-header">图书列表</h2>
<p>
    <a href="/admin/book/create" class="btn btn-success">增加图书</a>
</p>
<div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/book/trashed" class="label label-default ">已删除</a>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>编号</th>
                <th>分类</th>
				<th>书名</th>
				<th>标签</th>
				<th>出版社</th>
				<th>作者</th>
				<th>操作</th>
				<!-- <th>数目</th>
				<th>位置</th>
				<th>备注</th> -->
			</tr>
		</thead>
		<tbody>

			@foreach($books as $b)
			<tr>
				<td>{{$b->id}}</td>
                <td>@if($b->category_id == 0) 未分类
					@else
					{{$b->category->name}}
					@endif
				</td>
				<td><a href="/admin/book/{{$b->id}}">{{$b->name}}</a></td>
                <td>
                    @foreach($b->tags as $tag)
                        <span class="label label-info">{{$tag->name}}</span>
                    @endforeach
                </td>
				<td>{{$b->publisher}}</td>
				<td>{{$b->author}}</td>
				<td>
					<a href="/admin/book/{{$b->id}}/edit" class="btn btn-xs btn-info">编辑</a>

				</td>

				<!-- <td>{{$b->number}}</td>
				<td>{{$b->location}}</td>
				<td>
				@if($b->comment)
				{{$b->comment}}
				@endif
				</td> -->
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! $books->render() !!}
@endsection
