@extends('layouts.front')

@section('css')

@endsection


@section('content')
<!-- <div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">借书登记成功！</div>

                <div class="panel-body">
                    借书登记成功！
                    <a href="/borrow/create">点击</a>继续登记
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert " role="alert">
                <h3>借书登记成功！</h3>
                将于 <span id="restTime">3</span>秒后自动继续借书，您可以
                <a href="/borrow/create" class="alert-link">点击这里继续借书</a>或者
                <a href="/borrowed" class="alert-link">查看已借出图书清单</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script >
var i=3;
function showtext()
{
   var o=document.getElementById("restTime");
   if(i>0)
   {
   o.innerHTML=i;
   i=i-1;
   window.setTimeout("showtext()",1000);
   }
   else
   {
    window.location.href='/borrow/create';
   }
}
showtext();
</script>
@endsection
