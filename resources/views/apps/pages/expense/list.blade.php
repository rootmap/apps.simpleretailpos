@extends('apps.layout.master')
@section('title','Customer')
@section('content')
<section id="file-exporaat">


	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Customer List</h4>
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
								<th>Name</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Invoice ID</th>
								<th>Report</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->address}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->last_invoice_no}}</td>
								<td><a href="{{url('customer/report/'.$row->id)}}" class="btn btn-info mr-1 change-action">
									<i class="icon-file-o"></i> View Report
								</a></td>
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