@extends('apps.layout.master')
@section('title','Confirm Product New Stock')
@section('content')
<section>
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<form class="form" id="createInvoice" action="{{url('product/purchase/save')}}" method="post">
	<div class="row">
		<div class="col-md-10 offset-md-1" @if($userguideInit==1) data-step="1" data-intro="In this section, you can see New stock order no, new stock order date and select vendor name." @endif>
			<div class="card">
				<div class="card-header">
					<h4 align="center" class="card-title" id="from-actions-bottom-right">
						<i class="icon-cloud-upload"></i> Confirm Purchase Details</h4>
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
                                    <h4 align="center">New Purchase Order No.</h4>
                                    <div class="input-group">
									<input class="form-control" 
									@if(isset($autoOrderID))
										value="{{$autoOrderID}}" 
									@endif
									 type="text" name="order_no" placeholder="Order No.">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 align="center">Purchase Order Date. </h4>
                                    <div class="input-group">
                                    	<input class="form-control DropDateWithformat" type="text" name="order_date" placeholder="YYYY-mm-dd">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h4 align="center">Vendor name </h4>
                                    <div class="input-group">
										<select name="vendor_id" class="form-control">
											<option value="">Select Vendor / Supplier</option>
											<option value="new">Create New Vendor</option>
											@foreach($vendorData as $row)
											<option value="{{$row->id}}">{{$row->name}}</option>
											@endforeach
										</select>
										<input style="display: none;" type="text" name="new_vendor_name" autocomplete="off" class="form-control" placeholder="Enter new vendor name">
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
			<div class="col-xs-12" @if($userguideInit==1) data-step="2" data-intro="In this section, you can see your shopping cart and you can update the quantity for stock." @endif>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="icon-cloud-check"></i> Confirm Purchase Item List</h4>
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
										<th>Barcode</th>
										<th>Product Name</th>
										<th width="150">Quantity For Stock</th>
										<th>Purchase Cost</th>
										<th>Sell Price</th>
										<th width="50">Action</th>
									</tr>
								</thead>
								<tbody id="ShoppingCartList">
									<?php 
									//echo "<pre>";
									//print_r($req_name); ?>
									<?php 
										$dataLoop=1; 
										$dataQuantity=0; 
										$datacost=0; 
										$datasell=0; 
									?>
									@if(isset($req_pid))
										
										@foreach($req_pid as $index=>$pid)
											<tr id="row_{{$dataLoop}}">
												<td width="100" class="sl">{{$dataLoop}}</td>
												<td>{{$barcode[$index]}}</td>
												<td>{{$req_name[$index]}}</td>
												
												<td width="150">
													<input type="hidden" name="pid[]" class="form-control" value="{{$pid}}">
													<input type="hidden" name="p_name[]" class="form-control" value="{{$req_name[$index]}}">
													<input type="number" name="quantity[]" class="form-control typed_quantity" id="number" value="{{$req_quantity[$index]}}">
													
													
													<input type="hidden" name="barcode[]" class="form-control typed_quantity" id="number" value="{{$barcode[$index]}}">
													<input type="hidden" name="cid[]" class="form-control typed_quantity" id="number" value="{{$req_cid[$index]}}">
												</td>
												<td width="150"><input type="text" name="purchase_price[]" class="form-control typed_quantity" id="number" value="{{$purchase_price[$index]}}"></td>
												<td width="150"><input type="text" name="sell_price[]" class="form-control typed_quantity" id="number" value="{{$sell_price[$index]}}"></td>
												<td width="50">
													<button type="button" data-id="1" class="btn btn-sm btn-danger close-row" onclick="removeRowCart(<?=$dataLoop?>)">
														<i class="icon-cross"></i>
													</button>
												</td>
											</tr>
											<?php 
											$dataLoop++; 
											$dataQuantity+=$req_quantity[$index];
											$datacost+=($req_quantity[$index]*$purchase_price[$index]);
											$datasell+=($req_quantity[$index]*$sell_price[$index]);
											?>
										@endforeach
									@endif
								</tbody>
								<tfoot>
									<tr>
										<th colspan="2"></th>
										<th  style="font-weight: bolder; text-align: right;" align="right">Total =</th>
										<th style="font-weight: bolder;" id="shoppingCartQuantityTotal">{{$dataQuantity}}</th>
										<th>{{$datacost}}</th>
										<th>{{$datasell}}</th>
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
				<div class="col-md-12 col-sm-12 text-xs-center" @if($userguideInit==1) data-step="3" data-intro="when you click this button then your stock will be saved and generate the invoice." @endif>
					<button type="button" id="invoiceSubmit" class="btn btn-info">
						<i class="icon-shopping-cart"></i> Save Purchase Invoice
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
<script>
	
</script>
@endsection

@include('apps.include.datatable',['confirmStockIN'=>1,'dateDrop'=>1])