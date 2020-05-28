@extends('apps.layout.master')
@section('title','Warranty batch Out')
@section('content')
<section id="form-action-layouts">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the warranty inventory report in this table." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Warranty Inventory Report</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<form method="post" action="{{url('warranty/save')}}" class="form form-horizontal striped-labels form-bordered">
					{{csrf_field()}}
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
		                    	<th width="100">WARRANTY INVENTORY ID</th>
		                    	<th width="200">INVOICE ID</th>
		                    	<th width="200">WARRANTY DATE</th>
		                        <th width="30%">OLD PRODUCT</th>
		                        <th width="30%">NEW PRODUCT</th>
							</tr>
						</thead>
						<tbody id="ShoppingCartList">
							<?php //print_r($cartData)?>
							@if(isset($dataTable))
								<?php $sl=1; ?>
								@foreach($dataTable as $cat)
									<tr id="row_<?=$cat->id?>">
										<td width="100" class="sl">{{$sl}}</td>
										<td width="100"><?=$cat->invoice_id?></td>
										<td width="100"><?=$cat->warranty_date?></td>
										<td>
											{{$cat->old_product_html}}
											<input type="hidden" name="old_pid[]" class="old_pid" value="{{$cat->old_product_id}}">
											<input type="hidden" name="invoice_id[]" class="invoice_id" value="{{$cat->invoice_id}}">
											<input type="hidden" name="warranty_date[]" class="warranty_date" value="{{$cat->warranty_date}}">
											<input type="hidden"  class="new_pid" name="new_pid[]" value="{{$cat->new_product_id}}">
											<input type="hidden" name="old_product_name[]"   class="old_product_name"  value="{{$cat->old_product_html}}">
											<input type="hidden"  class="new_product_name"  name="new_product_name[]" value="{{$cat->new_product_html}}">
										</td>
										<td>{{$cat->new_product_html}}</td>
									</tr>
									<?php $sl++; ?>
								@endforeach
							@endif
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" align="right" style="text-align: right;"> Total Product in Batch for Replace = <span id="batchQuantity"><?=count($dataTable)?></span> </th>
							</tr>
							<tr>
								<th colspan="5" align="center" style="text-align: center;" @if($userguideInit==1) data-step="2" data-intro="Please click here for batch out warranty." @endif> 
									<button type="submit" class="btn btn-info">
										<i class="icon-plus"></i> Batch Out Warranty
									</button>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->
	



</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">

</script>
@endsection