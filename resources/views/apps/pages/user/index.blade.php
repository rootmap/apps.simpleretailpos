@extends('apps.layout.master')
@section('title','User Menu')
@section('content')
<section id="file-exporaat">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify new user under a store and provide this role." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-user-plus"></i> Add New User
						
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
							action="{{url('user/modify/'.$edit->id)}}"
						@else
							action="{{url('user/save')}}"
						@endif
						>
						{{ csrf_field() }}
							<div class="form-body">

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
			                            	<label for="projectinput1">Name </label>
				                            <input type="text" 
												@if(isset($edit))
													value="{{$edit->name}}" 
												@endif 
												 id="eventRegInput1" class="form-control border-primary" placeholder="Full name" name="name">
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Email </label>
				                            	 
												@if(isset($edit))
												<input type="text" id="eventRegInput2" class="form-control border-primary" placeholder="Email Address" name="email" readonly="" value="{{$edit->email}}">
													
												@else
												<input type="text" id="eventRegInput3" class="form-control border-primary" placeholder="Email Address" name="email">
												@endif 
												
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Phone </label>
				                            	<input type="text" 
												@if(isset($edit))
													value="{{$edit->phone}}" 
												@endif 
												 id="eventRegInput4" class="form-control border-primary" placeholder="Phone Number" name="phone">
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Address </label>
				                            	<input type="text" 
												@if(isset($edit))
													value="{{$edit->address}}" 
												@endif 
												 id="eventRegInput5" class="form-control border-primary" placeholder="Address" name="address">
				                        </div>
									</div>
									<div class="col-md-6">

										<div class="form-group">
			                            	<label for="projectinput1">Password </label>
				                            	<input type="password" 
												
												 id="eventRegInput6" class="form-control border-primary" placeholder="Password" name="password">
				                        </div>
				                        <div class="form-group">
			                            	<label for="projectinput1">Confirm Password </label>
				                            	<input type="password" 
												
												 id="eventRegInput7" class="form-control border-primary" placeholder="Confirm Password" name="password_confirmation">
				                        </div>
										@if(Auth::user()->user_type==1)
										<div class="form-group">
			                            	<label for="projectinput1">Store </label>
				                            
				                            	<select class="select2 form-control" name="store_id">
													<option value="">Select Store</option>
													@if(isset($storeList))
														@foreach($storeList as $rol)
															<option
															@if(isset($edit)) 
				                                                @if($edit->store_id==$rol->store_id) 
				                                                selected="selected"
				                                                @endif 
				                                            @endif
															value="{{$rol->store_id}}">{{$rol->name}}</option>
														@endforeach
													@endif
												</select>
				                        </div>
										<div class="form-group">
			                            	<label for="projectinput1">Role </label>
				                            
				                            	<select class="form-control" name="user_type">
													<option value="">Select Role</option>
													@if(isset($role))
														@foreach($role as $rol)
															<option
															@if(isset($edit)) 
				                                                @if($edit->user_type==$rol->id) 
				                                                selected="selected"
				                                                @endif 
				                                            @endif
															value="{{$rol->id}}">{{$rol->name}}</option>
														@endforeach
													@endif
												</select>
				                        </div>
				                        @else
				                        <div class="form-group">
			                            	<label for="projectinput1">Role </label>
				                            
				                            	<select class="select2 form-control" name="user_type">
													<option value="">Select Role</option>
													@if(isset($role))
														@foreach($role as $rol)
															<option
															@if(isset($edit)) 
				                                                @if($edit->user_type==$rol->id) 
				                                                selected="selected"
				                                                @endif 
				                                            @endif
															value="{{$rol->id}}">{{$rol->name}}</option>
														@endforeach
													@endif
												</select>
				                        </div>
				                        @endif
									</div>
								</div> 

								
		                        
		                        
		                        

							<div class="form-actions center">
								<button type="reset" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
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