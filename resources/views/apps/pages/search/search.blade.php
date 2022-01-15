@extends('apps.layout.master')
@section('title','Search Report')
@section('content')
<section id="form-action-layouts">
    <?php
    $userguideInit=StaticDataController::userguideInit();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Customize Search Filter</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-plus4"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse">
                    <div class="card-block">
                            <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h4>Start Date</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                            <input
                                            @if(!empty($start_date))
                                            value="{{$start_date}}"
                                            @endif
                                            name="inpage_start_date" id="inpage_start_date" type="text" class="form-control DropDateWithformat" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>End Date</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                            <input
                                            @if(!empty($end_date))
                                            value="{{$end_date}}"
                                            @endif
                                            name="inpage_end_date" id="inpage_end_date" type="text" class="form-control DropDateWithformat" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Search</h4>
                                        <div class="input-group">
                                            <input
                                            @if(!empty($search))
                                            value="{{$search}}"
                                            @endif
                                            type="text" id="inpage_search_nuc" class="form-control border-info" placeholder="Search Anything" name="inpage_search_nuc">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h4>&nbsp;</h4>
                                        <div class="input-group">
                                            <button type="button" id="inpageSearchbtn" class="btn btn-info btn-darken-1 mr-1">
                                                <i class="icon-check2"></i> Generate Search Report
                                            </button>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12" style="padding-top: 20px;">
                                        <fieldset>
                                            <label class="custom-control custom-checkbox display-inline">
                                            <input type="checkbox" id="inpage_nuc-search-all" checked="checked" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">All</span>
                                            </label>
                                            <label class="custom-control custom-checkbox display-inline">
                                            <input type="checkbox" id="inpage_nuc-search-customer" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Customer</span>
                                            </label>
                                            <label class="custom-control custom-checkbox display-inline">
                                            <input type="checkbox" id="inpage_nuc-search-invoice" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Invoice</span>
                                            </label>
                                            <label class="custom-control custom-checkbox display-inline">
                                            <input type="checkbox" id="inpage_nuc-search-product" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Product</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    
                                </div>
                            </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Both borders end-->
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-xs-center">
                        @if(isset($search))
                            <i class="icon-search"></i> Searching For : [<span class="text-info">{{$search}}</span>] | Total Record Found : [<span id="total_search_found" class="text-info">0</span>]
                        @else
                            <i class="icon-search"></i> Search Result
                        @endif
                        
                    </h4>
                </div>
                <div class="card-body collapse in">
                    <div class="row customer_place">
                        <div id="customer_search_result_loader" class="col-md-12"></div>
                    </div>
                    <!-- Customer Search Result Start-->
                    <div class="card customer_place">
                        <div class="card-header">
                            <h4 class="card-title"><i class="icon-user"></i> Customer : Found Total Record [<span id="customer_total_record">0</span>]</h4>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="customer_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Invoice ID</th>
                                            <th>Customer Since</th>
                                            <th>Report</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Customer Search Result End-->
                    <div class="row invoice_place">
                        <div id="search_result_loader" class="col-md-12"></div>
                    </div>
                    <!-- Invoice Search Result Start-->
                    <div class="card invoice_place">
                        <div class="card-header">
                            <h4 class="card-title"><i class="icon-document"></i> Invoice : Found Total Record [<span id="invoice_total_record">0</span>]</h4>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="invoice_table">
                                    <thead>
                                        <tr>
                                            <th>Invoice ID</th>
                                            <th>Invoice Date</th>
                                            <th width="250">Product</th>
                                            <th width="250">Sold To</th>
                                            <th width="200">Tender</th>
                                            <th>Status</th>
                                            <th>Total Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Search Result End-->
                    

                    <div class="row product_place">
                        <div id="product_search_result_loader" class="col-md-12"></div>
                    </div>
                    <!-- product_ Search Result Start-->
                    <div class="card product_place">
                        <div class="card-header">
                            <h4 class="card-title"><i class="icon-database"></i> Product : Found Total Record [<span id="product_total_record">0</span>]</h4>
                        </div>
                        <div class="card-body collapse in">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="product_table">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Category Name</th>
                                            <th>Barcode</th>
                                            <th width="200">Name</th>
                                            <th style="width: 50px;">Quantity in Stock</th>
                                            <th>Price</th>
                                            <th>Cost</th>
                                            <th>Product Since</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- product_ Search Result End-->
                </div>
            </div>
        </div>
    </div>
    <!-- Both borders end -->
</section>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1,'JDataTable'=>1])
@section('RoleWiseMenujs')
   <script>
    var viewInvoiceURL="{{secure_url('sales/invoice')}}";
        var viewRepairURL="{{secure_url('repair/view')}}";
        var viewTicketURL="{{secure_url('ticket/view')}}";
        var viewCustomerURL="{{secure_url('customer/report')}}";
        var searchCustomerURL="{{secure_url('search-nuc/customer')}}";
        var searchProductURL="{{secure_url('search-nuc/product')}}";
    var searchParam = <?=$search_param?>;

    function findnInpageCOnvertParam(){
        var  nuc_search_all = 0;
        if($('#inpage_nuc-search-all').is(":checked")){ nuc_search_all = 1; }

        var  nuc_search_customer = 0;
        if($('#inpage_nuc-search-customer').is(":checked")){ nuc_search_customer = 1; }

        var  nuc_search_invoice = 0;
        if($('#inpage_nuc-search-invoice').is(":checked")){ nuc_search_invoice = 1; }

        var  nuc_search_product = 0;
        if($('#inpage_nuc-search-product').is(":checked")){ nuc_search_product = 1; }

        var inpage_search_param  = {};
        inpage_search_param['inpage_nuc_search_all']=nuc_search_all;
        inpage_search_param['inpage_nuc_search_customer']=nuc_search_customer;
        inpage_search_param['inpage_nuc_search_invoice']=nuc_search_invoice;
        inpage_search_param['inpage_nuc_search_product']=nuc_search_product;
        
        return inpage_search_param;
    }

    $(document).ready(function(e){

        $("#inpageSearchbtn").click(function(){
            var inpage_start_date = $("#inpage_start_date").val();
            var inpage_end_date = $("#inpage_end_date").val();
            var inpage_search_nuc = $("#inpage_search_nuc").val();

            if(inpage_search_nuc.length == 0){
                swalErrorMsg("Please Type Your Search Text");
                return false;
            }

            console.log('inpage_start_date',inpage_start_date);
            console.log('inpage_end_date',inpage_end_date);
            console.log('inpage_search_nuc',inpage_search_nuc);
            var inpage_search_param=findnInpageCOnvertParam();
            console.log(inpage_search_param);

            var date_param = {};
                date_param['start_date'] = inpage_start_date;
                date_param['end_date'] = inpage_end_date;

            //var encode_param = JSON.stringify(date_param);
            var encode_param = date_param;
            Swal.showLoading();
                $(".customer_place").fadeOut();
                $(".invoice_place").fadeOut();
                $(".product_place").fadeOut();
                if(inpage_search_param['inpage_nuc_search_all']==1){
                    $(".customer_place").fadeIn('slow');
                    $(".invoice_place").fadeIn('slow');
                    $(".product_place").fadeIn('slow');
                    searchCustomerNuc(inpage_search_nuc,encode_param);
                    searchInvoice(inpage_search_nuc,encode_param);
                    searchProductNuc(inpage_search_nuc,encode_param);
                }

                if(inpage_search_param['inpage_nuc_search_all']==0 && inpage_search_param['inpage_nuc_search_customer']==1){
                    $(".customer_place").fadeIn('slow');
                    searchCustomerNuc(inpage_search_nuc,encode_param);
                }
                
                if(inpage_search_param['inpage_nuc_search_all']==0 && inpage_search_param['inpage_nuc_search_invoice']==1){
                    $(".invoice_place").fadeIn('slow');
                    searchInvoice(inpage_search_nuc,encode_param);
                }

                if(inpage_search_param['inpage_nuc_search_all']==0 && inpage_search_param['inpage_nuc_search_product']==1){
                    $(".product_place").fadeIn('slow');
                    searchProductNuc(inpage_search_nuc,encode_param);
                }

                Swal.hideLoading();
                swalSuccessMsg("Search Result Generated Successfully.");

        });


        @if(isset($search))
            $(".customer_place").fadeOut();
            $(".invoice_place").fadeOut();
            $(".product_place").fadeOut();
            if(searchParam['nuc_search_all']==1){
                $(".customer_place").fadeIn('slow');
                $(".invoice_place").fadeIn('slow');
                $(".product_place").fadeIn('slow');
                searchCustomerNuc("{{$search}}",searchParam);
                searchInvoice("{{$search}}",searchParam);
                searchProductNuc("{{$search}}",searchParam);
            }

            if(searchParam['nuc_search_all']==0 && searchParam['nuc_search_customer']==1){
                $(".customer_place").fadeIn('slow');
                searchCustomerNuc("{{$search}}",searchParam);
            }
            
            if(searchParam['nuc_search_all']==0 && searchParam['nuc_search_invoice']==1){
                $(".invoice_place").fadeIn('slow');
                searchInvoice("{{$search}}",searchParam);
            }

            if(searchParam['nuc_search_all']==0 && searchParam['nuc_search_product']==1){
                $(".product_place").fadeIn('slow');
                searchProductNuc("{{$search}}",searchParam);
            }

            
        @endif

        
 
        //$('#report_table').DataTable();

    });

    


    </script>

@endsection