@extends('apps.layout.master')
@section('title','Customer Lead')
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
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all customer lead in this table. You can edit and delete in this table" @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Customer Lead List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
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
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Lead Info</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->lead_info}}</td>
								<td>
                                        <a href="{{url('customer/lead/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="2" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('customer/lead/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-info btn-darken-1" @if($userguideInit==1) data-step="3" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
								</td>
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