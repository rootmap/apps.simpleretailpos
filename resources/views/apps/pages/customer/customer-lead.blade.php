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

		<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="In this section, you can add a new customer lead under a customer." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-user-plus"></i> Edit Customer Lead
						@else
						<i class="icon-user-plus"></i> Add Customer Lead
						@endif
					</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<form class="form" method="post" 
						@if(isset($edit))
							action="{{url('customer/lead/modify/'.$dataRow->id)}}"
						@else
							action="{{url('customer/lead/save')}}"
						@endif
						>
							<div class="form-body">
								{{ csrf_field() }} 
									<div class="form-group">
									<label for="eventRegInput1">Select Customer <span class="text-danger">*</span></label>
									<select class="select2 form-control" name="customer_id">
                                        <option 
	                                        @if(!isset($dataRow->customer_id))
		                                        @if(empty($dataRow->customer_id))
		                                        selected="selected" 
		                                        @endif
	                                        @endif

                                        value="">Select a Customer</option>
                                        @if(!isset($dataRow->customer_id))
                                        	<option value="0">Create New Customer</option>
                                        @endif

                                        @if(isset($existing_cus))
	                                        @foreach($existing_cus as $cus)
	                                        <option 
		                                        @if(isset($dataRow->customer_id))
			                                        @if($dataRow->customer_id==$cus->id)
			                                        selected="selected" 
			                                        @endif
		                                        @endif 
	                                        value="{{$cus->id}}">{{$cus->name}}</option>
	                                        @endforeach
                                        @endif                          
                                    </select>
									</div>
									<div class="form-group nameField" style="display: none;">
										<label for="eventRegInput1">Name <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
											value="{{$dataRow->name}}" 
										@endif 
										 id="eventRegInput1" class="form-control border-primary" placeholder="Customer Name" name="name">
									</div>


									<div class="form-group">
										<label for="eventRegInput2">Address <span class="text-danger">*</span></label>
										<input type="text" id="text" class="form-control border-primary" 
										@if(isset($edit))
										value="{{$dataRow->address}}" 
										@endif 
										placeholder="address" name="address">
									</div>	

									<div class="form-group">
										<label for="eventRegInput3">Phone <span class="text-danger">*</span></label>
										<input type="tel" 
										@if(isset($edit))
										value="{{$dataRow->phone}}" 
										@endif 
										id="tel" class="form-control border-primary" placeholder="1-(555)-555-5555" name="phone">
									</div>
								
									<div class="form-group">
										<label for="eventRegInput3">E-mail <span class="text-danger">*</span></label>
										<input type="email" 
										@if(isset($edit))
										value="{{$dataRow->email}}" 
										@endif 										
										id="eventRegInput4" class="form-control border-primary" placeholder="Email Address" name="email">
									</div>

									<div class="form-group">
										<label for="eventRegInput3">Lead Info <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$dataRow->lead_info}}" 
										@endif 										
										id="eventRegInput4" class="form-control border-primary" placeholder="Lead Info" name="lead_info">
									</div>

							
							</div>

							<div class="form-actions center">
								<button type="reset" class="btn btn-info btn-darken-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the clear button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-info btn-accent-2">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-info btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
									<i class="icon-check2"></i> Save
								</button>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@include('apps.include.datatable',['selectTwo'=>1,'customer_lead'=>1])
