@extends('apps.layout.master')
@section('title','Warranty Product')
@section('content')
<section id="form-action-layouts">

<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<div class="row">
		<div class="offset-md-1 col-md-9" @if($userguideInit==1) data-step="1" data-intro="You can create new warranty." @endif>
			<div class="ShowMessage"></div>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right"><i class="icon-cart31"></i> Warranty Product</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<?php /*method="post" action="{{url('warranty/save')}}" */ ?>
						<form class="form form-horizontal striped-labels form-bordered">
							<div class="form-body">
								
								<div class="form-group row">
	                            	<label class="col-md-4 label-control" for="projectinput1">Select old product to replace </label>
		                            <div class="col-md-8">
		                            	<select class="select2 form-control" name="ex_product_id">
											<option value="0">Select old product to replace</option>
											@if(isset($dataInvoiceProduct))
												@foreach($dataInvoiceProduct as $pro)
													<option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
												@endforeach
											@endif
										</select>
		                            </div>
		                        </div>
		                        <div class="form-group row">
	                            	<label class="col-md-4 label-control" for="projectinput1">Select New product to replace </label>
		                            <div class="col-md-8">
		                            	<select class="select2 form-control" name="new_product_id">
														<option value="0" data-quantity="0">Select new product to replace</option>
												@if(isset($dataProduct))
													@foreach($dataProduct as $pro)
														<option value="{{$pro->id}}" data-quantity="{{$pro->quantity}}">{{$pro->name}}</option>
													@endforeach
												@endif
										</select>
		                            </div>
		                        </div>	
								<div class="form-actions center">
									
									<button type="button" class="btn btn-info add_in_batch" @if($userguideInit==1) data-step="2" data-intro="When you select the old product to the new product then click save button." @endif>
										<i class="icon-plus"></i> Save
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
<?php /*<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Warranty Batch Out</h4>
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
					<input type="hidden" name="invoice_id" value="{{$dataTable->invoice_id}}">
					<input type="hidden" name="invoice_uid" value="{{$dataTable->id}}">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
		                    	<th width="100">SL.NO</th>
		                    	<th width="200">Invoice ID</th>
		                    	<th width="200">Warranty Date</th>
		                        <th width="30%">Old Product</th>
		                        <th width="30%">New Product</th>
								<th>Remove</th>
							</tr>
						</thead>

						<tbody id="ShoppingCartList">
							<?php //print_r($cartData)?>
							@if(isset($cartData))
								<?php $sl=1; ?>
								@foreach($cartData as $cat)
									<?php 
										$time=time();
									?>
									<tr id="row_<?=$time.$cat['old_product_id']?>">
										<td width="100" class="sl">{{$sl}}</td>
										<td width="100"><?=$dataTable->invoice_id?></td>
										<td width="100"><?=date('Y-m-d')?></td>
										<td>
											{{$cat['old_product_html']}}
											<input type="hidden" name="old_pid[]" class="old_pid" value="{{$cat['old_product_id']}}">
											<input type="hidden"  class="new_pid" name="new_pid[]" value="{{$cat['new_product_id']}}">
											<input type="hidden" name="old_product_name[]"   class="old_product_name"  value="{{$cat['old_product_html']}}">
											<input type="hidden"  class="new_product_name"  name="new_product_name[]" value="{{$cat['new_product_html']}}">
										</td>
										<td>{{$cat['new_product_html']}}</td>
										<td><button type="button" data-id="{{$cat['old_product_id']}}" class="btn btn-sm btn-danger close-row" onclick="removeRowCart(<?=$time.$cat['old_product_id']?>)"><i class="icon-cross"></i></button></td>
									</tr>
									<?php $sl++; ?>
								@endforeach
							@endif
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" align="right" style="text-align: right;"> Total Product in Batch for Replace = <span id="batchQuantity"><?=count($cartData)?></span> </th>
								<th></th>
							</tr>
							<tr>
								<th colspan="6" align="center" style="text-align: center;"> 
									<button type="submit" class="btn btn-primary">
										<i class="icon-plus"></i> Save Batch Out Warranty
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
</div> */ ?>
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

	function loadingOrProcessing(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;

    }

    function warningMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function successMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

	$(document).ready(function(){

		$(".add_in_batch").click(function(){
			var old_product=$("select[name=ex_product_id]").val();
			var new_product=$("select[name=new_product_id]").val();
			//console.log(old_product,new_product);

			if(old_product.length==0)
			{
				$(".ShowMessage").html(warningMessage("Please Select Old Product For Replace."));
				return false;
			}
			if(old_product==0)
			{
				$(".ShowMessage").html(warningMessage("Please Select Old Product For Replace."));
				return false;
			}

			if(new_product.length==0)
			{
				$(".ShowMessage").html(warningMessage("Please Select New Product For Replace."));
				return false;
			}
			if(new_product==0)
			{
				$(".ShowMessage").html(warningMessage("Please Select New Product For Replace."));
				return false;
			}

			var old_product_html=$("select[name=ex_product_id] option[value="+old_product+"]").html();
			var new_product_html=$("select[name=new_product_id] option[value="+new_product+"]").html();


			$("select[name=ex_product_id] option[value="+old_product+"]").remove();


			var timeStamp = Math.floor(Date.now() / 1000);

			var StrInputField='<input type="hidden" name="old_pid[]" class="old_pid" value="'+old_product+'"><input type="hidden"  class="new_pid" name="new_pid[]" value="'+new_product+'"><input type="hidden" name="old_product_name[]"   class="old_product_name"  value="'+old_product_html+'"><input type="hidden"  class="new_product_name"  name="new_product_name[]" value="'+new_product_html+'">';


			strString='<tr id="row_'+timeStamp+'"><td width="100" class="sl">1</td><td width="100"><?=$dataTable->invoice_id?></td><td width="100"><?=date('Y-m-d')?></td><td>'+old_product_html+' '+StrInputField+' </td><td>'+new_product_html+'</td><td><button type="button" data-id="'+old_product+'" class="btn btn-sm btn-danger close-row" onclick="removeRowCart('+timeStamp+')"><i class="icon-cross"></i></button></td></tr>';


			//$("#ShoppingCartList").append(strString);
			//genarateSL();
			$(".ShowMessage").html(loadingOrProcessing("Processing please wait...."));
			var postURL="{{url('warranty/cart/add/'.$dataTable->invoice_id)}}";
			$.post(postURL,{'old_product':old_product,'new_product':new_product,'_token':'<?=csrf_token()?>'},function(retData){
				if(retData==1)
				{
					$(".ShowMessage").html(successMessage("Saved to warranty inventory successfully."));
				}
				else
				{
					$(".ShowMessage").html(warningMessage("Failed, Please try again."));
				}
			});

		});



		$("select[name=new_product_id]").change(function(){
			var new_product_id=$(this).val();
			var new_product_quantity=$("select[name=new_product_id] option[value="+new_product_id+"]").attr('data-quantity');
			var new_product_text=$("select[name=new_product_id] option[value="+new_product_id+"]").html();
			if(new_product_quantity==0)
			{
				var new_default_text=$("select[name=new_product_id] option[value=0]").html();
				$("select[name=new_product_id] option[value=0]").attr("selected","selected");
				var new_selected_id=$("select[name=new_product_id] option[value=0]").parent().parent().children('span').children('span').children('span').children('span').attr('id');

				$("#"+new_selected_id).html(new_default_text);
				$("#"+new_selected_id).attr('title',new_default_text);
				
				alert('Product '+new_product_text+' Quantity Not Available For Replace Warranty.');
			}
			//console.log(new_product_id);
		});
	});


	function removeRowCart(cartID)
	{

		var old_pid=$("#row_"+cartID).find('td:eq(3)').children(".old_pid").val();
		var old_html=$("#row_"+cartID).find('td:eq(3)').children(".old_product_name").val();
		var optionHTML='<option value="'+old_pid+'">'+old_html+'</option>';
		$("select[name=ex_product_id]").append(optionHTML);
		$('#row_'+cartID).fadeOut();
		$('#row_'+cartID).remove();
		genarateSL();
		var postURL="{{url('warranty/cart/del/'.$dataTable->invoice_id)}}";
		$.post(postURL,{'old_product':old_pid,'_token':'<?=csrf_token()?>'},function(retData){
			console.log(retData);
		});
	}

	function genarateSL()
	{	
		var totalQuantity=0;
		var total=$('.sl').size();
		if(total)
		{
			$('.sl').each(function(index){
				
				$(this).html((index-0)+(1-0));
				totalQuantity+=1;
			});
		}

		$("#batchQuantity").html(totalQuantity);

	}
</script>
@endsection