@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h3>学生升年级<small>每年暑假后新学期，学生从低年级升入高年级</small></h3>
</div>


<form class="form-horizontal" action="index.html" method="post">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 col-md-2">原班级</label>
        <div class="col-xs-6 col-sm-2 col-md-2">
    		<select class="form-control" name="grade">
                <option value="0">年级</option>
                @foreach($grades as $grade)
                <option value="{{$grade->id}}">{{$grade->name}}</option>
                @endforeach
    		</select>
    	</div>
        <div class="col-xs-6 col-sm-2 col-md-2">
    		<select class="form-control" name="squad">
                <option value="0">班级</option>
    		</select>
    	</div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 col-md-2">选择学生</label>
        <div class="col-xs-12 col-sm-10 col-md-10">
            
        </div>
    </div>
</form>



@endsection
