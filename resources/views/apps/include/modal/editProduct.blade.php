<div class="modal fade text-xs-left" id="editProduct" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" id="myModalLabel35"> Edit Item Quantity</h3>
                  </div>
                  <form>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-4 label-control" for="projectinput1">Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="0" placeholder="Product Name" readonly="readonly" name="edit_product_name">
                                <input type="hidden" name="edit_id" value="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 label-control" for="projectinput1">Quantity</label>
                            <div class="col-md-8">
                                <input type="number" onkeyup="editRowLive(0);" onchange="editRowLive(0);" id="edit_quantity" class="form-control" value="0"  name="edit_quantity">
                            </div>
                        </div>                                                
                    </div>

                </form>
            </div>
        </div>
        </div>