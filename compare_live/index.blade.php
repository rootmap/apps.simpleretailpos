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

        <div class="row mb-1">
            <form method="post" action="javascript:loadCartProBar();">
                <div  style="margin: 0 auto; width: 50%;"  data-step="1" data-intro="Barcode Sales, Product could be sold by barcode.">
                    <label class="col-md-12 text-xs-center"><b>Enter Barcode</b></label>
                    <input type="text"  autocomplete="off" class="form-control col-md-6" name="barcode" placeholder="Enter Your Barcode & Press Enter.">
                </div>
            </form>
        </div>

        <div class="row" id="defaultProductView">
          {{-- @if(isset($product))
          @foreach($product as $pro)
          <div class="col-md-3 col-xs-6 col-sm-3">
            <a href="javascript:void(0);" data-id="{{$pro->id}}" data-price="{{$pro->price}}" class="btn-blue btn-lighten-1 btn-block add-pos-cart btn">
                <span>{{$pro->name}}</span>
            </a>
        </div>   
        @endforeach
        @endif   --}}

        <script type="text/javascript">
            .height-30
            {
                height:30px !important;
            }
        </script>
        <span id="product_place"> 
            <div class="col-md-12">
                <h2  class="text-xs-center">Click on category to load product. <br>  <br> 
                    {{-- <a href="{{url('product')}}" class="btn btn-info">
                        <i class="icon-ios-plus-outline"></i> Create new product
                    </a> --}}
                </h2>
            </div>
            
            {{-- @for($i=1; $i<=15; $i++)
            <div class="col-md-3">
                <a class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">
                    <div class="card-body collapse in">
                        
                        <div class="p-1 bg-info" style="padding: 0.7rem !important; border-top-right-radius:3px; border-top-left-radius: 3px;">
                            <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left" style="color: #fff;">Info Lighten 1</p>          
                        </div>
                        <div class="text-xs-right" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">12.45</div>

                    </div>    
                </a>
            </div>
            @endfor --}}
        </span>

    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12">

        </div>

    </div>
            <div class="row">
                <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="2" data-intro="General Sale, allows users to create one time sale items for purchase." @endif> 
                    <a class="thumbnail btn-block  bg-info bg-lighten-1" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#General_Sale"> <i class="icon-database2"></i> General Sale </a>
                </div>
                
                <div class="col-md-3 col-xs-6 col-sm-3 opdStore" @if($drawerStatus==1) style="display: none;" @endif  @if($userguideInit==1) data-step="3" data-intro="When you click Open Drawer / Close Drawer button then popup new windows for opening amount to drawer & closing drawer will also have print & close drawer option." @endif> 
                    <a class="thumbnail btn-block bg-info bg-lighten-3"  data-toggle="modal" data-target="#open-drawer" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;"><i class="icon-hand-grab-o"></i> Open Drawer </a>
                </div>

                <div class="col-md-3 col-xs-6 col-sm-3 cldStore" @if($drawerStatus==0) style="display: none;" @endif> 
                    <a class="thumbnail btn-block bg-info bg-accent-1" onclick="loadCloseDrawer()" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;"><i class="icon-hand-grab-o"></i> Close Drawer </a>
                </div>
             
                <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="4" data-intro="Payout, gives users the option to add or deduct cash from the drawer." @endif> 
                    <a class="thumbnail btn-block bg-info bg-accent-2" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#payoutModal"> <i class="icon-share-square"></i> Payout </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="5" data-intro="When you click Time Clock, it will show a popup & give you a option for punch-in/out. User can can see previous punch log by clicking on today punch." @endif> 
                    <a class="thumbnail btn-block bg-info bg-darken-2 btn-block" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#TimeClockModal"><i class="icon-clock-o"></i> Time Clock </a>
                </div>
                {{-- <div class="col-md-3 col-xs-6 col-sm-3"> 
                    <a class="thumbnail btn-block bg-danger" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#CustomerCard">Customer Card </a>
                </div> --}}
            </div>
            <style type="text/css">
                .height-10{ height: 10px !important; }
            </style>
            <div class="row">
                <div class="col-md-12" @if($userguideInit==1) data-step="6" data-intro="Here you will have categories which you have created. Also after you click on category it will show all the product on top & after you click on product it will add on POS Cart." @endif>
                    <h4 class="page-header"> <i class="icon-layout"></i> Categories <hr> </h4>
                </div>
                @if(isset($catInfo) && count($catInfo)>0)
                    <?php $i=1; ?>
                    @foreach($catInfo as $cat)
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-info bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <h5 class="text-xs-center">
                                        <a href="javascript:loadCatProduct({{$cat->id}});" style="text-decoration: none;">
                                            <i class="icon-chevron-circle-right"></i> {{$cat->name}}
                                        </a>
                                    </h5>         
                                </div>
                            </div>    
                        </div>
                    </div>
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

                {{-- @for($i=1; $i<=4; $i++)
                <div class="col-md-3">
                    <div class="card mb-1">
                        <div class="card-body collapse in">
                            <div class="bg-info bg-darken-{{$i}} height-10"></div>
                            <div class="p-1">
                                <h5 class="text-xs-center">
                                    <a href="javascript:void(0);" style="text-decoration: none;">Primary </a>
                                </h5>       
                            </div>
                        </div>    
                    </div>
                </div>
                @endfor

                 @for($i=1; $i<=4; $i++)
                <div class="col-md-3">
                    <div class="card mb-1">
                        <div class="card-body collapse in">
                            <div class="bg-info bg-accent-{{$i}} height-10"></div>
                            <div class="p-1">
                                <h5 class="text-xs-center">
                                    <a href="javascript:void(0);" style="text-decoration: none;">Primary </a>
                                </h5>         
                            </div>
                        </div>    
                    </div>
                </div>
                @endfor --}}

                
            </div>
        </div>
        <style type="text/css">
        /* Desktop 
        media (min-width:960px) {

            .testerPickup {
                position: fixed; top:42px;
            }   

        }*/
        .table td, .table th
        {
            padding: 0.1rem .75rem;
        }
    </style>
    <div class="col-lg-5 col-md-12 mr-0 pr-0">
        <!-- CSS Classes -->
        <div class="card testerPickup" style="margin-top: -20px;">
            <div class="card-header">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h5>
                        </h5>
                        
                        <div class="form-group" style="margin-bottom: 0px !important;">
                            <!-- basic buttons -->
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#Discount" @if($userguideInit==1) data-step="7" data-intro="The Discount button, gerenates a popup that allows you to discount an item." @endif><i class="icon-pencil2"></i> Discount</button>
                            <a href="javascript:void(0);" class="btn btn-secondary btn-sm"  @if($userguideInit==1) data-step="7" data-intro="You see current invoice number." @endif> Invoice#@if(isset($cart->invoiceID))    
                                {{$cart->invoiceID}}
                                @else
                                0
                            @endif </a>
                            <a href="{{url('sales/invoice/print/pdf/'.$last_invoice_id)}}" class="btn btn-secondary btn-sm" @if($userguideInit==1) data-step="8" data-intro="Gives you the option to re-print your last receipt." @endif> <i class="icon-printer"></i> Last Receipt</a>
                            <button type="button" class="btn btn-secondary btn-sm" id="description" @if($userguideInit==1) data-step="9" data-intro="you can create the some note." @endif><i class="icon-edit2"></i> <span id="npt">Note</span></button>
                            <div class="form-group row" style="margin-top: 5px; display: none;" id="show_description">
                                <textarea class="form-control" id="title1" rows="2" placeholder="Description"></textarea>
                            </div>
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
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart">
                                    @if(isset($cart->items))
                                    @foreach($cart->items as $index=>$row)
                                    <tr id="{{$row['item_id']}}">
                                        <td>{{$row['item']}}</td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})">{{$row['qty']}}</td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})" data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{$row['unitprice']}}</span></td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})">$<span>{{$row['price']}}</span></td>
                                        <td style="width: 83px;">
                                            <a href="javascript:editRowLive({{$row['item_id']}});" title="Edit" class="btn btn-sm btn-outline-info hiddenLiveSave" style="margin-right:2px; display: none;"><i class="icon-pencil22"></i></a>
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
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Discount : <span>0%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>
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
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <button type="button" class="btn btn-block btn-info btn-lighten-2">
                                                    <h4>
                                                        <span>Total Due</span> 
                                                        <span>$<span id="totalCartDueToPay">0.00</span>
                                                        </span>
                                                    </h4>
                                            </button>
                                        </th>
                                        <th colspan="3" @if($userguideInit==1) data-step="12" data-intro="When you click Make Payment button then popup new payment screen to pay via customer credit card/other card or paypal or cash." @endif> 
                                                <button id="btn-payment-modal_init" type="button" class="btn btn-info checkDrawer bg-lighten-1 btn-responsive" data-toggle="modal" data-target="#payModal" ><h4 style="text-transform: capitalize !important;"><i class="icon-cash"></i> Make Payment</h4></button>      
                                            
                                        </th>
                                    </tr>   
                                    <tr>
                                        <th colspan="5">
                                            <label>
                                                <input type="checkbox" name="counterPay" id="counterPay" 
                                                @if(isset($cart->AllowCustomerPayBill)) 
                                                    @if($cart->AllowCustomerPayBill>0) 
                                                     checked="checked"   
                                                    @endif 
                                                @endif 
                                            >
                                            Allow Customer Pay  From Counter Display
                                            </label>
                                        </th>
                                    </tr>                                 
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                        <style type="text/css">
                            .select2-container--default .select2-selection--single .select2-selection__rendered
                            {
                                font-weight: bolder !important;
                                text-align: center !important;
                                font-size: 22px !important;
                            }
                        </style>

                        <div class="col-xs-12 button-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button2" @if($userguideInit==1) data-step="11" data-intro="Here you can select your customer. " @endif>
                                <div class="input-group">
                                    <select style="width: 100%;" class="select2 form-control" name="customer_id">
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
                             
                            <style type="text/css">
                                .dropdown-toggle::after
                                {
                                    top: -7px !important;
                                }
                            </style>
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button6 checkDrawer" @if($userguideInit==1) data-step="13" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
                                <button id="completesale" type="button" class="btn btn-info btn-accent-2 btn-responsive btn1">     
                                   <i class="icon-circle-check"></i>  COMPLETE SALE
                                </button>
                            </div>

                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button1 btn-group checkDrawer" @if($userguideInit==1) data-step="14" data-intro="After paid payment then click print invoice button and you print this invoice." @endif>
                                <button  type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info btn-accent-4 btn-responsive btn1  dropdown-toggle"><i class="icon-printer4"></i> PRINT INVOICE &nbsp;</button>      
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item printncompleteSale" data-id="pos" href="javascript:void(0);"><i class="icon-printer4"></i> Default Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item printncompleteSale"  data-id="thermal"  href="javascript:void(0);"><i class="icon-ios-printer-outline"></i> Thermal Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item printncompleteSale"  data-id="barcode" href="javascript:void(0);"><i class="icon-barcode2"></i> Barcode Print</a>
                                    </div>

                            </div>   

                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button6 checkDrawer" @if($userguideInit==1) data-step="15" data-intro="When you click clear POS button then clear the all POS screen." @endif>
                                <button id="clearsale" type="button" class="btn btn-info btn-lighten-2 btn-responsive btn1">     
                                   <i class="icon-circle-cross"></i> CLEAR POS
                                </button>
                            </div>
                            
                            <div class="col-xs-4 col-sm-3 col-md-4 col-lg-4 button button6" @if($userguideInit==1) data-step="16" data-intro="When you click change sales view button then redirect to add product for sale page." @endif>
                                <button id="changeSalesView" type="button" class="btn btn-info btn-responsive btn1">     
                                    <i class="icon-stack3"></i> Change Sales View
                                </button>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-8 col-lg-8 button button6" @if($userguideInit==1) data-step="17" data-intro="In this button you can start / turn off your counter display." @endif>
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
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button6" @if($userguideInit==1) data-step="18" data-intro="When you click add partial payment then popup new window." @endif>
                                <button  id="btn-payment-modal_init" type="button" class="btn btn-info btn-darken-2 btn-responsive btn1 addPartialPayment">     
                                    <i class="icon-dollar"></i> Add Partial Payment
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
           @include('apps.include.modal.stripeCardModal',compact('stripe'))
           @include('apps.include.modal.cardPointeCardModal')
           @include('apps.include.modal.cardPointepartialCardModal')
           @include('apps.include.modal.paymodal',compact('stripe'))
           @include('apps.include.modal.open-drawer')
           @include('apps.include.modal.close-drawer')
           @include('apps.include.modal.time_clock')
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

<script src="{{url('theme/app-assets/js/scripts/ui/scrollable.min.js')}}" type="text/javascript"></script>
<script>
//editRowLive
    //
    function liveRowCartEdit(rowID)
    {
        var rowData=$("#"+rowID).children("td:eq(1)").html();
        if($("#"+rowID).children("td:eq(1)").children("input").val())
        {

            console.log(rowData);
        }
        else
        {
            var rowDataPrice=$("#"+rowID).children("td:eq(2)").find("span").html();
            var inputDataQuantity='<input type="text" style="width:50px;" value="'+rowData+'" onkeyup="updateLiveCartQuantity('+rowID+')"  onchange="updateLiveCartQuantity('+rowID+')" />';
            var inputDataPrice='<input type="text"  style="width:50px;"  value="'+rowDataPrice+'" onkeyup="updateLiveCartQuantity('+rowID+')"  onchange="updateLiveCartQuantity('+rowID+')" />';
            $("#"+rowID).children("td:eq(1)").html(inputDataQuantity);
            $("#"+rowID).children("td:eq(2)").find("span").html(inputDataPrice);
            $("#"+rowID).children("td:eq(4)").children("a:eq(0)").show();


        }
        
    }

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

    var productJson=<?php echo json_encode($product); ?>; 

    function loadCartProBar()
    {
        console.log("Action Perform");
        var barcode=$("input[name=barcode]").val();
        console.log(barcode);
        //$('.barcode').click();
        //$('#ajaxCart').click();

        if(barcode.length==0)
        {
            // alert('Please Type a Barcode No.!!!');
            $("#cartMessageProShow").html(warningMessage("Please Type a Barcode No.!!!"));
            return false;
        }
        $("#cartMessageProShow").html(loadingOrProcessing("Product adding to cart, Please Wait....!!!!"));
        var productFound=0;
        $.each(productJson,function(rindex,row){
            if(row.barcode==barcode)
            {
                console.log(row); 
                $("#qty").val(1);
                $("#stoke").val(row.quantity);
                $("#price").val(row.price);
                $("#product_name").val(row.name);
                //$("#rate").val(row.cost);
                $("#imei").val(row.imei);
                $("#brand").val(row.brand_name);
                $("#model").val(row.model_name);
                $("#pro_id").val(row.id);
                productFound=1;
                add_pos_cart(row.id,row.price,row.name);
            }
        });

        $("input[name=barcode]").val("");
        $("input[name=barcode]").focus();

        if(productFound==0)
        {
            // alert('Please Type a Barcode No.!!!');
            $("#cartMessageProShow").html(warningMessage("Please Type a Correct Barcode No.!!!"));
            return false;
        }
    }
    
    function loadCatProduct(cid)
    {
        var cid=parseInt(cid);
        if(cid>0)
        {
            $("#product_place").html(loadingOrProcessing("Loading Please Wait....!!!!"));
            var proHtml='';
            var productBgIn=1;
            $.each(productJson,function(rindex,row){
                if(row.category_id==cid)
                {
                    var productName="'"+row.name+"'";
                    proHtml+='<div class="col-md-3">';
                        proHtml+='<a href="javascript:add_pos_cart('+row.id+','+row.price+','+productName+');" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">';
                            proHtml+='<div class="card-body collapse in">';
                                        
                                proHtml+='<div class="p-1 bg-info" style="padding: 0.7rem !important; border-top-right-radius:3px; border-top-left-radius: 3px;">';
                                    proHtml+='<p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left" style="color: #fff;">'+row.name+'</p>';          
                                proHtml+='</div>';
                            proHtml+='<div class="text-xs-right" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">'+row.price+'</div>';
                            proHtml+='</div>';    
                        proHtml+='</a>';
                    proHtml+='</div>';
                    console.log(row);
                }
            });
            $("#product_place").html(proHtml);

        }
        else
        {
            console.log("Invalid Category ID");
        }
    }

    function add_pos_cart(ProductID,ProductPrice,ProductName)
    {
            //alert(ProductName);
            $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
            var ProductID=parseInt(ProductID);
            if(ProductID<1)
            {
                $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again.")); 
                return false;
            }
            //var ProductPrice=$(this).attr('data-price');
            //var ProductName=$(this).html();
            @if(isset($ps))
            var taxRate="{{$ps->sales_tax}}";
            @else
            var taxRate=0;
            @endif


            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {

                    if($("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").children("input").length)
                    {
                         $("#cartMessageProShow").html(warningMessage("Failed, Product in edit mode.")); 
                         return false;
                    }
                    ProductPrice=parseFloat($("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html()).toFixed(2);
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td  ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a  href="javascript:editRowLive('+ProductID+');"  title="Edit" class="btn btn-sm btn-outline-info hiddenLiveSave" style="margin-right:2px;  display: none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a  href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info hiddenLiveSave" style="margin-right:2px;  display: none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();
            $("#cartMessageProShow").html(loadingOrProcessing("Adding To Cart, Please Wait...!!!!")); 
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
                    $("#cartMessageProShow").html(successMessage("Product Added To Cart Successfully.")); 
                    //console.log("Processing : "+data);
                }
            });
            //------------------------Ajax POS End---------------------------//

    }

    function cc_format(value) {
      var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
      var matches = v.match(/\d{4,16}/g);
      var match = matches && matches[0] || ''
      var parts = []
      for (i=0, len=match.length; i<len; i+=4) {
        parts.push(match.substring(i, i+4))
      }
      if (parts.length) {
        return parts.join(' ')
      } else {
        return value
      }
    }

    function defineCardNumPurify(num)
    {
        var resultnum = num.split('^');
        var resultNumLength=resultnum.length;
        console.log(resultnum);
        console.log(resultNumLength);
        if(resultNumLength>1)
        {
            var totalNumchar=resultnum[0];
            var perNumchar=totalNumchar.replace(/\D/g, '');

            var cliCardHName=resultnum[1];
            var arrcliCardHName=cliCardHName.split('/');
            var cliCardHNameLength=arrcliCardHName.length;
            
            var cardHolderName="";
            if(cliCardHNameLength==1)
            {
                cardHolderName=arrcliCardHName[0];
            }
            else
            {
                cardHolderName=$.trim(arrcliCardHName[1])+" "+$.trim(arrcliCardHName[0]);
            }

            var cliCardExYear=resultnum[2];
            var yearcliCard=cliCardExYear.substr(0,2);
            var monthcliCard=cliCardExYear.substr(2,2);

            var cardExpiredOn=monthcliCard+" / "+yearcliCard;

            $("#card-number-prototype").val(cc_format(perNumchar));
            $("#card-number").val(cc_format(perNumchar));
            $("#card-name").val(cardHolderName);
            $("#card-expiry").val(cardExpiredOn);
        }
        else
        {
            $("#card-number").val(cc_format(num));
        }
    }

    function readCardInfo()
    {
        var cardProtype=$("#card-number-prototype").val();
        console.log('Card Info - ',cardProtype);
        defineCardNumPurify(cardProtype);
        var changeEvent = new Event('keyup')
        document.getElementById('card-number').dispatchEvent(changeEvent);
        document.getElementById('card-name').dispatchEvent(changeEvent);
        document.getElementById('card-expiry').dispatchEvent(changeEvent);
        $("#card-number-prototype").val($("#card-number").val());
        return false;
    }

    $(document).ready(function() { 
        /*var checkTopcol=$("body").hasClass("menu-collapsed");
        if(checkTopcol==false)
        {
            $(".cash_register_collapse").click();
        }*/

        //D:\Workspace\server\htdocs\nucleusv4\public\theme\app-assets\vendors\js\forms\extended\card\jquery.card.js:

        $("#card-number-prototype").keyup(function(){
            console.log($(this).val());
            var num=$(this).val();
            $("#card-number").val(num);
            var changeEvent = new Event('keyup')
            document.getElementById('card-number').dispatchEvent(changeEvent);
        });

  
        $("body").addClass("page-sidebar-minimize menu-collapsed");
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
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
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
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
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

        $(".cardpointe_bolt_payment").click(function(){

           

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

            $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Please wait, checking bolt device.")+"<div>");

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                //$("#payModal").modal('hide');
                //$("#cardPointeCustomerCard").modal('show');

                //$(".cusStripeAm").html("$"+amount_to_pay);

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

                //$(".card-pay-due-amount").html(parseNewPayment);
               
                var pingDevice="{{url('bolt/ping')}}";
                $.ajax({
                    'async': true,
                    'type': "GET",
                    'global': false,
                    'dataType': 'json',
                    'url': pingDevice,
                    'success': function (data) {

                        console.log(data);
                        //return false;
                        if(data.connected==false){
                            $(".payModal-message-area").html("<div class='col-md-12'>"+warningMessage("Please connect your Bolt device with internet.")+"<div>");
                        }
                        else
                        {
                            ///Token Start
                            $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Generating new session-id for transaction.")+"<div>");

                            var boltTokenCaptureURL="{{url('bolt/token')}}";
                            $.ajax({
                                'async': true,
                                'type': "POST",
                                'global': false,
                                'dataType': 'json',
                                'url': boltTokenCaptureURL,
                                'data': {
                                    'amountToPay':parseNewPayment,
                                    '_token':"{{csrf_token()}}"},
                                'success': function (data) {
                                    console.log(data);

                                    if(data.connected==false){
                                        $(".payModal-message-area").html("<div class='col-md-12'>"+warningMessage("Please connect your Bolt device with internet.")+"<div>");
                                    }
                                    else
                                    {
                                        var tokenSession=data.token;
                                        ///Capture Card Start
                                        $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Please Swipe/Insert your card to device & wait for PIN.")+"<div>");
                                        var boltCaptureURL="{{url('bolt/capture')}}";
                                        $.ajax({
                                            'async': true,
                                            'type': "POST",
                                            'global': false,
                                            'dataType': 'json',
                                            'url': boltCaptureURL,
                                            'data': {
                                                'amountToPay':parseNewPayment,
                                                'cardsession':tokenSession,
                                                '_token':"{{csrf_token()}}"},
                                            'success': function (data) {


                                                console.log("cardPointe Bolt Print Sales ID : "+data);
                                                if(data==null)
                                                {
                                                    $(".payModal-message-area").html(warningMessage("Failed to authorize payment. Please try again."));
                                                }
                                                else
                                                {
                                                    console.log(data.status);
                                                    if(data.status==1)
                                                    {
                                                        var amount_to_pay=$("input[name=amount_to_pay]").val();
                                                        
                                                        var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                                                        if($.trim(expaid)==0)
                                                        {
                                                            var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                        }
                                                        else
                                                        {
                                                            var newpayment=(expaid-0)+(amount_to_pay-0);
                                                            var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                        }
                                                        genarateSalesTotalCart();
                                                        
                                                        var AddPOSUrl="{{url('sales/cart/payment')}}";
                                                        $.post(AddPOSUrl,{'paymentID':1,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                                                          
                                                        });
                                                        
                                                        $(".payModal-message-area").html(successMessage(data.message));
                                                        
                                                        setTimeout(function(){
                                                                $("#payModal").modal('hide');
                                                        }, 3000);

                                                        $("#cartMessageProShow").show();
                                                        $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                                                    }
                                                    else
                                                    {
                                                        $(".payModal-message-area").html(warningMessage(data.message));
                                                    }
                                                }
                                               
                                            }
                                        });

                                        ///Capture Card End

                                    }

                                }

                            });

                            // Token End
                            
                            
                        }

                        //console.log("cardPointe Bolt Print Sales ID : "+data);
                    }
                });



                //------------------------Ajax Customer End---------------------------//
                return false;

            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });


        //cardPointe start
        $(".cardpointe_card_payment").click(function(){

           $(".cardpointeButton").show();

            $(".cardPointe-cardnumber").val("");
            $(".cardPointe-cardholder").val("");
            $(".cardPointe-month option[value='']").prop("selected",true);
            $(".cardPointe-year option[value='']").prop("selected",true);
            $(".cardPointe-cvc").val("");

            $(".cardPointe-cardholder").focus();

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
                $("#cardPointeCustomerCard").modal('show');

                $(".cusStripeAm").html("$"+amount_to_pay);

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

        $("button.payCardPointe").click(function(){

            //console.log("WOrking");
            $(".cardpointeButton").hide();

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                $(".cardpointeButton").show();
                //$("#payModal").modal('hide');
                $(".hidestripemsg").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }



            var cardNumber=$.trim($(".cardPointe-cardnumber").val());
            if(cardNumber.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card number."));
                return false;
            }

            var cardHName=$.trim($(".cardPointe-cardholder").val());
            if(cardHName.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card holder name."));
                return false;
            }

            var cardMonth=$.trim($(".cardPointe-month").val());
            if(cardMonth.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card expire month."));
                return false;
            }


            var cardYear=$.trim($(".cardPointe-year").val());
            if(cardYear.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card expire Year."));
                return false;
            }


            var cardcvc=$.trim($(".cardPointe-cvc").val());
            if(cardcvc.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card cvc/cvc2 pin."));
                return false;
            }

            $(".hidestripemsg").show();
            $(".hidestripemsg").html(loadingOrProcessing("CardPointe payment please wait...."));



            var addCardPointePaymentURL="{{url('cardpointe/pos/payment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addCardPointePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
                    'cardMonth':cardMonth,
                    'cardYear':cardYear,
                    'cardcvc':cardcvc,
                    'amountToPay':parseNewPayment,
                    '_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("cardPointe Print Sales ID : "+data);
                    if(data==null)
                    {
                        $(".cardpointeButton").show();
                        $(".hidestripemsg").show();
                        $(".hidestripemsg").html(warningMessage("Failed to authorize payment. Please try again."));
                    }
                    else
                    {
                        console.log(data.status);
                        if(data.status==1)
                        {
                            var amount_to_pay=$("input[name=amount_to_pay]").val();
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            genarateSalesTotalCart();
                            //------------------------Ajax POS Start-------------------------//
                            var AddPOSUrl="{{url('sales/cart/payment')}}";
                            $.post(AddPOSUrl,{'paymentID':1,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                               // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
                            });
                            //------------------------Ajax POS End---------------------------//
                            $(".hidestripemsg").show();
                            $(".hidestripemsg").html(successMessage(data.message));
                            
                            setTimeout(function(){
                                    $("#cardPointeCustomerCard").modal('hide');
                            }, 3000);

                            $("#cartMessageProShow").show();
                            $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                        }
                        else
                        {
                            $(".hidestripemsg").show();
                            $(".cardpointeButton").show();
                            $(".hidestripemsg").html(warningMessage(data.message));
                        }
                    }
                    //$(".message-place-authorizenet").html("dddd");
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });
        //cardPointe end


        //stripe start
        $(".stripe_card_payment").click(function(){


            var stripepartialURL="{{url('stripe')}}";

            $("#payment-form-stripe").attr("action",stripepartialURL);
            $("#partial_invoice_id").val(0);
            $("#partial_today_paid").val(0);

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
                $("#stripeCustomerCard").modal('show');

                $(".cusStripeAm").html("$"+amount_to_pay);

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

        $(".card-pay-stripe").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
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
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
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
        //stripe end



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
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
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

        $("#clearsale").click(function(){
            var c=confirm("Are you sure to clear the POS screen?");
            if(c)
            {
                var clposLink="{{url('pos/clear')}}";
                window.location.href=clposLink;
            }
        });

        $("#completesale").click(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }

            var expaid;
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
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
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
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
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td  ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td  ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info hiddenLiveSave" style="margin-right:2px; display:none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td>$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info hiddenLiveSave" style="margin-right:2px; display:none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

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
                    console.log("Processing : "+data);
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
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td>$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

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

        var unitPrice=$("#dataCart tr[id="+id+"]").children("td:eq(2)").find("span").children("input").val();
        var edit_quantity=$("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val();
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price",unitPrice);
        if($.isNumeric(edit_quantity))
        {
            if(edit_quantity>=0)
            {
                var totalPrice=unitPrice*edit_quantity;    
            }
            else
            {
                edit_quantity=0;
                
                var totalPrice=unitPrice*edit_quantity;    
                $("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val(edit_quantity);
            }
        }
        else
        {
            edit_quantity=0;
            //$("input[name=edit_quantity]").val(edit_quantity);
            $("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val(edit_quantity);
            var totalPrice=unitPrice*edit_quantity;    
        }
        
        var taxAmount=parseFloat((totalPrice*taxRate)/100).toFixed(2);
        $("#dataCart tr[id="+id+"]").children("td:eq(2)").find("span").html(unitPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(1)").html(edit_quantity);
        $("#dataCart tr[id="+id+"]").find("td:eq(3)").children("span").html(totalPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-tax",taxAmount);
        genarateSalesTotalCart();
        //need to incorporate witth ajax

        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl="{{url('sales/cart/custom/add')}}/"+id+"/"+edit_quantity+"/"+unitPrice;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                //tmp = data;
                console.log("Live Edit Processing : "+data);
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


            var expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(3)").children("span").html();
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
            var newPriceTotal=parseFloat(sumPriceTotal).toFixed(2);
            var newDiscount=parseFloat(calcDisc).toFixed(2);
            var newsubTotalPrice=parseFloat(subTotalPrice).toFixed(2);
            var newTotalTax=parseFloat(TotalTax).toFixed(2);

            if(newdues<0){ newdues="0.00"; }
            else if(newdues=="-0.00"){ newdues="0.00"; }



            $("#posCartSummary tr:eq(2)").find("th").children("span").html(discount+"%");

            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html(newsubTotalPrice);
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html(newTotalTax);
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html(newDiscount);
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html(newPriceTotal);
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(paid);
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html(newdues);

            $("input[name=amount_to_pay]").val(newdues);
            console.log($("input[name=amount_to_pay]").val());
            $("#prmDue").html(newdues);
            $("#totalCartDueToPay").html(newdues);
        }
        else
        {
            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("th").children("span").html("0%");
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html("0.00");
            $("input[name=amount_to_pay]").val("0.00");
            $("#prmDue").html("0.00");
            $("#totalCartDueToPay").html("0.00");
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
@include('apps.include.json.pospaymentpartial',compact('addPartialPayment'))
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

