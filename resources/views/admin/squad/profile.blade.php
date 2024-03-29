@extends('layouts.admin')


@section('css')
<style type="text/css">
.students> a{
	margin-top: 10px;
}
.btn{
    min-width: 68px;
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
                    <h3 class="panel-title">{{$squad->name}}</h3>
                </div>
                <div class="panel-body students">

						<div class="pull-left" >
							<a href="#d_{{$squad->id}}" class="btn btn-danger" data-toggle="modal" >{{trans('common.delete')}}</a>
	                    </div>
	                    <div class="pull-left" style="margin-left:5px;">
	                        <a href="{{url('admin/squad/'.$squad->id.'/edit')}}" class="btn btn-info">{{trans('common.edit')}}</a>
	                    </div>
						<div class="pull-left" style="margin-left:5px;">
	                        <a href="{{url('admin/squad/'.$squad->id.'/createseat')}}" class="btn btn-success">新建座位表</a>
	                        <!-- <a href="{{url('admin/seat/create')}}" class="btn btn-success">新建座位表</a> -->

	                    </div>


					<div class=" clearfix"></div>
                    <hr>

                    <div class="seat">
                         @foreach($squad->students as $key => $student)
                        <!-- {{$key}} -->
                        <a href="/admin/student/{{$student->id}}" class="btn
                            @if($student->gender == 1)
                                btn-info
                            @elseif($student->gender == 2)
                                btn-warning
                            @else
                                btn-default
                            @endif
                            ">{{$student->name}}</a>

                            @if(($key+1)%8 == 0)
                                <br/>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.squad.delete')
@endsection

@section('js')
<script src="{{ asset('js/dform.js') }}"></script>
<script type="text/javascript">
	$(".modal").on('show.bs.modal',function(event){
		var name = '{{$squad->name}}';
		var modal = $(this);
		modal.find('.squadName').text(name);
	});
</script>
@endsection
