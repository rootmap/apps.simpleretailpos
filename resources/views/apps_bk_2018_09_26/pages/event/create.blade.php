@extends('apps.layout.master')
@section('title','Create New Event Calender')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-md-8 offset-md-2">
	        <div class="card">

	 
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">New Event Calender</h4>
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
						@if(isset($editData))
							action="{{url('event/calendar/update/'.$editData->id)}}" 
						@else 
							action="{{url('event/calendar/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event Name</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegName" class="form-control border-primary" placeholder="Event Name" 
											@if(isset($editData))
												value="{{$editData->event_name}}"  
											@endif 
											 name="event_name">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event Url</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegURL" class="form-control border-primary" placeholder="Event Url" 
											@if(isset($editData))
												value="{{$editData->event_url}}"  
											@endif 
											 name="event_url">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event Start Date</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegStartDate" class="form-control border-primary DropDateWithformat" placeholder="Event Start Date" 
											@if(isset($editData))
												value="{{$editData->event_start_date}}"  
											@endif 
											 name="event_start_date">
										</div>
									</div>
		                        </div>
							</div>

						

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event Start Time</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegEndTime" class="form-control border-primary" placeholder="ent Start Time" 
											@if(isset($editData))
												value="{{$editData->event_start_time}}"  
											@endif 
											 name="event_start_time">
										</div>
									</div>
		                        </div>
							</div>


							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event End Date</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegEndDate" class="form-control border-primary DropDateWithformat" placeholder="Event End Date" 
											@if(isset($editData))
												value="{{$editData->event_end_date}}"  
											@endif 
											 name="event_end_date">
										</div>
									</div>
		                        </div>
							</div>


							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Event End Time</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegEndTime" class="form-control border-primary" placeholder="Event End Time" 
											@if(isset($editData))
												value="{{$editData->event_end_time}}"  
											@endif 
											 name="event_end_time">
										</div>
									</div>
		                        </div>
							</div>




							<div class="form-actions center">
	                            <button type="button" class="btn btn-warning mr-1">
	                            	<i class="icon-cross2"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-primary">
	                                <i class="icon-check2"></i> Save
	                            </button>
	                        </div>


							</div>
				

						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</section>
@endsection

@include('apps.include.datatable',['dateDrop'=>1])