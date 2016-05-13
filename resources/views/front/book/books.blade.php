@extends('layouts.front')




@section('content')

<div class="container-fluid">
  <div class="row">
       @if(isset($tags))
      <div class="col-sm-10 col-sm-offset-1 main">
          <strong>标签:</strong>
          @foreach($tags as $tag)
            <a href="/tag/{{$tag->id}}" class="btn btn-xs btn-info">{{$tag->name}}
                <span class="badge">{{$tag->count}}</span>
            </a>
          @endforeach
      </div>
      @endif


		<div class="col-sm-10 col-sm-offset-1  main">
		<!-- 	<h1 class="page-header">图书列表</h1>
      <h2 class="sub-header">图书清单</h2> -->
      共有 {{$book_number}} 本书
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>编号</th>
              <th>分类</th>
              <th>书名</th>
              <th>标签</th>
              <th>出版社</th>
              <th>作者</th>
            </tr>
          </thead>
          <tbody>

            @foreach($books as $b)
            <tr>
              <td>{{$b->id}}</td>
              <td>
                  @if($b->category_id == 0) 未分类
  					@else
  					{{$b->category->name}}
  					@endif
              </td>
              <td><a href="/book/{{$b->id}}">{{$b->name}}</a>

                @if( $b->canBorrow())
                  <span class="label label-success">可借</span>
                  @if( $b->hadBorrowed() )
                   <span class="label label-warning">已借出</span>
                  @endif
                @else
                <span class="label label-warning">已借出</span>
                @endif

              </td>
              <td>
                  @foreach($b->tags as $tag)
                      <span class="label label-info">{{$tag->name}}</span>
                  @endforeach
              </td>
              <td>{{$b->publisher}}</td>
              <td>{{$b->author}}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>

      {!! $books->render() !!}

		</div>


	</div>

</div>



@endsection
