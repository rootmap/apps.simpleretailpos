@extends('apps.layout.master')
@section('title','Dashboard Demo')
@section('content')
    <!-- main menu-->


<!-- fitness target -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1 text-xs-center">
                            <div class="card-header mb-2 pt-0">
                                <span class="info">Product</span>
                                <h3 class="font-large-2 text-bold-200">{{$dash->product_item_quantity}}</h3>
                            </div>
                            <div class="card-body">
                                <input type="text" value="65" class="knob hide-value responsive angle-offset" data-angleOffset="40" data-thickness=".15" data-linecap="round" data-width="130" data-height="130" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#00BCD4" data-knob-icon="icon-mobile">
                                <ul class="list-inline clearfix mt-1 mb-0">
                                    <li>
                                        <h2 class="grey darken-1 text-bold-400">{{$tod->product_item_quantity}}</h2>
                                        <span class="deep-orange">Today Added In System</span>
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
        <div class="card">
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
        <div class="card bg-info">
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


@endsection

@section('css')
    
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/unslider.css')}}">

    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/colors/palette-climacon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/users.min.css')}}">
    <!-- END Page Level CSS-->
@endsection

@section('js')
     <!-- build:js app-assets/js/vendors.min.js-->
    <!-- /build-->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBDkKetQwosod2SZ7ZGCpxuJdxY3kxo5Po" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/gmaps.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/extensions/jquery.knob.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/extensions/unslider-min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
        <script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/data/jvector/visitor-data.js')}}" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('theme/app-assets/js/scripts/pages/dashboard-fitness.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/scripts/pages/dashboard-crm.min.js')}}" type="text/javascript"></script>

@endsection