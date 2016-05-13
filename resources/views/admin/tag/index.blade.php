@extends('layouts.admin')

@section('css')
<style type="text/css">
    .l{float:left;margin-left: 5px;}
</style>
@endsection

@section('content')
<h2 class="sub-header">图书标签</h2>
<p>
    <a href="/admin/tag/create" class="btn btn-success">创建标签</a>
</p>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>标签名</th>
              <th>图书数目</th>
              <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $m)
            <tr>
              <td>{{$m->id}}</td>
              <td><a href="/admin/tag/{{$m->id}}">{{$m->name}}</a></td>
              <td>{{$m->count}}</td>
              <td >
                  <a href="/admin/tag/{{$m->id}}/edit" class="btn btn-info l">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>修改</a>

                  <form method="POST" action="/admin/tag/{{$m->id}}" class="l">
                      <input name="_method" type="hidden" value="DELETE">
                       {{ csrf_field() }}
                      <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除</button>
                 </form>

              </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $tags->render() !!}
</div>
@endsection
