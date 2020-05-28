@extends('apps.layout.master')
@section('title','Confirm Your Sales Product Info')
@section('content')
<section>

	<form class="form" id="createInvoice" action="{{url('sales/save')}}" method="post">
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 align="center" class="card-title" id="from-actions-bottom-right"><i class="icon-cart31"></i> Sales Invoice | Delivery Address / Customer Information</h4>
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
                                <div class="col-md-6">
                                    <h4 align="center">Customer List</h4>
                                    <div class="input-group">
									<select class="select2 form-control" name="customer_id">
												<option value="">Select a Customer</option>
												@if(isset($customerData))
													@foreach($customerData as $cus)
														<option value="{{$cus->id}}">{{$cus->name}}</option>
													@endforeach
												@endif							
										</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 align="center">Tender List</h4>
                                    <div class="input-group">
									<select class="select2 form-control" name="tender_id">
											<option value="">Select a Tender</option>
											@if(isset($tenderData))
												@foreach($tenderData as $tender)
													<option value="{{$tender->id}}">{{$tender->name}}</option>
												@endforeach
											@endif			
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
						<h4 class="card-title"><i class="icon-cart4"></i> Shopping Cart</h4>
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
										<th width="150">Quantity For Sale</th>
										<th width="150">Price Per Item</th>
										<th width="150">Total Price</th>
										<th width="50">Action</th>
									</tr>
								</thead>
								<tbody id="ShoppingCartList">
									<?php 
									//echo "<pre>";
									//print_r($req_name); ?>
									@if(isset($req_pid))
										<?php 
										$dataLoop=1; 
										$dataQuantity=0; 
										$dataTotalPrice=0; 
										?>
										@foreach($req_pid as $index=>$pid)
											<tr id="row_{{$dataLoop}}">
												<td width="100" class="sl">{{$dataLoop}}</td>
												<td>{{$req_name[$index]}}</td>
												<td width="150">
													<input type="hidden" name="pid[]" class="form-control" value="{{$pid}}">
													<input type="hidden" name="name[]" class="form-control" value="{{$req_name[$index]}}">
													<input type="hidden" name="price[]" class="form-control" value="{{$req_price[$index]}}">
													<input type="number" name="quantity[]" class="form-control typed_quantity" id="number" value="{{$req_quantity[$index]}}">
												</td>
												<td width="150">{{$req_price[$index]}}</td>
												<td width="150">{{($req_quantity[$index]*$req_price[$index])}}</td>
												<td width="50">
													<button type="button" data-id="1" class="btn btn-sm btn-danger close-row" onclick="removeRowCart(<?=$dataLoop?>)">
														<i class="icon-cross"></i>
													</button>
												</td>
											</tr>
											<?php 
											$dataLoop++; 
											$dataQuantity+=$req_quantity[$index];
											$dataTotalPrice+=($req_quantity[$index]*$req_price[$index]);
											?>
										@endforeach
									@endif
								</tbody>
								<tfoot>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="2" align="right">Total Quantity =</th>
										<th style="font-weight: bolder;" id="shoppingCartQuantityTotal">{{$dataQuantity}}</th>
										<th style="text-align: right;"><b>Total price =</b></th>
										<th style="font-weight:bolder;" id="shoppingCartPriceTotal">{{$dataTotalPrice}}</th>
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
						<i class="icon-download"></i>  Save & Genarate Invoice 
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
			var unitPrice=$(this).parent('td').parent('tr').find('td:eq(3)').html();
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
			var totalPrice=currrentQty*unitPrice;
			//alert(unitPrice);
			$(this).parent('td').parent('tr').find('td:eq(4)').html(totalPrice);
			genarateSL();
		});
		$(".typed_quantity").change(function(){
			var unitPrice=$(this).parent('td').parent('tr').find('td:eq(3)').html();
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
			var totalPrice=currrentQty*unitPrice;
			//alert(unitPrice);
			$(this).parent('td').parent('tr').find('td:eq(4)').html(totalPrice);
			genarateSL();
		});

		$("#invoiceSubmit").click(function(){
			var customerID=$("select[name=customer_id]").val();
			var tenderID=$("select[name=tender_id]").val();

			if(customerID.length==0)
			{
				alert('Please select a customer!!!');
				return false;
			}

			if(tenderID.length==0)
			{
				alert('Please select a tender!!!');
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
					var totalPriceR=$(this).parent('tr').find('td:eq(4)').html();
					totalQuantity+=0;
					totalPrice+=0;
					$(this).parent('tr').find('.typed_quantity').val('0');
				}
				else{
					var totalPriceR=$(this).parent('tr').find('td:eq(4)').html();
					totalQuantity+=(rowtotal-0);
					totalPrice+=(totalPriceR-0);
				}

			});


		}

		$("#shoppingCartQuantityTotal").html(totalQuantity);
		$("#shoppingCartPriceTotal").html(totalPrice);

	}

	

</script>

@endsection