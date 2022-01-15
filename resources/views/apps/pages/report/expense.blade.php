@extends('apps.layout.master')
@section('title','Expense Voucher Report')
@section('content')
<section id="form-action-layouts">
	<?php 
        $userguideInit=StaticDataController::userguideInit();
        //dd($dataMenuAssigned);
    ?>
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see expense voucher by date wise or expense head and generate excel or PDF." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Expense Voucher Report Filter</h4>
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
						<form method="post" action="{{url('expense/voucher/report')}}">
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
	                                <div class="col-md-3">
	                                    <h4>Expense Head</h4>
	                                    <div class="input-group">
											<select name="expense_id" class="select2 form-control">
												<option value="">Select a Expense Head</option>
												@if(isset($expenseHead))
													@foreach($expenseHead as $cus)
													<option 
													 @if(!empty($expense_id) && $expense_id==$cus->id)
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
											<a href="javascript:void(0);" data-url="{{url('expense/voucher/excel/report')}}" class="btn btn-info btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('expense/voucher/pdf/report')}}" class="btn btn-info btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('expense/voucher/report')}}" style="margin-left: 5px;" class="btn btn-info btn-accent-4 mr-1" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
												<i class="icon-refresh"></i> Reset
											</a>
											<a href="{{url('expense/voucher')}}" class="btn btn-info btn-darken-4 mr-1" @if($userguideInit==1) data-step="6" data-intro="if you want create new expense voucher then click this button." @endif>
												<i class="icon-plus"></i> Create Expense Voucher
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
	<div class="col-xs-12" @if($userguideInit==1) data-step="7" data-intro="You are seeing your expense voucher by search." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Expense Voucher List</h4>
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
								<th>Voucher ID</th>
								<th>Expense Head</th>
								<th>Expense DATE</th>
								<th>Description</th>
								<th>Expense AMOUNT</th>
								<th>Created at</th>
							</tr>
						</thead>
						<tbody>
							
							@if(isset($invoice))
								@foreach($invoice as $inv)
								<tr>
	                                <td>{{$inv->id}}</td>
	                                <td>{{$inv->expense_name}}</td>
	                                <td>{{date('Y-m-d',strtotime($inv->expense_date))}}</td>
	                                <td>{{$inv->expense_description}}</td>
	                                <td>{{$inv->expense_amount}}</td>
	                                <td>{{date('Y-m-d',strtotime($inv->created_at))}}</td>
	                            </tr>
	                            
	                            @endforeach
							@endif

						</tbody>
					</table>
				</div>
			</div>
		</div>




						{{-- <div class="col-lg-4 col-sm-12 border-right-pink bg-pink border-right-lighten-4">
                            <div class="card-block text-xs-center">
                                <h1 class="display-4 white"><i class="icon-cart font-large-2"></i> ${{$invoice_total}}</h1>
                                <span class="white">Total Invoice</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 bg-red border-right-pink border-right-lighten-4">
                            <div class="card-block text-xs-center">
                                <h1 class="display-4 white"><i class="icon-trending_up font-large-2"></i> ${{$cost_total}}</h1>
                                <span class="white">Total Cost</span>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 bg-green col-sm-12">
                            <div class="card-block text-xs-center">
                                <h1 class="display-4 white"><i class="icon-banknote font-large-2"></i> ${{$profit_total}}</h1>
                                <span class="white">Profit</span>
                            </div>
                        </div> --}}



	</div>
</div>
<!-- Both borders end -->





</section>
@endsection


@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])