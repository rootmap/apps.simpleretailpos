<div class="modal fade text-xs-left" id="CustomerCard" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Add Customer Card</h3>
  </div>
      <div class="card-body collapse in">
                    <div class="card-block">
                        
                        <div class="row">
                            <div class="col-xl-6 col-lg-12">
                                <div class='card-wrapper'></div>
                                <div class="col-xl-12 col-lg-12 col-md-12 pt-1" style="text-align: center;">
                                    <code class="payableUsingCard"><h3>Total Payable : $<span class="card-pay-due-amount">0.00</span></h3></code>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 pt-2 message-place-authorizenet" style="text-align: center;">
                                    
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12">


                                <form  class="card-form" method="post" action="#">
                                

                                <fieldset class="mb-1">
                                    <h5>Card Number</h5>
                                    <div class="form-group">
                                        <input 
                                         type="text" class="form-control authorize-card-number" name="number" id="card-number" maxlength="19" placeholder="Card Number">
                                    </div>
                                </fieldset>
                                <fieldset class="mb-1">
                                    <h5>Card Name</h5>
                                    <div class="form-group">
                                        <input
                                         type="text" class="form-control authorize-card-holder-name" name="name" id="card-name" placeholder="Card Holder Name">
                                    </div>
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="mb-1">
                                            <h5>Expiry Date</h5>
                                            <div class="form-group">
                                                <input
                                                 type="text" class="form-control authorize-card-expiry" name="expiry" id="card-expiry" placeholder="Card Expiry Date">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="mb-1">
                                            <h5>Card pin Number</h5>
                                            <div class="form-group">
                                                <input
                                                 type="text" class="form-control authorize-card-cvc" name="pin_cvc" id="card-cvc" maxlength="16" placeholder="Card CVC Number">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-actions center">
                                    <button type="button" class="btn btn-info btn-lighten-2 mr-1 close-authorize-payment-modal">
                                        <i class="icon-cross2"></i> Close 
                                    </button>
                                    
                                    <button type="button" class="btn btn-info btn-darken-2 card-pay-authorizenet">
                                        <i class="icon-check2"></i> Capture Payment
                                    </button>
                                    
                                </div>
           
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
</div>
