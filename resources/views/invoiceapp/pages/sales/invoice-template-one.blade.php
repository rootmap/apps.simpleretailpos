@extends('invoiceapp.layout.master')
@section('title','invoice template')
@section('content')
<section id="form-action-layouts">
    <div class="row">
        <div class="col-lg-3">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; font-size: 25px; font-weight: bold; padding-left: 0px;">
                <?=date('d.m.Y',strtotime($invoice->created_at))?>            
            </div>
            <div class="col-md-12" style="padding-top: 20px; padding-bottom: 4px; color: #000; padding-left: 0px;">
                <b>Customer Info</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}              
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->email}}              
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->phone}}              
            </div>

            <div class="col-md-12" style="padding-top: 21px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Ship To :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->email}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->phone}}            
            </div>


            <div class="col-md-12" style="padding-top: 35px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Payment Method :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$invoice->tender?$invoice->tender:"Not Paid Yet"}}            
            </div>

            <div class="col-md-12" style="padding-top: 30px; padding-bottom: 4px; padding-left: 0px;">
                <img width="200" src="{{url('company/'.$invInfo->logo)}}" alt="Logo">
            </div>

        </div>
        <div class="col-lg-9">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; color: #008000; font-size: 25px; font-weight: bold; padding-left: 0px;">
                {{$invInfo->company_name}}
            </div>
            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>{{$invInfo->company_thank_you_message}}</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$invInfo->company_services}}
            </div>
            <style type="text/css">
                table{ border: 1px #000 solid !important; }
                .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                    border: 1px solid #000;
                }
            </style>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; padding-left: 0px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-xs-center">Item Number</th>
                            <th class="text-xs-center">Description</th>
                            <th class="text-xs-center">Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($invoice_product))
                            @foreach($invoice_product as $inv)
                                <tr>
                                    <td class="text-xs-center">{{$inv->id}}</td>
                                    <td>{{$inv->product_name}}</td>
                                    <td class="text-xs-center">{{number_format($inv->price,2)}}</td>
                                    <td class="text-xs-center">{{$inv->quantity}}</td>
                                    <td class="text-xs-center">{{number_format($inv->total_price,2)}}</td>
                                </tr>
                            @endforeach
                        @endif

                        <?php 
                        if(count($invoice_product)<15)
                        {
                            $newRowCreate=15-count($invoice_product);
                            for($i=1; $i<=$newRowCreate; $i++):   
                            ?>
                            <tr>
                                    <td class="text-xs-center">&nbsp;</td>
                                    <td></td>
                                    <td class="text-xs-center"></td>
                                    <td class="text-xs-center"></td>
                                    <td class="text-right"></td>
                            </tr>
                            <?php
                            endfor;
                        }
                        ?>
                            
                        <tr style="border-bottom: 5px #000 solid;">
                            <td>Subtotal </td>
                            <td>Total Item : {{count($invoice_product)}}</td>
                            <td></td>
                            <td></td>
                            <td class="text-xs-center"><b> {{number_format((($invoice->total_amount+$invoice->discount_total)-$invoice->total_tax),2)}}</b></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="5"> Sales  Tax Rate: {{number_format($invoice->tax_rate,2)}}% 
                            <br>
                            <br>
                            @if($invoice->discount_type==1)
                                Discount Amount is {{number_format($invoice->discount_total, 2)}}
                            @elseif($invoice->discount_type==2)
                                Discount Rate : {{number_format($invoice->sales_discount, 2).'%'}}
                            @endif
                            </td>
                            <td colspan="2" class="text-right">Sales Tax  (+)</td>
                            <td class="text-xs-center">{{number_format($invoice->total_tax,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right"> Discount (-)</td>
                            <td class="text-xs-center">{{number_format($invoice->discount_total,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Invoice Total</td>
                            <td class="text-xs-center" style="border-bottom: 5px #000 solid;"><b>{{number_format($invoice->total_amount,2)}}</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Paid Amount</td>
                            <td class="text-xs-center txtPaidAMT">{{number_format($invoice_payment,2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Invoice Due</td>
                            <td class="text-xs-center txtInvoiceDue" style="border-bottom: 5px #000 solid;">
                               <?php
                                if(($invoice->total_amount-$invoice_payment)>0):
                                    echo number_format(($invoice->total_amount-$invoice_payment),2);
                                else:
                                    echo '0.00';
                                endif;
                                ?>
                            </td>
                        </tr>
                    </tfoot>


                </table>
            </div>
        </div>
    </div>

    <?php 
    $invoice_due_amount=number_format(($invoice->total_amount-$invoice_payment),2);
    ?>

    <div class="row">
        <div class="col-lg-12" style="padding-left: 5px; padding-top: 15px;">
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_one}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_two}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_three}}</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>{{$invInfo->mm_four}}</b>
            </div>
            <div class="col-md-11 text-left" style="padding-left: 0px; border-bottom: 3px #000 solid; font-size: 28px; color: #008000;">
                <b>{{$invInfo->fotter_company_name}}</b>
            </div>
            <div class="col-md-1 text-left" style="padding-left: 0px; font-size: 28px; color: #008000;">
                <img width="80" src="{{url('company/'.$invInfo->logo_fotter)}}" style="margin-top: 21px;">
            </div>
            <div class="col-md-12" style="clear: both;">
                <div class="col-md-3 text-xs-center">
                    {{$invInfo->c_one}}
                </div>
                <div class="col-md-5 text-xs-center">
                    {{$invInfo->c_two}}
                </div>
                <div class="col-md-4 text-xs-center">
                    {{$invInfo->c_three}}
                </div>

                <div class="col-md-3 text-xs-center">
                   {{$invInfo->c_four}}
                </div>
                <div class="col-md-5 text-xs-center">
                    {{$invInfo->c_five}}
                </div>
                <div class="col-md-4 text-xs-center">
                    {{$invInfo->c_six}}
                </div>
            </div>
            <div class="col-md-12" style="border-bottom: 5px #000 solid; clear: both; margin-top: 15px;">

            </div>
        </div>
    </div><br>
    
    <!-- Invoice Footer -->
    <div id="invoice-footer" style="padding-bottom:100px;">
        <div class="row">
            <div class="text-xs-center"> 
                @if($invoice_due_amount>0 && $chkEmailInvoice>0)
                    <a class="btn btn-primary make-payment-btn-one" href="#" data-toggle="modal" data-target="#payModal" id="btn-payment-modal_init"> <i class="icon-open"></i>  Make Payment</a>
                @endif
                <a class="btn btn-success" href="{{url('capture/invoice/print/pdf/'.$invoice->id)}}"> <i class="icon-printer3"></i>  Print</a>
            </div>
    </div>
    <!--/ Invoice Footer -->


</div>
</div>
</div>
</div>
</div>








</section>
@include('invoiceapp.include.modal.CustomerCardModal')
@include('invoiceapp.include.modal.paymodal')
@endsection

@section('counter-display-css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/forms/extended/form-extended.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/forms/switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/colors/palette-switch.min.css')}}">
@endsection

@section('counter-display-js')
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/switch.min.js')}}" type="text/javascript"></script>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/pos.css')}}">
<style type="text/css">
.one-make-full
{
    line-height:3.8rem !important;
}

.two-make-full
{
    line-height:1.8rem !important;
}

.third-make-full
{
    line-height:1.3rem !important;
}
</style>
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/extended/card/jquery.card.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-typeahead.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-formatter.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-card.min.js')}}" type="text/javascript"></script>



<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<script>
  

    function loadingOrProcessing(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;

    }

    function warningMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function successMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    $(document).ready(function() {
  

        /*$(".bootstrap-switch-handle-on").click(function(){
            checkerCounterST();
        });
        
        $(".bootstrap-switch-handle-off").click(function(){
            checkerCounterST();
        });

        $(".bootstrap-switch-label").click(function(){
            checkerCounterST();
        });*/

     
        $(".close-authorize-payment-modal").click(function(){
            $("#CustomerCard").modal('hide');
        });

        $(".authorize_card_payment").click(function(){
                       
            var amount_to_pay="<?php echo $invoice_due_amount; ?>";
            if($.trim(amount_to_pay)>0)
            {
                $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');
                var parseNewPayment=0;         
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                $(".card-pay-due-amount").html(parseNewPayment);


            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $(".Paypal_Pay").click(function(){
                       
            var amount_to_pay="<?php echo $invoice_due_amount; ?>";
            if($.trim(amount_to_pay)>0)
            {
               /* $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');
                var parseNewPayment=0;         
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                $(".card-pay-due-amount").html(parseNewPayment);*/
                $(".modal-footer").hide('slow');
                $(".payModal-message-area").html(loadingOrProcessing("Please wait processing your invoice..."));

                window.location.href="{{url('invoice/paypal/'.$invoice_id)}}";

            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $(".card-pay-authorizenet").click(function(){

            var parseNewPayment=0;

            var amount_to_pay="<?php echo $invoice_due_amount; ?>";                
            
            var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            


            var cardNumber=$.trim($(".authorize-card-number").val());
            if(cardNumber.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card number."));
                return false;
            }

            var cardHName=$.trim($(".authorize-card-holder-name").val());
            if(cardHName.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card holder name."));
                return false;
            }

            var cardExpire=$.trim($(".authorize-card-expiry").val());
            if(cardExpire.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card expire month/Year."));
                return false;
            }

            var cardcvc=$.trim($(".authorize-card-cvc").val());
            if(cardcvc.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card cvc/cvc2 pin."));
                return false;
            }

            $(".message-place-authorizenet").html(loadingOrProcessing("Authorizing payment please wait...."));



            var addAuthrizePaymentURL="{{url('capture/pos/payment/publicpayment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addAuthrizePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
                    'invoiceID':"{{$invoice->invoice_id}}",
                    'cardExpire':cardExpire,
                    'cardcvc':cardcvc,
                    'amountToPay':parseNewPayment,
                    '_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Authrizenet Print Sales ID : "+data);
                    if(data==null)
                    {
                        $(".message-place-authorizenet").html(warningMessage("Failed to authorize payment. Please try again."));
                    }
                    else
                    {
                        console.log(data.status);
                        if(data.status==1)
                        {
                            console.log('Starting saving payment info');
                            //------------------------Ajax POS Start-------------------------//
                            var AddPOSUrlfff="{{url('capture/inv/payment')}}";
                            $.post(AddPOSUrlfff,{'invoice_id':'{{$invoice->invoice_id}}','paymentID':8,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                                //txtPaidAMT txtInvoiceDue
                               $(".txtPaidAMT").html(parseNewPayment);
                               $(".txtInvoiceDue").html("0.00");
                               $(".card-pay-authorizenet").hide('slow');
                               $(".make-payment-btn-one").hide('slow');
                               $(".message-place-authorizenet").html(successMessage(data.message));
                            });
                            //------------------------Ajax POS End---------------------------//
                            $(".message-place-authorizenet").html(successMessage(data.message));

                        }
                        else
                        {
                            $(".message-place-authorizenet").html(warningMessage(data.message));
                        }
                    }
                    //$(".message-place-authorizenet").html("dddd");
                }
            });
            //------------------------Ajax Customer End---------------------------//


        });

        


$("input[name=amount_to_pay]").keyup(function(){
    var customerID=$.trim($("select[name=customer_id]").val());
    if(customerID.length==0)
    {
        alert("Please select a customer to make payment.");
        return false;
    }
    console.log($(this).val());
    var dues=$("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html();
    var amp=$(this).val();
    if($.isNumeric($.trim(amp)))
    {
        var newAMP=amp;
    }
    else
    {
        var newAMP=0;
    }

    $(this).val(newAMP);

    var mkdues=$.trim(dues)-$.trim(newAMP);
    var newdues=parseFloat(mkdues).toFixed(2);

    $("#prmDue").html(newdues);

});
});


    
</script>

@endsection

