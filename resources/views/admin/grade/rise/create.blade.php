@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h3>学生升年级<small>每年暑假后新学期，学生从低年级升入高年级</small></h3>
</div>


<form class="form-horizontal" action="index.html" method="post">
    <div class="form-group">
        <label for="" class="control-label col-xs-12 col-sm-2">当前班级</label>
        <div class="col-xs-12 col-sm-10">
            <div class="btn-toolbar " role="toolbar" aria-label="...">
                <div class="btn-group" role="group" >
                    <a class="btn btn-default grade" grade="9">五甲</a>
                    <a class="btn btn-default grade" grade="10">五乙</a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default grade" grade="7">四甲</a>
                    <a class="btn btn-default grade" grade="8">四乙</a>
                </div>
                <div class="btn-group">
                    <a class="btn btn-default grade" grade="5">三甲</a>
                    <a class="btn btn-default grade" grade="6">三乙</a>
                </div>
                <div class="btn-group">
                    <a href="" class="btn btn-default">二甲</a>
                    <a href="" class="btn btn-default">二乙</a>
                </div>
                <div class="btn-group">
                    <a href="" class="btn btn-default">一甲</a>
                    <a href="" class="btn btn-default">一乙</a>
                </div>
            </div>
        </div>
    </div>
</form>



@endsection
