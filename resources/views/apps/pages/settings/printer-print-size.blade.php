@extends('apps.layout.master')
@section('title','POS Setting')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-8 offset-md-2" @if($userguideInit==1) data-step="1" data-intro="In this section, you can change multiple POS printer width and height." @endif>
	        <div class="card">
	            <div class="card-body collapse in">
	                <div class="card-block">
						<form method="post"  
						@if(isset($ps))
							action="{{url('setting/printer/print-paper/size/update/'.$ps->id)}}" 
						@else 
							action="{{url('setting/printer/print-paper/size/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}


							<div class="form-body">
								<div class="col-md-12">
									<h4>POS Printer Page</h4>
									<hr class="bg-blue">
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Width</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="POS Width" 
												@if(isset($ps))
													value="{{$ps->pos_width}}"  
												@endif 
												 name="pos_width">
											</div>
										</div>
			                        </div>
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Height</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="POS Height" 
												@if(isset($ps))
													value="{{$ps->pos_height}}"  
												@endif 
												 name="pos_height">
											</div>
										</div>
			                        </div>
								</div>
							</div>

							<div class="form-body">
								<div class="col-md-12">
									<h4>Thermal Printer Page</h4>
									<hr class="bg-blue">
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Width</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Thermal Width" 
												@if(isset($ps))
													value="{{$ps->thermal_width}}"  
												@endif 
												 name="thermal_width">
											</div>
										</div>
			                        </div>
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Height</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Thermal Height" 
												@if(isset($ps))
													value="{{$ps->thermal_height}}"  
												@endif 
												 name="thermal_height">
											</div>
										</div>
			                        </div>
								</div>
							</div>

							<div class="form-body">
								<div class="col-md-12">
									<h4>Barcode Printer Page</h4>
									<hr class="bg-blue">
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Width</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Barcode Width" 
												@if(isset($ps))
													value="{{$ps->barcode_width}}"  
												@endif 
												 name="barcode_width">
											</div>
										</div>
			                        </div>
								</div>
								<div class="col-md-6">
									<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Height</label>
		                        		<div class="col-md-7">
											<div class="form-group">
												<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Barcode Height" 
												@if(isset($ps))
													value="{{$ps->barcode_height}}"  
												@endif 
												 name="barcode_height">
											</div>
										</div>
			                        </div>
								</div>
							</div>

							<div class="form-actions center">
	                            <button type="button" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
	                            	<i class="icon-cross2"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-info btn-darken-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
	                                <i class="icon-check2"></i> Save
	                            </button>
	                        </div>
						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!--Start image popup-->

	<!--End image popup-->
</section>
@endsection

@section("css")
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/ui/jqueryui.min.css')}}">
@endsection

@section("js")
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/buttons-selects.min.js')}}" type="text/javascript"></script>
@endsection