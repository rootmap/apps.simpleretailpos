@extends('apps.layout.master')
@section('title','Purchase Invoice List')
@section('content')
<section id="form-action-layouts">

<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>  
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Purchase Invoice Report Filter</h4>
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
						<form method="post" action="{{url('purchase')}}">
							{{csrf_field()}}
							<fieldset class="form-group">
	                            <div class="row">
	                                <div class="col-md-3">
	                                    <h4>Start Date</h4>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
	                                        <input 
	                                        @if(!empty($start_date))
	                                        	value="{{$start_date}}"  
	                                        @endif
	                                        name="start_date" type="text" class="form-control DropDateWithformat" />
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <h4>End Date</h4>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
	                                        <input 
	                                        @if(!empty($end_date))
	                                        	value="{{$end_date}}"  
	                                        @endif 
	                                         name="end_date" type="text" class="form-control DropDateWithformat" />
	                                    </div>
	                                </div>
	                                <div class="col-md-2">
	                                    <h4>Purchase Order ID</h4>
	                                    <div class="input-group">
										<input 
										 @if(!empty($order_no))
	                                        	value="{{$order_no}}"  
	                                     @endif 
										 type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="order_no">
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <h4>Vendor</h4>
	                                    <div class="input-group">
											<select name="vendor_id" class="select2 form-control">
												<option value="">Select a vendor</option>
												@if(isset($vendor))
													@foreach($vendor as $cus)
													<option 
													 @if(!empty($vendor_id) && $vendor_id==$cus->id)
				                                        selected="selected"  
				                                     @endif 
													value="{{$cus->id}}">{{$cus->name}}</option>
													@endforeach
												@endif
											</select>
	                                    </div>
	                                </div>
	                                <div class="col-md-12">
	                                    
	                                    <div class="input-group" style="margin-top:32px;">
	                                        <button type="submit" class="btn btn-info btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
												<i class="icon-check2"></i> Generate Report
											</button>
											<a href="javascript:void(0);" data-url="{{url('purchase/excel/report')}}" class="btn btn-info btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('purchase/pdf/report')}}" class="btn btn-info btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('purchase')}}" style="margin-left: 5px;" class="btn btn-info btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
												<i class="icon-refresh"></i> Reset
											</a>
											<a href="{{url('purchase/create')}}" style="margin-left: 5px;" class="btn btn-info btn-darken-4">
												<i class="icon-plus"></i> Create new purchase invoice
											</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </fieldset>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the stock in order list in this table. You see product detail or edit or delete option." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-stack"></i> Purchase Invoice List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="min-height: 360px;">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Invoice Quantity</th>
                                <th>Invoice Cost</th>
                                <th>Supplier / Vendor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->order_no}}</td>
                                <td>{{$row->order_date}}</td>
                                <td>{{$row->total_quantity}}</td>
                                <td>{{number_format($row->total_amount,2)}}</td>
                                <td>{{$row->vendor_name}}</td>
                                <td>
                                    <span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-info dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{url('purchase/receipt/'.$row->id)}}" title="View Detail" class="dropdown-item"><i class="icon-clipboard2"></i> View Detail</a>
                                            <a href="{{url('purchase/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                        </span>
                                    </span>
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

@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])