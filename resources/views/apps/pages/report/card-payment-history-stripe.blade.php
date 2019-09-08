@extends('apps.layout.master')
@section('title','Card Payment History')
@section('content')
<section id="form-action-layouts">
<?php 
        $userguideInit=StaticDataController::userguideInit();
        //dd($dataMenuAssigned);
    ?>
<div class="row">
	<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see payment history by date wise or invoice or card number and generate excel or PDF." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Stripe - Card Payment History Report Filter</h4>
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
					<form method="post" action="{{url('stripe/payment/history/report')}}">
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
									 type="text" id="eventRegInput1" class="form-control border-info" placeholder="Invoice ID" name="invoice_id">
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <h4>Card Number</h4>
	                                {{-- <div class="input-group">
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
	                                </div> --}}
	                                <div class="input-group">
									<input 
									 @if(!empty($card_number))
	                                    	value="{{$card_number}}"  
	                                 @endif 
									 type="text" id="eventRegInput1" class="form-control border-info" placeholder="Card Number" name="card_number">
	                                </div>
	                            </div>
	                            <div class="col-md-12">
	                                
	                                <div class="input-group" style="margin-top:32px;">
	                                    <button type="submit" class="btn btn-info btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
											<i class="icon-check2"></i> Generate Report
										</button>
										<a href="javascript:void(0);" data-url="{{url('stripe/payment/history/excel/report')}}" class="btn btn-info btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
											<i class="icon-file-excel-o"></i> Generate Excel
										</a>
										<a href="javascript:void(0);" data-url="{{url('stripe/payment/history/pdf/report')}}" class="btn btn-info btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
											<i class="icon-file-pdf-o"></i> Generate PDF
										</a>
										<a href="{{url('stripe/payment/history')}}" style="margin-left: 5px;" class="btn btn-info btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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


    <!-- Both borders end-->
<div class="row" @if($userguideInit==1) data-step="6" data-intro="Card payment all data list will display on below table." @endif>
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i>  Stripe - Card Payment History</h4>
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
                                <th>Invoice ID</th>
                                <th>Payment Date</th>
                                <th>Card Number</th>
                                <th>Card Type</th>
                                <th>Transaction ID</th>
                                <th>Paid Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
	                            @foreach($dataTable as $row)
	                            <tr>
	                                <td>{{$row->id}}</td>
	                                <td>{{$row->invoice_id}}</td>
	                                <td>{{$row->created_at}}</td>
	                                <td>
	                                	{{$row->card_number}}
	                                </td>
	                                <td>{{$row->CardType}}</td>
	                                <td>{{$row->transactionID}}</td>
	                                <td>{{$row->paid_amount}}</td>
	                                <td>
	                                	@if($row->hour_gone>24)
		                                	@if($row->refund_status==1)
		                                	<button onclick="refundTransaction({{$row->id}})" type="button" class="btn btn-info"  @if($userguideInit==1) data-step="7" data-intro="Payment could be refund using click on this button." @endif><i class="icon-moneybag"></i> Refund Amount</button>
		                                	@else
		                                		<button type="button" class="btn btn-info"><i class="icon-moneybag"></i> Refund Complete</button>
		                                	@endif
	                                	@else
		                                	@if($row->refund_status==1)
		                                	<button onclick="VoidTransaction({{$row->id}})" type="button" class="btn btn-info"  @if($userguideInit==1) data-step="7" data-intro="Payment could be refund/void using click on this button." @endif><i class="icon-moneybag"></i> VOID Transaction</button>
		                                	@else
		                                		<button type="button" class="btn btn-green" ><i class="icon-moneybag"></i> VOID Complete</button>
		                                	@endif
	                                	@endif
	                                </td>
	                            </tr>
	                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No Record Found</td>
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
@section('counter-display-js')
	<script type="text/javascript">
		function refundTransaction(id)
		{
			var c=confirm('Are you sure to refund this transaction ?');
			if(c)
			{
				//------------------------Ajax Customer Start-------------------------//
		         var AddHowMowKhaoUrl="{{url('authorize/net/payment/refund')}}";
		         $.ajax({
		            'async': true,
		            'type': "POST",
		            'global': false,
		            'dataType': 'json',
		            'url': AddHowMowKhaoUrl,
		            'data': {'rid':id,'_token':"{{csrf_token()}}"},
		            'success': function (data) {
		            	console.log(data);
		                if(data==1)
		                {
		                	window.location.reload();
		                }
		                else
		                {
		                	alert('Something went wrong, Please try again.');
		                }
		            }
		        });
		        //------------------------Ajax Customer End---------------------------//
			}
		}

		function VoidTransaction(id)
		{
			var c=confirm('Are you sure to void/cancel this transaction ?');
			if(c)
			{
				//------------------------Ajax Customer Start-------------------------//
		         var AddHowMowKhaoUrl="{{url('authorize/net/payment/void')}}";
		         $.ajax({
		            'async': true,
		            'type': "POST",
		            'global': false,
		            'dataType': 'json',
		            'url': AddHowMowKhaoUrl,
		            'data': {'rid':id,'_token':"{{csrf_token()}}"},
		            'success': function (data) {
		            	console.log(data);
		                if(data==1)
		                {
		                	window.location.reload();
		                }
		                else
		                {
		                	alert('Something went wrong, Please try again.');
		                }
		            }
		        });
		        //------------------------Ajax Customer End---------------------------//
			}
		}
	</script>
@endsection
@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])