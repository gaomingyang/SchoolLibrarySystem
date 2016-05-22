@extends('layouts.front')


@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$student->grade->name}} <strong>{{$student->name}}</strong></div>
                <table class="table ">
                	@foreach($student->waitReturn() as $b)
                    <tr class="r{{$b->id}}">
                    	<td class="col-xs-5 col-sm-5">
                            <a href="/book/{{$b->book_id}}"><< {{$b->book->name}} >></a>
                            借书日期: {{$b->borrow_time}}
                        </td>
                    	<td>
                            <a href="javascript:returnBook({{$b->id}})" class="btn btn-success ">还书</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
	function returnBook(id){
		var token='{!! csrf_token() !!}';
		$.post('/return',{'id':id,'_token':token},function(data){
			if (data == 'success') {
				$("tr.r"+id).fadeOut();
			}
		});
	}
</script>
@endsection
