@extends('layouts.front')


@section('content')
@include('common.flash')
<div class="container">

    <div class="row">
        <div class="col-sm-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">标签-{{$tag->name}} {{$tag->count}}本书</h3>

                </div>
                <!-- <div class="panel-body"> -->
                    <table class="table ">
                        <tr>
                            <th>编号</th>
                            <th>分类</th>
                            <th>书名</th>
                            <th>标签</th>
                            <th>出版社</th>
                            <th>作者</th>
                        </tr>
                        @foreach($tag->books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>
                                @if($book->category_id == 0) 未分类
                					@else
                					{{$book->category->name}}
                					@endif
                            </td>
                            <td><a href="/book/{{$book->id}}">{{$book->name}}</a>
                                @if( $book->canBorrow())
                                  <span class="label label-success">可借</span>
                                  @if( $book->hadBorrowed() )
                                   <span class="label label-warning">已借出</span>
                                  @endif
                                @else
                                <span class="label label-warning">已借出</span>
                                @endif
                            </td>
                            <td>
                                @foreach($book->tags as $tag)
                                    <a href="#" class="btn btn-info btn-xs">{{$tag->name}}</a>
                                @endforeach
                            </td>
                            <td>{{$book->publisher}}</td>
                            <td>{{$book->author}}</td>
                        </tr>
                        @endforeach
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

@endsection
