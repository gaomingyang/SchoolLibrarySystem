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

<h2 class="sub-header">班级管理</h2>
<p>
    <a href="/admin/grade/create" class="btn btn-success">增加班级</a>
</p>
<!-- <div class="row">
	<div class="col-sm-1 pull-right">
		<a href="/admin/grade/trashed" class="label label-default ">已删除</a>
	</div>
</div> -->


@foreach($grades as $grade)
  <div class="col-xs-6 col-md-3">
      <!-- <a href="#" class="thumbnail">{{$grade->name}}</a> -->
      <div class="thumbnail" link="/admin/grade/{{$grade->id}}">
        <div class="caption">
            <h3>{{$grade->name}}</h3>
        </div>
      </div>
  </div>
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
