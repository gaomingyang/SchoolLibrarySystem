@extends('layouts.admin')


@section('content')
@include('common.flash')

<h2 class="sub-header">图书分类</h2>
<p>
    <a href="/admin/category/create" class="btn btn-success">创建分类</a>
</p>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>分类名</th>
				<th><div class="pull-right">操作</div></th>
			</tr>
		</thead>
		<tbody>

			@foreach($categories as $c)
			<tr>
				<td>{{$c->id}}</td>
				<td><a>{{$c->name}}</a></td>
				<td>
                    <div class="pull-right">
                        <form action="{{ url('admin/category/'.$c->id) }}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> 删除
                            </button>
                        </form>
                    </div>
                    <div class="pull-right">
                        <a href="{{url('admin/category/'.$c->id.'/edit')}}" class="btn btn-info">编辑</a>
                    </div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{!! $categories->render() !!}
@endsection
