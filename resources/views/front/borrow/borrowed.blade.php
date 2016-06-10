@extends('layouts.front')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12  col-sm-10 col-sm-offset-1 main">
          @if(count($delayeds) > 0 )
          <h2>过期未归还</h2>
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
	              @foreach($delayeds as $d)
	              <tr>
	                <td>{{$d->book_id}}</td>
	                <td><a href="/book/{{$d->book_id}}">{{$d->book->name}}</a></td>
	                <td>{{$d->student->squad->name}}</td>
	                <td><a href="/student/{{$d->student->id}}">{{$d->student->name}}</a></td>
	                <td>{{$d->borrow_time}}</td>
	                <td>{{$d->return_time}}</td>
	                <td>{{$d->comment}}</td>
	              </tr>
	              @endforeach
            	</tbody>
            </table>
            </div>
          @endif

            <h2 class="sub-header">借出书单</h2>
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
		              <td>{{$b->book_id}}</td>
		              <td><a href="/book/{{$b->book_id}}">{{$b->book->name}}</a></td>
		              <td>{{$b->student->squad->name}}</td>
		              <td><a href="/student/{{$b->student->id}}">{{$b->student->name}}</a></td>
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
