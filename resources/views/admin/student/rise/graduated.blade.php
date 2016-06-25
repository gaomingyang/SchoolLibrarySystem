@extends('layouts.admin')

@section('css')
<style type="text/css">
#model_stuname{
	font-weight: bold;
	color:#0E88EB;
}

</style>

@endsection


@section('content')
@include('common.flash')
<h2 class="sub-header">已毕业学生</h2>
<div class="row">
	<div class="col-md-4">
		<div class="input-group">
			<input type="text" class="form-control" name="name" value="" placeholder="学生名">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default" name="button">搜索</button>
			</span>
		</div>
	</div>
	<div class="col-md-2">
		<p class="form-control-static">共{{$number}}人</p>
	</div>
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>姓名</th>
				<th>性别</th>
				<th>曾在班级</th>
				<th>毕业时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
                <td><a href="/admin/student/{{$student->id}}">{{$student->name}}</a></td>
                <td>{{$student->gendername()}}</td>
				<td>{{$student->squad->name}}</td>
                <td>{{$student->graduated_at}}</td>
                <td>
                    <a href="#gr_student" class="btn btn-xs btn-success" data-toggle="modal" data-stuname="{{$student->name}}" data-stuid="{{$student->id}}" title="取消毕业状态，恢复到所在的班级">恢复</a>
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $students->render() !!}
</div>
<!--
@include('admin.student.rise.unrise');
-->

<div id="gr_student" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">恢复确认</h4>
            </div>
            <div class="modal-body">
                <p>确定要把学生<span id="model_stuname"></span>恢复为未毕业状态？</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="model_submit" href="" data-token="{{ csrf_token() }}" data-method="put">{{trans('common.submit')}}</a>
                <button class="btn btn-danger" data-dismiss="modal">{{trans('common.cancel')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script type="text/javascript">
	$('#gr_student').on('show.bs.modal',function(event){
		var button = $(event.relatedTarget);
		var stuname = button.data('stuname');
		var stuid = button.data('stuid');
		var url = "{{URL::route('admin.student.grollback',array('id'=>""))}}";
		

		var modal = $(this);
		modal.find('#model_stuname').text(stuname);

		modal.find('#model_submit').attr("href","{{ URL::route('admin.student.grollback', array('id' =>"stuid")) }}");

	});

$(function(){
	 //生成删除提交form
    $("[data-method='put']").append(function () {
        var dform = "\n"
        dform += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n"
        dform += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n"
        if ($(this).attr('data-token')) {
            dform += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n"
        }
        dform += "</form>\n"
        return dform
    }).removeAttr('href').click(function(){$(this).find("form").submit(); });

});



</script>











@endsection
