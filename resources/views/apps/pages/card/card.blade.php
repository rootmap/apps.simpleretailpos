@extends('apps.layout.master')
@section('title','Card Info')
@section('content')
<!-- Card start -->
<section class="createCard" id="createCard">
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					@if(isset($dataRow))
					<h4 class="card-title">Edit Card</h4>
					@else
					<h4 class="card-title">Card</h4>
					@endif
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="reload"><i class="icon-reload"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
							<li><a data-action="close"><i class="icon-cross2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						
						<div class="row">
							<div class="col-xl-6 col-lg-12">
								<div class='card-wrapper'></div>
							</div>
							<div class="col-xl-6 col-lg-12">


								<form  class="card-form" method="post"

								@if(isset($dataRow))
								action="{{url('card/update/'.$dataRow->id)}}"
								@else
								action="{{url('card/save')}}"
								@endif
								>
								

								<fieldset class="mb-1">
									<h5>Card Number</h5>
									<div class="form-group">
										<input 
											 @if(isset($dataRow))
                                        value="{{$dataRow->card_number}}" 
                                        @endif
										 type="text" class="form-control card-number" name="number" id="card-number" maxlength="19" placeholder="Card Number">
										 <input type="hidden" name="cardinfo" value="VISA">
									</div>
								</fieldset>
								<fieldset class="mb-1">
									<h5>Card Name</h5>
									<div class="form-group">
										<input
										 @if(isset($dataRow))
                                        value="{{$dataRow->card_name}}" 
                                        @endif

										 type="text" class="form-control card-name" name="name" id="card-name" placeholder="Card Holder Name">
									</div>
								</fieldset>
								<div class="row">
									<div class="col-md-6">
										<fieldset class="mb-1">
											<h5>Expiry Date</h5>
											<div class="form-group">
												<input
												 @if(isset($dataRow))
                                        value="{{$dataRow->expriy_date}}" 
                                        @endif

												 type="text" class="form-control card-expiry" name="expiry" id="card-expiry" placeholder="Card Expiry Date">
											</div>
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset class="mb-1">
											<h5>Card pin Number</h5>
											<div class="form-group">
												<input
													 @if(isset($dataRow))
                                        value="{{$dataRow->pin_number}}" 
                                        @endif


												 type="text" class="form-control card-cvc" name="pin_cvc" id="card-cvc" maxlength="16" placeholder="Card CVC Number">
											</div>
										</fieldset>
									</div>
								</div>
								<div class="form-actions center">
									<button type="button" class="btn btn-warning mr-1">
										<i class="icon-cross2"></i> Cancel
									</button>
									@if(isset($dataRow))
									<button type="submit" class="btn btn-primary">
										<i class="icon-check2"></i> Update
									</button>
									@else
									<button type="submit" class="btn btn-primary">
										<i class="icon-check2"></i> Save
									</button>
									@endif
								</div>
								<input type="hidden" name="_token" value="{{csrf_token()}}">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!-- Card end -->

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/forms/extended/form-extended.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/extended/card/jquery.card.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-typeahead.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-formatter.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-card.min.js')}}" type="text/javascript"></script>
@endsection