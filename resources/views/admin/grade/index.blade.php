@extends('layouts.admin')


@section('css')
<style type="text/css">
    a {
        text-decoration: none;
    }
    .page-header{
        border-bottom: none;
        padding-bottom: 0;
    }
    .gradeBlock{
        /*border: 1px solid #ccc;*/
    }
</style>

@endsection

@section('content')
@include('common.flash')

<h2 class="sub-header">年级/班级</h2>
<p>
    <a href="/admin/grade/create" class="btn btn-success">增加年级</a>
    <a href="/admin/squad/create" class="btn btn-primary">增加班级</a>
    <a href="/admin/grade/rise" class="btn btn-warning">毕业/升年级</a>
</p>
<div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/student/graduated" class="label label-default ">已毕业学生</a>
		<a href="/admin/grade/trashed" class="label label-default ">已删除</a>
	</div>
</div>


@foreach($grades as $grade)
<div class="gradeBlock">
    <div class="page-header col-sm-12">

                <h3 >{{$grade->name}}</h3>

            <a href="/admin/grade/{{$grade->id}}/edit" class="label label-warning">编辑</a>
            <a href="" class="label label-danger">删除</a>


	</div>

    @if($grade->squads)
        <h1>
        @foreach($grade->squads as $squad)
        <a href="/admin/squad/{{$squad->id}}" ><span class="label label-info">{{$squad->name}}</span></a>
        @endforeach
        </h1>
    @endif
    <hr>
</div>
@endforeach

@endsection

@section('js')

@endsection
