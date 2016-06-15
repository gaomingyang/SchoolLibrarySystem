@extends('layouts.admin')

@section('css')
<style type="text/css">
    .well{
        display: none;
    }
    .stu{
        width: 74px;
        margin-right:10px;
        margin-bottom: 5px;
    }

</style>

@endsection


@section('content')
<div class="page-header">
    <h3>学生升年级<small>新学期，学生从低年级升入高年级</small></h3>
</div>


<form class="form-horizontal" action="index.html" method="post">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 col-md-2">原班级</label>
        <!-- <div class="col-xs-6 col-sm-2 col-md-2">
    		<select class="form-control" name="grade" class="grade">
                <option value="0">年级</option>
                @foreach($grades as $grade)
                <option value="{{$grade->id}}">{{$grade->name}}</option>
                @endforeach
    		</select>
    	</div> -->
        <div class="col-xs-6 col-sm-2 col-md-2">
    		<select class="form-control squad" name="squad">
                <option value="0">班级</option>
                @foreach($grades as $grade)
                    @foreach($grade->squads as $squad)
                        <option value="{{$squad->id}}">{{$squad->name}}</option>
                    @endforeach
                @endforeach
    		</select>
    	</div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 col-md-2">选择学生</label>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="students well">

            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 col-md-2">新班级</label>
        <div class="col-xs-6 col-sm-2 col-md-2">
    		<select class="form-control newsquad" name="newsquad">
                <option value="0">选择新班级</option>
                @foreach($grades as $grade)
                    @foreach($grade->squads as $squad)
                        <option value="{{$squad->id}}">{{$squad->name}}</option>
                    @endforeach
                @endforeach
    		</select>
    	</div>
        <div class="col-xs-4 col-sm-2 col-md-2">
            <div class="checkbox">
                <label>
            		<input type="checkbox" name="graduate" value="1" class="graduate"  >毕业(离校)
                </label>

            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-2">
	    	<button class="btn btn-primary" type="submit">{{trans('common.submit')}}</button>
	    </div>
    </div>

</form>

@endsection


@section('js')
<script type="text/javascript">

$(function(){
    // alert('ready');
    $(".squad").change(function(){
        var squad_id = $(".squad option:selected").val();
        var url = '{{URL('stuBySquad')}}';
        $.get(url+'/'+squad_id,function(data){
			if (data == null) {
				$(".students").html('<span class="alert alert-warning col-md-12">没有学生</span>');
				return;
			};

			var one='';
			$.each(data,function(k,v){
				one+='<button type="button" class=" stu student'+v.id+' btn ';
				if (v.gender == 1) {
					one+='btn-info';
				}else if(v.gender == 2){
					one+='btn-warning';
				}else{
					one+='btn-default';
				}

				one+='" ><label>'+v.name+'<input type="checkbox" aria-hidden="true"></label></button>';
				one+='';
			});

			$(".students").html(one);
            $(".well").fadeIn();

		},'json');

    });

	$(".graduate").checked(function(){
        
    });

});
</script>

@endsection
