@extends('layouts.admin')

@section('content')
<h2 class="sub-header">{{isset($title) ? $title : ''}}</h2>
<p>数目{{$number}}</p>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
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
  <td><a href="/book/{{$b->book_id}}">{{$b->book->name}}</a></td>
  <td><a href="#">{{$b->student->grade->name}}</a></td>
  <td><a href="#">{{$b->student->name}}</a></td>
  <td>{{$b->borrow_time}}</td>
  <td>{{$b->return_time}}</td>
  <td>{{$b->comment}}</td>
</tr>
@endforeach

</tbody>
</table>
{!! $borroweds->render() !!}
</div>
@endsection
