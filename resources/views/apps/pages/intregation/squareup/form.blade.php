<html>
<head>
  <title>Square Payment Form</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="squareconnectpayment" content="{{ url('square/connect/capture/payment/nonce') }}">
  <!-- link to the SqPaymentForm library -->
  <script type="text/javascript" src=<?php
                                      echo "\"";
                                      echo (env("USE_PROD") == "true")  ?  "https://js.squareup.com/v2/paymentform"
                                        :  "https://js.squareupsandbox.com/v2/paymentform";
                                      echo "\"";
                                      ?>></script>
  <script type="text/javascript">
    window.applicationId ="{{$squareAccount->app_id}}";
    window.locationId ="{{$squareAccount->location_id}}";
  </script>
  <script src="{{asset('theme/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{asset("intregation/squareup/js/sq-payment-form.js")}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset("intregation/squareup/css/sq-payment-form.css")}}">
</head>

<body>
  <div class="sq-payment-form">
    <div id="sq-walletbox">
      <button id="sq-google-pay" class="button-google-pay"></button>
      <button id="sq-apple-pay" class="sq-apple-pay"></button>
      <button id="sq-masterpass" class="sq-masterpass"></button>
      <div class="sq-wallet-divider">
        <span class="sq-wallet-divider__text">Or</span>
      </div>
    </div>
    <div id="sq-ccbox">
      <form id="nonce-form" novalidate action="javascript:processCardPayment();" method="post">
        <div class="sq-field">
          <label class="sq-label">Card Number</label>
          <div id="sq-card-number"></div>
        </div>
        <div class="sq-field-wrapper">
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">CVV</label>
            <div id="sq-cvv"></div>
          </div>
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">Expiration</label>
            <div id="sq-expiration-date"></div>
          </div>
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">Postal</label>
            <div id="sq-postal-code"></div>
          </div>
        </div>
        <div class="sq-field">
          <button id="sq-creditcard" class="sq-button" onclick="onGetCardNonce(event)">
            Pay Now
          </button>
        </div>
       
        <div id="error"></div>
        <input type="hidden" id="card-nonce" name="nonce">
        <input type="hidden" id="card-amount" name="card-amount" value="0">
      </form>
    </div>
  </div>

</body>

</html>