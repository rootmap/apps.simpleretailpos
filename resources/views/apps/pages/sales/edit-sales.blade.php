@extends('apps.layout.master')
@section('title','Edit Your Sales Info')
@section('content')
<section>
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<form class="form" id="createInvoice" action="{{url('sales/modify/'.$invoice->id)}}" method="post">
	<div class="row">
		<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="In this section you can modify customer and tender." @endif>
			<div class="card">
				<div class="card-header">
					<h4 align="center" class="card-title" id="from-actions-bottom-right"><i class="icon-cart31"></i> Change Your Sales Invoice | Delivery Address / Customer Information</h4>
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
                                    <div class="input-group" style="text-align: center;">
									<select style="width: 80%;" class="select2 form-control" name="customer_id">
												<option value="">Select a Customer</option>
												@if(isset($customerData))
													@foreach($customerData as $cus)
														<option  
														@if(isset($invoice->customer_id) && ($invoice->customer_id==$cus->id))
															selected="selected"  
														@endif  
														value="{{$cus->id}}">{{$cus->name}}</option>
													@endforeach
												@endif							
										</select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 align="center">Tender List</h4>
                                    <div class="input-group" style="text-align: center;">
									<select style="width: 80%;" class="select2 form-control" name="tender_id">
											<option value="">Select a Tender</option>
											@if(isset($tenderData))
												@foreach($tenderData as $tender)
													<option 
													@if(isset($invoice->tender_id) && ($invoice->tender_id==$tender->id))
														selected="selected"  
													@endif   
													value="{{$tender->id}}">{{$tender->name}}</option>
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
			<div class="col-xs-12"  @if($userguideInit==1) data-step="2" data-intro="In this section you see all product info." @endif>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="icon-cart4"></i> Change Your Shopping Cart</h4>
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
										<th width="150">Cost Per Item</th>
										<th width="150">Price Per Item</th>
										<th width="150">Total Price</th>
										<th width="50">Action</th>
									</tr>
								</thead>
								<tbody id="ShoppingCartList">
									<?php 
									//echo "<pre>";
									//print_r($req_name); 

									$dataLoop=1; 
										$dataQuantity=0; 
										$dataTotalPrice=0; 
									?>
									@if(isset($invoice_product))
										@foreach($invoice_product as $index=>$row)
											<tr id="row_{{$dataLoop}}">
												<td width="100" class="sl">{{$dataLoop}}</td>
												<td>{{$row->product_name}}</td>
												<td width="150">
													<input type="hidden" name="sid[]" class="form-control" value="{{$row->id}}">
													<input type="hidden" name="pid[]" class="form-control" value="{{$row->product_id}}">
													<input type="hidden" name="name[]" class="form-control" value="{{$row->product_name}}">
													<input type="number" name="quantity[]" class="form-control typed_quantity" id="number" value="{{$row->quantity}}">
												</td>
												<td width="150">
													<input type="text" name="cost[]" class="form-control typed_cost_price" value="{{$row->cost}}">
												</td>
												<td width="150">
													<input type="text" name="price[]" class="form-control typed_unit_price" value="{{$row->price}}">
												</td>
												<td width="150">{{($row->quantity*$row->price)}}</td>
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
										<th style="font-weight: bolder; text-align: right;" colspan="3" align="right">Total Quantity =</th>
										<th style="font-weight: bolder;" id="shoppingCartQuantityTotal"><?=$dataQuantity?></th>
										<th style="text-align: right;"><b>Sub Total =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="shoppingCartPriceTotal">{{$dataTotalPrice}}</th>
									</tr>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="5" align="right">
											<b>Sales Tax (<span id="tax_rate">{{$invoice->tax_rate}}</span>%) [+] =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="total_tax">{{$invoice->total_tax}}</th>
									</tr>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="5" align="right">
											<b>Discount Amount(<span id="sales_discount" data-id="{{$invoice->discount_type}}">{{$invoice->sales_discount}}</span>@if($invoice->discount_type==2)%@endif)  [-] 

											 =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="discount_total">{{$invoice->discount_total}}</th>
									</tr>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="5" align="right">
											<b>Invoice Total =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="InvoiceTotalWDT">{{$invoice->total_amount}}</th>
									</tr>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="5" align="right">
											<b>Paid Amount =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="paidAmount">{{$invoice_payment}}</th>
									</tr>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="5" align="right">
											<b>Invoice Due =</b></th>
										<th colspan="2" style="font-weight:bolder;" id="invoiceDue">
											<?php 
											if(($invoice->total_amount-$invoice_payment)>0)
											{
												echo ($invoice->total_amount-$invoice_payment);
											}
											else
											{
												echo 0;
											}
											?>
											</th>
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
					<button type="button" id="invoiceSubmit" class="btn btn-primary" @if($userguideInit==1) data-step="3" data-intro="please click here if you want to modify your invoice." @endif>
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
			var unitPrice=$(this).parent('td').parent('tr').find('td:eq(4)').children("input").val();
			var currrentQty=$(this).val();
			//console.log('qty',currrentQty);
			//console.log('Price',unitPrice);
			//return false;
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
			$(this).parent('td').parent('tr').find('td:eq(5)').html(totalPrice);
			genarateSL();
		});
		$(".typed_quantity").change(function(){
			var unitPrice=$(this).parent('td').parent('tr').find('td:eq(4)').children("input").val();
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
			$(this).parent('td').parent('tr').find('td:eq(5)').html(totalPrice);
			genarateSL();
		});

		$(".typed_unit_price").keyup(function(){
			var unitPrice=$(this).val();
			var currrentQty=parseFloat($(this).parent('td').parent('tr').find('td:eq(2)').children("input:eq(3)").val()).toFixed(2);
			//console.log('qty',currrentQty);
			//console.log('Price',unitPrice);
			//return false;
			if(unitPrice.length==0)
			{
				unitPrice=0;
				$(this).val('0');
			}

			if(unitPrice<=0)
			{
				unitPrice=0;
				$(this).val('0');
			}

			var totalPrice=currrentQty*unitPrice;
			//alert(unitPrice);
			$(this).parent('td').parent('tr').find('td:eq(5)').html(totalPrice);
			genarateSL();
		});

		$(".typed_unit_price").change(function(){
			var unitPrice=$(this).val();
			var currrentQty=parseFloat($(this).parent('td').parent('tr').find('td:eq(2)').children("input:eq(3)").val()).toFixed(2);
			if(unitPrice.length==0)
			{
				unitPrice=0;
				$(this).val('0');
			}

			if(unitPrice<=0)
			{
				unitPrice=0;
				$(this).val('0');
			}

			var totalPrice=currrentQty*unitPrice;
			//alert(unitPrice);
			$(this).parent('td').parent('tr').find('td:eq(5)').html(totalPrice);
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

			/*if(tenderID.length==0)
			{
				alert('Please select a tender!!!');
				return false;
			}*/

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
					var totalPriceR=$(this).parent('tr').find('td:eq(5)').html();
					totalQuantity+=(rowtotal-0);
					totalPrice+=(totalPriceR-0);
				}
				
			});


		}

		$("#shoppingCartQuantityTotal").html(totalQuantity);
		$("#shoppingCartPriceTotal").html(totalPrice);
		genarateSalesFinish();
	}


	function genarateSalesFinish()
	{
		var totalPrice=0;
		totalPrice=$.trim($("#shoppingCartPriceTotal").html());
		var tax_rate=0;
		var discount_type=0;
		var discount_amount=0;
		var discount_total=0;
		var paidAmount=0;
		var InvoiceTotalWDT=0;
		var total_tax=0;
		var invoiceDue=0;
		if($.trim($("#tax_rate").html())>0){ tax_rate=$.trim($("#tax_rate").html()); }
		if(tax_rate.length>0){ total_tax=((totalPrice*tax_rate)/100).toFixed(2); }
		if($.trim($("#sales_discount").attr("data-id"))>0){ discount_type=$.trim($("#sales_discount").attr("data-id")); }

		if(discount_type==1)
		{
			discount_amount=$.trim($("#sales_discount").html());
			discount_total=discount_amount;
		}
		else if(discount_type==2)
		{
			discount_amount=$.trim($("#sales_discount").html());
			discount_total=((totalPrice*discount_amount)/100).toFixed(2);
		}

		//console.log(discount_type,discount_total);

		$("#total_tax").html(total_tax);
		$("#discount_total").html(discount_total);

		InvoiceTotalWDT=(((totalPrice-0)+(total_tax-0))-discount_total).toFixed(2);
		$("#InvoiceTotalWDT").html(InvoiceTotalWDT);
		paidAmount=$.trim($("#paidAmount").html());
		invoiceDue=(InvoiceTotalWDT-paidAmount).toFixed(2);
		$("#invoiceDue").html(invoiceDue);
	}

	

</script>

@endsection