<div class="modal fade text-xs-left" id="slip" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Send Invoice</h3>
  </div>
      <form method="post" action="{{url('sales/send/invoice')}}">
        <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Invoice ID</label>
                <div class="col-md-8">
                    <input type="text" readonly="readonly" class="form-control invoice_slip_id" placeholder="Invoice ID" name="invoice_id">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Email Address</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Email Address" name="email_address">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-info apply-send">
                        <i class="icon-email2"></i> Send 
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
</div>
</div>