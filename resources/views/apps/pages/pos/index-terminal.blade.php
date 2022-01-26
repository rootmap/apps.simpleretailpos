@extends('apps.layout.master')
@section('title','Point of Sales')
@section('content')
<section id="form-action-layouts">
    <?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();

    //dd($dataMenuAssigned);
?>
  
    
    <!------ Include the above in your HEAD tag ---------->
    
	<div class="row">
		<div class="col-lg-7 col-md-12 pos-product-display" style="min-height: 700px;">
            <div id="cartMessageProShow" style="display: block;"></div>
        <div class="row">
            <div class="col-md-12" @if($userguideInit==1) data-step="6" data-intro="Here you will have categories which you have created. Also after you click on category it will show all the product on top & after you click on product it will add on POS Cart." @endif>
                
                
                <div class="col-md-6" @if($userguideInit==1)  data-step="1" data-intro="Barcode Sales, Product could be sold by barcode." @endif>
                    <form method="post" action="javascript:loadCartProBar();" style="margin-top: -15px;">
                            <label class="col-md-12 text-xs-center"><b>Enter Barcode</b></label>
                            <input type="text"  autocomplete="off" class="form-control col-md-6" name="barcode" placeholder="Enter Your Barcode & Press Enter.">
                    </form>
                </div>
                <div class="col-md-6">
                    <h4 class="page-header"> 
                        <i class="icon-layout"></i> 
                        Categories <hr> 
                    </h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-1">
                    <div class="card-body collapse in">
                        <div class="bg-info bg-lighten-4 height-10"></div>
                        <div class="p-1">
                            <p class="text-xs-left mb-0">
                                <a href="javascript:void(0);"  data-toggle="modal" data-target="#General_Sale" style="text-decoration: none;">
                                    <i class="icon-database"></i> General Sale
                                </a>
                            </p>         
                        </div>
                    </div>    
                </div>
            </div>

            @if(isset($catInfo) && count($catInfo)>0)
                <?php $i=1; ?>
                @foreach($catInfo as $cat)
                @if($cat->name=="Repair")
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-info bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#instoreRepairModal" style="text-decoration: none;">
                                            <i class="icon-cogs"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @elseif($cat->name=="Ticket")
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-info bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#instoreTicketModal" style="text-decoration: none;">
                                            <i class="icon-cogs"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-info bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:loadCatProduct({{$cat->id}});" style="text-decoration: none;">
                                            <i class="icon-chevron-circle-right"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @endif
                <?php 
                $i++; 
                if($i==5)
                {
                    $i=1;
                }
                ?>
                @endforeach 
            @else
                <div class="col-md-12">
                    <h2  class="text-xs-center">No categories found. <br>  <br> 
                        <a href="{{url('category')}}" class="btn btn-info"><i class="icon-ios-plus-outline"></i> Create Now</a>
                    </h2>
                </div>
            @endif

            

            
        </div>
        <div class="row" id="defaultProductView">

            <span id="product_place"></span>

        </div>

        <hr>
        @include('apps.include.virtual-terminal')
        
            
    </div>

    <div class="col-lg-5 col-md-12 mr-0 pr-0 dropableCartZone">
        <!-- CSS Classes -->
        <div class="card testerPickup paper-cut" style="margin-top: -20px;">
            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">

                        <!-- starting group menu ---->
                        
                        <div class="col-sm-4 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="icon-settings"></i> Other Action
                                </button>
                                <div class="dropdown-menu arrow">
                                    <a href="{{url('sales/invoice/print/pdf/'.$last_invoice_id)}}" class="dropdown-item"><i class="icon-printer info"></i> Print Last Receipt</a>
                                    <button class="dropdown-item" type="button" id="counterStatusChange"><i class="icon-monitor info"></i> 
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
                                    <button class="dropdown-item" type="button" id="counterPay">
                                        @if(isset($cart->AllowCustomerPayBill)) 
                                                    @if($cart->AllowCustomerPayBill>0) 
                                                        <i class='icon-checkmark info'></i> Allow pay from counter display
                                                    @else
                                                        <i class='icon-close-circled info'></i> Allow pay from counter display
                                                    @endif
                                        @else
                                            <i class='icon-close-circled info'></i> Allow pay from counter display
                                        @endif
                                        
                                    </button>
                                    <button class="dropdown-item" type="button" id="changeSalesView"><i class="icon-layout info"></i> Change Sales View</button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#payoutModal"><i class="icon-share-square info"></i> Payout </button>
                                    <button class="dropdown-item" type="button"  data-toggle="modal" data-target="#TimeClockModal">
                                        <i class="icon-clock-o info"></i> Time Clock 
                                    </button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#salesReturn">
                                        <i class="icon-repeat2 info"></i> Sales Return
                                    </button>
                                    <button class="dropdown-item addPartialPayment" type="button"><i class="icon-money info"></i> 
                                    Add Partial Payment
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info  btn-block" @if($userguideInit==1) data-step="7" data-intro="The Discount button, gerenates a popup that allows you to discount an item." @endif data-toggle="modal" data-target="#Discount">
                                % Discount
                                </button>
                            </div>
                        </div>


                        <div class="col-sm-2 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info  btn-block"   @if($userguideInit==1) data-step="16" data-intro="When you click clear POS button then clear the all POS screen." @endif  id="clearsale">
                               <i class="icon-circle-cross"></i> Reset
                                </button>
                            </div>
                        </div>

                        <div class="clearfix"></div>                       
                        <!-- Ending group menu ----->

                </div>
            </div>

            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                <div class="row">



                    <div class="col-sm-12 col-xs-12"  @if($userguideInit==1) data-step="12" data-intro="Here you can select your customer. " @endif>

                        <div class="input-group border-info">
                            <span style="cursor: pointer;" class="input-group-addon addNewCustomerPOS info" id="basic-addon4"><i class="icon-user-plus"></i> New Customer</span>
                            <select style="width: 100%; font-size: 16px !important; font-weight: bolder;" class="select2 form-control" name="customer_id">
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



                </div>
            </div>
            <div class="card-body collapse in" @if($userguideInit==1) data-step="10" data-intro="In this section, you see all the product you added also you can see the total, paid amount and due amount. you must be a select customer then you can access other action." @endif>
                <div class="card-blockf">
                    <div class="card-text">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th align="center" style="text-align: center; width: 150px;">Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart">
                                    @if(isset($cart->items))
                                        @if(count($cart->items)>0)
                                            @foreach($cart->items as $index=>$row)
                                            <tr id="{{$row['item_id']}}">
                                                <td valign="center">{{$row['item']}}</td>
                                                <td>
                                                    <div class="input-group" style="border-spacing: 0px !important;">
                                                        <span class="input-group-addon dedmoreqTv4Ex"><i class="{{($row['qty']==1)?'icon-remove':'icon-minus'}}"></i></span>
                                                        <input style="text-align: center;" type="text" class="form-control directquantitypos" placeholder="Addon On Both Side" aria-label="Amount (to the nearest dollar)" value="{{$row['qty']}}">
                                                        <span class="input-group-addon addmoreqTv4"><i class="icon-plus"></i></span>
                                                    </div>
                                                </td>
                                                <td class="priceEdit" valign="center"  style="line-height: 35px;" data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{number_format($row['unitprice'],2)}}</span></td>
                                                <td  class="priceEdit" valign="center"  style="line-height: 35px;">$<span>{{number_format($row['price'],2)}}</span></td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">
                                                    <h3 style="height: 50px; text-align: center; line-height: 50px;">
                                                        No Item on Cart
                                                    </h3>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                                <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Discount : <span>0%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>0.00</span></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>Total</th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>0.00</span></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>Paid</th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>
                                            @if(isset($cart->paid))
                                            {{$cart->paid}}
                                            @else
                                            0.00
                                            @endif
                                        </span></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>Due</th>
                                        <td></td>
                                        <td></td>
                                        <td>$<span>0.00</span></td>
                                    </tr>
                                                                  
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                        <style type="text/css">
                            
                        </style>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>



                <style type="text/css">
                    
                </style>
                <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                    <div class="row">
                        <div class="col-sm-6 col-xs-6 border-right-green">
                            <div class="col-md-12" style="padding:0px; margin: 0px;">
                                <h2 class="gray hellvetia text-xs-center" style="padding:0px; margin: 0px;">Total</h2>
                            </div>
                            <div class="col-md-12" style="padding:0px; margin: 0px;">
                                <h3 class="text-xs-center info" style="padding:0px;  margin: 0px;">$<span id="cartTotalAmount">0.00</span></h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="col-md-12"><h2 class="gray hellvetia text-xs-center">Amount Due</h2></div>
                            <div class="col-md-12" style="padding:0px; margin: 0px;">
                                <h3 class="text-xs-center yellow" style="padding:0px; margin: 0px;">$<span id="totalCartDueToPay">0.00</span></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header" style="padding:0rem !important; display: none">
                    <table class="table">
                        <tr>
                            <td><i class="icon-close-circled"></i></td>
                            <td>Cash</td>
                            <td></td>
                                            <td></td>
                            <td>$<span>0.00</span></td>
                        </tr>
                    </table>
                </div>

                <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                    <div class="row">
                        <style type="text/css">
                                
                            </style>
                            <div class="col-xs-12 button-group">
                                <!-- Quick Links -->

                                <style type="text/css">
                                    

                                </style>


                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button posQL button6 checkDrawer" @if($userguideInit==1) data-step="13" data-intro="When you click Make Payment button then popup new payment screen to pay via customer credit card/other card or paypal or cash." @endif>
                                    
                                    <button id="btn-payment-modal_init" data-toggle="modal" data-target="#payModal"  type="button" class="btn btn-info btn-darken-2 btn-responsive btn1  spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
                                       <i class="icon-cash"></i> Make Payment
                                    </button>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button posQL button1 btn-group checkDrawer" @if($userguideInit==1) data-step="15" data-intro="After paid payment then click print invoice button and you print this invoice." @endif>
                                    <button  type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info btn-darken-3 btn-responsive btn1  dropdown-toggle spfontcartfotter" style="font-size: 15px !important; font-weight: 600;"><i class="icon-printer4"></i> Print Invoice &nbsp;</button>      
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item printncompleteSale" data-id="pos" href="javascript:void(0);"><i class="icon-printer4"></i> Default Print</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item printncompleteSale"  data-id="thermal"  href="javascript:void(0);"><i class="icon-ios-printer-outline"></i> Thermal Print</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item printncompleteSale"  data-id="barcode" href="javascript:void(0);"><i class="icon-barcode2"></i> Barcode Print</a>
                                        </div>

                                </div>   

                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button posQL button6 checkDrawer"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
                                    <button id="completesale" type="button" class="btn btn-block btn1 btn-info btn-darken-4 btn-responsive btn1 spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
                                       <i class="icon-circle-check"></i>  Complete Sale
                                    </button>
                                </div>

                                <div @if($drawerStatus==1)  style="display: none;" @endif class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 opdStore"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
                                    <button id="completesale" type="button" class="btn btn-block btn1 btn-info btn-darken-4 btn-responsive btn1 spfontcartfotter"   data-toggle="modal" data-target="#open-drawer" style="font-size: 15px !important; font-weight: 600;">     
                                       <i class="icon-hand-grab-o"></i> Open Drawer
                                    </button>
                                </div>

                                <div @if($drawerStatus==0)  style="display: none;"  @endif class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 cldStore"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
                                    <button id="completesale" type="button" class="btn btn-block btn1 btn-info btn-darken-4 btn-responsive btn1 spfontcartfotter"  onclick="loadCloseDrawer()" style="font-size: 15px !important; font-weight: 600;">     
                                       <i class="icon-hand-grab-o"></i> Close Drawer
                                    </button>
                                </div>




                                <!-- Quick Links End -->
                            </div>
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
           @include('apps.include.modal.salesReturn')
           @include('apps.include.modal.generalsaleModal')
           @include('apps.include.modal.payout')
           @include('apps.include.modal.cash-out')
           @include('apps.include.modal.cashoutModal')
           @include('apps.include.modal.discountModal')
           @include('apps.include.modal.CustomerCardModal')
           @include('apps.include.modal.stripeCardModal',compact('stripe'))
           @include('apps.include.modal.complete-sales')
           @include('apps.include.modal.squareup')
           @include('apps.include.modal.cardPointeCardModal')
           @include('apps.include.modal.cardPointepartialCardModal')
           @include('apps.include.modal.squareupPartial')
           @include('apps.include.modal.paymodal',compact('stripe'))
           @include('apps.include.modal.open-drawer')
           @include('apps.include.modal.close-drawer')
           @include('apps.include.modal.time_clock')
           @include('apps.include.modal.virtual-terminal')
           @include('apps.include.modal.pospaymentpartial')
           
           



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
<script src="{{url('js/calc.js')}}" type="text/javascript"></script>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/pos.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')

<script src="{{url('theme/app-assets/vendors/js/forms/extended/card/jquery.card.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-typeahead.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-card.min.js')}}" type="text/javascript"></script>



<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>

<script src="{{url('theme/app-assets/js/scripts/ui/scrollable.min.js')}}" type="text/javascript"></script>

<script src="{{url('theme/app-assets/vendors/js/extensions/dragula.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.js')}}" ></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('js/stripe.js')}}" ></script>
<script src="{{asset('js/sales-return.js')}}" ></script>
<script>
//editRowLive
    //
var AddHowMowKhaoUrlCartPOSvfour="{{secure_url('sales/cart/complete-sales')}}";    
var sales_return_invoice_detail = "{{secure_url('sales/return/invoice/detail')}}";
var sales_return_item = "{{secure_url('sales/return/item')}}";
var sales_return_invoice_ajax="{{secure_url('sales/return/invoice/ajax')}}";
var sales_return_save_ajax="{{secure_url('sales/return/save/ajax')}}";

var product_pos_settings_product_url = "{{secure_url('product-config/json')}}";
var productJson=null; 

var selectedDefCusPOSSCRvFour="";
var defCusIDCusPOSSCRvFour=0;
    @if(!isset($cart->customerID))
        @if(empty($cart->customerID))
    selectedDefCusPOSSCRvFour=" selected='selected'  ";
        @endif
    @endif

    @if(isset($cart->customerID))
    defCusIDCusPOSSCRvFour="<?php echo $cart->customerID; ?>";
    @endif


@if(isset($ps))
var taxRate="{{$ps->sales_tax}}";
@else
var taxRate=0;
@endif
var checkerCounterST="{{url('counter-display-status-change')}}";
var AddSalesCartAddUrl="{{url('sales/cart/add')}}";
var AddSalesVTCartAddUrl="{{url('sales/vt/cart/add')}}";
var transactionStore="{{url('/transaction/store')}}";
var cartCounterPaymentStatus="{{url('cart/counter-payment/status')}}";
var cartPosPayout="{{url('cart/pos/payout')}}";
var openStore="{{url('open/store')}}";
var closeStore="{{url('close/store')}}";
var authorizeNetCapturePosPayment="{{url('authorize/net/capture/pos/payment')}}";

var salesCartPayment="{{url('sales/cart/payment')}}";
var pingDevice="{{url('bolt/ping')}}";
var boltTokenCaptureURL="{{url('bolt/token')}}";
var boltCaptureURL="{{url('bolt/capture')}}";
var CardPointePOSPaymentURL="{{url('cardpointe/pos/payment')}}";
var invoicePosPayPaypal="{{url('invoice/pos/pay/paypal')}}";

var salesCartCompleteSales="{{url('sales/cart/complete-sales')}}";
// var salesInvoicePrintMediaPDF="{{url('sales/invoice/print/media/pdf')}}";
//var AddHowMowKhaoUrlCartPOSvfourPrintPDFSalesRec="url('sales/invoice/print/media/pdf')";
var AddHowMowKhaoUrlCartPOSvfourPrintPDFSalesRec="{{url('sales/invoice/print/media/last-invoice')}}";
var clposLink="{{url('pos/clear')}}";
var salesCartCustomer="{{url('sales/cart/customer')}}";
var customerPosAjaxAdd="{{url('customer/pos/ajax/add')}}";
var salesCartAssignDiscount="{{url('sales/cart/assign/discount')}}";
var AddProductAjaxSaveUrl="{{url('product/ajax/save')}}";
var salesCartCustomerAdd="{{url('sales/cart/custom/add')}}";
var salesCartRowDelete="{{url('sales/cart/row/delete')}}";
    
var attendancePunchSave="{{url('attendance/punch/save')}}";
var repairListUrl="{{url('repair/list')}}";
var repairInfoPOsAjax="{{url('repair/info/pos/ajax')}}";

var addPartialPaymentCond=0;
@if($addPartialPayment==1)
    addPartialPaymentCond=1;
@endif

var partialpayinvoiceajaxURL="{{url('partialpay/invoice/ajax')}}";

var partial_invoice=null;
@if(!empty($partial_invoice)) 
    var partial_invoice="{{$partial_invoice}}";
@endif

var stripepartialURL="{{url('stripepartial')}}";

var addCardPointePartialPaymentURL="{{url('cardpointe/partial/payment')}}";
var boltPartialCaptureURL="{{url('bolt/partial/capture')}}";
var authorizenetcapturepospartialpayment="{{url('authorize/net/capture/pos/partial/payment')}}";

var drawerStatusCheck=0;
@if($drawerStatus==0) 
    drawerStatusCheck=0;
@else
    drawerStatusCheck=1;
@endif

var changeSalesViewURLurl="{{url('sales')}}";
var stripepartialURLSTSIm="{{url('stripe')}}";
var partialpaypaypal="{{url('partial/pay/paypal')}}";

var editRowLiveAddPOSUrl=salesCartCustomerAdd;
var delposSinleRowAddPOSUrl=salesCartRowDelete;
var verifyManagerLogin="{{url('ma/verify')}}";
var cartProductImgUrl="{{url('upload/product')}}";
var defaultProductimgURLCartPOSvfour="{{url('images/product-avater-2.jpg')}}";
var loadingSVGProduct="{{url('images/loading.svg')}}";

var product_image_status=0;
@if(isset($product_image_status))
    @if($product_image_status->product_image_status==1)
        product_image_status=1;
    @endif
@endif
var squareupPaymentFormload="{{url('intregation/squareup/form')}}";
</script>
<script src="{{url('js/product-config.js')}}" type="text/javascript"></script>
<script src="{{url('js/pos.js')}}" type="text/javascript"></script>
<script src="{{url('js/intregation.js')}}" type="text/javascript"></script>
@endsection

