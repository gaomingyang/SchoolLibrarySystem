@extends('layouts.admin')

@section('css')
<style typte="text/css">
.btn{
    min-width: 68px;
}
#seatmap{
    border:3px dashed #ccc;
    min-height: 400px;
    min-width: 650px;
    position: relative;
    /*border-collapse:collapse;*/
}
#students{
    border:3px dashed #ccc;
    /*border-collapse:collapse;*/
}
.seatrow{
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
.seatheader{
    position: absolute;
    top:20px;
    width: 100%;
}
.seatheader>label,.seatfooter>label{
    text-align: center;
    width:100%;
}
.seatcontent{
    margin-top: 50px;
    /*background-color: #ccc;*/
    display: block;
}
.seatfooter{
    float:left;
    position: absolute;;
    bottom:10px;
    width:100%;
    margin:10px auto;
    margin-bottom:10px;
}

</style>
@endsection

@section('content')
<div class="page-header">
    <h3>新建座位表</h3>
</div>

<h4>座位表布局设置</h4>
<div class="form-horizontal">

    <div class="form-group">
        <label for="" class="control-label col-xs-12 col-sm-2 xol-md-2">学生人数</label>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <p class="form-control-static"><span id="stunum">{{$squad->students->count()}}</span>人</p>
        </div>
    </div>

    <div class="form-group">
    	<label for="mark" class="control-label col-xs-12 col-sm-2 col-md-2">座位类型</label>
    	<div class="col-xs-12 col-sm-4 col-md-4">
    		<label class="radio-inline"><input type="radio" name="seattype" value="2" checked >两人一桌</label>
    		<label class="radio-inline"><input type="radio" name="seattype" value="1">一人一桌</label>
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

    <div class="form-group">
        <label for="" class="control-label col-xs-12 col-sm-2 col-md-2">名称</label>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <input type="text" name="name" value="" class="form-control" placeholder="座表名称">
        </div>
    </div>

</div>
<h4>座位表预览</h4>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-8" id="seatmap">
        <div  ondrop="drop(event)" ondragover="allowDrop(event)" >
            <div class="seatheader">
                <label for="">讲台</label>
            </div>

            <div class="seatcontent">
                


            </div>

            <div class="seatfooter">
                <label for="">教室后方</label>
            </div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-4" id="students">
        <div ondrop="drop(event)" ondragover="allowDrop(event)" class="">
            <h3>候选区</h3>
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
                    <!-- @if(($key+1)%10 == 0)
                    <br>
                    @endif -->
            @endforeach
        </div>
    </div>


</div>

@endsection


@section('js')
<script type="text/javascript">
$(function(){


    $("#makeSeatBtn").click(function(){
        var seattype = $("input[name=seattype]:checked").val();
        var stunum = $("#stunum").text();
        var row = $("#rowNum").val();
        var col = $("#colNum").val();

        var seatnum = row*col;
        if(seatnum < stunum){
            alert('座位数不够学生数目！');
        }


        for (var i = 1; i <= seatnum ; i++) {
            $('<div id="seat'+i+'" ondrop="drop(event)" ondragover="allowDrop(event)"></div>').appendTo(".seatcontent");
        }




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
