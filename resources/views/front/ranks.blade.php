@extends('layouts.front')

@section('content')
<div class="container">
	<div class="page-header">
    	<h3>借书次数排行榜</h3>

    </div>
	<div class="row">
		<!-- <a href="" class="pull-right">查看全部</a> -->
		<!-- 横向柱状图 -->

		
		@foreach($students as $k=>$s)
			<p> <!-- [{{$k+1}}] --> 
			<a href="/student/{{$s->student_id}}">{{$s->student->name}}</a>({{$s->student->grade->name}})--{{$s->total}}本 </p>
		@endforeach
		
	</div>


	<div class="page-header">
    	<h3>热门图书排行榜</h3>
    </div>
    <div class="row">
    	<!-- 横向柱状图 -->
    	@foreach($books as $b)
			<p> <a href="/book/{{$b->book_id}}"><<{{$b->name}}>></a>--被借{{$b->total}}次</p>
    	@endforeach
    </div>


	<!-- <div class="page-header">
    	<h3>借书类别统计</h3>
    </div>
    <div class="row">
    	饼图
    </div> -->


    



	


</div>



@endsection




@section('js')

@endsection