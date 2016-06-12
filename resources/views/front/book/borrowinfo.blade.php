
@if(count($books) > 0)

@foreach($books as $book)
<div class="panel panel-default ">
    <div class="panel-heading">
        <h3 class="panel-title"><<{{$book->name}}>> [{{$book->id}}]借书信息</h3>
    </div>
    <table class="table table-hover">
        <tr>
            <td>班级</td>
            <td>学生</td>
            <td>借书日期</td>
            <td>备注</td>
            <td>操作</td>
        </tr>
        @if($book->waitReturn() )
            @foreach($book->waitReturn() as $b)
            <tr>
                <td>{{$b->student->squad->name}}</td>
                <td>{{$b->student->name}}</td>
                <td>{{$b->borrow_time}}</td>
                <td>{{$b->comment}}</td>
                <td class="book{{$b->id}}">
                    @if($b->return_time)
                    已归还
                    @else
                    <a href="javascript:returnBook({{$b->id}})" class="btn btn-xs btn-success btn-returnbook">还书</a>
                    <span class="returned " style="display:none">已归还</span>
                    @endif
                </td>
            </tr>
            @endforeach
        @endif

    </table>
</div>
@endforeach


<script type="text/javascript">
function returnBook(id){
    var token='{!! csrf_token() !!}';
    $.post('/return',{'id':id,'_token':token},function(data){
        if (data == 'success') {
            $("td.book"+id).html('已归还');
            $("#keyword").val('').focus();
            // alert('还书成功');
            // $(".btn-returnbook").fadeOut();
            // $(".book"+id+"returned").fadeIn();
        }
    });

}
</script>

@else
<div class="alert alert-warning" role="alert">没有查到借书记录!</div>


@endif
