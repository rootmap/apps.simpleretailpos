@extends('apps.layout.master')
@section('title','System Role Wise Menu')
@section('content')
<section id="file-exporaat">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-10 offset-md-1" @if($userguideInit==1) data-step="1" data-intro="You can access user for role wise." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						
						<i class="icon-user-plus"></i> Add System Role Wise Menu
						
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
						<form class="form" method="post" action="{{url('RoleWiseMenu/save')}}">
						{{ csrf_field() }}
							<div class="form-body">
								<div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Select Role </label>
		                            <div class="col-md-10">
		                            	<select class="form-control" name="role_id">
											<option value="0">Select Role</option>
											@if(isset($role))
													@foreach($role as $rol)
														<option value="{{$rol->id}}">{{$rol->name}}</option>
													@endforeach
											@endif
										</select>
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-2 label-control" for="projectinput1">Available Menus </label>
		                            <div class="col-md-10">
		                            	<div class="row">
	                        				<button class="btn collepsed btn-info" type="button">Collepsed</button>
	                        			    <button  class="btn expanded btn-info" type="button">Expanded</button>
	                        			    <button  class="btn checked btn-info" type="button">Checked All</button>
	                        				<button  class="btn unchecked btn-info" type="button">Unchek All</button>
								  		</div>
									
									@if(isset($menus))
									<ul class="tree" style="margin-left: -32px; margin-top: 10px;">
									  @foreach($menus as $row)
									  <li class="has">
									    <input type="checkbox" class="dbMenu" name="menu_id[]" value="{{$row['id']}}">
									    <label>{{$row['name']}} <span class="total">({{$row['total']}})</span></label>
									    @if($row['total']>0)
									    <ul>
									      @foreach($row['submenu'] as $sub)
									      <li>
									        <input type="checkbox"  class="dbMenu" name="menu_id[]" value="{{$sub->id}}">
									        <label> {{$sub->name}} </label>
									      </li>
									      @endforeach
									      
									    </ul>
									    @endif
									  </li>
									  @endforeach
									</ul>
									@endif
		                            </div>
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

</section>
@endsection

{{-- @include('apps.include.datatable',['JDataTable'=>1]) --}}
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection
@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">

	function loadingOrProcessing(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;

    }

    function warningMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function successMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

	$(document).ready(function(){

		$("select[name=role_id]").change(function(){
			$("#pageMSG").fadeIn();
			$("#pageMSG").html("");
			var role_id=$(this).val();
			$(".tree input[type='checkbox']").prop('checked', false);
			$("#pageMSG").html(loadingOrProcessing("Processing existing menus, please wait..."));
	        //------------------------Ajax Customer Start-------------------------//
	         var AddHowMowKhaoUrl="{{url('/RoleWiseMenu/ajax')}}";
	         $.ajax({
	            'async': false,
	            'type': "POST",
	            'global': false,
	            'dataType': 'json',
	            'url': AddHowMowKhaoUrl,
	            'data': {'_token':"{{csrf_token()}}",'role_id':role_id},
	            'success': function (data) {
	                var total=data.total;
	                if(total==0)
	                {
	                	$("#pageMSG").html(warningMessage("No existing menu found on selected role."));
	                	$(".tree input[type='checkbox']").prop('checked', false);
	                }
	                else
	                {
	                	$("#pageMSG").html("");
	                	$("#pageMSG").fadeOut();
	                	$('.tree ul').fadeIn();
						
						var datas=data.datas;
	                	$.each(datas,function(key,row){
	                		$("input[value='"+row.menu_id+"']").prop('checked', true);
	                	});
						
	                }
	            }
	        });
	        //------------------------Ajax Customer End---------------------------//
		});
	});
</script>
@endsection
@section('RoleWiseMenucss')
<style type="text/css">
	
input[type=checkbox] {
  vertical-align: middle !important;
}

button.btn.collepsed::before {
  content: "(-) ";
}
button.btn.expanded::before {
  content: "(+) ";
}
button.btn.checked::before {
  font-family: fontAwesome;
  content: "\f00c\00a0";
}
button.btn.unchecked::before {
  font-family: fontAwesome;
  content: "\f00d\00a0";
}

.tree {
  /*margin: 1% auto;*/
  width: 100%;
}

.tree ul {
  display: none;
  margin: 4px auto;
  margin-left: 6px;
  border-left: 1px dashed #dfdfdf;
}


.tree li {
  /*padding: 12px 18px;*/
  cursor: pointer;
  vertical-align: middle;
  background: #fff;
  list-style: none;

}

.tree li:first-child {
  border-radius: 3px 3px 0 0;
}

.tree li:last-child {
  border-radius: 0 0 3px 3px;
}

.tree .active,
.active li {
  background: #efefef;
}

.tree label {
  cursor: pointer; 
  border-bottom:1px #ccc solid;
}

.tree input[type=checkbox] {
  margin: -2px 6px 0 0px;
}

.has > label {
  color: #000;
}

.tree .total {
  color: #e13300;
}
</style>
@endsection

@section('RoleWiseMenujs')
<script type="text/javascript">
	$(document).on('click', '.tree label', function(e) {
  $(this).next('ul').fadeToggle();
  e.stopPropagation();
});

$(document).on('change', '.tree input[type=checkbox]', function(e) {
  $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
  $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
  e.stopPropagation();
});

$(document).on('click', 'button', function(e) {
  switch ($(this).text()) {
    case 'Collepsed':
      $('.tree ul').fadeOut();
      break;
    case 'Expanded':
      $('.tree ul').fadeIn();
      break;
    case 'Checked All':
      $(".tree input[type='checkbox']").prop('checked', true);
      break;
    case 'Unchek All':
      $(".tree input[type='checkbox']").prop('checked', false);
      break;
    default:
  }
});
</script>
@endsection