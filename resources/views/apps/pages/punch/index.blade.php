@extends('apps.layout.master')
@section('title','Create Manual Cashier Punch')
@section('content')
<section id="file-exporaat">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

		<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="You can create/modify manual cashier puch." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-money"></i> Edit Manual Cashier Punch
						@else
						<i class="icon-money"></i> Create Manual Cashier Punch
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
							action="{{url('attendance/punch/manual/modify/'.$edit->id)}}"
						@else
							action="{{url('attendance/punch/manual/save')}}"
						@endif
						>
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="eventRegInput1">
										<span>Select Cashier From Employee</span> 
										<span class="text-danger">*</span>
									</label>
									<select name="user_id" class="form-control border-primary">
										<option value="0">Select Cashier From Employee</option>
										@if(isset($userL))
											@foreach($userL as $head)
												<option 
												@if(isset($edit))
													@if($edit->user_id==$head->id)
														selected="selected" 
													@endif
												@endif 
												 value="{{$head->id}}">{{$head->name}}</option>
											@endforeach
										@endif
									</select>
								</div>

									<div class="form-group">
										<label for="eventRegInput3">In Date <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$edit->in_date}}" 
										@else 
										value="{{date('Y-m-d')}}" 
										@endif 
										 class="form-control border-primary DropDateWithformat" placeholder="In Date" name="in_date">
									</div>

									<div class="form-group">
										<label for="eventRegInput3">In Time <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$edit->in_time}}" 
										@else 
										value="{{date('H:i:s')}}" 
										@endif 
										 class="form-control border-primary" placeholder="In Time" name="in_time">
									</div>
								

									<div class="form-group">
										<label for="eventRegInput3">Out Date <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$edit->in_date}}" 
										@else 
										value="{{date('Y-m-d')}}" 
										@endif 
										 class="form-control border-primary DropDateWithformat" placeholder="Out Date" name="out_date">
									</div>

									<div class="form-group">
										<label for="eventRegInput3">Out Time <span class="text-danger">*</span></label>
										<input type="text" 
										@if(isset($edit))
										value="{{$edit->out_time}}" 
										@else 
										value="{{date('H:i:s')}}" 
										@endif 
										 class="form-control border-primary" placeholder="Out Time" name="out_time">
									</div>
						
							</div>

							<div class="form-actions center">
								<a href="{{url('attendance/punch/report')}}" class="btn btn-info mr-1" @if($userguideInit==1) data-step="4" data-intro="if you want to see cashier punch history then click this button." @endif>
									<i class="icon-android-share"></i> Back to Cashier Punch History
								</a>
								<button type="reset" class="btn btn-info btn-darken-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the clear button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-info btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
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

	<!-- Both borders end-->
</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1,'dateDrop'=>1])