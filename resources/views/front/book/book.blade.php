@extends('layouts.front')


@section('content')
<div class="container">
    <!-- <div class="page-header">
        <h1>图书信息</h1>
    </div> -->
    <div class="row">
        <div class="col-sm-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">图书信息
                    <!-- <span class="pull-right">
                        <a href="{{url('book/'.$book->id.'/edit')}}" class=" .pull-right">编辑</a>
                    </span> -->
                    </h3>

                </div>
                <!-- <div class="panel-body">  -->
                    <table class="table">
                        <tr><td>书名</td><td><< {{$book->name}} >></td></tr>
                        <tr><td>出版社</td><td>{{$book->publisher}}</td></tr>
                        <tr><td>作者</td><td>{{$book->author}}</td></tr>
                        <tr><td>位置</td><td>{{$book->location}}</td></tr>
                        <tr><td>备注</td><td>{{$book->comment}}</td></tr>
                        <tr><td>数目</td><td>{{$book->number}}</td></tr>
                        <tr><td>标签</td><td>
                            @foreach($book->tags as $tag)
                                <a href="#" class="btn btn-info btn-xs">{{$tag->name}}</a>
                            @endforeach</td>
                        </tr>
                    </table>

                <!-- </div> -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">借书信息</h3>
                </div>

                <table class="table table-hover">
                    <tr>
                        <td>班级</td>
                        <td>学生</td>
                        <td>借书日期</td>
                        <td>还书日期</td>
                        <td>备注</td>
                    </tr>

                        @foreach($book->borrowed as $b)
                        <tr>
                            <td>{{$b->student->grade->name}}</td>
                            <td>{{$b->student->name}}</td>
                            <td>{{$b->borrow_time}}</td>
                            <td>{{$b->return_time}}</td>
                            <td>{{$b->comment}}</td>
                        </tr>
                        @endforeach
                


                </table>


            </div>
        </div>
    </div>
</div>


@endsection
