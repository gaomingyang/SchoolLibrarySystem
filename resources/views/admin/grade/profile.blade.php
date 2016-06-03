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
							<a href="#d_{{$grade->id}}" class="btn btn-danger" data-toggle="modal" >{{trans('common.delete')}}</a>
	                    </div>
	                    <div class="pull-right" style="margin-left:5px;">
	                        <a href="{{url('admin/grade/'.$grade->id.'/edit')}}" class="btn btn-info">{{trans('common.edit')}}</a>
	                    </div>
						<div class="pull-right">
	                        <a href="{{url('admin/grade/'.$grade->id.'/seattable/create')}}" class="btn btn-success">新建座位表</a>
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

@include('admin.grade.delete')
@endsection

@section('js')
<script src="{{ asset('js/dform.js') }}"></script>
@endsection
