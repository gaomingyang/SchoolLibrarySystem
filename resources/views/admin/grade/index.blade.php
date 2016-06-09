@extends('layouts.admin')


@section('css')
<style type="text/css">
.thumbnail{
    height:95px;
}
.thumbnail:hover{
    cursor:pointer;
}
h3{text-align: center;}
.thumbnail:hover{
    background-color: #eee;
}
</style>

@endsection

@section('content')
@include('common.flash')

<h2 class="sub-header">年级/班级</h2>
<p>
    <a href="/admin/grade/create" class="btn btn-success">增加年级</a>
    <a href="/admin/squad/create" class="btn btn-info">增加班级</a>
    <a href="/admin/grade/rise" class="btn btn-warning">升年级</a>
</p>
<!-- <div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/grade/trashed" class="label label-default ">已删除</a>
	</div>
</div> -->


@foreach($grades as $grade)
{{$grade->name}}<br>

@if($grade->squads)
    @foreach($grade->squads as $squad)
        <a href="/admin/squad/{{$squad->id}}">{{$squad->name}}</a>
    @endforeach
@endif

<hr>
@endforeach

@endsection

@section('js')
<script type="text/javascript">
    $(function(){
        $(".thumbnail").click(function(){
            var url = $(this).attr('link')
            window.location.href=url;
        });
    });
</script>
@endsection
