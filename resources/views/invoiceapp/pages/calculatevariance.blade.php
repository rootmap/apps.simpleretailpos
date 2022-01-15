@extends('apps.layout.master')
@section('title','Calculate Variance')
@section('content')
<section id="form-action-layouts">
	<div class="row match-height">


		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right">Enter Quantity in hand for each item</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<form class="form form-horizontal striped-labels form-bordered" action="{{url('calculatevariance/save')}}">
	                    	<div class="form-body">
	                    		{{ csrf_field() }}
			                    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 5 LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="5white[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 5 LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="5black[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 5C LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="5cblack[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 5SE LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="5seblack[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6 LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6white">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6 LCD Black - Premium  </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6black">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6 Plus LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6plusblack">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6 Plus LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6pluswhite">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6S LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6sblack">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6S LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6swhite">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6S Plus LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6spluswhite">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 6S Plus LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="6splusblack[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">Small Parts </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="smallparts[]">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 7 LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="7black">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 7 LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="7white">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 7 Plus LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="7plusblack">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 7 Plus LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="7pluswhite">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">Battery </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="battery">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPad Air Digi </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="ipadairdigi">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPad 2 Digi </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="ipad2digi">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPad Mini 1 Digi </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="ipadmini">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPad 3 Digi </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="ipad3digi">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">Overnight Shipping - Under Minimum Order </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="Overnightshipping">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">Note 4 LCD </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="note4">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 8 LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="8black">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 8 LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="8white">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 8 Plus LCD Black - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="8plusblack">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">iPhone 8 Plus LCD White - Premium </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="8pluswhite">
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput1">Other </label>
		                            <div class="col-md-9">
		                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity " name="other">
		                            </div>
		                        </div>


	                        <div class="form-actions right">
								<button type="button" class="btn btn-warning mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Save
								</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection