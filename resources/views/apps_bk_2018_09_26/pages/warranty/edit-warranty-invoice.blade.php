@extends('apps.layout.master')
@section('title','Warranty Product')
@section('content')
<section id="form-action-layouts">


	


<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Warranty Inventory Deatil</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<form method="post" action="{{url('warranty/update/'.$dataTable->id)}}" class="form form-horizontal striped-labels form-bordered">
					{{csrf_field()}}
					<input type="hidden" name="invoice_id" value="{{$dataTable->invoice_id}}">
					<input type="hidden" name="invoice_uid" value="{{$dataTable->id}}">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
		                    	<th width="100">Warranty ID</th>
		                    	<th width="200">Invoice ID</th>
		                    	<th width="200">Warranty Date</th>
		                        <th width="30%">Old Product</th>
		                        <th width="30%">New Product</th>
							</tr>
						</thead>
						<tbody id="ShoppingCartList">
							@if(isset($dataProduct))

								@foreach($dataProduct as $ex)
									<tr>
										<td>{{$ex->warranty_id}}</td>
										<td>{{$ex->invoice_id}}</td>
										<td>
											{{$ex->warranty_date}}
										</td>
										<td>{{$ex->product_name}}</td>
										<td>
											{{$ex->new_product_name}}
										</td>
									</tr>	
								@endforeach

							@endif
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" align="right" style="text-align: right;"> Total Product in Batch for Replace = <span id="batchQuantity">{{count($dataProduct)}}</span> </th>
							</tr>
							<tr>
								<th colspan="5" align="center" style="text-align: center;"> 
									<a href="{{url('warranty/report')}}" class="btn btn-primary">
										<i class="icon-table"></i> Back To Warranty Inventory Report
									</a>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->
	



</section>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1])