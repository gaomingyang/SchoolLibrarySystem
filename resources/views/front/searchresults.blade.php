@extends('layouts.front')

@section('content')

<div class="col-sm-10 col-sm-offset-1  main">
    <div class="">
        <h3>图书搜索结果</h3>
    </div>
搜索到{{$book_number}}本书
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>编号</th>
              <th>分类</th>
              <th>书名</th>
              <th>标签</th>
              <th>出版社</th>
              <th>作者</th>
            </tr>
        </thead>
        <tbody>
        @foreach($books as $b)
        <tr>
          <td>{{$b->id}}</td>
          <td>
              @if($b->category_id == 0) 未分类
                @else
                {{$b->category->name}}
                @endif
          </td>
          <td><a href="/book/{{$b->id}}">{{$b->name}}</a>
            @if( $b->canBorrow())
              <span class="label label-success">可借</span>
              @if( $b->hadBorrowed() )
               <span class="label label-warning">已借出</span>
              @endif
            @else
            <span class="label label-warning">已借出</span>
            @endif
          </td>
          <td>
              @foreach($b->tags as $tag)
                  <span class="label label-info">{{$tag->name}}</span>
              @endforeach
          </td>
          <td>{{$b->publisher}}</td>
          <td>{{$b->author}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $books->render() !!}
</div>


@if(isset($students))
<div class="">
    <h3>学生搜索结果</h3>
</div>
搜索到{{$student_number}}个学生
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>姓名</th>
                <th>性别</th>
                <th>班级</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td><a href="/student/{{$student->id}}">{{$student->name}}</a></td>
                <td>{{$student->gendername()}}</td>
                <td>{{$student->squad->name}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>


</div>
@endif




@endsection
