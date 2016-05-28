@extends('layouts.front')

@section('content')
<div class="container">

	@if(isset($students))
	<div class="page-header">
    	<h3>借书次数排行榜</h3>
    </div>
	<div class="row">
		@if(count($students) == 10)
		<a href="/rank/student" class="pull-right">查看全部</a>
		@else
		<a href="javascript:history.go(-1);" class="pull-right">返回</a>
		@endif
		<!-- 横向柱状图 -->

		
		@foreach($students as $k=>$s)
			<p>
				<span class="badge">{{$k+1}}</span>
				<a href="/student/{{$s->student_id}}">{{$s->student->name}}</a>({{$s->student->grade->name}})--{{$s->total}}本 </p>
		@endforeach
		
	</div>
	@endif



	@if(isset($books))

	<div class="page-header">
    	<h3>热门图书排行榜</h3>
    </div>
    <div class="row">
    	@if(count($books) == 20)
		<a href="/rank/book" class="pull-right">查看全部</a>
		@else
		<a href="javascript:history.go(-1);" class="pull-right">返回</a>
		@endif
    	<!-- 横向柱状图 -->
    	@foreach($books as $k=>$b)
			<p> 
				<span class="badge">{{$k+1}}</span>
				<a href="/book/{{$b->book_id}}"><<{{$b->book->name}}>></a>({{$b->book->category->name}})--借过{{$b->total}}次
			</p>
    	@endforeach
    </div>

    @endif


	<div class="page-header">
    	<h3>借书类别统计</h3>
    </div>
    <div class="row">
    	<!-- 饼图 -->
    	@foreach($bookCategories as $c)
    		<p>
			{{$c['name']}}--{{$c['number']}}本--{{$c['percentage']}}
			</p>
    	@endforeach
    </div>


    



	


</div>



@endsection




@section('js')

@endsection