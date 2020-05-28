@extends('apps.layout.master')
@section('title','Warranty Batch Out')
@section('content')
<section id="file-exporaat">


	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Warranty Batch Out</h4>
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
					<style type="text/css" media="screen">
						table tr td:last-child{color: #fff;}
					</style>
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
		                    	<th>WARRANTY BATCH ID</th>
		                        <th>WARRANTY BATCH DATE</th>
								<th>OPTION</th>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							<tr>
								<td>21</td>
								<td>2017-03-02</td>
								<td>
									<a href="{{url('/warrantyInvoice')}}" class="btn btn-primary"><i class="icon-paperplane"></i> See Details</a>
								</td>
							</tr>
							
						
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