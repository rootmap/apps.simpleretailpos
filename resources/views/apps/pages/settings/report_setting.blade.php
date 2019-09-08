@extends('apps.layout.master')
@section('title','Report Setting')
@section('content')
<section id="form-action-layouts">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<div class="row">
		<div class="col-md-12 " @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify company information." @endif>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Report Setting</h4>
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
						@if(isset($rs))
							action="{{url('site/report_setting/update/'.$rs->id)}}" 
						@else 
							action="{{url('site/report_setting/save')}}" 
						@endif
						class="form form-horizontal striped-labels" enctype="multipart/form-data">
							{{csrf_field()}}
							@if(isset($rs)) <input type="hidden" name="eximage" value="<?= $rs->logo; ?>" /> @endif
							<div class="col-md-6">
								<div class="form-body">
		                			<div class="form-group row last">
		                        		<label class="col-md-4 label-control">Company Name</label>
		                        		<div class="col-md-8">
		                        			<input type="text" name="company_name" placeholder="Company Name" class="form-control" 
		                        			@if(isset($rs))
												value="{{$rs->company_name}}"  
											@endif >
										</div>
			                        </div>
			                    </div>   
			                    <div class="form-body"> 
			                        <div class="form-group row last">
		                        		<label class="col-md-4 label-control">Phone</label>
		                        		<div class="col-md-8">
		                        			<input type="text" name="phone" placeholder="Phone" class="form-control"
		                        			@if(isset($rs))
												value="{{$rs->phone}}"  
											@endif>
										</div>
			                        </div>
								</div>
								<div class="form-body"> 
			                        <div class="form-group row last">
		                        		<label class="col-md-4 label-control">E - Mail</label>
		                        		<div class="col-md-8">
		                        			<input type="text" name="email" placeholder="E - Mail" class="form-control"
		                        			@if(isset($rs))
												value="{{$rs->email}}"  
											@endif>
										</div>
			                        </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-body"> 
			                        <div class="form-group row last">
		                        		<label class="col-md-4 label-control">Tax ID</label>
		                        		<div class="col-md-8">
		                        			<input type="text" name="tax_id" placeholder="Tax ID" class="form-control"
		                        			@if(isset($rs))
												value="{{$rs->tax_id}}"  
											@endif>
										</div>
			                        </div>
								</div>
								<div class="form-body"> 
			                        <div class="form-group row last">
		                        		<label class="col-md-4 label-control">Company Logo</label>
		                        		<div class="col-md-8">
		                        			<label id="projectinput7" class="col-md-8 file center-block">
											<input type="file" name="logo" id="file">
											<span class="file-custom"></span>
										</label>
										@if(isset($rs))
												<img class="card-img-top img-fluid" src="{{ URL::asset('upload/report_setting/'.$rs->logo) }}">
											@endif
										</div>
			                        </div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="form-body"> 
		                        <div class="form-group row last">
	                        		<label class="col-md-2 label-control">Address</label>
	                        		<div class="col-md-8">
	                        			<input type="text" name="address" placeholder="Address" class="form-control"
	                        			@if(isset($rs))
												value="{{$rs->address}}"  
											@endif>
									</div>
		                        </div>
							</div>
							<div class="form-body"> 
		                        <div class="form-group row last">
	                        		<label class="col-md-2 label-control">Disclaimer Details</label>
	                        		<div class="col-md-8">
	                        			<textarea id="projectinput8" rows="5" class="form-control" name="disclaimer" placeholder="Disclaimer Details">
	                        				@if(isset($rs))
												{{ html_entity_decode($rs->disclaimer)}}
											@endif</textarea>
									</div>
		                        </div>
							</div>
							<div class="form-body"> 
		                        <div class="form-group row last">
	                        		<label class="col-md-2 label-control">Signature Content</label>
	                        		<div class="col-md-8">
	                        			<textarea id="projectinput8" rows="5" class="form-control" name="signature" placeholder="Signature Content">
	                        				@if(isset($rs))
												{{html_entity_decode($rs->signature)}} 
											@endif
	                        			</textarea>
									</div>
		                        </div>
							</div>
							
							
			


							<div class="form-actions center">
	                            <button type="button" class="btn btn-warning mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
	                            	<i class="icon-cross2"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
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
<script type="text/javascript">
	$(document).ready(function(){
		$("select[name=nav_class_name]").change(function(){ 
			var navData=$("#navChange").attr("data");
			$("#navChange").removeClass(navData);
			$("#navChange").addClass($(this).val());
			$("#navChange").attr("data",$(this).val());

		});
	});
</script>
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/buttons-selects.min.js')}}" type="text/javascript"></script>
@endsection