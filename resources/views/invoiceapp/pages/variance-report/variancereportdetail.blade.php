@extends('apps.layout.master')
@section('title','Variance Report Detail')
@section('content')
<section id="form-action-layouts">
	<!-- Both borders end-->
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Variance Report Detail</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<style type="text/css" media="screen">
						.table th {
						    border-top: table-borderless;
						    padding: 10px 10px 10px 10px; 
						}	
					</style>
					<div class="table-responsive">
						<table class="table table-bordered mb-0">
							<thead>
								<tr>
									<th>VARIANCE ID</th>
									<th>VARIANCE DATE</th>
									<th>PRODUCT NAME</th>
									<th>QUANTITY IN SYSTEM</th>
									<th>QUANTITY IN HAND</th>
									<th>QUANTITY VARIANCE</th>
									<th>COST VARIANCE</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1434657382</td>
									<td>2015-06-18</td>
		                            <td>iPhone 5 LCD White - Premium</td>
									<td>14</td>
		                            <td>15</td>
									<td>-1</td>
		                            <td>-29.00</td>
								</tr>
								<tr>
									<td>1434657382</td>
									<td>2015-06-18</td>
		                            <td>iPhone 5 LCD White - Premium</td>
									<td>14</td>
		                            <td>15</td>
									<td>-1</td>
		                            <td>-29.00</td>
								</tr>
								<tr>
									<td>1434657382</td>
									<td>2015-06-18</td>
		                            <td>iPhone 5 LCD White - Premium</td>
									<td>14</td>
		                            <td>15</td>
									<td>-1</td>
		                            <td>-29.00</td>
								</tr>
								<tr>
									<td>1434657382</td>
									<td>2015-06-18</td>
		                            <td>iPhone 5 LCD White - Premium</td>
									<td>14</td>
		                            <td>15</td>
									<td>-1</td>
		                            <td>-29.00</td>
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