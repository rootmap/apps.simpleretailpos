@extends('apps.layout.master')
@section('title','Store-Shop Info')
@section('content')
<section id="file-exporaat">
<?php 
    $userguideInit=StaticDataController::userguideInit();
?>
		<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify new store shop." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-home"></i> Your Store-Shop Info
						
					</h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<span id="pageMSG"></span>
							<div class="form-body">
							
		                        <div class="form-group col-md-6">
	                            	<label for="projectinput1">Store Name </label>
		                            <input type="text" 
										@if(isset($edit))
											value="{{$edit->name}}" 
										@endif 
										 id="eventRegInput1"  readonly="readonly" class="form-control border-info" placeholder="Full name" name="name">
		                        </div>
								<div class="form-group col-md-6">
	                            	<label for="projectinput1">Store ID </label>
		                            	<input type="text" 
										@if(isset($edit))
											value="{{$edit->store_id}}" 
										@else
											 value="{{$store_id}}" 
										@endif 
										 id="eventRegInput1" readonly="readonly" class="form-control border-info" placeholder="Store ID" name="store_id">
		                        </div>
		                        <div class="form-group col-md-6">
	                            	<label for="projectinput1">Contact Email </label>
		                            	 
										
										<input type="text" id="eventRegInput1" class="form-control border-info" placeholder="Email Address"   readonly="readonly" name="email" @if(isset($edit)) value="{{$edit->email}}" @endif>
											
										
										
		                        </div>
		                        <div class="form-group col-md-6">
	                            	<label for="projectinput1">Phone </label>
		                            	<input type="text" 
										@if(isset($edit))
											value="{{$edit->phone}}" 
										@endif 
										 id="eventRegInput1" readonly="readonly" class="form-control border-info" placeholder="Phone Number" name="phone">
		                        </div>
		                        <div class="form-group col-md-12">
	                            	<label for="projectinput1">Address </label>
		                            	<input type="text" 
										@if(isset($edit))
											value="{{$edit->address}}" 
										@endif 
										 id="eventRegInput1"  readonly="readonly" class="form-control border-info" placeholder="Address" name="address">
		                        </div>

		                        
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Both borders end-->

<!-- Both borders end -->
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