@extends('apps.layout.master')
@section('title','Navigation Setting')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-md-8 offset-md-2">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Navigation Setting</h4>
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
						@if(isset($tab))
							action="{{url('site/navigation/update/'.$tab->id)}}" 
						@else 
							action="{{url('site/navigation/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-3 label-control">Select Navigation</label>
	                        		<div class="col-md-6">
										<select name="nav_class_name" class="form-control border-purple">
											<option class="" value="">Select Navigation Background</option>
											@if(isset($color))
												@foreach($color as $col):
													<option class="{{$col->color_value}}" 
													@if(isset($tab))
														@if($tab->nav_class_name==$col->color_value)
															selected="selected" 
														@endif
													@endif
													value="{{$col->color_value}}">
														{{$col->color_name}}
													</option>
												@endforeach		
											@endif									
										</select>
									</div>
									<div class="col-md-2">
										@if(isset($tab))
											<nav id="navChange" class="header-navbar navbar navbar-with-menu {{$tab->nav_class_name}} navbar-dark navbar-shadow  navbar-border" data="{{$tab->nav_class_name}}">
										@else
											<nav id="navChange" class="header-navbar navbar navbar-with-menu bg-purple bg-darken-1 navbar-dark navbar-shadow  navbar-border" data="bg-purple bg-darken-1">
										@endif
										    <div class="navbar-wrapper">
										        <div class="navbar-header">
										            <ul class="nav navbar-nav">
										                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container collapsed" aria-expanded="false"><i class="icon-ellipsis pe-2x icon-rotate-right"></i></a></li>
										            </ul>
										        </div>
										    </div>
										</nav>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-3 label-control">Select Counter Display Color</label>
	                        		<div class="col-md-6">
										<select name="cd_class_name" class="form-control border-purple">
											<option class="" value="">Select Counter Display Background</option>
											@if(isset($color))
												@foreach($color as $col):
													<option class="{{$col->color_value}}" 
													@if(isset($tab))
														@if($tab->nav_class_name==$col->color_value)
															selected="selected" 
														@endif
													@endif
													value="{{$col->color_value}}">
														{{$col->color_name}}
													</option>
												@endforeach		
											@endif									
										</select>
									</div>
									<div class="col-md-2">
										@if(isset($tab))
											<nav id="cdChange" class="header-navbar navbar navbar-with-menu {{$tab->nav_class_name}} navbar-dark navbar-shadow  navbar-border" data="{{$tab->nav_class_name}}">
										@else
											<nav id="cdChange" class="header-navbar navbar navbar-with-menu bg-purple bg-darken-1 navbar-dark navbar-shadow  navbar-border" data="bg-purple bg-darken-1">
										@endif
										    <div class="navbar-wrapper">
										        <div class="navbar-header">
										            <ul class="nav navbar-nav">
										                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container collapsed" aria-expanded="false"><i class="icon-ellipsis pe-2x icon-rotate-right"></i></a></li>
										            </ul>
										        </div>
										    </div>
										</nav>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-3 label-control">Outline Border</label>
	                        		<div class="col-md-6">
										<select name="outline_border_name" class="form-control border-purple">
											<option class="" value="">Select Outline Border</option>
											@if(isset($color))
												@foreach($color as $col):
													<option class="{{$col->color_value}}" 
													@if(isset($tab))
														@if($tab->outline_border_name==str_replace('bg','border',$col->color_value))
															selected="selected" 
														@endif
													@endif
													value="{{str_replace('bg','border',$col->color_value)}}">
														{{$col->color_name}}
													</option>
												@endforeach		
											@endif		
										</select>
									</div>
									<div class="col-md-2">
										@if(isset($tab))
										<nav id="outline_borderChange" class="header-navbar navbar navbar-with-menu {{$tab->outline_border_name}}  navbar-shadow  navbar-border" data="{{$tab->outline_border_name}}">
										@else
										<nav id="outline_borderChange" class="header-navbar navbar navbar-with-menu border-danger border-lighten-3 navbar-shadow  navbar-border" data="border-danger border-darken-1">
										@endif
										    <div class="navbar-wrapper">
										        <div class="navbar-header">
										            <ul class="nav navbar-nav">
										                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container collapsed" aria-expanded="false"><i class="icon-ellipsis pe-2x icon-rotate-right"></i></a></li>
										            </ul>
										        </div>
										    </div>
										</nav>
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

		$("select[name=cd_class_name]").change(function(){ 
			var navData=$("#cdChange").attr("data");
			$("#cdChange").removeClass(navData);
			$("#cdChange").addClass($(this).val());
			$("#cdChange").attr("data",$(this).val());

		});

		$("select[name=outline_border_name]").change(function(){ 
			var navData=$("#outline_borderChange").attr("data");
			$("#outline_borderChange").removeClass(navData);
			$("#outline_borderChange").addClass($(this).val());
			$("#outline_borderChange").attr("data",$(this).val());

		});
	});
</script>
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/buttons-selects.min.js')}}" type="text/javascript"></script>
@endsection