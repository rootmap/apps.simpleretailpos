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
                                                    <label class="col-md-4 label-control" for="projectinput1">Amount To Pay Today</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <input type="text"  name="amount_to_pay"  class="form-control" placeholder="0.00" aria-describedby="button-addon2" data-amount="">
                                                            <span class="input-group-btn" id="button-addon2">
                                                                <button class="btn btn-info amountextract" type="button">Exact</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label class="col-md-4 label-control" for="Description">Payment Due</label>
                                                  <div class="col-md-8">
                                                    <span id="prmDue">$0.00</span>
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
                                          <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 button button1 authorizenet btn-group">
                                              @if(isset($authorizeNettender))
                                                <a id="btn-payment-modal_modal_button" data-id="{{$authorizeNettender[0]->id}}" type="button" class="btn btn-green btn-lighten-1 btn-responsive margin-all-bottom-button {{$authorizeNettender[0]->tender_class}}" >
                                                    {{$authorizeNettender[0]->name}}
                                                </a> 
                                              @endif
                                          </div>

                                          @if(!empty($stripe))
                                          <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 button button1 authorizenet btn-group">
                                                <a id="btn-payment-modal_modal_button" data-id="26" type="button" class="btn btn-green btn-lighten-1 btn-responsive margin-all-bottom-button stripe_card_payment" >
                                                    Card Payment With Stripe
                                                </a> 
                                          </div>
                                          @endif

                                          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 button button1 authorizenet btn-group">
                                              @if(isset($payPaltender))
                                                <a id="btn-payment-modal_modal_button" data-id="{{$payPaltender[0]->id}}" type="button" class="btn btn-info btn-lighten-2 btn-responsive margin-all-bottom-button {{$payPaltender[0]->tender_class}}" >
                                                    {{$payPaltender[0]->name}}
                                                </a> 
                                              @endif
                                          </div>


                                          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 button button1">
                                            @if(isset($tender))
                                              @foreach($tender as $ten)
                                              <button id="btn-payment-modal_modal_button" data-id="{{$ten->id}}" type="button" class="btn btn-info btn-responsive margin-all-bottom-button make-payment" >
                                                  {{$ten->name}}
                                              </button>  
                                              @endforeach
                                            @endif      
                                          </div>

                                            

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Pay Modal End-->
