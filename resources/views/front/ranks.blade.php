@extends('layouts.front')

@section('css')
<link rel="stylesheet" href="/css/jquery-ui.css">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<p>时间：从 <input type="text" class="dp" value="{{$fromdate}}">开始统计</p>
	</div>


	@if(isset($students))
	<div class="page-header">
    	<h3>借书排行榜</h3>
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
				<a href="/student/{{$s->student_id}}">{{$s->student->name}}</a>({{$s->student->squad->name}})--{{$s->total}}本 </p>
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


	@if(isset($bookCategories))
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
    @endif









</div>



@endsection




@section('js')
<script src="/js/jquery-ui.js"></script>
<script type="text/javascript">
$((function($){
$.datepicker.regional['zh-CN'] = {
	clearText: '清除',
	clearStatus: '清除已选日期',
	closeText: '关闭',
	closeStatus: '不改变当前选择',
	prevText: '<上月',
	prevStatus: '显示上月',
	prevBigText: '<<',
	prevBigStatus: '显示上一年',
	nextText: '下月>',
	nextStatus: '显示下月',
	nextBigText: '>>',
	nextBigStatus: '显示下一年',
	currentText: '今天',
	currentStatus: '显示本月',
	monthNames: ['一月','二月','三月','四月','五月','六月', '七月','八月','九月','十月','十一月','十二月'],
	monthNamesShort: ['一','二','三','四','五','六', '七','八','九','十','十一','十二'],
	monthStatus: '选择月份',
	yearStatus: '选择年份',
	weekHeader: '周',
	weekStatus: '年内周次',
	dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
	dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
	dayNamesMin: ['日','一','二','三','四','五','六'],
	dayStatus: '设置 DD 为一周起始',
	dateStatus: '选择 m月 d日, DD',
	dateFormat: 'yy-mm-dd',
	firstDay: 1,
	initStatus: '请选择日期',
	isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
})(jQuery));
</script>


<script type="text/javascript">
// $.datepicker.setDefaults({
//   showOn: "both",
//   buttonImageOnly: true,
//   buttonImage: "calendar.gif",
//   buttonText: "Calendar"
// });

	$( ".dp" ).datepicker({
		yearRange: "2015:2100",
		dateFormat:"yy-mm-dd",
	});

	$(".dp").change(function(){
		var fromdate = $(this).val();
		var url = "{{URL('/updatefromdate')}}";
		var token='{!! csrf_token() !!}';
		$.post(url,{'_token':token,'fromdate':fromdate},function(data){
			if(data == 'success') {
				window.location.reload();
			}else{
				alert(data);
			}
		});

	});

</script>
@endsection
