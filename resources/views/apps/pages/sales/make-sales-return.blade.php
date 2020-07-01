@extends('apps.layout.master')
@section('title','Make Sales Return Item')
@section('content')
<section id="form-action-layouts">
	<?php
	$userguideInit=StaticDataController::userguideInit();
	?>
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see Item Wise Sales by date wise or invoice or Customer and generate excel or PDF." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Sales Return : Sales Invoice Filter</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
							{{csrf_field()}}
							<input type="hidden" name="sales_return_today" value="{{date('Y-m-d')}}">
                            
                            <div class="col-md-2">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" title="Invoice Date" class="form-control DropDateWithformat" value="{{date('Y-m-d')}}" name="sales_return_invoice_date" id="sales_return_invoice_date" placeholder="Invoice Date">
                                    <div class="form-control-position">
                                    <i class="icon-calendar2 info"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" title="Invoice ID" class="form-control" id="sales_return_invoice_id" name="sales_return_invoice_id" placeholder="Invoice ID">
                                    <div class="form-control-position">
                                        <i class="icon-paper info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" title="Barcode" class="form-control" id="sales_return_barcode" name="sales_return_barcode" placeholder="Barcode">
                                    <div class="form-control-position">
                                        <i class="icon-barcode info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                    <button type="button" class="btn btn-info loadSalesReturnInvoices">
                                    <i class="icon-zoom-in2"></i> Generate
                                    </button>
                            </div>
                            <div class="col-md-1" style="margin-right:10px;">
                                    <button type="button" class="btn btn-info resetSalesReturnInvoices">
                                    <i class="icon-close"></i> Clear
                                    </button>
                            </div>
                            <div class="col-md-2 backSalesReturnInvoicesGrid" style="display:none;">
                                    <button type="button" class="btn btn-info backSalesReturnInvoices">
                                    <i class="icon-ios-undo-outline"></i> Back To Invoice
                                    </button>
                            </div>
					</div>
				</div>
			</div>
        </div>
        
        <div class="col-md-12" id="salesReturnMSG"></div>

	<div class="col-xs-12">

		

		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Item Wise Sales Report</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="clearfix"></div>
              <div class="col-md-12">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="warranty_invoice_list">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Tender</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
              </div>
              <div class="col-md-12" id="returnSalesItems" style="display:none;">
                <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="returnSalesItems_warranty_invoice_list">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Return Amount</th>
                                    <th>Return Note | Enter Reason</th>
                                    <th>Return</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
              </div>
              <div class="clearfix"></div>
			</div>
		</div>




						



	</div>
</div>
<!-- Both borders end -->





</section>
@endsection



@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/datedropper.min.css')}}">
@endsection
@section('js')
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{url('theme/app-assets/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript">
    $(document).ready(function() {
        $(".DropDateWithformat").dateDropper({
            dropWidth: 200,
            maxYear: "<?=date('Y')?>",
            minYear: "2010",
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#fa4420",
            dropBorder: "1px solid #fa4420",
            dropBorderRadius: "20",
            dropShadow: "0 0 10px 0 rgba(250, 68, 32, 0.6)"
        });
    });
</script>
<!-- END PAGE LEVEL JS-->
<script src="{{url('js/intregation.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    var sales_return_invoice_detail = "{{secure_url('sales/return/invoice/detail')}}";
    var sales_return_item = "{{secure_url('sales/return/item')}}";
    var sales_return_invoice_ajax="{{secure_url('sales/return/invoice/ajax')}}";
    var sales_return_save_ajax="{{secure_url('sales/return/save/ajax')}}";
</script>
<script src="{{url('js/sales-return.js')}}" type="text/javascript"></script>
@endsection


