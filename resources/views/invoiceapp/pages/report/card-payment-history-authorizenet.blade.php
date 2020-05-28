@extends('apps.layout.master')
@section('title','Card Payment History')
@section('content')
<section id="form-action-layouts">



    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i> Card Payment History</h4>
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
	                                <td>{{$row->card_number}}</td>
	                                <td>{{$row->CardType}}</td>
	                                <td>{{$row->transactionID}}</td>
	                                <td>{{$row->paid_amount}}</td>
	                                <td>
	                                	@if($row->refund_status==1)
	                                	<button onclick="refundTransaction({{$row->id}})" type="button" class="btn btn-danger"><i class="icon-moneybag"></i> Refund Amount</button>
	                                	@else
	                                		<button type="button" class="btn btn-success"><i class="icon-moneybag"></i> Refund Complete</button>
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
	</script>
@endsection
@include('apps.include.datatable',['JDataTable'=>1])