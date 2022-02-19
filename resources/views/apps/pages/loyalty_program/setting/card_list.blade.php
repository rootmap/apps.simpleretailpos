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
				<h4 class="card-title"><i class="icon-users2"></i>Membership Card list</h4>
				{{-- <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a> --}}
        		<div class="heading-elements">
					{{-- <ul class="list-inline mb-0">
						<li><a href="{{url('customer/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('customer/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul> --}}

				</div>
                <a class="btn btn-success" a href="{{ route('loyalty.setting.card.create') }}" style="float: right;">+ Create New Membership Card</a>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>ID</th>
								<th>Image</th>
								<th>Membership name</th>
								<th>Point Range Start</th>
								<th>Point Range End</th>
								<th>Status</th>
								<th>Action </th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->card_image_path}}</td>
								<td>{{$row->membership_name}}</td>
								<td>{{$row->point_range_from}}</td>
								<td>{{$row->point_range_to}}</td>
								<td>{{$row->status}}</td>
								<td> <a class="btn btn-sm btn-outline-danger" a href="{{ route('loyalty.setting.card.show',[$row->id]) }}">View</a> </td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="7">No Record Found</td>
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
