@extends('layouts.admin')


@section('content')
<div class="page-header">
    <h3>{{$student->name}}</h3>
</div>

<div >
    <div class="pull-right">
        <a href="/admin/student/{{$student->id}}/edit" class="btn btn-info btn-sm">编辑</a>
        <a href="#" class="btn btn-warning btn-sm">删除</a>
    </div>
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">姓名</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->name}}</p>
        </div>
    </div>
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">班级</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->grade->name}}</p>
        </div>
    </div>
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">性别</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->gendername()}}</p>
        </div>
    </div>
</div>


<div class="page-header">
    <h4>借书记录</h4>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-10">
        @if(count($student->borrow) > 0)
            <p>
                借书信息:
            </p>
            @foreach($student->borrow as $b)

            <p>
                {{$b->book_id}}  {{$b->book->name}}
            </p>

            @endforeach
        @endif
    </div>
</div>






@endsection
