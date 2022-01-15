@extends('apps.layout.master')
@section('title','Tutorial Video Setting')
@section('content')
<section id="file-exporaat">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="you can added/modify new tutorial video." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-user-plus"></i> Add New Tutorial Video
						
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
							action="{{url('TutorialVideo/modify/'.$edit->id)}}"
						@else
							action="{{url('TutorialVideo/save')}}"
						@endif
						enctype="multipart/form-data" >
						{{ csrf_field() }}
							<div class="form-body">
							@if(isset($edit))
								<input type="hidden" name="exname" value="{{$edit->name}}">
								<input type="hidden" name="exthumb" value="{{$edit->thumb}}">
							@endif
		                        <div class="form-group">
	                            	<label for="projectinput1">Video Title </label>
		                            <input type="text" 
										@if(isset($edit))
											value="{{$edit->title}}" 
										@endif 
										 id="eventRegInput1" class="form-control border-primary" placeholder="Video Title" name="title">
		                        </div>
		                        <div class="form-group">
	                            	<label for="projectinput1" >File Name </label>
		                            	
										<input type="file" class="form-control " name="name" id="file">
										
		                        </div>
		                        <div class="form-group">
	                            	<label for="projectinput1" >Image </label>
		                            	
										<input type="file" class="form-control" name="thumb" id="file">
										@if(!empty($edit))
	                                 		<img src="{{url('upload/TutorialVideo/thumb/'.$edit->thumb)}}" width="50%">
	                                 	@endif
		                        </div>
		                        <div class="form-group">
	                            	<label for="projectinput1">Video Status </label>
		                            	<select class="select2 form-control" name="status">
											<option value="">Select Video Status</option>
											
												<?php 
													if(!empty($edit->status)==1)
													{
												?>
													<option selected="" value="1">Publish</option>
													<option value="2">Unpublish</option>

													<?php } else {?>
														<option selected="" value="2">Unpublish</option>
														<option value="1">Publish</option>
													
												<?php }?>
											
										</select>
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
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="4" data-intro="you are seeing all tutorial video list." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-users"></i> Tutorial Video List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>File Name</th>
                                <th>Status</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                	<?php 
                                		if($row->status==1)
                                		{
                                			echo 'Publish';
                                		}
                                		else
                                		{
                                			echo 'Unpublish';
                                		}
                                	?>
                                </td>
                                <td>
                                        <a href="{{url('TutorialVideo/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="5" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('TutorialVideo/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-danger" @if($userguideInit==1) data-step="6" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->
</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
<link href="{{url('video/video-js.css')}}" rel="stylesheet">

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  {{-- <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script> --}}
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<script src="{{url('/video.js')}}"></script>
@endsection