@extends('layouts.front')


@section('content')
<div class="col-sm-10 col-sm-offset-1">


<div class="page-header">
    <h3>{{$student->name}}</h3>
</div>

<div >
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">姓名</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->name}}</p>
        </div>
    </div>
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">性别</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->gendername()}}</p>
        </div>
    </div>
    <div class="row">
        <label class="col-xs-12 col-sm-1 ">班级</label>
        <div class="col-xs-12 col-sm-6">
            <p class="">{{$student->squad->name}}</p>
        </div>
    </div>
</div>


<div class="page-header">
    <h4>借书记录</h4>
</div>

<div class="row">
<div class="col-xs-12 col-sm-10">

 @if(count($student->borrow) > 0)
<div class="table-responsive">
    <table class="table table-striped">
       <thead>
           <tr>
               <th>图书编号</th>
               <th>图书名称</th>
               <th>借书时间</th>
               <th>还书时间</th>
           </tr>
       </thead>
       <tbody>
            @foreach($student->borrow as $b)
            <tr>
               <td>{{$b->book_id}}</td>
               <td>{{$b->book->name}}</td>
               <td>{{$b->borrow_time}}</td>
               <td>{{$b->return_time}}</td>
            </tr>
            @endforeach
       </tbody>
    </table>
</div>
@else
还没有借过书。。。
@endif
</div>

</div>



</div>


@endsection
