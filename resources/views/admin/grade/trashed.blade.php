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
    <h3 class="sub-header">已删除年级</h3>
    @if(count($grades)>0)
    <table class="table">
        <tr>
            <th>名称</th>
            <!-- <th>操作</th> -->
        </tr>

        @foreach($grades as $grade)
        <tr>
            <td>{{$grade->name}}</td>
            <!-- <td></td> -->
        </tr>
        @endforeach

    </table>
    @else
    没有已删除的年级！
    @endif
    <h3 class="sub-header">已删除班级</h3>
    @if(count($squads)>0)
    <table class="table">
        <tr>
            <th>名称</th>
            <!-- <th>操作</th> -->
        </tr>

        @foreach($squads as $squad)
        <tr>
            <td>{{$squad->name}}</td>
            <!-- <td></td> -->
        </tr>
        @endforeach

    </table>
    @else
    没有已删除的班级！
    @endif



@endsection
