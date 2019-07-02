@extends('apps.layout.master')
@section('title','Point of Sales')
@section('content')

<section id="form-action-layouts">
	<div class="row">
		<div class="col-lg-7 col-md-12 pos-product-display" style="min-height: 700px;">

            <div class="row">
                <style type="text/css">
                .pagination
                {
                    margin-top: 0px !important;
                }
            </style>
            <div class="col-md-12 col-xs-12 col-sm-12">
                {{-- <div class="text-xs-center" style="margin-bottom:1rem;">
                   <h4 class="text-danger"> <a href="{{url('sales')}}" class="btn btn-primary">Switch Sales View </a> Counter Display status <input type="checkbox" class="switchBootstrap" id="switchBootstrap9" data-on-text="Online" data-off-text="Offline"  @if(isset($CounterDisplay))
                            @if($CounterDisplay==1)
                                checked="checked" 
                            @endif
                        @endif> </h4>
                </div> --}}
                <div class="text-xs-center">
                    <nav aria-label="Page navigation">
                        {!!$product->links()!!} 
                    </nav>
                </div>
            </div>
        </div>

        <style type="text/css">
            .border-radius-button
            {
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                font-weight: 600;
            }

            .add-pos-cart {
              min-height: 50px !important;
              line-height: 50px !important;
              text-align: center;
              border: 1px solid #123456;
              margin-bottom:5px;
            }
            .add-pos-cart > span {
              display: inline-block;
              vertical-align: middle;
              line-height: normal;
            }
        </style>

        <div class="row" id="defaultProductView">
          @if(isset($product))
          @foreach($product as $pro)
          <div class="col-md-3 col-xs-6 col-sm-3">
            <a href="javascript:void(0);" data-id="{{$pro->id}}" data-price="{{$pro->price}}" class="btn-blue btn-lighten-1 btn-block add-pos-cart btn">
                <span>{{$pro->name}}</span>
            </a>
        </div>   
        @endforeach
        @endif  

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">

        </div>

    </div>
    <div class="row">
        <div class="col-md-3 col-xs-6 col-sm-3"> 
            <a class="thumbnail btn-block  bg-info bg-lighten-1" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#General_Sale">General Sale </a>
        </div>
        
        <div class="col-md-3 col-xs-6 col-sm-3 opdStore" @if($drawerStatus==1) style="display: none;" @endif> 
            <a class="thumbnail btn-block bg-info bg-lighten-3"  data-toggle="modal" data-target="#open-drawer" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;">Open Drawer </a>
        </div>

        <div class="col-md-3 col-xs-6 col-sm-3 cldStore" @if($drawerStatus==0) style="display: none;" @endif> 
            <a class="thumbnail btn-block bg-info bg-accent-1" onclick="loadCloseDrawer()" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;">Close Drawer </a>
        </div>
     
        <div class="col-md-3 col-xs-6 col-sm-3"> 
            <a class="thumbnail btn-block bg-info bg-accent-2" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#payoutModal">Payout </a>
        </div>
        <div class="col-md-3 col-xs-6 col-sm-3"> 
            <a class="thumbnail btn-block bg-info bg-darken-2 btn-block" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#TimeClockModal">Time Clock </a>
        </div>
        {{-- <div class="col-md-3 col-xs-6 col-sm-3"> 
            <a class="thumbnail btn-block bg-danger" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#CustomerCard">Customer Card </a>
        </div> --}}
            </div>
        </div>
        <style type="text/css">
        /* Desktop */
        @media (min-width:960px) {

            .testerPickup {
                position: fixed; top:42px;
            }   

        }
        .table td, .table th
        {
            padding: 0.1rem .75rem;
        }
    </style>
    <div class="col-lg-5 col-md-12">
        <!-- CSS Classes -->
        <div class="card testerPickup" style="">
            <div class="card-header">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h5>
                        </h5>
                        
                        <div class="form-group" style="margin-bottom: 0px !important;">
                            <!-- basic buttons -->
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#Discount"><i class="icon-pencil2"></i> Discount</button>
                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm"> Invoice#@if(isset($cart->invoiceID))    
                                {{$cart->invoiceID}}
                                @else
                                0
                            @endif </a>
                            <a href="{{url('sales/invoice/print/pdf/'.$last_invoice_id)}}" class="btn btn-secondary btn-sm"> <i class="icon-printer"></i> Last Receipt</a>
                            <button type="button" class="btn btn-secondary btn-sm" id="description"><i class="icon-edit2"></i> <span id="npt">Note</span></button>
                            <div class="form-group row" style="margin-top: 5px; display: none;" id="show_description">
                                <textarea class="form-control" id="title1" rows="2" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-blockf">
                    <div class="card-text">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart">
                                    @if(isset($cart->items))
                                    @foreach($cart->items as $index=>$row)
                                    <tr id="{{$row['item_id']}}">
                                        <td>{{$row['item']}}</td>
                                        <td>{{$row['qty']}}</td>
                                        <td data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{$row['price']}}</span></td>
                                        <td style="width: 83px;">
                                            <a href="javascript:edit_pos_item({{$row['item_id']}});" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a>
                                            <a href="javascript:delposSinleRow({{$row['item_id']}});" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Discount : <span>0%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td></td>
                                        <td colspan="3">$<span>
                                            @if(isset($cart->paid))
                                            {{$cart->paid}}
                                            @else
                                            0.00
                                            @endif
                                        </span></td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th colspan="5">
                                            <label><input type="checkbox" name="counterPay" id="counterPay" 
                                                @if(isset($cart->AllowCustomerPayBill)) 
                                                    @if($cart->AllowCustomerPayBill>0) 
                                                     checked="checked"   
                                                    @endif 
                                                @endif 
                                            >
                                            Allow Customer Pay From Counter Display</label>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-xs-12 button-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button2">
                                <div class="input-group">
                                    <select class="select2 form-control" name="customer_id">
                                        <option 
                                        @if(!isset($cart->customerID))
                                        @if(empty($cart->customerID))
                                        selected="selected" 
                                        @endif
                                        @endif

                                        value="">Select a Customer</option>

                                        <option value="0">Create New Customer</option>


                                        @if(isset($customerData))
                                        @foreach($customerData as $cus)
                                        <option 
                                        @if(isset($cart->customerID))
                                        @if($cart->customerID==$cus->id)
                                        selected="selected" 
                                        @endif
                                        @endif
                                        value="{{$cus->id}}">{{$cus->name}}</option>
                                        @endforeach
                                        @endif                          
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button1 checkDrawer">
                                <button id="btn-payment-modal_init" type="button" class="btn btn-info bg-darken-1 btn-responsive btn1" data-toggle="modal" data-target="#payModal">MAKE PAYMENT</button>      
                            </div>  
                            <style type="text/css">
                                .dropdown-toggle::after
                                {
                                    top: -7px !important;
                                }
                            </style>
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button1 btn-group checkDrawer">
                                {{-- id="printncompleteSale" --}}
                                <button  type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info btn-accent-4 btn-responsive btn1  dropdown-toggle">PRINT INVOICE &nbsp;</button>      
                                {{-- <div class="btn-group btn btn-success btn-responsive btn1"> --}}
                                    {{-- <button type="button" class="btn btn-square btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Warning</button> --}}
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item printncompleteSale" data-id="pos" href="javascript:void(0);"><i class="icon-printer4"></i> Default Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item printncompleteSale"  data-id="thermal"  href="javascript:void(0);"><i class="icon-ios-printer-outline"></i> Thermal Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item printncompleteSale"  data-id="barcode" href="javascript:void(0);"><i class="icon-barcode2"></i> Barcode Print</a>
                                    </div>
                                {{-- </div> --}}

                            </div>   

                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button6 checkDrawer">
                                <button id="completesale" type="button" class="btn btn-info btn-accent-2 btn-responsive btn1">     
                                    COMPLETE SALE
                                </button>
                            </div>
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button6">
                                <button id="changeSalesView" type="button" class="btn btn-info btn-responsive btn1">     
                                    <i class="icon-stack3"></i> Change Sales View
                                </button>
                            </div>
                            <div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 button button6">
                                <button id="counterStatusChange" type="button" class="btn btn-info btn-darken-2 btn-responsive btn1"> <i class="icon-air-play"></i>  
                                    @if(isset($CounterDisplay))
                                        @if($CounterDisplay==1)   
                                            <span>Turn-off Your Counter Display</span>
                                        @else
                                            <span>Start Your Counter Display</span>
                                        @endif
                                    @else
                                        <span>Start Your Counter Display</span>
                                    @endif
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--/ All Modal -->
        <!--Edit Product Start-->
          @include('apps.include.modal.editliveProduct')
          @include('apps.include.modal.editProduct')
         
<!--Edit Product End-->
<!--New Customer Start-->
        
<!--New Customer End-->

<!-- Modal for General Sale-->

<!-- Modal for Cash Out-->

           @include('apps.include.modal.new-customer')
           @include('apps.include.modal.generalsaleModal')
           @include('apps.include.modal.payout')
           @include('apps.include.modal.cash-out')
           @include('apps.include.modal.cashoutModal')
           @include('apps.include.modal.discountModal')
           @include('apps.include.modal.CustomerCardModal')
           @include('apps.include.modal.paymodal')
           @include('apps.include.modal.open-drawer')
           @include('apps.include.modal.close-drawer')
           @include('apps.include.modal.time_clock')


        </div>
    </div>
</section>
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
    function alignProductLine()
    {
        $.each($(".add-pos-cart"),function(index,row){
            var charStr=$.trim($(row).html()).length;
            if(charStr<=15)
            {
                $(row).addClass('one-make-full');
            }
        });
    }

    function storecloseLTTheme(name,price)
    {
        var conPrice=parseFloat(price).toFixed(2);
        var data='<tr><td align="left">'+name+' Collected (+) :  </td><td align="left">$'+conPrice+'</td></tr>';
        return data;
    }

    function loadCloseDrawer()
    {
        $("#closeStoreMsg").html("");
        $("#close-drawer").modal('show');
        //------------------------Ajax Customer Start-------------------------//
         var AddHowMowKhaoUrl="{{url('/transaction/store')}}";
         $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                console.log(data);
                var salesTotal=parseFloat(data.salesTotal).toFixed(2);
                var totalTax=parseFloat(data.totalTax).toFixed(2);
                var opening_amount=parseFloat(data.opening_amount).toFixed(2);
                var totalPayout=parseFloat(data.totalPayout).toFixed(2);

                var currectStoreTotal=(salesTotal-0)+(opening_amount-0)+(totalPayout-0);

                    currectStoreTotal=parseFloat(currectStoreTotal).toFixed(2);

                $("#storeCloseDate").html(data.opening_time);
                $("#storeCloseTotalCollection").html(salesTotal);
                $("#storeCloseOpeningAmount").html(opening_amount);
                $("#storeCloseTaxAmount").html(totalTax);
                $("#totalPayout").html(totalPayout);

                //storeCloseTableTenderList
                var salesDataTendr=data.totalSalesTender;
                var salesDataTendrLength=salesDataTendr.length;
                if(salesDataTendrLength>0)
                {
                    var htmlSalesString='';
                    $("#storeCloseTableTenderList").html(htmlSalesString);
                    $.each(salesDataTendr,function(key,row){
                        console.log(row);
                        htmlSalesString+=storecloseLTTheme(row.tender_name,row.tender_total);
                    });
                    $("#storeCloseTableTenderList").html(htmlSalesString);
                }

                $("#currectStoreTotal").html(currectStoreTotal);

                $("#openStoreMsg").html("");
            }
        });
        //------------------------Ajax Customer End---------------------------//
    }


    function paginationPerfect()
    {
        $(".pagination").addClass("pagination-round");
        $.each($(".pagination").find("li"),function(index,row){
            $(row).addClass("page-item");
            $(row).children("a").addClass("page-link");
            //$(row).children("a").addClass("page-link");
            if($(row).attr("class")=="active page-item")
            {
                var getPageNumber=$.trim($(row).children("span").html());
                $(row).html('<a href="javascript:void(0);" class="page-link">'+getPageNumber+'</a>');
            }

            /*if($(row).attr("class")=="disabled page-item")
            {
                $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
            }*/



            if($.trim($(row).children("span").html()).length>0)
            {
                if($.trim($(row).children("span").html())=="«")
                {
                    var getPageNumber=$.trim($(row).children("span").html());
                        //console.log(getPageNumber);
                        $(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
                    }
                    
                    if($.trim($(row).children("span").html())=="»")
                    {
                        var getPageNumber=$.trim($(row).children("span").html());
                        //console.log(getPageNumber);
                        $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
                    }
                    
                }

                if($.trim($(row).children("a").html()).length>0)
                {
                    if($.trim($(row).children("a").html())=="«")
                    {
                        var getPageNumber=$.trim($(row).children("a").append(" Prev"));
                        console.log(getPageNumber);
                        //$(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
                    }
                    
                    if($.trim($(row).children("a").html())=="»")
                    {
                        var getPageNumber=$.trim($(row).children("a").html("Next »"));
                        console.log(getPageNumber);
                        //$(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
                    }
                    
                }
                


            });
    }

    function checkerCounterST()
    {
        var counterStatus=0;
        var counterString=$("#counterStatusChange").children("span").html();
        if(counterString=="Start Your Counter Display")
        {
            counterStatus=1;
            $("#counterStatusChange").children("span").html("Turn-off Your Counter Display");
        }
        else
        {
            $("#counterStatusChange").children("span").html("Start Your Counter Display");
        }

        //------------------------Ajax Customer Start-------------------------//
         var AddHowMowKhaoUrl="{{url('counter-display-status-change')}}";
         $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': {'counterStatus':counterStatus,'_token':"{{csrf_token()}}"},
            'success': function (data) {
                console.log("Counter Display Status : "+data)
            }
        });
        //------------------------Ajax Customer End---------------------------//
    }


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
        var checkTopcol=$("body").hasClass("menu-collapsed");
        if(checkTopcol==false)
        {
            $(".cash_register_collapse").click();
        }
        alignProductLine();
        genarateSalesTotalCart();
        paginationPerfect();

        $("#counterPay").click(function(){
            var counterpayCheck=document.getElementById("counterPay").checked;
            var counterPayStatus=0
            if(counterpayCheck==true)
            {
                counterPayStatus=1;
            }

            //---------------------Ajax New Product Start---------------------//
            var AddProductUrl="{{url('cart/counter-payment/status')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'counterPayStatus':counterPayStatus,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log(data);
                }
            });
            //-----------------Ajax New Product End------------------//
        });


        @if($drawerStatus==0) 
            $(".checkDrawer").fadeOut('fast');
        @else
            $(".checkDrawer").fadeIn('fast');
        @endif
        $("#changeSalesView").click(function(){
            var url="{{url('sales')}}";
            window.location.href=url;
        });
        $(".save-card-customer").click(function(){
            alert('ok');
        });

        $(".savePayout").click(function(){
            var amp=$("#payout_amount").val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
                $("#payout_amount").val(newAMP);
            }
            var payout_reason=$("#payout_reason").val();
            $("#payoutMSG").html(loadingOrProcessing("Saving please wait...."));
            //---------------------Ajax New Product Start---------------------//
            var AddProductUrl="{{url('cart/pos/payout')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'payout_amount':newAMP,'payout_reason':payout_reason,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Saving Payout : "+data);
                    if(data==1)
                    {
                        $("#payoutMSG").html(successMessage("Payout Saved Successfully."));
                        $("#payout_amount").val("0.00");
                        $("#payout_reason").val("");
                        $("#payoutMSG").hide('slow');
                        $("#payoutModal").modal('hide');
                    }
                    else
                    {
                        $("#payoutMSG").html(warningMessage("Failed to saved payout, Please try again."));
                    }
                }
            });
            //-----------------Ajax New Product End------------------//
        });

        $(".openStore").click(function(){
            $(".openStore").fadeOut('fast');
            $("#openStoreMsg").html(loadingOrProcessing("Saving please wait...."));

            var openStoreBalance=$.trim($("input[name=openStoreBalance]").val());
            if(openStoreBalance.length==0)
            {
                openStoreBalance=0;
            }

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('open/store')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'openStoreBalance':openStoreBalance,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Store Opening ID : "+data)
                    if(data)
                    {
                        $("#openStoreMsg").html(successMessage("Store is open successfully."));
                        $("#open-drawer").modal('hide');
                        $(".opdStore").fadeOut('fast');
                        $(".cldStore").fadeIn('slow');

                        $(".closeStore").fadeIn('fast');

                        $(".checkDrawer").fadeIn('fast');
                    }
                    else
                    {   
                        $("#openStoreMsg").html(warningMessage("Failed, please try again...."));
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
            //$(".payModal-message-area").html(warningMessage("Please select a customer."));
        });

        $(".closeStore").click(function(){
            $(".closeStore").fadeOut('fast');
            $("#closeStoreMsg").html(loadingOrProcessing("Saving close drawer info, please wait...."));
             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('close/store')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Store Close ID : "+data)
                    if(data)
                    {
                        $("#closeStoreMsg").html(successMessage("Drawer close successfully."));
                        $("#close-drawer").modal('hide');
                        
                        $(".cldStore").fadeOut('slow');
                        $(".opdStore").fadeIn('fast');
                        $(".openStore").fadeIn('fast');

                        $(".checkDrawer").fadeOut('fast');
                    }
                    else
                    {   
                        $("#closeStoreMsg").html(warningMessage("Failed, please try again...."));
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
            //$(".payModal-message-area").html(warningMessage("Please select a customer."));
        });

        $("#counterStatusChange").click(function(){
            checkerCounterST();
        });


        /*$(".bootstrap-switch-handle-on").click(function(){
            checkerCounterST();
        });
        
        $(".bootstrap-switch-handle-off").click(function(){
            checkerCounterST();
        });

        $(".bootstrap-switch-label").click(function(){
            checkerCounterST();
        });*/

        $('#description').click(function() {
            $('#show_description').toggle("slide");
        });

        $(".close-authorize-payment-modal").click(function(){
            $("#CustomerCard").modal('hide');
        });

        $(".authorize_card_payment").click(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            var subTotalPrice=0;
            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                subTotalPrice+=(rowPrice-0);      
            });

            subTotalPrice=parseFloat(subTotalPrice).toFixed(2);

            if(subTotalPrice<1)
            {
                //$("#payModal").modal('hide');
               // alert("Your cart is empty");
                $(".payModal-message-area").html(warningMessage("Your cart is empty"));
                return false;
            }

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');


                var parseNewPayment=0;

                var amount_to_pay=$("input[name=amount_to_pay]").val();                
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                }

                $(".card-pay-due-amount").html(parseNewPayment);


            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $(".card-pay-authorizenet").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }


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



            var addAuthrizePaymentURL="{{url('authorize/net/capture/pos/payment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addAuthrizePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
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
                            var amount_to_pay=$("input[name=amount_to_pay]").val();
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                            }
                            genarateSalesTotalCart();
                            //------------------------Ajax POS Start-------------------------//
                            var AddPOSUrl="{{url('sales/cart/payment')}}";
                            $.post(AddPOSUrl,{'paymentID':8,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                               // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
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

        $(".authorize_card_refund").click(function(){
            alert('Refund');
        });

        $(".Paypal_Pay").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            
            var parseNewPayment=0;
            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }

            if($.trim(parseNewPayment)>0)
            {
               /* $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');
                var parseNewPayment=0;         
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                $(".card-pay-due-amount").html(parseNewPayment);*/
                $(".modal-footer").hide('slow');
                $(".payModal-message-area").html(loadingOrProcessing("Please wait processing your invoice..."));

                window.location.href="{{url('invoice/pos/pay/paypal')}}";

            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });


        $(".printncompleteSale").click(function(){
            var printDataType=$.trim($(this).attr("data-id"));
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }

            var expaid;
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            if(paid<1)
            {
                alert("Please add payment.");
                return false;
            }

            console.log("Printing Type - ",printDataType);

            //return false;

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/cart/complete-sales')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'printData':1,'print_type':printDataType,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Completing Print Sales ID : "+data)
                    if(data)
                    {
                        var PrintLocation="{{url('sales/invoice/print/media/pdf')}}/"+printDataType+"/"+data;
                        //window.location.href=PrintLocation;

                        var win = window.open(PrintLocation);
                        if (win) {
                            //Browser has allowed it to be opened
                            win.focus();
                            window.location.href=window.location.href;
                        } else {
                            alert('Please allow popups for this website');
                        }
                    }
                    else
                    {
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });

        $("#completesale").click(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }

            var expaid;
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            if(paid<1)
            {
                var c=confirm("Are you sure to create invoice without payment.!!!");
                if(c==false)
                {
                    return false;
                }
            }

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/cart/complete-sales')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Completing Sales : "+data)
                    if(data==1)
                    {
                        window.location.href=window.location.href;
                    }
                    else
                    {
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });


        $("select[name=customer_id]").change(function(){
            var customerID=$.trim($(this).val());
            console.log(customerID);
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }
            else if(customerID==0)
            {
                $("#NewCustomerDash").modal('show');
                return false;
            }


            //------------------------Ajax Customer Start-------------------------//
            var AddCustomerUrl="{{url('sales/cart/customer')}}/"+customerID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddCustomerUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Assigning custome to cart : "+data)
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });


        $(".save-new-customer").click(function(){

//alert('working');
            
           // return false;



                    var name=$.trim($("input[name=new_customer_name]").val());
                    var phone=$.trim($("input[name=new_customer_phone]").val());
                    var email=$.trim($("input[name=new_customer_email]").val());
                    var address=$.trim($("input[name=new_customer_address]").val());
                    //console.log(name,phone,email,address);
                    if(name.length==0)
                    {
                        alert("Please select a customer Name.");
                        return false;
                    }
                    else if(phone.length==0)
                    {
                        alert("Please select a customer Phone Number.");
                        return false;
                    }
                    else if(email.length==0)
                    {
                        alert("Please select a customer Email.");
                        return false;
                    }
                    else if(address.length==0)
                    {
                        alert("Please select a customer Address.");
                        return false;
                    }
                    
                    $(".save-new-customer-parent").html(" Processing please wait.....");

                    //------------------------Ajax Customer Start-------------------------//
                    var AddNewCustomerUrl="{{url('customer/pos/ajax/add')}}";
                    $.ajax({
                        'async': false,
                        'type': "POST",
                        'global': false,
                        'dataType': 'json',
                        'url': AddNewCustomerUrl,
                        'data': {'name':name,'phone':phone,'email':email,'address':address,'_token':"{{csrf_token()}}"},
                        'success': function (data) {
                            $("select[name=customer_id]").append('<option value="'+data+'">'+name+'</option>');
                            $("select[name=customer_id] option[value='"+data+"']").prop("selected",true);

                            console.log("Saved New Customer : "+data);
                            $("#NewCustomerDash").modal('hide');

                            //------------------------Ajax Customer Start-------------------------//
                            var AddCustomerPOSUrl="{{url('sales/cart/customer')}}/"+data;
                            $.ajax({
                                'async': false,
                                'type': "POST",
                                'global': false,
                                'dataType': 'json',
                                'url': AddCustomerPOSUrl,
                                'data': {'_token':"{{csrf_token()}}"},
                                'success': function (datas) {
                                    console.log("Assigning custome to cart : "+datas)
                                }
                            });
                            //------------------------Ajax Customer End---------------------------//
                        }
                    });
                    //------------------------Ajax Customer End---------------------------//
                });






        $(".make-payment").click(function(){


            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }

            var payment_id=$(this).attr("data-id");
            var payment_text=$(this).html();
            var c=confirm("Are you sure to proced with "+$.trim(payment_text)+" ?.");
            if(c)
            {
                var amount_to_pay=$("input[name=amount_to_pay]").val();
                console.log(amount_to_pay,payment_id,$.trim(payment_text));
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                }
                genarateSalesTotalCart();
                $("#payModal").modal("hide");
                //------------------------Ajax POS Start-------------------------//
                var AddPOSUrl="{{url('sales/cart/payment')}}";
                $.post(AddPOSUrl,{'paymentID':payment_id,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                    console.log(response);
                });
                //------------------------Ajax POS End---------------------------//
            }
            
        });

        $(".amountextract").click(function(){
            console.log($(this).parent().html());
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }
            genarateSalesTotalCart();
        });

        $("#discount_amount").keyup(function(){
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
        });

        $(".apply-discount").click(function(){
            var amp=$("#discount_amount").val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            var discount_type=0;
            discount_type=$("select[name=discount_type]").val();
            


            genarateSalesTotalCart();
            $("#Discount").modal("hide");

            //------------------------Ajax New Product Start-------------------------//
            var AddProductUrl="{{url('sales/cart/assign/discount')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'discount_type':discount_type,'discount_amount':newAMP,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Assigning Discount : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//


        });

        $(".edit_pos_item").click(function(){
            console.log("WW");
        });


        $(".GAddProductToCart").click(function(){
            @if(isset($ps))
            var taxRate="{{$ps->sales_tax}}";
            @else
            var taxRate=0;
            @endif
            var ProductName=$.trim($("input[name=gName]").val());
            var ProductPrice=$.trim($("input[name=gPrice]").val());
            var ProductCPrice=$.trim($("input[name=CPrice]").val());
            var ProductDesc=$.trim($("textarea[name=gDetail]").val());

            if(ProductName.length==0)
            {
                alert("Please name should not be empty..");
                return false;
            }

            if(ProductPrice.length==0)
            {
                    alert("Please price should not be empty..");
                    return false;
            }

            if(ProductCPrice.length==0)
            {
                    alert("Please Cost price should not be empty..");
                    return false;
            }

         if(ProductDesc.length==0)
         {
             ProductDesc="General Sales.";
         }
         else
         {
            ProductDesc='General Sales : '+ProductDesc;
        }


        console.log(ProductName,ProductPrice,ProductDesc);
        $("#General_Sale").modal("hide");
            //------------------------Ajax New Product Start-------------------------//
            var ProductID; 
            var AddProductUrl="{{url('product/ajax/save')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'name':ProductName,'price':ProductPrice,'cost_price':ProductCPrice,'detail':ProductDesc,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    ProductID=data; 
                    //console.log("Adding New Product : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//
            //console.log(ProductID);

            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//

        });


$(".add-pos-cart").click(function(){
            //alert('sss');
            var ProductID=$(this).attr('data-id');
            var ProductPrice=$(this).attr('data-price');
            var ProductName=$(this).html();
            @if(isset($ps))
            var taxRate="{{$ps->sales_tax}}";
            @else
            var taxRate=0;
            @endif


            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//

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

function editRowLive(id)
{
    @if(isset($ps))
    var taxRate="{{$ps->sales_tax}}";
    @else
    var taxRate=0;
    @endif
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        var unitPrice=$("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price");
        var edit_quantity=$("input[name=edit_quantity]").val();
        if($.isNumeric(edit_quantity))
        {
            if(edit_quantity>=0)
            {
                var totalPrice=unitPrice*edit_quantity;    
            }
            else
            {
                edit_quantity=0;
                $("input[name=edit_quantity]").val(edit_quantity);
                var totalPrice=unitPrice*edit_quantity;    
            }
        }
        else
        {
            edit_quantity=0;
            $("input[name=edit_quantity]").val(edit_quantity);
            var totalPrice=unitPrice*edit_quantity;    
        }
        
        var taxAmount=parseFloat((totalPrice*taxRate)/100).toFixed(2);
        
        $("#dataCart tr[id="+id+"]").find("td:eq(1)").html(edit_quantity);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html(totalPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-tax",taxAmount);
        genarateSalesTotalCart();
        //need to incorporate witth ajax

        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl="{{url('sales/cart/custom/add')}}/"+id+"/"+edit_quantity;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                //tmp = data;
                console.log("Custom Quantity Processing : "+data)
            }
        });
        //------------------------Ajax POS End---------------------------//
    }

    function delposSinleRow(ID)
    {
        var c=confirm("Are you sure to delete this item.");
        if(c)
        {
            $("#dataCart tr[id="+ID+"]").remove();
            genarateSalesTotalCart();
            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/row/delete')}}/"+ID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Delete Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//
        }

    }

    function edit_pos_item(id)
    {
        //console.log(id);
        
        //console.log($("#dataCart tr[id="+id+"]").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(0)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(1)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price"));
        var edit_product_name=$("#dataCart tr[id="+id+"]").find("td:eq(0)").html();
        var edit_quantity=$("#dataCart tr[id="+id+"]").find("td:eq(1)").html();
        //var edit_unit_price=$("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html();
        $("input[name=edit_product_name]").val($.trim(edit_product_name));
        $("input[name=edit_quantity]").val($.trim(edit_quantity));
        $("input[name=edit_quantity]").attr("onkeyup","editRowLive("+id+")");
        $("input[name=edit_quantity]").attr("onchange","editRowLive("+id+")");
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        $("input[name=edit_id]").val(id);
        $('#editProduct').modal('show');
        //$('#myModal').modal('hide');
    }

    
    function genarateSalesTotalCart()
    {
        if($("#dataCart tr").length > 0)
        {
            var subTotalPrice=0;
            var TotalTax=0;
            var priceTotal=0;
            var due=0;
            var discount=0;
            var discount_type=0;

            if($("select[name=discount_type]").length>0)
            {
                discount_type=$("select[name=discount_type]").val();
            }


            var expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                var rowTax=$(row).find("td:eq(2)").attr("data-tax");
                subTotalPrice+=(rowPrice-0);    
                TotalTax+=(rowTax-0);    
            });

            var calcDisc=0;
            if($("#discount_amount").length>0)
            {
                discount=$.trim($("#discount_amount").val());
                if(discount_type==1)
                {
                    calcDisc=$.trim($("#discount_amount").val());
                }
                else if(discount_type==2)
                {
                    calcDisc=((subTotalPrice*$.trim($("#discount_amount").val()))/100);
                }
                else
                {
                    calcDisc=0;
                }
            }
            else
            {
                discount=0;
            }

            var sumPriceTotal=((subTotalPrice-0)+(TotalTax-0));
            //var calcDisc=((sumPriceTotal*discount)/100);
            sumPriceTotal=sumPriceTotal-calcDisc;
            var sumdues=sumPriceTotal-paid;
            var newdues=parseFloat(sumdues).toFixed(2);
            var newPriceTotal=sumPriceTotal.toFixed(2);
            var newDiscount=calcDisc.toFixed(2);
            var newsubTotalPrice=subTotalPrice.toFixed(2);
            var newTotalTax=TotalTax.toFixed(2);

            if(newdues<0){ newdues="0.00"; }
            else if(newdues=="-0.00"){ newdues="0.00"; }



            $("#posCartSummary tr:eq(2)").find("th").children("span").html(discount+"%");

            $("#posCartSummary tr:eq(0)").find("td:eq(1)").children("span").html(newsubTotalPrice);
            $("#posCartSummary tr:eq(1)").find("td:eq(1)").children("span").html(newTotalTax);
            $("#posCartSummary tr:eq(2)").find("td:eq(1)").children("span").html(newDiscount);
            $("#posCartSummary tr:eq(3)").find("td:eq(1)").children("span").html(newPriceTotal);
            $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(paid);
            $("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html(newdues);

            $("input[name=amount_to_pay]").val(newdues);
            console.log($("input[name=amount_to_pay]").val());
            $("#prmDue").html(newdues);

        }
        else
        {
            $("#posCartSummary tr:eq(0)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(1)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("th").children("span").html("0%");
            $("#posCartSummary tr:eq(3)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html("0.00");
            $("input[name=amount_to_pay]").val("0.00");
            $("#prmDue").html("0.00");
        }


    }

</script>
<script type="text/javascript">
    $("#punch").click(function(){
            $(".hideDIv").hide();
            $("#punchMSG").hide();
            //------------------------Ajax POS Start-------------------------//
            var timevalue=$("#punch_time").val();
            var timeLen=timevalue.length;
            if(timeLen==19)
            {
                $("#punchMSG").show();
                $("#punchMSG").html(loadingOrProcessing("Processing Your Attendance Info, Please wait....."));
                var AddPOSUrl="{{url('attendance/punch/save')}}";
                $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': AddPOSUrl,
                    'data': {'date':timevalue,'_token':"{{csrf_token()}}"},
                    'success': function (data) {
                        //tmp = data;
                        $("#punchMSG").show();
                        $("#punchMSG").html(successMessage("Your Attendance Saved Successfully."));
                        console.log("Attendance Processing : "+data);
                        
                        if(data.length>0)
                        {
                            $(".hideDIv").show();
                            $("#punchLogTimes").html("");
                            $.each(data,function(key,row){
                                var elapsed_time=row.elapsed_time;
                                if(row.out_time=="00:00:00")
                                {
                                    elapsed_time="00:00:00";
                                }
                                var htmlStr='<tr><td>'+row.in_date+'</td><td>'+row.in_time+'</td><td>'+row.out_date+'</td><td>'+row.out_time+'</td><td>'+elapsed_time+'</td></tr>';
                                $("#punchLogTimes").append(htmlStr);
                            });
                        }
                        
//punchLogTimes

                    }
                });
            }
            else
            {
                $("#punchMSG").show();
                $("#punchMSG").html(warningMessage("Invalid Time Format Please Contact With Site Administrator."));
                return false;
            }
            
            //------------------------Ajax POS End---------------------------//
            //attendance/punch/json
            //attendanceJson
    });
</script>
<!-- <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                </tfoot> -->
                                @endsection

