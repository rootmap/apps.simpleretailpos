@extends('apps.layout.master')
@section('title','Dashboard')
@section('content')
    <!-- main menu-->
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>

<!-- fitness target -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card-header mb-2 pt-0">
                                <span class="info">Product</span>
                                <h3 class="font-large-2 text-bold-200">{{$dash->product_item_quantity}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleOffset="40" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#00BCD4" data-knob-icon="icon-mobile">
                                <ul class="list-inline clearfix mt-1 mb-0">
                                    <li>
                                        <h2 class="grey darken-1 text-bold-400">{{$tod->product_item_quantity}}</h2>
                                        <span class="info">Today Added In System</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1 text-xs-center">
                            <div class="card-header mb-2 pt-0">
                                <span class="deep-orange">Stock In</span>
                                <h3 class="font-large-2 text-bold-200">{{$dash->stockin_invoice_quantity}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="text" value="70" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#FF5722" data-knob-icon="icon-truck3">
                                <ul class="list-inline clearfix mt-1 mb-0">
                                    <li>
                                        <h2 class="grey darken-1 text-bold-400">{{$tod->stockin_invoice_quantity}}</h2>
                                        <span class="deep-orange">Today Stock In</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1 text-xs-center">
                            <div class="card-header mb-2 pt-0">
                                <span class="success">Customer</span>
                                <h3 class="font-large-2 text-bold-200">{{$dash->customer_quantity}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="text" value="81" class="knob hide-value responsive angle-offset" data-angleOffset="20" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#009688" data-knob-icon="icon-users">
                                <ul class="list-inline clearfix mt-1 mb-0">
                                    <li>
                                        <h2 class="grey darken-1 text-bold-400">{{$tod->customer_quantity}}</h2>
                                        <span class="success">Today Added in System</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="my-1 text-xs-center">
                            <div class="card-header mb-2 pt-0">
                                <span class="danger">Warranty</span>
                                <h3 class="font-large-2 text-bold-200">{{$dash->warranty_invoice_quantity}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleOffset="20" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#DA4453" data-knob-icon="icon-page-break">
                                <ul class="list-inline clearfix mt-1 mb-0">
                                    <li>
                                        <h2 class="grey darken-1 text-bold-400">{{$tod->warranty_invoice_quantity}}</h2>
                                        <span class="danger">Today Provide Warranty</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ fitness target -->

<!-- friends & weather charts -->
<div class="row match-height">
    
    
</div>
<!-- friends & weather charts -->

<div class="row">



    <div class="col-xl-4 col-lg-6 col-md-12">
        <div class="card" style="padding-bottom: 10px;">
            <div class="card-body">
                <div class="card-block text-xs-center">
                    <div class="card-header mb-2">
                        <span class="success darken-1">Total Invoice / Sales Amount</span>
                        <h3 class="font-large-2 grey darken-1 text-bold-400" style="font-size: 30px !important;">${{$dash->sales_amount}}</h3>
                    </div>
                    <div class="card-body">
                        <input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="150" data-height="150" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#37BC9B" data-knob-icon="icon-dollar">
                        <ul class="list-inline clearfix mt-2 mb-0">
                            <li class="border-right-grey border-right-lighten-2 pr-2">
                                <h2 class="grey darken-1 text-bold-400">${{$dash->sales_cost}}</h2>
                                <span class="success">Total Cost</span>
                            </li>
                            <li class="pl-2">
                                <h2 class="grey darken-1 text-bold-400">${{$dash->sales_profit}}</h2>
                                <span class="danger">Total Profit</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
    	.list-group-item
    	{
    		    padding: 0.90rem 1.25rem !important;
    	}
    </style>

    <div class="col-xl-4 col-lg-6 col-md-12">
        {{-- <div class="card bg-info">
            <div class="card-body">
                <div class="card-block">
                    <h4 class="card-title">Product Sold Heighest Time</h4>
                    <p class="card-text">[{{count($product)}}] Products Showing out of [{{$dash->product_item_quantity}}].</p>
                </div>
                <ul class="list-group list-group-flush">
                    @if(isset($product))
                        @foreach($product as $pro)
                            <li class="list-group-item">
                                <span class="tag tag-default tag-pill bg-primary float-xs-right">{{$pro->sold_times}}</span> {{$pro->name}}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div> --}}
        <div class="card" style="padding-bottom: 10px;">
            <div class="card-body collapse in" style="padding-top: 30px;">
                <div class="card-block">
                    <div id="pie-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="success">${{$tod->sales_amount}}</h3>
                            <span>Today Total Sales</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-cart4 success font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                    <progress class="progress progress-sm progress-success mt-1 mb-0" value="80" max="100"></progress>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="deep-orange">${{$tod->sales_cost}}</h3>
                            <span>Today Total Cost</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-shop2 deep-orange font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                    <progress class="progress progress-sm progress-deep-orange mt-1 mb-0" value="35" max="100"></progress>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-body text-xs-left">
                            <h3 class="info">${{$tod->sales_profit}}</h3>
                            <span>Today Total Profit</span>
                        </div>
                        <div class="media-right media-middle">
                            <i class="icon-banknote info font-large-2 float-xs-right"></i>
                        </div>
                    </div>
                    <progress class="progress progress-sm progress-info mt-1 mb-0" value="35" max="100"></progress>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .mini-stat-type-2 {
        position: relative;
        background-color: #FBFBFB;
        padding: 10px;
        margin-bottom: 20px;
    }

    .quick_link_box2 {
        background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , #ffffff 0%, #f4f4f4 100%) repeat scroll 0 0 !important;
        border-radius: 0px !important;
        -webkit-box-shadow: 0px 0px 1px 0px rgba(0,0,0,0.5) !important;
        -moz-box-shadow: 0px 0px 1px 0px rgba(0,0,0,0.5) !important;
        box-shadow: 0px 0px 1px 0px rgba(0,0,0,0.5) !important;
    }

    .td_none {
        text-decoration: none !important;
        color: #0c0c0c;
    }
    .td_none:hover {
        text-decoration: none !important;
        color: #0c0c0c;
        font-weight: bolder;
    }

    .overview-icon {
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        height: 50px;
        width: 50px;
        text-align: center;
        display: block;
        content: "";
        line-height: 50px;
        font-size: 30px;
        margin: 15px auto;
    }

    .slow-spin {
      -webkit-animation: fa-spin 6s infinite linear;
      animation: fa-spin 6s infinite linear;
    }

    .overview-icon > i
    {
        color: #fff;
    }
</style>


@if(in_array('dashboard_other_report', $dataMenuAssigned))
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header card-warning">
                <h4 class="card-title" style="color: #fff;"><i class="icon-stats-dots"></i> Other Reports</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i style="color: #fff;" class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2" style="color: #fff;"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in" style="padding-top: 20px;">


                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('profit/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Invoice Profit</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-info"><i class="icon-credit-card icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('payment/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Payment Report</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-bitbucket"><i class="icon-undo icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('customer/list')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Customer Report</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-danger"><i class="icon-bar-chart icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('product/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Product Status</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-soundcloud"><i class="icon-pie-chart icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('sales/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Sales Report</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-success"><i class="icon-bar-chart icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('product/stock/in/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Stockin Order</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-pink"><i class="icon-line-chart icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('paypal/payment/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Paypal Payment</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-green"><i class="icon-paypal icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('product/profit/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Product Profit</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-teal"><i class="icon-desktop icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('expense/voucher/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Expense Report</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-twitter"><i class="icon-money icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('authorize/net/payment/history')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Card Payment</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-amber"><i class="icon-dollar icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('variance/report')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Variance Report</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-deep-orange"><i class="icon-shopping-cart icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>

               

                <div class="col-md-2 col-xs-4 col-xs-override">
                    <a href="{{url('sales/return/list')}}" class="td_none">
                        <div class="mini-stat-type-2 shadow quick_link_box2">
                            <h6 class="text-xs-center text-strong text-inverse">Sales Return</h6>
                            <p class="text-xs-center">
                                <span class="overview-icon bg-indigo"><i class="icon-exchange icon-spin"></i></span>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="clearfix"></div>
                <br>
            </div>
        </div>
    </div>
</div>
@endif



@if(in_array('dashboard_today_cashier_punch_log', $dataMenuAssigned))
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header card-success" style="color: #fff;">
                <h4 class="card-title"><i class="icon-clock-o"></i> Today Cashier Punch Log</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4" style="color: #fff;"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2" style="color: #fff;"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead class="bg-success" style="color: #fff;">
                            <tr>
                                <th>SL</th>
                                <th>Cashier Name</th>
                                <th>Date IN</th>
                                <th>Time IN</th>
                                <th>Date Out</th>
                                <th>Time Out</th>
                                <th>Elapsed Time(H:M:S)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($cashier_punch))
                                @foreach($cashier_punch as $index=>$row)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->in_date}}</td>
                                    <td>{{$row->in_time}}</td>
                                    <td>{{$row->out_date}}</td>
                                    <td>{{$row->out_time}}</td>
                                    <td>{{$row->elsp}}</td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end --> 
@endif

@if(in_array('dashboard_recent_system_access_log', $dataMenuAssigned))
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header card-danger" style="color: #fff;">
                <h4 class="card-title"><i class="icon-history"></i> Recent System Access Log</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4" style="color: #fff;"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2" style="color: #fff;"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead class="bg-danger" style="color: #fff;">
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Date &amp; Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($loginactivity))
                            @foreach($loginactivity as $index=>$row)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->activity}}</td>
                                <td>{{$row->created_at}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Both borders end -->
@endsection

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/unslider.css')}}">

    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/colors/palette-climacon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/users.min.css')}}">
    <!-- END Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/charts/c3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/charts/c3-chart.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <style type="text/css">
        div.dataTables_length{
                padding-left: 10px;
                padding-top: 15px;
        }

        .dataTables_length>label{
            margin-bottom: 0px !important;
            display:block; !important;
        }

        div.dataTables_filter
        {
            padding-right: 10px;
        }

        div.dataTables_info{
            padding-left: 10px;
        }

        div.dataTables_paginate{
            padding-right: 10px;
            padding-top: 5px;
        }
    </style>
@endsection

@section('js')
     <!-- build:js app-assets/js/vendors.min.js-->
    <!-- /build-->
    <script src="{{url('theme/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('theme/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{url('theme/app-assets/vendors/js/charts/d3.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/c3.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="js/pie.js" type="text/javascript"></script> --}}
    <script type="text/javascript">
        $(window).on("load", function() {
            var pieChart = c3.generate({
                bindto: "#pie-chart",
                color: {
                    pattern: [
                                "#99B898", 
                                "#FECEA8", 
                                "#FF847C",
                                "#DC143C",
                                "#00FFFF",
                                "#00008B",
                                "#008B8B",
                                "#B8860B"
                            ]
                },
                data: {
                    columns: [
                        @if(isset($product))
                            @foreach($product as $pro)
                                ["{{$pro->name}}", {{$pro->sold_times}}],
                            @endforeach
                        @endif
                    ],
                    type: "pie",
                    onclick: function(d, i) {},
                    onmouseover: function(d, i) {},
                    onmouseout: function(d, i) {}
                }
            });
            
        });
    </script>
    
    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    
    <script src="{{url('theme/app-assets/vendors/js/charts/gmaps.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/extensions/jquery.knob.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>

    <script src="{{url('theme/app-assets/vendors/js/extensions/unslider-min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
        <script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/data/jvector/visitor-data.js')}}" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->

    <script src="{{url('theme/app-assets/js/scripts/pages/dashboard-crm.min.js')}}" type="text/javascript"></script>

@endsection