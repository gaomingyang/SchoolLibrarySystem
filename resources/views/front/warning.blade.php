@extends('layouts.front')

@section('content')

<div class="container-fluid">
<div class="row">
  <div class="col-sm-10 col-sm-offset-1 main">
    <div class="panel panel-default">
      <div class="panel-heading">
       {{$title}}
      </div>
      <div class="panel-body">
          {{$content}}
      </div>
    </div>
  </div>
</div>
</div>
@endsection
