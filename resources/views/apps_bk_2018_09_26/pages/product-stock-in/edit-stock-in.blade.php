@extends('apps.layout.master')
@section('title','Edit Your Stock IN Info')
@section('content')
<section>

	<form class="form" id="createInvoice" action="{{url('product/stock/in/modify/'.$order->id)}}" method="post">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-header">
					<h4 align="center" class="card-title" id="from-actions-bottom-right">
						<i class="icon-cloud-upload"></i> Change Stockin Details</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <h4 align="center">Stockin Order No.</h4>
                                    <div class="input-group">
									<input class="form-control" type="text" value="{{$order->order_no}}" name="order_no" placeholder="Order No.">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 align="center">Stockin Order Date. </h4>
                                    <div class="input-group">
                                    	<input class="form-control"  value="{{$order->order_date}}"  type="text" name="order_date" placeholder="YYYY-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 align="center">Vendor name </h4>
                                    <div class="input-group">
                                    <select name="vendor_id" class="form-control">
                                    	<option value="">Select Vendor / Supplier</option>
                                    	@foreach($vendorData as $row)
                                    	<option 
                                    	@if($order->vendor_id==$row->id)
                                    		selected="selected" 
                                    	@endif
                                    	value="{{$row->id}}">{{$row->name}}</option>
                                    	@endforeach
                                    </select>
                                    </div>
                                </div>
                                
                            </div>
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
						<h4 class="card-title"><i class="icon-cloud-check"></i> Change Stockin Inventory Item</h4>
						<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
								<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-body collapse in">
						<!-- <div class="card-block card-dashboard">
							<p class="card-text">Example of table having both column & row borders. Add <code>.table-bordered</code> class with <code>.table</code> for both borders table.</p>
						</div> -->
						<div class="table-responsive">
							<table class="table table-bordered mb-0">
								<thead>
									<tr>
										<th width="100">SL</th>
										<th>Product Name</th>
										<th width="150">Quantity in Stock</th>
										<th width="50">Action</th>
									</tr>
								</thead>
								<tbody id="ShoppingCartList">
									<?php 
									$dataLoop=1; 
									$dataQuantity=0; 
									$dataTotalPrice=0; 
									?>
									@if(isset($order_product))
										@foreach($order_product as $index=>$row)
											<tr id="row_{{$dataLoop}}">
												<td width="100" class="sl">{{$dataLoop}}</td>
												<td>{{$row->product_name}}</td>
												<td width="150">
													<input type="hidden" name="sid[]" class="form-control" value="{{$row->id}}">
													<input type="hidden" name="pid[]" class="form-control" value="{{$row->product_id}}">
													<input type="hidden" name="name[]" class="form-control" value="{{$row->product_name}}">
													<input type="hidden" name="price[]" class="form-control" value="{{$row->price}}">
													<input type="number" name="quantity[]" class="form-control typed_quantity" id="number" value="{{$row->quantity}}">
												</td>
												<td width="50">
													<button type="button" data-id="1" class="btn btn-sm btn-danger close-row" onclick="removeRowCart(<?=$dataLoop?>)">
														<i class="icon-cross"></i>
													</button>
												</td>
											</tr>
											<?php 
											$dataLoop++; 
											$dataQuantity+=$row->quantity;
											$dataTotalPrice+=($row->quantity*$row->price);
											?>
										@endforeach
									@endif
								</tbody>
								<tfoot>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="2" align="right">Total Quantity =</th>
										<th style="font-weight: bolder;" id="shoppingCartQuantityTotal"><?=$dataQuantity?></th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
								
					</div>

				</div>
			</div>
		</div>
		<!-- Both borders end -->

		<!-- Invoice Footer -->
		<div id="invoice-footer">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-xs-center">
					<button type="button" id="invoiceSubmit" class="btn btn-primary">
						<i class="icon-download"></i>  Modify Stockin Order Detail 
					</button>
				</div>
			</div>
		</div>
		<!--/ Invoice Footer -->
	</form>

</div>
</div>
</div>
</div>
</div>
</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".typed_quantity").keyup(function(){
			var currrentQty=$(this).val();
			if(currrentQty.length==0)
			{
				currrentQty=0;
				$(this).val('0');
			}

			if(currrentQty<=0)
			{
				currrentQty=0;
				$(this).val('0');
			}
			genarateSL();
		});
		$(".typed_quantity").change(function(){
			var currrentQty=$(this).val();
			if(currrentQty.length==0)
			{
				currrentQty=0;
				$(this).val('0');
			}

			if(currrentQty<=0)
			{
				currrentQty=0;
				$(this).val('0');
			}
			genarateSL();
		});

		$("#invoiceSubmit").click(function(){
			var order_no=$("input[name=order_no]").val();
			var order_date=$("input[name=order_date]").val();

			if(order_no.length==0)
			{
				alert('Please Type a Order No.!!!');
				return false;
			}

			if(order_date.length==0)
			{
				alert('Please select a Date.!!!');
				return false;
			}

			$("#createInvoice").submit();
		});



	});


	function removeRowCart(cartID)
	{
		$('#row_'+cartID).fadeOut();
		$('#row_'+cartID).remove();
		genarateSL();
	}

	function genarateSL()
	{	
		var totalQuantity=0;
		var totalPrice=0;
		var total=$('.sl').size();
		if(total)
		{
			$('.sl').each(function(index){
				
				$(this).html((index-0)+(1-0));
				var rowtotal=$(this).parent('tr').find('.typed_quantity').val();
				if(rowtotal<=0)
				{
					totalQuantity+=0;
					$(this).parent('tr').find('.typed_quantity').val('0');
				}
				else{
					totalQuantity+=(rowtotal-0);
				}
				
			});


		}

		$("#shoppingCartQuantityTotal").html(totalQuantity);

	}

	

</script>

@endsection