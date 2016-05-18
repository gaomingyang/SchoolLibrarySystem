@extends('layouts.admin')


@section('content')
@include('common.flash')
<div class="container">

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
                    <table class="table ">
                        <tr><td class="">书名</td><td><< {{$book->name}} >></td></tr>
                        <tr><td>出版社</td><td>{{$book->publisher}}</td></tr>
                        <tr><td>作者</td><td>{{$book->author}}</td></tr>
                        <tr><td>分类</td>
                            <td>
                                @if($book->category_id == 0) 未分类
                                @else
                                    {{$book->category->name}}
                                @endif

                            </td>
                        </tr>
                        <tr><td>标签</td><td>
                            @foreach($book->tags as $tag)
                                <a href="/admin/tag/{{$tag->id}}" class="btn btn-info btn-xs">{{$tag->name}}</a>
                            @endforeach</td>
                        </tr>

                        <tr><td>位置</td><td>{{$book->location}}</td></tr>
                        <tr><td>备注</td><td>{{$book->comment}}</td></tr>

                        <tr>
                            <td colspan="2">
                                <!-- <a href="#d_{{$book->id}}" data-toggle="modal" class="btn btn-danger" >
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                删除</a>  -->
                                <div class="pull-right">
                                    <form action="{{ url('admin/book/'.$book->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> 删除图书
                                        </button>
                                    </form>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('admin/book/'.$book->id.'/edit')}}" class="btn btn-success .pull-left">编辑图书</a>
                                </div>

                            </td>
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


@include('admin.book.delete')
@endsection

@section('js')
<script src="{{ asset('js/dform.js') }}"></script>
@endsection
