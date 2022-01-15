@extends('apps.layout.master')
@section('title','Profit Report')
@section('content')
<section id="form-action-layouts">
	<?php 
        $userguideInit=StaticDataController::userguideInit();
        //dd($dataMenuAssigned);
    ?>
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see profit report by date wise or invoice or customer and generate excel or PDF." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Profit Report Filter</h4>
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
						<form method="post" action="{{url('profit/report')}}">
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
	                                    <h4>Invoice ID</h4>
	                                    <div class="input-group">
										<input 
										 @if(!empty($invoice_id))
	                                        	value="{{$invoice_id}}"  
	                                     @endif 
										 type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="invoice_id">
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <h4>Customer</h4>
	                                    <div class="input-group">
											<select name="customer_id" class="select2 form-control">
												<option value="">Select a customer</option>
												@if(isset($customer))
													@foreach($customer as $cus)
													<option 
													 @if(!empty($customer_id) && $customer_id==$cus->id)
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
											<a href="javascript:void(0);" data-url="{{url('profit/excel/report')}}" class="btn btn-info btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('profit/pdf/report')}}" class="btn btn-info btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('profit/report')}}" style="margin-left: 5px;" class="btn btn-info btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
												<i class="icon-refresh"></i> Reset
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


	<?php 
	$invoice_total=0;
	$cost_total=0;
	$profit_total=0;
	?>
	@if(isset($invoice))
		@foreach($invoice as $inv)
		<?php 
			$invoice_total+=$inv->total_amount;
			$cost_total+=$inv->total_cost;
			$profit_total+=$inv->total_profit;
		?>
        @endforeach
	@endif


<div class="col-lg-4 col-sm-12 border-right-pink bg-info bg-lighten-1 border-right-lighten-4">
            <div class="card-block text-xs-center">
                <h1 class="display-4 white"><i class="icon-cart font-large-2"></i> ${{$invoice_total}}</h1>
                <span class="white">Total Invoice</span>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 bg-info bg-lighten-2 border-right-pink border-right-lighten-4">
            <div class="card-block text-xs-center">
                <h1 class="display-4 white"><i class="icon-trending_up font-large-2"></i> ${{$cost_total}}</h1>
                <span class="white">Total Cost</span>
            </div>
        </div>
        
        <div class="col-lg-4 bg-info bg-lighten-3 col-sm-12">
            <div class="card-block text-xs-center">
                <h1 class="display-4 white"><i class="icon-banknote font-large-2"></i> ${{$profit_total}}</h1>
                <span class="white">Profit</span>
            </div>
        </div>
	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="6" data-intro="You are seeing your profit list by search." @endif>

		

		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Profit List</h4>
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
								<th>INVOICE ID</th>
								<th>INVOICE DATE</th>
								<th>SOLD TO</th>
								<th>INVOICE TOTAL AMOUNT</th>
								<th>TOTAL COST AMOUNT</th>
								<th>PROFIT</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($invoice))
								@foreach($invoice as $inv)
								<tr>
	                                <td>{{$inv->invoice_id}}</td>
	                                <td>{{date('Y-m-d',strtotime($inv->created_at))}}</td>
	                                <td>{{$inv->customer_name}}</td>
	                                <td>{{$inv->total_amount}}</td>
	                                <td>{{$inv->total_cost}}</td>
	                                <td>{{$inv->total_profit}}</td>
	                            </tr>
	                            @endforeach
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