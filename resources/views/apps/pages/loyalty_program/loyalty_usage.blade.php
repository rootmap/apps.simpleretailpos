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
				<h4 class="card-title"><i class="icon-users2"></i> Loyalty Point Usages</h4>
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
								<th>ID</th>
								<th>user Id</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Used Loyalty Point</th>
								<th>used For</th>
								<th>Invoice Id</th>
								<th>Amount</th>
								<th>Consumed Date</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->user_id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->used_loyalty_point}}</td>
								<td>{{$row->used_for}}</td>
								<td>{{$row->invoice_id}}</td>
								<td>{{$row->amount}}</td>
								<td>{{$row->created_at}}</td>

							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="10">No Record Found</td>
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
