@extends('apps.layout.master')
@section('title','Analytical Dashboard')
@section('content')
    <!-- main menu-->
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
    $userguideInit=StaticDataController::userguideInit();
?>

<!-- fitness target -->
<div class="row">
    
    <div class="col-xs-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1 text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Sales VS Expense</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="inventory_non_inventory_repair_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="inventory_non_inventory_repair"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Sales VS Return</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="sales_and_buyback_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="sales_and_buyback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-xl-12 col-lg-12 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Sales VS Profit</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="sales_vs_profit_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="sales_vs_profit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    
                    <div class="col-xl-6 col-lg-6 col-md-6 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Top Populer Products</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="top_five_products_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="top_five_products"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Today Sales Total & Current Inventory Stock</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="top_five_products_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-top: 100px; text-align:center;">
                                    <div id="daily_sale_and_product_inventory"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title text-xs-center">Highest Sales Interaction By</h5>
                                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="expand" id="top_five_products_expand"><i class="icon-expand2"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="cashier_sales_interaction_by_product" style="height: 600px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-12 col-lg-12 col-md-12 border-right-blue-grey border-right-lighten-5">
                        <div class="my-1  text-xs-center">
                            <div class="card-body">
                                <div id="employeeTree" style="height: 600px;"></div>
                            </div>
                        </div>
                    </div> --}}
                    
                </div>
        </div>
    </div>
    
</div>
<!--/ fitness target -->

<!-- friends & weather charts -->
<div class="row match-height">
    
    
</div>
<!-- friends & weather charts -->
<!-- Both borders end -->
@endsection

@section('css')
   
@endsection

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(inventory_non_inventory_repair);
        function inventory_non_inventory_repair() {
            var jsonData = $.ajax({
            url: "{{secure_url('analytical/profitvsexpense/json')}}",
            dataType:"json",
            async: false
            }).responseText;
            var data = google.visualization.arrayToDataTable(jQuery.parseJSON(jsonData));
            var options = {
                title: 'Profit VS Expense',
                chartArea: {width: '40%'},
                colors: ['#b0120a', '#ffab91'],

            };

            var chart = new google.visualization.BarChart(document.getElementById('inventory_non_inventory_repair'));
            chart.draw(data, options);
            $("#inventory_non_inventory_repair_expand").click(function(){
                var options = {
                    title: 'Profit VS Expense',
                    chartArea: {width: '60%'},
                    colors: ['#b0120a', '#ffab91'],

                };
                var chart = new google.visualization.BarChart(document.getElementById('inventory_non_inventory_repair'));
                chart.draw(data, options);
            });
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(sales_and_buyback);

        function sales_and_buyback() {
            // Some raw data (not necessarily accurate)
            var jsonData = $.ajax({
            url: "{{secure_url('analytical/salesvsreturn/json')}}",
            dataType:"json",
            async: false
            }).responseText;

            var data = google.visualization.arrayToDataTable(jQuery.parseJSON(jsonData));
            // var data = google.visualization.arrayToDataTable([
            // ['Date', 'Sales', 'Buyback'],
            // ['2020-06-01', 8175000, 8008000],
            // ['2020-06-02', 3792000, 3694000],
            // ['2020-06-03', 2695000, 2896000],
            // ['2020-06-04', 2099000, 1953000],
            // ['2020-06-05', 1526000, 1517000]
            // ]);

            var options = {
            title : 'Sales VS Return',
            seriesType: 'bars',
            series: {5: {type: 'line'}}        };
            var chart = new google.visualization.ComboChart(document.getElementById('sales_and_buyback'));
            chart.draw(data, options);
            $("#sales_and_buyback_expand").click(function(){
                var options = {
                title : 'Sales VS Return',
                seriesType: 'bars',
                chartArea: {width: '60%'},
                series: {5: {type: 'line'}}        };
                var chart = new google.visualization.ComboChart(document.getElementById('sales_and_buyback'));
                chart.draw(data, options);
            });
            //sales_and_buyback_expand
        }

        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(sales_vs_profit);
        function sales_vs_profit() {

            var jsonData = $.ajax({
            url: "{{secure_url('analytical/salesvsprofit/json')}}",
            dataType:"json",
            async: false
            }).responseText;

            var data = new google.visualization.arrayToDataTable(jQuery.parseJSON(jsonData));
            // var data = new google.visualization.arrayToDataTable([
            //     ['daily', 'Sales','Profit'],
            //     ['2020-06-01',0,0],
            //     ['2020-06-02', 2,0.1],
            //     ['2020-06-03', 5,2.34],
            //     ['2020-06-04', 3,3.56],
            //     ['2020-06-05', 4,2.22],
            //     ['2020-06-06', 8,6.54],
            //     ['2020-06-07', 2,0.23],
            //     ['2020-06-08', 5,1.23]
            // ]);

            var options = {
                title: 'Sales VS Profit',
            };

            var chart = new google.visualization.LineChart(document.getElementById('sales_vs_profit'));
            chart.draw(data, options);

            $("#sales_vs_profit_expand").click(function(){
                var options = {
                    title: 'Sales VS Profit',
                    chartArea: {width: '80%'},
                };

                var chart = new google.visualization.LineChart(document.getElementById('sales_vs_profit'));
                chart.draw(data, options);
            });
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(cashier_sales_interaction_by_product);

        function cashier_sales_interaction_by_product() {
            var jsonData = $.ajax({
            url: "{{secure_url('analytical/top/cashier/products/json')}}",
            dataType:"json",
            async: false
            }).responseText;

            var data = google.visualization.arrayToDataTable(jQuery.parseJSON(jsonData));

            // var data = google.visualization.arrayToDataTable([
            // ['Task', 'Sales Invoice Quantity'],
            // ['Fahad - 11 Product',     11],
            // ['Fakhrul - 2 Product',      2],
            // ['Justin Dabish - 2 Product',  2],
            // ['Ruhi - 2 Product', 2],
            // ['Monmon - 7 Product',    7]
            // ]);

            var options = {
                @if(Auth::user()->user_type==1)
                    title: 'Cashier Sales Interaction By Product | Admin will see all store without date filter but individual store will have only daily data'
                @else
                    title: 'Today Cashier Sales Interaction By Product'
                @endif
            };

            var chart = new google.visualization.PieChart(document.getElementById('cashier_sales_interaction_by_product'));

            chart.draw(data, options);
        }

        
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var jsonData = $.ajax({
            url: "{{secure_url('analytical/topproducts/json')}}",
            dataType:"json",
            async: false
            }).responseText;

            var data = google.visualization.arrayToDataTable(jQuery.parseJSON(jsonData));
            // var data = google.visualization.arrayToDataTable([
            //     ["Element", "Density", { role: "style" } ],
            //     ["Copper", 8.94, "#b87333"],
            //     ["Silver", 10.49, "silver"],
            //     ["Gold", 19.30, "gold"],
            //     ["Platinum", 21.45, "color: #e5e4e2"]
            // ]);

            var view = new google.visualization.DataView(data);
            data.addColumn('number', 'Sales');
            view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options = {
                title: "Top 10 Populer Products",
                bar: {groupWidth: "65%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("top_five_products"));
            chart.draw(view, options);

            $("#top_five_products_expand").click(function(){
                var options = {
                    title: "Top 10 Populer Products",
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('top_five_products'));
                chart.draw(data, options);
            });
        }

        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawGauge);

        var gaugeOptions = {min: 0, max: 10000, yellowFrom: 7500, yellowTo: 8500,
        redFrom: 8500, redTo: 10000, minorTicks: 5};
        var gauge;

        function drawGauge() {

            var jsonData = $.ajax({
            url: "{{secure_url('analytical/salesninventory/json')}}",
            dataType:"json",
            async: false
            }).responseText;
            console.log(jsonData);

            var soldnproduct = jQuery.parseJSON(jsonData);

            gaugeData = new google.visualization.DataTable();
            gaugeData.addColumn('number', 'Today Sales');
            gaugeData.addColumn('number', 'Total Inventory');
            gaugeData.addRows(2);
            gaugeData.setCell(0, 0, soldnproduct.sold);
            gaugeData.setCell(0, 1, soldnproduct.product);

            gauge = new google.visualization.Gauge(document.getElementById('daily_sale_and_product_inventory'));
            gauge.draw(gaugeData, gaugeOptions);
        }

        function changeTemp(dir) {
            gaugeData.setValue(0, 0, gaugeData.getValue(0, 0) + dir * 25);
            gaugeData.setValue(0, 1, gaugeData.getValue(0, 1) + dir * 20);
            gauge.draw(gaugeData, gaugeOptions);
        }

        // google.charts.load('current', {packages:["orgchart"]});
        // google.charts.setOnLoadCallback(employeeTree);

        // function employeeTree() {
        //     var data = new google.visualization.DataTable();
        //     data.addColumn('string', 'Name');
        //     data.addColumn('string', 'Manager');
        //     data.addColumn('string', 'ToolTip');

        //     // For each orgchart box, provide the name, manager, and tooltip to show.
        //     data.addRows([
        //     [{'v':'Mike', 'f':'Mike<div style="color:red; font-style:italic">President</div>'},
        //     '', 'The President'],
        //     [{'v':'Jim', 'f':'Jim<div style="color:red; font-style:italic">Vice President</div>'},
        //     'Mike', 'VP'],
        //     ['Alice', 'Mike', ''],
        //     ['Bob', 'Jim', 'Bob Sponge'],
        //     ['Carol', 'Bob', '']
        //     ]);

        //     // Create the chart.
        //     var chart = new google.visualization.OrgChart(document.getElementById('employeeTree'));
        //     // Draw the chart, setting the allowHtml option to true for the tooltips.
        //     chart.draw(data, {'allowHtml':true});
        // }

    </script>
@endsection