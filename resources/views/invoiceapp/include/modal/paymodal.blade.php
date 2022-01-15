     <!-- Modal for Make Payment start-->
                            <div class="modal fade text-xs-left" id="payModal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <h3 class="modal-title" id="myModalLabel35"> Payment</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Amount To Pay </label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <input type="text" disabled="disabled" value="<?php echo $invoice_due_amount; ?>"  name="amount_to_pay"  class="form-control" placeholder="0.00" aria-describedby="button-addon2" data-amount="">
                                                        </div>
                                                    </div>
                                                </div>

                                               

                                            <div class="form-group row">
                                              <div class="payModal-message-area"></div>
                                            </div>

                                            


                                        </div>
                                        <div class="modal-footer">
                                          <style type="text/css">
                                              .authorizenet > .dropdown-toggle::after
                                              {
                                                  margin: -0.2em 0 0 0;
                                              }
                                          </style>
                                          <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button1 authorizenet btn-group">
                                              
                                              @if(isset($authorizeNettender) && $chkAuthorizeNetPayment>0)
                                                <a id="btn-payment-modal_modal_button" data-id="{{$authorizeNettender[0]->id}}" type="button" class="btn btn-success btn-responsive margin-all-bottom-button {{$authorizeNettender[0]->tender_class}}" >
                                                    AuthorizeNet {{$authorizeNettender[0]->name}}
                                                </a> 
                                              @endif

                                          </div>

                                          <style type="text/css">
                                              .paypal_pay_modal > .dropdown-toggle::after
                                              {
                                                  margin: 2em 0 0 0 !important;
                                              }
                                          </style>
                                          <div style="margin-left: 2em !important;" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 button button1 paypal_pay_modal btn-group">
                                              
                                              @if(isset($payPaltender) && $chkAuthorizeNetPayment>0)
                                                <a id="btn-payment-modal_modal_button" data-id="{{$payPaltender[0]->id}}" type="button" class="btn btn-success btn-responsive margin-all-bottom-button {{$payPaltender[0]->tender_class}}" >
                                                    {{$payPaltender[0]->name}}
                                                </a> 
                                              @endif

                                          </div>
                                          
                                            

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Pay Modal End-->
