@extends('apps.layout.master')
@section('title','System Available Menu')
@section('content')
<section id="file-exporaat">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify a new system available menu." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-user-plus"></i> Edit System Available Menu
						@else
						<i class="icon-user-plus"></i> Add New System Available Menu
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
							action="{{url('menu-item/modify/'.$dataRow->id)}}"
						@else
							action="{{url('menu-item/save')}}"
						@endif
						>
						{{ csrf_field() }}
							<div class="form-body">
								
								<div class="form-group">
									<label for="eventRegInput1">Menu Name <span class="text-danger">*</span></label>
									<input type="text" 
									@if(isset($edit))
										value="{{$dataRow->name}}" 
									@endif 
									 id="eventRegInput1" class="form-control border-primary" placeholder="System Available Menu Name" name="name">
								</div>	
								<div class="form-group">
									<label for="eventRegInput1">Menu URL <span class="text-danger">*</span></label>
									<input type="text" 
									@if(isset($edit))
										value="{{$dataRow->url}}" 
									@endif 
									 id="eventRegInput1" class="form-control border-primary" placeholder="URL" name="url">
								</div>	
								<div class="form-group">
									<label for="eventRegInput1">Parent / Child Menu <span class="text-danger">*</span></label>
									<select id="eventRegInput1" class="form-control border-primary" name="menu_type">
										<option 
										@if(isset($edit)) 
											@if($dataRow->is_parent==0)
												selected="selected" 
											@endif
										@endif
										value="0">Select Type</option>
										<option 
										@if(isset($edit)) 
											@if($dataRow->is_parent==1)
												selected="selected" 
											@endif
										@endif
										value="1">Parent Menu</option>
										<option 
										@if(isset($edit)) 
											@if(!empty($dataRow->parent_id))
												selected="selected" 
											@endif
										@endif
										value="2">Child Menu</option>
									</select>
								</div>
								<div class="form-group">
									<label for="eventRegInput1">Select Parent <span class="text-danger">*</span></label>
									<select id="eventRegInput1" class="form-control border-primary" name="parent_id">
										<option value="0">Select Parent Menu</option>
										@if(isset($dataTableParent))
											@foreach($dataTableParent as $row)
												<option 
												@if(isset($edit)) 
													@if(!empty($dataRow->parent_id)) 
														@if($dataRow->parent_id==$row->id)
															selected="selected" 
														@endif
													@endif
												@endif

												value="{{$row->id}}">{{$row->name}} - {{$row->total}}</option>
											@endforeach
										@endif
									</select>
								</div>						
							</div>

							<div class="form-actions center">
								<button type="button" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-info btn-darken-2">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-info btn-darken-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
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
	<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="4" data-intro="You are seeing all system available menu list in this table. You can edit/delete." @endif>
			<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> System Available Menu List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>URL</th>
								<th>Parent Menu</th>
								<th style="width: 100px;">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->url}}</td>
								<td>{{$row->parent_id}}</td>
								<td>
                                        <a href="{{url('menu-item/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="5" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('menu-item/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-info btn-darken-2" @if($userguideInit==1) data-step="6" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
                                </div>
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
</div>

</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])