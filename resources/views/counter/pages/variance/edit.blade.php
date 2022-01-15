@extends('apps.layout.master')
@section('title','Calculate Variance')
@section('content')
<section id="form-action-layouts">
	<div class="row match-height">


		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right"><i class="icon-tab"></i> Modify Quantity in hand for each item</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<form method="post" class="form form-horizontal striped-labels form-bordered" action="{{url('variance/modify/'.$invoice->id)}}">
	                    	<div class="form-body">
	                    		
	                    		{{ csrf_field() }}
	                    		@if(isset($invoice_product))
		                    		@foreach($invoice_product as $row)
					                    <div class="form-group row">
			                            	<label class="col-md-3 label-control" for="projectinput1">{{$row->product_name}}</label>
				                            <div class="col-md-9">
				                            	<input type="hidden" name="pid[]" value="{{$row->product_id}}">
				                            	<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity | Leave it empty if you dont want it on variance report." value="{{$row->quantity_in_hand}}" name="quantity[]">
				                            </div>
				                        </div>
			                        @endforeach
		                        @endif
		                        
	                        <div class="form-actions right">
								<button type="button" class="btn btn-warning mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Update
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