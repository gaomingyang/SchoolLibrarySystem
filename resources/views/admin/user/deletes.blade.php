@foreach($users as $u)
<div id="d_{{$u->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">删除确认</h4>
            </div>
            <div class="modal-body">
                <p>确定要执行删除操作？</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{!! URL::route('admin.user.destroy', array('id' => $u->id)) !!}" data-token="{{ csrf_token() }}" data-method="delete">确定</a>
                <button class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
@endforeach
