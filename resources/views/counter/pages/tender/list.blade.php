@extends('apps.layout.master')
@section('title','Tender Report')
@section('content')
<section id="file-exporaat">


	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Tender Report</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
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