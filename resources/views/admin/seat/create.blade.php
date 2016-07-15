@extends('layouts.admin')

@section('css')
<style typte="text/css">
.btn{
    min-width: 68px;
}
#seatmap{
    border:3px dashed #ccc;
    min-height: 400px;
    min-width: 800px;
}
.students{
    margin-bottom: 80px;
}
[id^="seat"]{
    width:70px;
    height:35px;
    float:left;
    border:1px solid #aaa;
    margin:5px;
}
[id^='seat']:nth-child(odd){
    margin-right:0px;
}
[id^='seat']:nth-child(even){
    margin-left:0px;
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
<div id="seatmap" ondrop="drop(event)" ondragover="allowDrop(event)">
    <div id="seat1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat2" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat3" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat4" ondrop="drop(event)" ondragover="allowDrop(event)"></div>

    <div id="seat5" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat6" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat7" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat8" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <br>
    <div class="" style="clear:both"></div>

    <div id="seat9"  ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat10" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat11" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat12" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat13" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat14" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat15" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
    <div id="seat16" ondrop="drop(event)" ondragover="allowDrop(event)"></div>







</div>
<h4>学生{{$squad->students->count()}}人</h4>
<div class="students">
    @foreach($squad->students as $key => $student)
        <a href="/admin/student/{{$student->id}}" draggable="true" ondragstart="drag(event)"
            id="stu{{$student->id}}" class="btn
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

function drag(ev){
    ev.dataTransfer.setData("Text",ev.target.id);
}
function allowDrop(ev){
    ev.preventDefault();
}
function drop(ev){
    ev.preventDefault();
    var data=ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
}

function print(){

}

</script>



@endsection
