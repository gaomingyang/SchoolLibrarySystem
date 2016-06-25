<div id="gr_student" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">恢复确认</h4>
            </div>
            <div class="modal-body">
                <p>确定要把学生<span id="model_stuname"></span>恢复为未毕业状态？</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{!! URL::route('admin.student.grollback', array('id' => $student->id)) !!}" data-token="{{ csrf_token() }}" data-method="delete">{{trans('common.submit')}}</a>
                <button class="btn btn-danger" data-dismiss="modal">{{trans('common.cancel')}}</button>
            </div>
        </div>
    </div>
</div>
