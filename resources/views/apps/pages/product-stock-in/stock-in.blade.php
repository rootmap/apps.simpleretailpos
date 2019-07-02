@extends('apps.layout.master')
@section('title','Stock in Product')
@section('content')
<section id="form-action-layouts">

<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="In this section, you can add a new stock under a product" @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right"><i class="icon-upload3"></i> Add New Stock</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">

						<form class="form">
							<div class="form-body">
							
									<div class="form-group">
										<label for="userinput1">Product Name</label>
										<select name="pid" class="select2 form-control">
											@if(isset($productData))
												@foreach($productData as $pro)
												<option data-price="{{$pro->price}}" value="{{$pro->id}}">
													{{$pro->name}}
												</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="form-group">
										<label for="userinput2">Quantity To Add</label>
										<input type="number" name="quantity" class="form-control" id="number" value="1">
									</div>
									<div class="form-group">
										
										<button type="button" id="addCart" class="btn btn-info btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you click this button then product add to shopping cart." @endif>
											<i class="icon-plus"></i> Add to cart
										</button>
									</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Both borders end-->
	<form class="form" action="{{url('product/stock/in/confirm')}}" method="post">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-xs-12" @if($userguideInit==1) data-step="3" data-intro="You are seeing all the new inventory list in this table. You can delete option." @endif>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="icon-upload22"></i> New Inventory List</h4>
						<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
						<div class="heading-elements">
							<ul class="list-inline mb-0">
								<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
								<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="card-body collapse in">
						<!-- <div class="card-block card-dashboard">
							<p class="card-text">Example of table having both column & row borders. Add <code>.table-bordered</code> class with <code>.table</code> for both borders table.</p>
						</div> -->
						<div class="table-responsive">
							<table class="table table-bordered mb-0">
								<thead>
									<tr>
										<th width="100">SL</th>
										<th>Product Name</th>
										<th width="150">Est.Quantity</th>
										<th width="50">Action</th>
									</tr>
								</thead>
								<tbody id="ShoppingCartList">
									
								</tbody>
								<tfoot>
									<tr>
										<th style="font-weight: bolder; text-align: right;" colspan="2" align="right">Total Quantity</th>
										<th style="font-weight: bolder;" id="shoppingCartQuantityTotal">0</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
								
					</div>

				</div>
			</div>
		</div>
		<!-- Both borders end -->

		<!-- Invoice Footer -->
		<div id="invoice-footer">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-xs-center">
					<button type="submit" class="btn btn-info btn-accent-3" @if($userguideInit==1) data-step="4" data-intro="When you click this button then it will go to next step." @endif>
						<i class="icon-point-right"></i>  Proceed 
					</button>
				</div>
			</div>
		</div>
		<!--/ Invoice Footer -->
	</form>

</div>
</div>
</div>
</div>
</div>






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
	$(document).ready(function(){
		var productQ=[];
		$("#addCart").click(function(){
			var pid=$("select[name=pid]").val();
			var quantity=$("input[name=quantity]").val();
			var price=$("select option[value="+pid+"]").attr("data-price");
			var product_name=$("select option[value="+pid+"]").html();

			//alert(price);

			if(quantity.length==0)
			{
				alert('Please type quantity.');
				return false;
			}
			if(quantity==0)
			{
				alert('Please type quantity.');
				return false;
			}

			var timeStamp = Math.floor(Date.now() / 1000);

			var StrInputField='<input type="hidden" name="pid[]" value="'+pid+'"><input type="hidden" name="quantity[]" value="'+quantity+'"><input type="hidden" name="name[]" value="'+product_name+'"><input type="hidden" name="price[]" value="'+price+'">';


			strString='<tr id="row_'+timeStamp+'"><td width="100" class="sl">'+pid+'</td><td>'+product_name+' '+StrInputField+' </td><td width="150">'+quantity+'</td><td width="50"><button type="button" data-id="'+pid+'" class="btn btn-sm btn-danger close-row" onclick="removeRowCart('+timeStamp+')"><i class="icon-cross"></i></button></td></tr>';

			$("#ShoppingCartList").append(strString);
			genarateSL();

		});

	});


	function removeRowCart(cartID)
	{
		$('#row_'+cartID).fadeOut();
		$('#row_'+cartID).remove();
		genarateSL();
	}

	function genarateSL()
	{	
		var totalQuantity=0;
		var total=$('.sl').size();
		if(total)
		{
			$('.sl').each(function(index){
				
				$(this).html((index-0)+(1-0));
				var rowtotal=$(this).parent('tr').find('td:eq(2)').html();
				totalQuantity+=(rowtotal-0);
			});


		}

		$("#shoppingCartQuantityTotal").html(totalQuantity);

	}

</script>

@endsection