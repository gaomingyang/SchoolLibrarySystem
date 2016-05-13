@extends('layouts.admin')


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
                            <th>#</th>
                            <th>书名</th>
                            <th>出版社</th>
                        </tr>
                        @foreach($tag->books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td><a href="/admin/book/{{$book->id}}">{{$book->name}}</a></td>
                            <td>{{$book->publisher}}</td>
                        </tr>
                        @endforeach
                    </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

@endsection
