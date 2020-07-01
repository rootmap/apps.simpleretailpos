@extends('apps.layout.master')
@section('title','Purchase Report')
@section('content')
<section>
	
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="card">
				<div class="card-header">
					<h4 align="center" class="card-title" id="from-actions-bottom-right">
						<i class="icon-cloud-upload"></i> Purchase Invoice Details</h4>
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
									<input style="text-align:center;" class="form-control" value="{{$pro->order_no}}" type="text" readonly name="order_no" placeholder="Order No.">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 align="center">Purchase Order Date. </h4>
                                    <div class="input-group">
									<input style="text-align:center;"  class="form-control" readonly type="text" value="{{$pro->order_date}}" name="order_date" placeholder="YYYY-mm-dd">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h4 align="center">Vendor name </h4>
                                    <div class="input-group">
									<input style="text-align:center;"  readonly type="text" value="{{$pro->vendor_name}}" name="new_vendor_name" autocomplete="off" class="form-control" placeholder="Enter new vendor name">
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
						<h4 class="card-title"><i class="icon-cloud-check"></i> Purchase Item List</h4>
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
										<th>Purchase Total</th>
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
									@if(isset($proItem))
										
										@foreach($proItem as $index=>$pid)
											<tr id="row_{{$dataLoop}}">
												<td width="100" class="sl">{{$dataLoop}}</td>
												<td>{{$pid->product_barcode}}</td>
												<td>{{$pid->product_name}}</td>
												<td width="150">{{$pid->quantity}}</td>
												<td width="150">{{$pid->cost}}</td>
												<td width="150">{{$pid->price}}</td>
												<td width="50">{{$pid->cost*$pid->quantity}}</td>
											</tr>
											<?php 
											$dataLoop++; 
											$dataQuantity+=$pid->quantity;
											$datacost+=($pid->quantity*$pid->cost);
											$datasell+=($pid->quantity*$pid->price);
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
				<div class="col-md-12 col-sm-12 text-xs-center">
				<a type="button" href="{{url('purchase')}}" id="invoiceSubmit" class="btn btn-info">
						<i class="icon-shopping-cart"></i> Back To Purchase Invoice List
					</a>
				</div>
			</div>
		</div>
		<!--/ Invoice Footer -->

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