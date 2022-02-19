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
				<h4 class="card-title"><i class="icon-users2"></i>Promotions list</h4>
        		<div class="heading-elements">
				</div>
                <a class="btn btn-success" a href="{{ route('loyalty.setting.promotion.create') }}" style="float: right;">+ Create New Promoion</a>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>For Card Holder</th>
								<th>Conversion Rate</th>
								<th>Start At</th>
								<th>End At</th>
								<th>Status</th>
								<th>Action </th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->promotion_title}}</td>
								<td>{{$row->for_membership_type}}</td>
								<td>{{$row->currency_to_loyalty_conversion_rate}}</td>
								<td>{{$row->start_at}}</td>
								<td>{{$row->end_at}}</td>
								<td>{{$row->status}}</td>
								<td> <a class="btn btn-sm btn-outline-danger" a href="{{ route('loyalty.setting.promotion.show',[$row->id]) }}">View</a> </td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="8">No Record Found</td>
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
