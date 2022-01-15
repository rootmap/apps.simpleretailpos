@extends('apps.layout.master')
@section('title','Import customer')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $dataMenuAssigned=array();
	    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
		$userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-12 " @if($userguideInit==1) data-step="1" data-intro="You can import customer in this section." @endif>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Import customer</h4>
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
						 
							action="{{url('customer/import/save')}}" 
						
						class="form form-horizontal striped-labels" enctype="multipart/form-data">
							{{csrf_field()}}
							
							<div class="form-body"> 
		                        <div class="form-group row last">
	                        		<label class="col-md-5 label-control">Import File</label>
	                        		<div class="col-md-7">
	                        			<input type="file" name="importfile" id="importfile" />
									</div>
		                        </div>
							</div>
							<div class="form-actions center">
	                            <button type="reset" class="btn btn-info btn-darken-2 mr-1" @if($userguideInit==1) data-step="4" data-intro="if you want clear all information then click the clear button." @endif>
	                            	<i class="icon-cross2"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-info btn-accent-2" @if($userguideInit==1) data-step="3" data-intro="When you fill up all information then click save button." @endif>
	                                <i class="icon-check2"></i> Save
	                            </button>
	                            <a href="{{url('file/sample_file_customer.xlsx')}}" class="btn btn-info btn-accent-4 mr-1 change-action" @if($userguideInit==1) data-step="2" data-intro="When you click this button then open this excel and  you can see customer import format." @endif>
									<i class="icon-file-excel"></i> Download Sample File
								</a>
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