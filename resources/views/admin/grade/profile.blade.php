@extends('layouts.admin')


@section('css')
<style type="text/css">
.students> a{
	margin-top: 10px;
}
</style>
@endsection

@section('content')
@include('common.flash')
<div class="container">

    <div class="row">
        <div class="col-sm-10 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$grade->name}}</h3>

                </div>
                <div class="panel-body students">

						<div class="pull-right" style="margin-left:5px;">
	                        <form action="{{ url('admin/grade/'.$grade->id) }}" method="POST">
	                            {!! csrf_field() !!}
	                            {!! method_field('DELETE') !!}
	                            <button type="submit" class="btn btn-danger">
	                                <i class="fa fa-trash"></i> 删除
	                            </button>
	                        </form>
	                    </div>
	                    <div class="pull-right">
	                        <a href="{{url('admin/grade/'.$grade->id.'/edit')}}" class="btn btn-info">编辑</a>
	                    </div>
					<div class=" clearfix"></div>


                    @foreach($grade->students as $student)
                        <a href="/admin/student/{{$student->id}}" class="btn
                            @if($student->gender == 1)
                                btn-info
                            @elseif($student->gender == 2)
                                btn-warning
                            @else
                                btn-default
                            @endif

                            ">{{$student->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
