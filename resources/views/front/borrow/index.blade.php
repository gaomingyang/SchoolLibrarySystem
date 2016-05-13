@extends('layouts.front')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12  col-sm-10 col-sm-offset-1 main">

            <h2 class="sub-header">{{$title}}</h2>
            <p>数目：{{$number}}本</p>
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
              <th>图书编号</th>
              <th>书名</th>
              <th>班级</th>
              <th>学生姓名</th>
              <th>借书时间</th>
              <th>还书时间</th>
              <th>备注信息</th>
            </tr>
            </thead>
            <tbody>
            @foreach($borroweds as $b)
            <tr>
                <td>
                    {{$b->book_id}}
                </td>
              <td><a href="/book/{{$b->book_id}}">{{$b->book->name}}</a></td>
              <td>{{$b->student->grade->name}}</td>
              <td>{{$b->student->name}}</td>
              <td>{{$b->borrow_time}}</td>
              <td>{{$b->return_time}}</td>
              <td>{{$b->comment}}</td>
            </tr>
            @endforeach

            </tbody>
            </table>
            {!! $borroweds->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
