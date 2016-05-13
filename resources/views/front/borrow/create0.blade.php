@extends('layouts.front')

@section('css')
<style type="text/css">
	.btn,.btn-warning{
		min-width: 68px;
    }
    .students> a{
    	margin-top: 10px;
    }
	.well{margin-bottom: 0;}
</style>
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h2 class="sub-header">借书</h2>

			<form action="{{URL('/borrow')}}" method="POST" class="form-horizontal bookform" >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="student_id" id="student_id" value="0">

				<div class="form-group">
					<label for="" class="control-label col-xs-12 col-sm-2 col-md-2">借书</label>
					<div class="col-xs-12 col-sm-6 col-md-6 seledBooks">
					</div>
					<div class="col-xs-4 col-sm-4">
						<a href="javascript:addBook()" class="btn btn-info  addBookBtn pull-left">已登记图书</a>
						<a href="javascript:void(0)" data-toggle="modal" data-target="#createBook" class="btn btn-link  addBookBtn pull-left">未登记图书</a>
					</div>
				</div>

				<div class="searchbook form-group" style="display:none">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="书名或编号" maxlength="20" id="keyword">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" onclick="searchBook()">搜索</button>
							</span>
						</div>
					</div>
				</div>

				<div class="searchbook searchbooklist form-group" style="display: none">
					<div class="col-xs-6 col-xs-offset-2 col-sm-6 col-sm-offset-2 searchedbooks">

					</div>
					<div class="col-xs-4 col-sm-4">
						<a href="javascript:addSeledBook()" class="btn btn-success">添加</a>
						<a href="javascript:unaddBook()" class="btn btn-warning">取消</a>
					</div>

				</div>


				<!-- <div class="form-group">
					<label for="" class="control-label col-md-2">数目</label>
					<div class="col-md-1">
						<input type="text" class="form-control"  maxlength="2" value="1">
					</div>
				</div> -->

				<div class="form-group">
					<label for="" class="control-label col-xs-12 col-sm-2">班级</label>
					<div class="col-xs-12 col-sm-10">
						<div class="btn-toolbar " role="toolbar" aria-label="...">
							<div class="btn-group" role="group" >
								<a class="btn btn-default grade" grade="9">五甲</a>
								<a class="btn btn-default grade" grade="10">五乙</a>
							</div>
							<div class="btn-group">
								<a class="btn btn-default grade" grade="7">四甲</a>
								<a class="btn btn-default grade" grade="8">四乙</a>
							</div>
							<div class="btn-group">
								<a class="btn btn-default grade" grade="5">三甲</a>
								<a class="btn btn-default grade" grade="6">三乙</a>
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
					<label for="" class="control-label col-xs-12 col-sm-2">借书人</label>
					<div class="col-xs-12 col-sm-6">
						<div class="students well">
						</div>
					</div>
					<div id="selGender" style="display: none;">
						<label class="radio-inline"><input type="radio" name="gender" value="1">男</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="gender" value="2">女</label>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="control-label col-md-2">备注</label>
					<div class="col-md-6">
						<input type="text" name="comment" class="form-control" placeholder="备注信息" >
						<!-- <textarea name="comment" id="" cols="30" rows="5" class="form-control"></textarea> -->
					</div>
				</div>

				<div class="form-group" style="">
				    <div class="col-md-offset-2 col-md-10">
				    	<button class="btn btn-primary" type="submit">确定</button>
				    </div>
				</div>
	</form>

		</div>

	</div>

</div>




<!-- Modal -->
<div class="modal fade" id="createBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="myModalLabel">图书登记及借出</h4>
     	</div>
      	<div class="modal-body">
        	<form class="form-horizontal">
        		<div class="form-group">
            		<label for="recipient-name" class="control-label col-md-2">书名:</label>
            		<div class="col-md-6">
            			<input type="text" class="form-control" id="bookname">
            			<p style="color:red;" class="name_warning"></p>
            		</div>
          		</div>
         		<div class="form-group">
            		<label for="message-text" class="control-label col-md-2">出版社:</label>
            		<div class="col-md-6">
            			<input type="text" class="form-control" id="bookpublisher">
            		</div>
          		</div>
          		<div class="form-group">
            		<label for="message-text" class="control-label col-md-2">作者:</label>
            		<div class="col-md-6">
               			<input type="text" class="form-control" id="bookauthor">
               		</div>
          		</div>


        	</form>
      	</div>
    	<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        	<button type="button" class="btn btn-primary" onclick="createBook()">保存</button>
    	</div>
    </div>
  </div>
</div>


@endsection

@section('js')
<script type="text/javascript">
token='{!! csrf_token() !!}';
$(function(){
	//when the address change, show users below.
	$(".grade").click(function(){
		$(".grade").removeClass('active');
		$(this).addClass('active');
		grade_n = $(this).attr('grade');

		var url='{{URL('stuByGrade')}}';
			$.get(url+'/'+grade_n,function(data){
				if (data == null) {
					$(".students").html('<span class="alert alert-warning col-md-12">没有学生</span>');
					return;
				};

				var one='';
				$.each(data,function(k,v){
					one+='<a href="javascript:sel('+v.id+')" class="student'+v.id+' btn ';
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

	$(":radio[name='gender']").click(function(){
		var student_id = $("#student_id").val();
		var gender= $(this).val();
		if (gender==1 || gender==2) {
			var url = "{{URL('student/ajaxupdategender')}}"; //或者'/student/ajaxupdategender'
			$.post(url,{'_token':token,'id':student_id,'gender':gender},function(data){
				if (data == 'success') {
					//更新成功后，更新界面学生状态
					var sel_student = $(".students > a.active");
					if (gender == 1) {
						sel_student.removeClass("btn-default").addClass("btn-info");
					}else{
						sel_student.removeClass("btn-default").addClass("btn-warning");
					}

					//隐藏性别选项
					$("#selGender").fadeOut('slow');
				}
			});

		}
	});

	$("#bookname").focusout(function(){
		var bookname = $("#bookname").val();
			if ($.trim(bookname) != '') {
				$.get('/book/ajaxrepeat',{'name':bookname},function(data){
					if (data == 'repeat') {
						$(".name_warning").html('发现同名书籍，<a href="/books/name/'+bookname+'" target="_blank">点击查看</a>');
					}else{
						$(".name_warning").html('');
					}
				});
			}
	});

	$(".bookform").submit(function(){
		var student_id = $("#student_id").val();
		var book_id = ("input[name=book_id]")

		if (student_id == 0 || student_id == '') {
			alert('没有选择学生！');
			event.preventDefault();
		}
		// var hasBook = $.contains($("input:checked"),$(".bookform"));
		// var hasBook = $("bookform input:checkbox")
		var n = $( "input:checked" ).length;
		if (n < 1) {
			alert('没有添加书！');
			event.preventDefault();
		}
	});

});

//选定借书人
function sel(id){
	// alert(id);
	// $(".students > a").removeClass('active').css('color','#fff');
	// $(".student"+id).addClass('active sel').css('color','black');
	$(".students > a").removeClass('active');
	$(".student"+id).addClass('active sel');

	if ($(".student"+id).hasClass('btn-default')) {
		$("#selGender").fadeIn();
	}else{
		$("#selGender").fadeOut();
	}
	$("#student_id").val(id);
}

//添加借书 已登记图书
function addBook()
{
	$(".addBookBtn").fadeOut();
	$(".searchbook").fadeIn();
}
//取消添加 已登记图书
function unaddBook()
{
	$(".searchbook").fadeOut();
	$(".addBookBtn").fadeIn();
	$("#keyword").val('');
	$(".searchedbooks").html('');
}

//图书搜索 已登记图书
function searchBook()
{
	// var kw = $("input[name='keyword']").val();
	var kw = $("#keyword").val();
	if (kw == "") {
		alert('请输入书名或者书的编号');
	}else{
		var url='{{URL('book/searchbykw')}}';
		$.get(url+'/'+kw,function(data){
			var bookinfo = '';
			$(".searchedbooks").html('');
			$.each(data,function(k,v){
				var str = "<p ><label>"+v.name+'('+v.publisher+'&nbsp;'+v.author+')';
				// if (v.canBorrow ) {
					str +=
					"&nbsp;&nbsp;<input name=\"book\" bookname=\""+v.name+"\" bookid=\""+v.id+"\" type=\"checkbox\"> </label></p>";
				// }else{
				// 	str +=
				// 	"&nbsp;不可借</p>";
				// }
				$(str).appendTo(".searchedbooks");
			});
		},'json');
	}
}

//确认选择添加到借书单 已登记图书
function addSeledBook()
{
	$("input[name='book']:checked").each(function(){
		var bookname = $(this).attr('bookname');
		var bookid = $(this).attr('bookid');
		$("<div href=\"\" class=\"btn btn-default seledBook"+bookid+" \">"+bookname+"&nbsp;<a href=\"javascript:removeSeledBook("+bookid+");\" class=\"close\">x</a></div>").appendTo(".seledBooks");
		$("<input type=\"checkbox\" checked=\"checked\" style=\"display: none;\" name=\"book_id[]\" value=\""+bookid+"\" id=\"selBook"+bookid+"\">").appendTo(".bookform");

		// if ($("#book_ids").val() == "") {
		// 	$("#book_ids").val(bookid);
		// }else{
		// 	var oldv = $("#book_ids").val();
		// 	$("#book_ids").val(oldv+','+bookid);
		// }
	});

	$(".searchbook").fadeOut();
	$(".addBookBtn").fadeIn();
	$("#keyword").val('');
	$(".searchedbooks").html('');
}

//未登记图书  登记并借
function createBook()
{
	var name = $("#bookname").val();
	var publisher = $("#bookpublisher").val();
	var author = $("#bookauthor").val();
	// var token='{!! csrf_token() !!}';
	$.post('/book/ajaxstore',{'name':name,'publisher':publisher,'author':author,'_token':token},function(data){
		if (data != 'fail') {
			$('#createBook').modal('hide');
			// alert(data);
			$("<div href=\"\" class=\"btn btn-default seledBook"+data+" \">"+name+"&nbsp;<a href=\"javascript:removeSeledBook("+data+");\" class=\"close\">x</a></div>").appendTo(".seledBooks");
			$("<input type=\"checkbox\" checked=\"checked\" style=\"display: none;\" name=\"book_id[]\" value=\""+data+"\" id=\"selBook"+data+"\">").appendTo(".bookform");
		}else{
			alert('图书登记失败');
		}
	});
}

//借书单中去除图书
function removeSeledBook(id)
{
	$(".seledBook"+id).fadeOut();
	$("#selBook"+id).remove();
}
</script>
@endsection
