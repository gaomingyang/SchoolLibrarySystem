@extends('layouts.admin')


@section('css')
<style type="text/css">
    a {
        text-decoration: none;
    }
    .page-header{
        border-bottom: none;
        padding-bottom: 0;
    }
    .gradeBlock{
        /*border: 1px solid #ccc;*/
    }
</style>
@endsection

@section('content')
@include('common.flash')

    <h2 class="sub-header">年级/班级</h2>
    <p>
        <a href="/admin/grade/create" class="btn btn-success">增加年级</a>
        <a href="/admin/squad/create" class="btn btn-success">增加班级</a>
        <a href="/admin/student/create" class="btn btn-success">增加学生</a>
        <a href="/admin/student/rise" class="btn btn-warning">毕业/升年级</a>
    </p>
    <div class="row">
    	<div class="col-sm-1 pull-right">
    		<a href="/admin/grade/trashed" class="label label-default ">已删除</a>
    	</div>
    </div>

    @foreach($grades as $grade)
        <div class="gradeBlock">
            <div class="page-header col-sm-12">
                <h3 >{{$grade->name}}</h3>
                <a href="/admin/grade/{{$grade->id}}/edit" class="label label-warning">编辑</a>
                <a href="#delgrade" class="label label-danger" data-toggle="modal" data-gradename="{{$grade->name}}" data-gradeid="{{$grade->id}}">删除</a>
        	</div>

            @if($grade->squads)
                <h1>
                @foreach($grade->squads as $squad)
                <a href="/admin/squad/{{$squad->id}}" ><span class="label label-info">{{$squad->name}}</span></a>
                @endforeach
                </h1>
            @endif
            <hr>
        </div>
    @endforeach

    <div id="delgrade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">确定要删除<span class="delGradeName">？</h4>
                </div>
                <div class="modal-body">
                    <p>提示:必须年级内的班级全部删除后才可删除年级!</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" id="model_submit" href="javascript:void(0);" data-token="{{ csrf_token() }}" >{{trans('common.submit')}}</a>
                    <button class="btn btn-danger" data-dismiss="modal">{{trans('common.cancel')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
<script type="text/javascript">
    $("#delgrade").on('show.bs.modal',function(event){
        var btn = $(event.relatedTarget);
        var gradename = btn.data('gradename');
        var gradeid = btn.data('gradeid');
        var url = "/admin/grade/"+gradeid;

        var modal = $(this);
        modal.find('.delGradeName').text(gradename);

        $("#delgrade").append(function () {
			var dform = "\n"
			dform += "<form id='delform' action='" + url + "' method='POST' style='display:none'>\n"
			dform += "<input type='hidden' name='_method' value='delete'>\n"
			dform += "<input type='hidden' name='_token' value='{{ csrf_token() }}'>\n"
			dform += "</form>\n"
			return dform
		});

		$('#model_submit').click(function(){
			$("#delform").submit();
		});
    });
</script>
@endsection
