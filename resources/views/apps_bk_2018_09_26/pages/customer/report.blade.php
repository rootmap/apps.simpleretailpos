@extends('apps.layout.master')
@section('title','Customer Report')
@section('content')
<section id="file-exporaat">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>
<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-user"></i> Customer Basic Information
					
					</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					{{-- <div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div> --}}
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<div>
							<div class="form-body">
								<div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Name</label>
		                            <div class="col-md-9">
		                            	<span>{{$dataCus->name}}</span>
		                            </div>
		                        </div>
								<div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Address</label>
		                            <div class="col-md-9">
		                            	<span>{{$dataCus->address}}</span>
		                            </div>
		                        </div>
								<div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Phone</label>
		                            <div class="col-md-9">
		                            	<span>{{$dataCus->phone}}</span>
		                            </div>
		                        </div>
								<div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Email</label>
		                            <div class="col-md-9">
		                            	<span>{{$dataCus->email}}</span>
		                            </div>
		                        </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$invoice_total=0;
			$cost_total=0;
			$profit_total=0;
			$total_quantity=0;
		?>
		@if(isset($dataTable))
		@foreach($dataTable as $row)
		<?php 
			$invoice_total+=$row->total_amount;
			$cost_total+=$row->total_cost;
			$profit_total+=$row->total_profit;
			$total_quantity+=1;
			?>
		@endforeach
		@endif
		<div class="col-md-4">
			<div class="col-lg-6 col-sm-12  bg-pink ">
                <div class="card-block text-xs-center">
                    <h1 class="display-6 white"><i class="icon-cart font-large-2"></i> ${{$invoice_total}}</h1>
                    <span class="white">Total Invoice</span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 bg-lime bg-darken-4 ">
                <div class="card-block text-xs-center">
                    <h1 class="display-6 white"><i class="icon-trending_up font-large-2"></i> <br>${{$cost_total}}</h1>
                    <span class="white">Total Cost</span>
                </div>
            </div>
            <div class="col-lg-6 bg-green col-sm-12 ">
                <div class="card-block text-xs-center">
                    <h1 class="display-6 white"><i class="icon-banknote font-large-2"></i> ${{$profit_total}}</h1>
                    <span class="white">Profit</span>
                </div>
            </div>
            <div class="col-lg-6 bg-purple bg-darken-1 col-sm-12" >
                <div class="card-block text-xs-center">
                    <h1 class="display-6 white"><i class="icon-database font-large-2"></i><br> ${{$total_quantity}}</h1>
                    <span class="white">Total Quantity</span>
                </div>
            </div>
		</div>
	<!-- Both borders end-->

	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Customer Report</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive" style="min-height: 300px;">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>ID</th>
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th>Sold To</th>
                                <th>Invoice Total Amount</th>
                                <th>Action</th>
								
							</tr>
						</thead>
						<tbody>
							
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
                                <td>{{$row->invoice_id}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->total_amount}}</td>
								<td>
                                    <span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                        	@if(in_array('Customer_List_Report_View_Invoice', $dataMenuAssigned)) 
                                            	<a href="{{url('sales/invoice/'.$row->id)}}" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Invoice</a>
                                            @endif 

                                            @if(in_array('Customer_List_Report_Delete_Invoice', $dataMenuAssigned)) 
                                            	<a href="{{url('sales/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                            @endif 

                                        </span>
                                    </span>
                                </td>
                            </tr>
							<?php 
								$invoice_total+=$row->total_amount;
								$cost_total+=$row->total_cost;
								$profit_total+=$row->total_profit;
								?>
							@endforeach
							@else
							<tr>
								<td colspan="6">No Record Found</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->


</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])