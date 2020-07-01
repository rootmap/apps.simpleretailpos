@extends('apps.layout.master')
@section('title','Change Password')
@section('content')
<section>
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-4 offset-md-4" @if($userguideInit==1) data-step="1" data-intro="In this section, you can modify your password." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-key2"></i> Change Your Password
					</h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<span id="pageMSG"></span>
                        <form class="form" method="post" action="{{url('change-password')}}">
						{{ csrf_field() }}
							<div class="form-body">

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
			                            	<label for="projectinput1"> Current Password </label>
				                            <input type="password" id="eventRegInput1" class="form-control border-info" placeholder="Enter Your Current Password" name="current_password">
				                        </div>
                                        <div class="form-group">
			                            	<label for="projectinput1"> New Password </label>
				                            <input type="password" id="eventRegInput1" class="form-control border-info" placeholder="Enter Your New Password" name="new_password">
				                        </div>
                                        <div class="form-group">
			                            	<label for="projectinput1"> Re-Type Password </label>
				                            <input type="password" id="eventRegInput1" class="form-control border-info" placeholder="Enter Your Re-Type Password" name="retype_password">
				                        </div>
                                        <div class="form-actions center">
                                            <a href="{{url('change-password')}}" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
                                                <i class="icon-cross2"></i> Cancel
                                            </a>
                                            
                                            <button type="submit" class="btn btn-info btn-darken-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
                                                <i class="icon-check2"></i> Update New Password
                                            </button>
                                        
                                        </div>
									</div>
									
                                    
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