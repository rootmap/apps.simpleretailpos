<div class="modal fade text-xs-left" id="payoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="myModalLabel35"> Payout / Drop Detail</h3>
      </div>
          <div class="modal-body">
              <div class="col-md-12" id="payoutMSG"></div>
              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Amount
                  </label>
                  <div class="col-md-8">
                      <input type="text" id="payout_amount" class="form-control" placeholder="Amount" name="payout_amount">
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 label-control" for="Description">Reason</label>
                <div class="col-md-8">
                  <textarea class="form-control" id="payout_reason" rows="3" placeholder="Reason" name="payout_reason"></textarea>
              </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                <div class="col-md-8">
                  <button type="button" class="btn btn-primary savePayout">
                      <i class="icon-check2"></i> Save
                  </button>
                </div>
              </div>
          </div>
    </div>
  </div>
</div>