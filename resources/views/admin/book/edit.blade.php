@extends('layouts.admin')

@section('css')
<link href="{{ asset('/bootstrap/plugin/tokenfield/css/bootstrap-tokenfield.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('/bootstrap/plugin/tokenfield/css/jquery-ui.css ') }}" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div class="page-header">
    <h3>编辑图书信息</h3>
</div>

<form action="{{URL('/admin/book/'.$book->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="_method" value="PUT">
	@include('admin.book.form')
	<div class="form-group" style="">
	    <div class="col-md-offset-2 col-md-10">
	    	<button class="btn btn-primary" type="submit">确定</button>
	    </div>
	</div>
</form>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('/bootstrap/plugin/tokenfield/jquery-ui.js ') }}"></script>
<script type="text/javascript" src="{{ asset('/bootstrap/plugin/tokenfield/bootstrap-tokenfield.js ') }}" ></script>
<script type="text/javascript">

    $('#tags').tokenfield({
        autocomplete: {
            source: <?php echo App\Tag::getTagsString()?>,
            delay: 100
        },
        showAutocompleteOnFocus: !0,
        delimiter: [","],
        tokens: <?php echo  App\Book::withTrashed()->find($book->id)->tagNameString() ?>
    })

	$(function(){
		$("input[name='name']").focusout(function(){
			var bookname = $(this).val();
			if ($.trim(bookname) != '') {
				$.get('/book/ajaxrepeat',{'name':bookname},function(data){
					if (data == 'repeat') {
						$(".name_warning").html('发现同名书籍，<a href="/books/name/'+bookname+'" target="_blank">点击查看</a>');
					}else{
						$(".name_warning").html('');
					}
				});
			}
			// else{
			// 	// alert('empty book name');
			// 	$("<p>书名不能为空！</p>").after("input[name='name']");
			// }
		});
	});
</script>
@endsection
