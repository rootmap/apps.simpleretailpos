<div class="modal fade text-xs-left" id="attachmentAddInvoice" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Invoice Attachment</h3>
  </div>
      
        <div class="modal-body">
            

            <div class="row">
                
                <div class="col-xs-12 col-md-7">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>File Name </th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="loadAttachmentinSalesReport">
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="center"> No Record Found </td>
                          </tr>
                          
                        </tbody>
                    </table>
                </div>

                <div class="col-xs-12 col-md-5">
                    <form method="post" enctype="multipart/form-data" action="{{url('sales/add/attachment/invoice')}}">
                        {{csrf_field()}}
                        <input type="hidden" readonly="readonly" class="form-control invoice_attachment_id" placeholder="Invoice ID" name="invoice_id">
                        <div class="form-group row">
                            <label class="col-md-12 label-control" for="projectinput1">Add Attachment File </label>
                            <div class="col-md-12">
                                  <input type="file" name="attachment" class="form-control" id="exampleInputFile">
                            </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-12">
                                <button type="submit" class="btn btn-info">
                                    <i class="icon-save"></i> Upload & Save 
                                </button>
                              </div>
                        </div>
                    </form>
                </div>

            </div>

            

            

        </div>
    </form>
</div>
</div>
</div>