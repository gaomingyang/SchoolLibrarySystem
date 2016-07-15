@extends('layouts.admin')

@section('css')
<style typte="text/css">
.btn{
    min-width: 68px;
}
#seat{
    border:3px dashed #ccc;
    min-height: 400px;
}
.students{
    margin-bottom: 80px;
}
</style>
@endsection

@section('content')
<div class="page-header">
    <h3>新建座位表</h3>
</div>


<h4>座位表布局设置</h4>
<form class="form-horizontal" action="" method="post">
    <div class="form-group">
    	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">座位类型</label>
    	<div class="col-xs-12 col-sm-4 col-md-4">
    		<label class="radio-inline"><input type="radio" name="tabletype" value="2" checked>两人一桌</label>
    		<label class="radio-inline"><input type="radio" name="tabletype" value="1">一人一桌</label>
            <!-- <label class="radio-inline"><input type="radio" name="tabletype" value="3" value="">自定义</label> -->
    	</div>
    </div>
    <div class="form-group">
    	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">行列分布</label>
    	<span class="col-xs-1 col-sm-1 col-md-1">
    		<input type="text" class="form-control" name="row" placeholder="行" id="rowNum" value="8">
    	</span>
        <span class="col-xs-1 col-sm-1 col-md-1">
    		<input type="text" class="form-control col" name="column" placeholder="列" id="colNum" value="4">
    	</span>
        <span class="col-xs-3 col-sm-3 col-md-3">
            <button type="button" name="button" class="btn btn-default" id="makeSeatBtn">生成</button>
            <button type="button" name="button" class="btn btn-default" >预览</button>
            <button type="button" name="button" class="btn btn-default" onclick="print();">打印</button>
        </span>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-md-10 col-md-offset-2">
            <span class="">默认两人一桌，分为4列，可根据班级情况自行调整。</span>
        </div>
    </div>
    <input type="hidden" id="stuNum" name="number" value="{{$squad->students->count()}}">
</form>

<h4>座位表预览</h4>
<div id="seat">

</div>
<h4>学生{{$squad->students->count()}}人</h4>
<div class="students">
    @foreach($squad->students as $key => $student)
        <a href="/admin/student/{{$student->id}}" class="btn
            @if($student->gender == 1)
                btn-info
            @elseif($student->gender == 2)
                btn-warning
            @else
                btn-default
            @endif
            ">{{$student->name}}</a>
            @if(($key+1)%10 == 0)
            <br>
            @endif
    @endforeach
</div>


@endsection


@section('js')
<script type="text/javascript">
$(function(){
    var tabletype=$("input[name='tabletype']:selected").val();
    var stunum = $("#stuNum").val();
    var row = $("#rowNum").val();
    var col = $("#colNum").val();

    $("#makeSeatBtn").click(function(){
        alert(tabletype);

    });


});



function print(){

}

</script>



@endsection
