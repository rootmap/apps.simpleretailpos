@extends('apps.layout.master')
@section('title','Variance Report List')
@section('content')
<section id="form-action-layouts">
	<!-- Both borders end-->
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Variance Report List</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<!-- <div class="card-block card-dashboard">
						<p class="card-text">Example of table having both column & row borders. Add <code>.table-bordered</code> class with <code>.table</code> for both borders table.</p>
					</div> -->
					<style type="text/css" media="screen">
						table tr td:last-child{color: #fff;}
					</style>
					<div class="table-responsive">
						<table class="table table-bordered mb-0">
							<thead>
								<tr>
									<th>VARIANCE ID</th>
									<th>VARIANCE DATE</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>John</td>
									<td>Doe</td>
									<td>
										<a href="{{url('/variancereportdetail')}}" class="btn btn-primary"><i class="icon-plus2"></i> See Details</a>
										<a href=""  class="btn btn-danger"><i class="icon-warning"></i> Delete</a>
									</td>
								</tr>
								<tr>
									<td>Mary</td>
									<td>Moe</td>
									<td>
										<a href="{{url('/variancereportdetail')}}" class="btn btn-primary"><i class="icon-plus2"></i> See Details</a>
										<a href=""  class="btn btn-danger"><i class="icon-warning"></i> Delete</a>
									</td>
								</tr>
								<tr>
									<td>July</td>
									<td>Dooley</td>
									<td>
										<a href="{{url('/variancereportdetail')}}" class="btn btn-primary"><i class="icon-plus2"></i> See Details</a>
										<a href=""  class="btn btn-danger"><i class="icon-warning"></i> Delete</a>
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

	<!-- Invoice Footer -->
	<div id="invoice-footer">
		<div class="row">
			<div class="col-md-7 col-sm-12">

			</div>
			<div class="col-md-5 col-sm-12 text-xs-center">
				<button type="submit" class="btn btn-primary"><i class="icon-paperplane"></i>  Sale Product</button>
			</div>
		</div>
	</div>
	<!--/ Invoice Footer -->


</div>
</div>
</div>
</div>
</div>








</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
@endsection