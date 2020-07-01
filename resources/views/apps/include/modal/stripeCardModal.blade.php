<div class="modal fade text-xs-left" id="stripeCustomerCard" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Pay With Stripe Payment Gateway</h3>
  </div>
      <div class="card-body collapse in">
                    <div class="card-block">
  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="{{url('intregation/accepted_c22e0.png')}}">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ $stripe?$stripe->publishable_key:'0' }}"
                                                    id="payment-form-stripe">
                        {{csrf_field()}}
  
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div style="box-shadow: none; border: none;" class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Ex. Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> 
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4'    type='text'>
                            </div>
                            <input type="hidden" name="partial_invoice_id" id="partial_invoice_id" value="0">
                            <input type="hidden" name="partial_today_paid" id="partial_today_paid" value="0">
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide hidestripemsg'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now <span class="cusStripeAm"></span></button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        </div>
    </div>
                </div>
            </div>
</div>
</div>
</div>
