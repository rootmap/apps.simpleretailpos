@extends('apps.layout.master')
@section('title','Dashboard Demo')
@section('content')
    <!-- main menu-->


<div class="row">



    <div class="col-xl-4 col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-block text-xs-center">
                    <div class="card-header mb-2">
                        <span class="success darken-1">Total Invoice / Sales Amount</span>
                        <h3 class="font-large-2 grey darken-1 text-bold-400" style="font-size: 30px !important;">$ww</h3>
                    </div>
                    <div class="card-body">
                        <input type="text" value="75" class="knob hide-value responsive angle-offset" data-angleOffset="0" data-thickness=".15" data-linecap="round" data-width="150" data-height="150" data-inputColor="#e1e1e1" data-readOnly="true" data-fgColor="#37BC9B" data-knob-icon="icon-dollar">
                        <ul class="list-inline clearfix mt-2 mb-0">
                            <li class="border-right-grey border-right-lighten-2 pr-2">
                                <h2 class="grey darken-1 text-bold-400">$2222</h2>
                                <span class="success">Total Cost</span>
                            </li>
                            <li class="pl-2">
                                <h2 class="grey darken-1 text-bold-400">$22</h2>
                                <span class="danger">Total Profit</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-12">
        <div class="card">
            <div class="card-body collapse in">
                <div class="card-block">
                    <div id="pie-chart"></div>
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
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/charts/c3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/charts/c3-chart.min.css')}}">
@endsection

@section('js')
     <!-- build:js app-assets/js/vendors.min.js-->
    <!-- /build-->
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
                    pattern: ["#99B898", "#FECEA8", "#FF847C"]
                },
                data: {
                    columns: [
                        ["data1", 30],
                        ["data2", 120]
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