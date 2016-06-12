@extends('layouts.front')

@section('css')
<style type="text/css">
	.btn,.btn-warning{
              min-width: 68px;
    }
    .students>a{
    	margin-top: 10px;
    }
</style>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="header">还书</h2>
			<h3 class="sub-header">根据图书还书</h3>
			<div class="form-horizontal ">
				<div class="searchbook form-group" >
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">图书</label>
					<div class="col-xs-12 col-sm-6 col-md-6 ">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="书名或编号" maxlength="20" id="keyword" autofocus>
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" onclick="searchBook()">搜索</button>
							</span>
						</div>
					</div>
				</div>

				<div class="searchbook searchbooklist form-group" >
					<div class="col-xs-6 col-xs-offset-2 col-sm-6 col-sm-offset-2 " id="returninfo">

					</div>

				</div>

			</div>
		</div>




		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<h3 class="sub-header">根据学生还书</h3>
			<form class="form-horizontal ">
				<div class="form-group">
					<label for="" class="control-label col-md-2">班级</label>
					<div class="col-sm-10">
						<div class="btn-toolbar" role="toolbar" aria-label="...">
							<div class="btn-group" role="group" >
								<a class="btn btn-default squad" squad="9">五甲</a>
								<a class="btn btn-default squad" squad="10">五乙</a>
							</div>
							<div class="btn-group">
								<a class="btn btn-default squad" squad="7">四甲</a>
								<a class="btn btn-default squad" squad="8">四乙</a>
							</div>
							<div class="btn-group">
								<a class="btn btn-default squad" squad="5">三甲</a>
								<a class="btn btn-default squad" squad="6">三乙</a>
							</div>
							<!-- <div class="btn-group">
								<a href="" class="btn btn-default">二甲</a>
								<a href="" class="btn btn-default">二乙</a>
							</div>
							<div class="btn-group">
								<a href="" class="btn btn-default">一甲</a>
								<a href="" class="btn btn-default">一乙</a>
							</div> -->
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="control-label col-md-2">借书人</label>
					<div class="col-sm-6">
						<div class="students well">
						</div>
					</div>
				</div>

			</form>
		</div>


	</div>
</div>

@endsection

@section('js')
<script type="text/javascript">
$(function(){
	$("#keyword").bind('keypress',function(event){
		if (event.keyCode == '13') {
			searchBook();
		}
	});


	//when the address change, show users below.
	$(".squad").click(function(){
		$(".squad").removeClass('active');
		$(this).addClass('active');
		squad = $(this).attr('squad');

		var url='{{URL('stuBySquad')}}';
			$.get(url+'/'+squad,function(data){
				if (data == null) {
					$(".students").html('<span class="alert alert-warning col-md-12">没有学生</span>');
					return;
				};
				var one='';
				$.each(data,function(k,v){
					one+='<a href="javascript:stu_book('+v.id+')" class="student'+v.id+' btn ';
					if (v.gender == 1) {
						one+='btn-info';
					}else if(v.gender == 2){
						one+='btn-warning';
					}else{
						one+='btn-default';
					}

					one+='">'+v.name+'</a>';
					one+='&nbsp;&nbsp;';
				});

				$(".students").html(one);
			},'json');
		});
});

//新标签打开还书
function stu_book(id){
	// window.open('/return/student/'+id);
	window.location.href='/return/student/'+id;
}

//图书搜索
function searchBook()
{
	// var kw = $("input[name='keyword']").val();
	var kw = $("#keyword").val();
	if (kw == "") {
		alert('请输入书名或者书的编号');
	}else{
		$("#returninfo").load('/book/borrowinfo/'+kw);
	}
}



</script>


@endsection
