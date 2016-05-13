@extends('layouts.front')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-10  col-sm-6 col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">图书管理员</div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="五乙">杨水</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="五乙">杨水仙</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="五乙">杨夜超</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="五乙">代央学</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="四乙">杨颖兰</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="四乙">代美黄</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="四乙">贾功林</li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="left" title="四乙">杨倩</li>
                      </ul>
                </div>
            </div>
        </div>

        <div class="col-xs-10  col-sm-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">电脑学习组成员</div>
                <div class="panel-body">
                    <div class="list-group col-xs-10 col-sm-4 col-md-4">
                        <button type="button" class="list-group-item">杨水</button>
                        <button type="button" class="list-group-item">杨水仙</button>
                        <button type="button" class="list-group-item">杨夜超</button>
                        <button type="button" class="list-group-item">代央学</button>
                        <button type="button" class="list-group-item">贾采嫦</button>
                        <button type="button" class="list-group-item">贾培高</button>
                    </div>

                    <div class="list-group col-xs-10 col-sm-4 col-md-4">
                        <a href="#" class="list-group-item">贾功林</a>
                        <a href="#" class="list-group-item">白定力</a>
                        <a href="#" class="list-group-item">杨颖兰</a>
                        <a href="#" class="list-group-item">代培义</a>
                        <a href="#" class="list-group-item">贾潇含</a>
                        <a href="#" class="list-group-item">代月行</a>
                        <a href="#" class="list-group-item">贾灯想</a>
                        <a href="#" class="list-group-item">白佑坤</a>
                        <a href="#" class="list-group-item">代敏</a>
                        <a href="#" class="list-group-item">代恋香</a>
                    </div>

                    <div class="list-group col-xs-10 col-sm-4 col-md-4">
                        <a href="#" class="list-group-item">贾庆超</a>
                        <a href="#" class="list-group-item">贾秋孔</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endsection
