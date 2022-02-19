@extends('apps.layout.master')
@section('title','Customer')
@section('content')
<section id="file-exporaat">
<?php
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
	$userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all customer in this table and see customer report." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> User's Loyalty Invoices</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a href="{{url('customer/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('customer/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>Invoice ID</th>
								<th>User ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Purchase Amount</th>
								<th>Promotion ID</th>
								<th>Earned Point</th>
								<th>Membership Type</th>
								<th> Tender ID </th>
								<th>Tender Name</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->invoice_id}}</td>
								<td>{{$row->user_id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->purchase_amount}}</td>
								<td>{{$row->promotion_id}}</td>
								<td>{{$row->earned_point}}</td>
								<td>{{$row->membership_card_type}}</td>
								<td>{{$row->tender_id}}</td>
								<td>{{$row->tender_name}}</td>
							</tr>
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
