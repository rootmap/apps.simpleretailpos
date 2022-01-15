<div class="modal fade text-xs-left" id="salesReturn" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <p class="modal-title" id="myModalLabel35">
            <b>
                <i class="icon-repeat2 info"></i> Sales Return | Generate Invoice for Return
            </b>
          </p>
      </div>
          <div class="modal-body">
              <input type="hidden" name="sales_return_today" value="{{date('Y-m-d')}}">
              <div class="col-md-12" id="salesReturnMSG"></div>
              <div class="col-md-2">
                <div class="form-group position-relative has-icon-left">
                    <input type="text" title="Invoice Date" class="form-control DropDateWithformat" value="{{date('Y-m-d')}}" name="sales_return_invoice_date" id="sales_return_invoice_date" placeholder="Invoice Date">
                    <div class="form-control-position">
                      <i class="icon-calendar2 info"></i>
                    </div>
                </div>
              </div>
              
              <div class="col-md-2">
                <div class="form-group position-relative has-icon-left">
                      <input type="text" title="Invoice ID" class="form-control" id="sales_return_invoice_id" name="sales_return_invoice_id" placeholder="Invoice ID">
                      <div class="form-control-position">
                        <i class="icon-paper info"></i>
                      </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group position-relative has-icon-left">
                      <input type="text" title="Barcode" class="form-control" id="sales_return_barcode" name="sales_return_barcode" placeholder="Barcode">
                      <div class="form-control-position">
                        <i class="icon-barcode info"></i>
                      </div>
                </div>
              </div>
              <div class="col-md-2">
                    <button type="button" class="btn btn-info loadSalesReturnInvoices">
                      <i class="icon-zoom-in2"></i> Generate
                    </button>
              </div>
              <div class="col-md-1" style="margin-right:10px;">
                    <button type="button" class="btn btn-info resetSalesReturnInvoices">
                      <i class="icon-close"></i> Clear
                    </button>
              </div>
              <div class="col-md-2 backSalesReturnInvoicesGrid" style="display:none;">
                    <button type="button" class="btn btn-info backSalesReturnInvoices">
                      <i class="icon-ios-undo-outline"></i> Back To Invoice
                    </button>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="warranty_invoice_list">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Tender</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
              </div>
              <div class="col-md-12" id="returnSalesItems" style="display:none;">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="returnSalesItems_warranty_invoice_list">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Return Amount</th>
                                    <th>Return Note | Enter Reason</th>
                                    <th>Return</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
              </div>
              <div class="clearfix"></div>
          </div>
    </div>
  </div>
</div>