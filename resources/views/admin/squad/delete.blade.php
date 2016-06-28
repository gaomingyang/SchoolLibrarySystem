<div id="d_{{$squad->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">确定要删除<span class="squadName"></span>？</h4>
            </div>
            <div class="modal-body">
                <p>提示:必须班级内的学生全部清空后才可删除班级!</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{!! URL::route('admin.squad.destroy', array('id' => $squad->id)) !!}" data-token="{{ csrf_token() }}" data-method="delete">{{trans('common.submit')}}</a>
                <button class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
