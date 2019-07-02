@extends('apps.layout.master')
@section('title','Department')
@section('content')
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
<section id="file-exporaat">
		<div class="row">
		<div class="col-md-6" @if($userguideInit==1) data-step="1" data-intro="you can added/modify new department." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-user-plus"></i> Edit Department
						@else
						<i class="icon-user-plus"></i> Add New Department
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
							action="{{url('Department/modify/'.$dataRow->id)}}"
						@else
							action="{{url('Department/save')}}"
						@endif
						>

							{{ csrf_field() }}

							<div class="form-body">
								
								<div class="form-group">
									<label for="eventRegInput1">Name <span class="text-danger">*</span></label>
									<input type="text" 
									@if(isset($edit))
										value="{{$dataRow->name}}" 
									@endif 
									 id="eventRegInput1" class="form-control border-primary" placeholder="Department Name" name="name">
								</div>							
							</div>

							<div class="form-actions center">
								<button type="button" class="btn btn-warning mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-primary" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
									<i class="icon-check2"></i> Save
								</button>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6" @if($userguideInit==1) data-step="4" data-intro="You are seeing all department list in this table." @endif>
			<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Department List</h4>
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
								<th style="width: 100px;">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($role))
							@foreach($role as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>
                                        <a href="{{url('Department/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="5" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('Department/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-danger" @if($userguideInit==1) data-step="6" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
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


</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])