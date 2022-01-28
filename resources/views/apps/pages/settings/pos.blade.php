@extends('apps.layout.master')
@section('title','POS Setting')
@section('content')
<section id="form-action-layouts">
	<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<div class="row">
		<div class="col-md-8 offset-md-2" @if($userguideInit==1) data-step="1" data-intro="You can change POS setting like (POS display item, sale tax rate, discount, discount type and select invoice email layout)." @endif>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">POS Setting</h4>
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
						@if(isset($ps))
							action="{{url('pos/settings/update/'.$ps->id)}}" 
						@else 
							action="{{url('pos/settings/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">POS Display Item</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="POS Display Item" 
											@if(isset($ps))
												value="{{$ps->pos_item}}"  
											@endif 
											 name="pos_item">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Virtual Terminal Item</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Default item Name" 
											@if(isset($ps))
												value="{{$ps->vt_item_name}}"  
											@endif 
											 name="vt_item_name">
											 <code> Default Item Name For Virtual Terminal</code>
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Sales Tax Rate (%)</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Sales Tax Rate(%)" 
											@if(isset($ps))
												value="{{$ps->sales_tax}}"  
											@endif 
											 name="sales_tax">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Discount  (%)</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Default Discount" 
											@if(isset($ps))
												value="{{$ps->sales_discount}}"  
											@endif 
											 name="sales_discount">
										</div>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Discount Type</label>
	                        		<div class="col-md-7">
										<select name="discount_type" class="form-control border-primary">
											<option 
											@if(isset($ps))
												@if($ps->discount_type==1)
													selected="selected"  
												@endif
											@endif 
											value="1">Amount</option>
											<option 
											@if(isset($ps))
												@if($ps->discount_type==2)
													selected="selected"  
												@endif
											@endif 
											value="2">Percent %</option>
										</select>
									</div>
		                        </div>
							</div>

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Invoice Layout</label>
	                        		<div class="col-md-7">
										<div class="popup">
											<fieldset class="text-xs-center">
			                                    <label for="radio-i1">
			                                    	<img class="layout_1" data-id="1" src="{{url('images/invoice_layout/a.png')}}" height="100">
			                                    </label>
			                                    <a href="{{url('pos/settings/invoice/1')}}"><i class="icon-edit2"></i> Edit Invoice</a>
			                                    <input style="opacity: 0;" type="radio" name="invoice_layout" id="radio-i1"  value="1"   
			                                    @if(isset($ps))
			                                    	@if($ps->invoice_layout==1)
														 checked="checked" 
													@endif  
												@endif 
			                                    class="jui-ni-radio-buttons">
			                                    <label for="radio-i2">
			                                    	<img class="layout_1" data-id="2"  src="{{url('images/invoice_layout/b.png')}}" height="100">
			                                    </label>
			                                    <a href="{{url('pos/settings/invoice/2')}}"><i class="icon-edit2"></i> Edit Invoice</a>
			                                    <input style="opacity: 0;" type="radio" name="invoice_layout" id="radio-i2" value="2" 
			                                    @if(isset($ps))
			                                    	@if($ps->invoice_layout==2)
														 checked="checked" 
													@endif  
												@endif 
			                                    class="jui-ni-radio-buttons">
			                                </fieldset>
			                            </div>
									</div>
		                        </div>
							</div>





						


							<div class="form-actions center">
	                            <button type="button" class="btn btn-info btn-lighten-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the cancel button." @endif>
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

</section>
@endsection

@section("css")
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/ui/jqueryui.min.css')}}">
@endsection

@section("js")
<script src="{{url('theme/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/ui/jquery-ui/buttons-selects.min.js')}}" type="text/javascript"></script>
@endsection