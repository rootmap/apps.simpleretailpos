@extends('apps.layout.master')
@section('title','CardPointe Account Setting')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-8 offset-md-2" @if($userguideInit==1) data-step="1" data-intro="You can add a API public id and secret key" @endif>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">CardPointe & Bolt Account Setting</h4>
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
						<form method="post"  
						@if(isset($edit))
							action="{{url('cardpointe/account/update/setting')}}" 
						@else 
							action="{{url('cardpointe/account/setting')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Merchant ID / MID </label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="API Public ID" 
											@if(isset($edit))
												value="{{$edit->merchant_id}}"  
											@endif 
											 name="merchant_id">
										</div>
									</div>
		                        </div>
							</div>

											<input type="hidden" id="eventRegInput1" class="form-control border-green" placeholder="Secret Key" 
											@if(isset($edit))
												value="{{$edit->username}}"  
											@endif 
											 name="username">
										

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Cardpointe Basic Authorization</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Basic Authorization" 
											@if(isset($edit))
												value="{{$edit->password}}"  
											@endif 
											 name="password">
										</div>
									</div>
		                        </div>
							</div>


							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Bolt HSN</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="HSN" 
											@if(isset($edit))
												value="{{$edit->hsn}}"  
											@endif 
											 name="hsn">
										</div>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Bolt Authorization Key</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Authorization Key" 
											@if(isset($edit))
												value="{{$edit->authkey}}"  
											@endif 
											 name="authkey">
										</div>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">CardPointe Active module</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="checkbox" id="eventRegInput1" class="border-green" placeholder="Transaction Key" 
											@if(isset($edit))
												@if($edit->module_status==1)
													checked="checked"  
												@endif
											@endif 
											 name="module_status">
										</div>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Active Bolt Terminal</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="checkbox" id="eventRegInput1" class="border-green" placeholder="Transaction Key" 
											@if(isset($edit))
												@if($edit->bolt_status==1)
													checked="checked"  
												@endif
											@endif 
											 name="bolt_status">
										</div>
									</div>
		                        </div>
							</div>
							
							


							<div class="form-actions center">
	                            <button type="button" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the Cancel button." @endif>
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

</section>
@endsection

@section("css")
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/ui/jqueryui.min.css')}}">
@endsection

@section("js")
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/buttons-selects.min.js')}}" type="text/javascript"></script>
@endsection