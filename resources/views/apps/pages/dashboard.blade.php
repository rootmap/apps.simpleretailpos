@extends('apps.layout.master')
@section('title','Dashboard')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-xs-12">
	        <div class="card">
	            <div class="card-body">
	                <div class="card-block">
	                    <div class="row">
	                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
	                            <div class="media px-1">
	                                <div class="media-left media-middle">
	                                    <i class="icon-box font-large-1 blue-grey"></i>
	                                </div>
	                                <div class="media-body text-xs-right">
	                                    <span class="font-large-2 text-bold-300 info">5,879</span>
	                                </div>
	                                <p class="text-muted">Total Products <span class="info float-xs-right"><i class="icon-arrow-up4 info"></i> 16.89%</span></p>
	                                <progress class="progress progress-sm progress-info" value="80" max="100"></progress>
	                            </div>
	                        </div>
	                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
	                            <div class="media px-1">
	                                <div class="media-left media-middle">
	                                    <i class="icon-tag3 font-large-1 blue-grey"></i>
	                                </div>
	                                <div class="media-body text-xs-right">
	                                    <span class="font-large-2 text-bold-300 deep-orange">423</span>
	                                </div>
	                                <p class="text-muted">New Orders<span class="deep-orange float-xs-right"><i class="icon-arrow-up4 deep-orange"></i> 5.14%</span></p>
	                                <progress class="progress progress-sm progress-deep-orange" value="45" max="100"></progress>
	                            </div>
	                        </div>
	                        <div class="col-xl-3 col-lg-6 col-sm-12 border-right-blue-grey border-right-lighten-5">
	                            <div class="media px-1">
	                                <div class="media-left media-middle">
	                                    <i class="icon-shuffle3 font-large-1 blue-grey"></i>
	                                </div>
	                                <div class="media-body text-xs-right">
	                                    <span class="font-large-2 text-bold-300 danger">61%</span>
	                                </div>
	                                <p class="text-muted">Conversion Rate<span class="danger float-xs-right"><i class="icon-arrow-down4 danger"></i> 2.24%</span></p>
	                                <progress class="progress progress-sm progress-danger" value="75" max="100"></progress>
	                            </div>
	                        </div>
	                        <div class="col-xl-3 col-lg-6 col-sm-12">
	                            <div class="media px-1">
	                                <div class="media-left media-middle">
	                                    <i class="icon-dollar font-large-1 blue-grey"></i>
	                                </div>
	                                <div class="media-body text-xs-right">
	                                    <span class="font-large-2 text-bold-300 success">$6,87M</span>
	                                </div>
	                                <p class="text-muted">Total Profit<span class="success float-xs-right"><i class="icon-arrow-up4 success"></i> 43.84%</span></p>
	                                <progress class="progress progress-sm progress-success" value="60" max="100"></progress>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>	
	</div>
	<div class="row">
    <div class="col-xs-12">
        <div class="card box-shadow-0">
            <div class="card-body collapse in">
                <div class="row">
                    <div class="col-xl-8 col-lg-12">
				        <div class="card">
				            <div class="card-body">
				                <div class="card-block text-xs-center">
				                    <div class="card-header mb-2">
				                        <span class="success darken-1">Total Budget</span>
				                        <h3 class="font-large-2 grey darken-1 text-bold-200">$24,879</h3>
				                    </div>
				                    <div class="card-body">
				                        <div style="display:inline;width:150px;height:150px;"><canvas width="150" height="150"></canvas><input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleoffset="0" data-thickness=".15" data-linecap="round" data-width="150" data-height="150" data-inputcolor="#e1e1e1" data-readonly="true" data-fgcolor="#37BC9B" data-knob-icon="icon-dollar" readonly="readonly" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -114px; display: none;"><i class="knob-center-icon icon-dollar" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(225, 225, 225); padding: 0px; -webkit-appearance: none; margin-left: -114px;font-size: 50px;"></i></div>
				                        <ul class="list-inline clearfix mt-2 mb-0">
				                            <li class="border-right-grey border-right-lighten-2 pr-2">
				                                <h2 class="grey darken-1 text-bold-400">75%</h2>
				                                <span class="success">Completed</span>
				                            </li>
				                            <li class="pl-2">
				                                <h2 class="grey darken-1 text-bold-400">25%</h2>
				                                <span class="danger">Remaining</span>
				                            </li>
				                        </ul>
				                    </div>
				                </div>
				            </div>
					    </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card-block">
                            <h4 class="card-title py-1 text-xs-center">Sales All Over The World</h4>
                            <div class="row">
                                <div class="col-xl-12 col-lg-4 col-sm-12">
                                    <div class="media">
                                        <div class="media-body">
                                            <span>Total Profit <i class="icon-arrow-up4 success"></i> <span class="teal accent-3">6.89%</span></span>
                                            <h2 class="mb-0">$47.8K</h2>
                                        </div>
                                        <div class="media-right media-top pr-2">
                                            <i class="icon-dollar font-large-1"></i>
                                        </div>
                                    </div>
                                    <div id="map-total-profit" class="height-75" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="75" version="1.1" width="263" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.9375px; top: -0.1875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#1de9b6" d="M25,32.5L55.41666666666667,35L85.83333333333334,45L116.25,33.75L146.75,41.25L177.16666666666669,32.5L207.58333333333334,40L238,25" stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="25" cy="32.5" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="55.41666666666667" cy="35" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="85.83333333333334" cy="45" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="116.25" cy="33.75" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="146.75" cy="41.25" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="177.16666666666669" cy="32.5" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="207.58333333333334" cy="40" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="238" cy="25" r="4" fill="#ffffff" stroke="#1de9b6" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
                                </div>
                                <div class="col-xl-12 col-lg-4 col-sm-12">
                                    <div class="media">
                                        <div class="media-body">
                                            <span>Total Orders <i class="icon-arrow-down4 deep-orange accent-3"></i> <span class="deep-orange accent-3">4.27%</span></span>
                                            <h2 class="mb-0">789</h2>
                                        </div>
                                        <div class="media-right media-top pr-2">
                                            <i class="icon-cart font-large-1"></i>
                                        </div>
                                    </div>
                                    <div id="map-total-orders" class="height-75" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="75" version="1.1" width="263" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.9375px; top: -0.1875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#ff6e40" d="M25,32.5L55.41666666666667,35L85.83333333333334,45L116.25,33.75L146.75,38.75L177.16666666666669,32.5L207.58333333333334,35L238,25" stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="25" cy="32.5" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="55.41666666666667" cy="35" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="85.83333333333334" cy="45" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="116.25" cy="33.75" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="146.75" cy="38.75" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="177.16666666666669" cy="32.5" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="207.58333333333334" cy="35" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="238" cy="25" r="4" fill="#ffffff" stroke="#ff6e40" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 189px; top: 6px; display: none;"><div class="morris-hover-row-label">8</div><div class="morris-hover-point" style="color: #FF6E40">
  Likes:
  20
</div></div></div>
                                </div>
                                <div class="col-xl-12 col-lg-4 col-sm-12">
                                    <div class="sales pr-2">
                                        <div class="sales-today mb-1">
                                            <p class="m-0">Today <span class="sucess float-xs-right"><i class="icon-arrow-up4 success"></i> 6.89%</span></p>
                                            <progress class="progress progress-sm progress-success progress-accent-3 mb-0" value="70" max="100"></progress>
                                        </div>
                                        <div class="sales-yesterday">
                                            <p class="m-0">Yesterday <span class="deep-orange accent-2 float-xs-right"><i class="icon-arrow-down4 deep-orange accent-3"></i> 4.18%</span></p>
                                            <progress class="progress progress-sm progress-deep-orange progress-accent-2 mb-0" value="60" max="100"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	


</section>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/charts/morris.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/unslider.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/weather-icons/climacons.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/calendars/clndr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/colors/palette-climacon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/users.min.css')}}">
@endsection

@section('js')
 <!-- BEGIN PAGE VENDOR JS-->
<script src="{{url('theme/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/extensions/moment.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/extensions/underscore-min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/extensions/clndr.min.js')}}" type="text/javascript"></script>
<!-- <script src="{{url('theme/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script> -->
<script src="{{url('theme/app-assets/vendors/js/extensions/unslider-min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
    <!-- BEGIN PAGE LEVEL JS-->
<script src="{{url('theme/app-assets/js/scripts/pages/dashboard-project.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->


<script src="{{url('theme/app-assets/vendors/js/extensions/jquery.knob.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/chartist-plugin-tooltip.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/charts/jquery.sparkline.min.js')}}" type="text/javascript"></script>
@endsection