@extends('apps.layout.master')
@section('title','Submit Ticket')
@section('content')
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
<section id="file-exporaat">
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="you can added/modify new support ticket." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-user-plus"></i> Create new support ticket
						
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
						<span id="pageMSG"></span>
						<form class="form" method="post" 
						@if(isset($edit)) 
							action="{{url('SupportTicket/modify/'.$edit->id)}}"
						@else
							action="{{url('SupportTicket/save')}}"
						@endif
						enctype="multipart/form-data" 
						>
						{{ csrf_field() }}
							<div class="form-body">

								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
			                            	<label for="projectinput1">Full Name </label>
				                            <input type="text" 
												@if(isset($edit))
													value="{{$edit->name}}" 
												@endif 
												 id="eventRegInput1" class="form-control border-primary" value="{{Auth::user()->name}}" readonly="" placeholder="Full name" name="name">
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Subject <span style="color: red; font-size: 16px;">*</span></label>
				                            	
												<input type="text" id="eventRegInput2" class="form-control border-primary" placeholder="Subject" name="subject"  @if(isset($edit)) value="{{$edit->subject}}" @endif>
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Department <span style="color: red; font-size: 16px;">*</span></label>
				                            
				                            	<select class="select2 form-control" name="department_id">
													<option value="">Select Department</option>
													@if(isset($dep))
														@foreach($dep as $rol)
															<option
															@if(isset($edit)) 
				                                                @if($edit->department_id==$rol->id) 
				                                                selected="selected"
				                                                @endif 
				                                            @endif
															value="{{$rol->id}}">{{$rol->name}}</option>
														@endforeach
													@endif
												</select>
				                        </div>
									</div>
									<div class="col-md-2"></div>
									<div class="col-md-5">

										<div class="form-group">
			                            	<label for="projectinput1">Email </label>
				                            	<input type="email" 
												
												 id="eventRegInput6" readonly="" class="form-control border-primary" value="{{Auth::user()->email}}" placeholder="Password" name="email">
				                        </div>
				                        
										<div class="form-group">
			                            	<label for="projectinput1">Related Service <span style="color: red; font-size: 16px;">*</span></label>
				                            
				                            	<select class="select2 form-control" name="related_service_id">
													<option value="">Select Related Service</option>
													@if(isset($menu_pages))
														@foreach($menu_pages as $rol)
															<option
															@if(isset($edit)) 
				                                                @if($edit->related_service_id==$rol->id) 
				                                                selected="selected"
				                                                @endif 
				                                            @endif
															value="{{$rol->id}}">{{$rol->name}}</option>
														@endforeach
													@endif
												</select>
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Priority <span style="color: red; font-size: 16px;">*</span></label>
				                            
				                            	<select class="select2 form-control" name="priority">
													<option value="">Select Priority</option>
													<option value="High">High</option>
													<option value="Medium">Medium</option>
													<option value="Low">Low</option>
													
												</select>
				                        </div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
			                            	<label for="projectinput1">Message <span style="color: red; font-size: 16px;">*</span></label>
				                            	<textarea id="projectinput8" rows="5" class="form-control" name="message" placeholder="Message"></textarea>
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Attachment if need: </label>
				                            	<label id="projectinput7" class="file center-block">
													<input type="file" name="attachment" id="file">
													<span style="color: red">Allowed Extention : JPG, PNG, DOC, XLS, PPT</span>
												</label>
				                        </div>
									</div>
								</div> 

								
		                        
		                        
		                        

							<div class="form-actions center">
								<button type="reset" class="btn btn-warning mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
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