<!-- Modal for Make Payment start-->
<div class="modal fade text-xs-left" id="addPartialPayment" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" align="center" id="myModalLabel35"> Add Partial Payment</h3>
      </div>
      <form>
        <div class="modal-body">
          
          <div class="col-md-12" id="partialpayMSG"></div>
          <div class="row">
            
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput2">Invoice </label>
                            <select style="width: 100%;"  class="select2 form-control" name="partialpay_invoice_id">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Total Invoice Amount</label>
                            <input type="text" readonly="readonly" id="projectinput1" class="form-control" placeholder="Total Invoice Amount" name="partialpay_total_bill">
                        </div>
                    </div>
                  
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput2">Customer Name </label>
                            <input type="text" readonly="readonly" id="projectinput1" class="form-control" placeholder="Customer Name " name="partialpay_customer_name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Previously Paid Amount </label>
                            <input type="text"  readonly="readonly" id="projectinput1" class="form-control" placeholder="Previously Paid Amount " name="partialpay_pre_paid">
                        </div>
                    </div>
                  
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput2">Today Paid Amount </label>
                            <input type="text" id="projectinput1" class="form-control" placeholder="Previously Paid Amount " name="partialpay_today_paid">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1">Current Due Amount</label>
                            <input type="text" readonly="readonly" id="projectinput1" class="form-control" placeholder="Today Paid Amount" name="partialpay_amount">
                            <input type="hidden" name="partialpay_hidden_due_amount" value="0">
                        </div>
                    </div>
                  
                </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <style type="text/css">
            .authorizenet > .dropdown-toggle::after
            {
            margin: -0.2em 0 0 0;
            }
            </style>
            @if(isset($authorizeNettender))
              @if(!empty($authorizeNettender))
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                  <a id="btn-payment-modal_modal_button" data-id="{{$authorizeNettender[0]->id}}" type="button" class="btn btn-info btn-lighten-1 btn-responsive  btn-block  margin-all-bottom-button manualcardPayment" >
                    {{$authorizeNettender[0]->name}}
                  </a>
                </div>
              @endif
            @endif 

            @if(!empty($stripe))
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                    <a id="btn-payment-modal_modal_button" data-id="26" type="button" class="btn btn-info btn-block btn-lighten-1 btn-responsive  btn-block  margin-all-bottom-button manualstripe_card_payment" >
                        Stripe
                    </a> 
              </div>
            @endif

            @if(!empty($cardpointe))
              @if($cardpointe->module_status==1)
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                      <a id="btn-payment-modal_modal_button" data-id="26" type="button" class="btn btn-info btn-block btn-lighten-1 btn-responsive  btn-block  margin-all-bottom-button cardpointe_card_payment_manual" >
                          CardPointe
                      </a> 
                </div>
              @endif

              @if($cardpointe->bolt_status==1)
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                      <a id="btn-payment-modal_modal_button" data-id="26" type="button" class="btn btn-info btn-block btn-lighten-1 btn-responsive  btn-block  margin-all-bottom-button cardpointe_bolt_payment_manual" >
                          Bolt
                      </a> 
                </div>
              @endif
            @endif

            @if(isset($payPaltender))
              @if(!empty($payPaltender))
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                  <a id="btn-payment-modal_modal_button" data-id="{{$payPaltender[0]->id}}" type="button" class="btn btn-info btn-lighten-2 btn-responsive margin-all-bottom-button  btn-block  manualPaypalPayment" >
                    {{$payPaltender[0]->name}}
                  </a>
                </div>
              @endif
            @endif

            @if(isset($tender))
              @foreach($tender as $ten)
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1">
                  <button id="btn-payment-modal_modal_button" data-id="{{$ten->id}}" type="button" class="btn btn-info btn-responsive margin-all-bottom-button  btn-block  manualMakePayment" >
                  {{$ten->name}}
                  </button>
                </div>
              @endforeach
            @endif           

            @if(isset($square))
              @if(!empty($square))
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 button button1 authorizenet btn-group">
                    <a id="btn-payment-modal_modal_button" data-id="SquareupPayment" type="button" class="btn btn-green btn-block btn-lighten-2 btn-responsive margin-all-bottom-button SquareupPartalPayment" >
                        Square
                    </a> 
              </div>
              @endif
            @endif
            
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Pay Modal End-->