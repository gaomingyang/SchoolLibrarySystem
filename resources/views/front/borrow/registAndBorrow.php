<div class="modal fade" id="createBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">图书登记及借出</h4>
      </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group">
                <label for="recipient-name" class="control-label col-md-2">书名:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="bookname">
                  <p style="color:red;" class="name_warning"></p>
                </div>
              </div>
            <div class="form-group">
                <label for="message-text" class="control-label col-md-2">出版社:</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="bookpublisher">
                </div>
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label col-md-2">作者:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="bookauthor">
                  </div>
              </div>


          </form>
        </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" onclick="createBook()">保存</button>
      </div>
    </div>
  </div>
</div>