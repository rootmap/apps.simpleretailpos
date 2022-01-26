<!-- Modal for Make Payment start-->
<div class="modal fade text-xs-left" id="virtualTerminalModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" align="center" id="myModalLabel35"> Give Name To This Item</h3>
      </div>
      <form>
        <div class="modal-body">
          <div class="col-md-12" id="vtMSG"></div>
          <div class="row">
              <div class="col-md-6 offset-md-3" style="text-align:center;">
                  <div class="form-group">
                      <label for="projectinput2" class="text-xs-center" style="text-align:center;">Item Name </label>
                      <input type="text"  class="form-control" placeholder="Please enter a name to this item " name="vtFidName">
                  </div>
              </div>
          </div>
          <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn text-center btn-info btn-lighten-2 btn-responsive  modalBtnAddItemTocard" >
                      <i class="fa fa-cart-plus"></i>  Add Item To Card
                  </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Pay Modal End-->