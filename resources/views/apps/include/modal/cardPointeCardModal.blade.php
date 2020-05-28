<div class="modal fade text-xs-left" id="cardPointeCustomerCard" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Pay With CardPointe Payment 
        <img class="img-responsive pull-left" src="http://i76.imgup.net/accepted_c22e0.png">
      </h3>
  </div>
      <div class="card-body collapse in">
                    <div class="card-block">


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
       .hidestripemsg
       {
            display: none;
       }
    </style>


  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default credit-card-box">
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                    <form role="form" action="javascript:void(0);" method="post">
                        {{csrf_field()}}
  
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control cardPointe-cardholder' size='4' type='text' placeholder="Name on Card">
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div style="box-shadow: none; border: none;" class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control cardPointe-cardnumber' size='20' type='text'  placeholder="Card Number">
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete="off" class="form-control cardPointe-cvc" placeholder="ex. 311" size="4" type="text">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Ex. Month</label> 
                                <select class="form-control cardPointe-month" name="cardPointe-month">
                                    <option value="">Month</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{strlen($i)==1?"0".$i:$i}}">{{strlen($i)==1?"0".$i:$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> 
                                <select class="form-control cardPointe-year" name="cardPointe-year">
                                    <option value="">Year</option>
                                    @for($i=date('Y')+30; $i>=date('Y'); $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide hidestripemsg'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-xs-12 cardpointeButton">
                                <button class="btn btn-primary btn-lg btn-block payCardPointe" type="button">Pay Now <span class="cusStripeAm"></span></button>
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
