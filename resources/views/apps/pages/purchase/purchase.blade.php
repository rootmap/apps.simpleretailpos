@extends('apps.layout.master')
@section('title','Purchase')
@section('content')
<section id="form-action-layouts">

<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>
	<div class="row">
	    <div class="col-md-12" id="addingMessageArea"></div>
	    <div class="clearfix"></div>
	    
		
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right"><i class="icon-upload3"></i> Add New Purchase</h4>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">

					<form class="form">
							<div class="form-body">
							    <div class="col-md-3">
							        <div class="form-group">
										
										<label for="userinput2">Your Barcode</label>
										<div class="input-group">
											<input type="text" name="barcode" autocomplete="off" class="form-control" placeholder="Enter Barcode">
											<span class="input-group-addon" id="checkBarcode" style="cursor:pointer;"><i class="icon-barcode"></i> Check Barcode</span>
										</div>
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="form-group" style="padding-right:10%;">
										<label for="userinput1">Product Name</label>
										<select name="pid" class="select2 form-control">
											@if(isset($productData))
												@foreach($productData as $pro)
												<option data-price="{{$pro->price}}" value="{{$pro->id}}">
													{{$pro->barcode}} - {{$pro->name}}
												</option>
												@endforeach
											@endif
										</select>
										<input style="display: none;" type="text" name="product_name" autocomplete="off" class="form-control" placeholder="Enter new product name">
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="form-group" style="padding-right:10%;">
										<label for="userinput1">Category</label>
										<select name="cid" class="select2 form-control">
											<option value="0">Select Category</option>
											@if(isset($catData))
												@foreach($catData as $pro)
												<option value="{{$pro->id}}">{{$pro->name}}</option>
												@endforeach
											@endif
											
										</select>
										
									</div>
							    </div>
							    <div class="col-md-3">
							        <div class="form-group">
										<label for="userinput2">Purchase Price</label>
										<input type="text" name="purchase_price" class="form-control"  value="0">
									</div>
								</div>
														    <div class="clearfix"></div>
							    <div class="col-md-3">
							        <div class="form-group">
										<label for="userinput2">Sell Price</label>
										<input type="text" name="sell_price" class="form-control"  value="0">
									</div>
							    </div>
							    
	
							    
							    <div class="col-md-2">
							        <div class="form-group">
										<label for="userinput2">Quantity To Add</label>
										<input type="number" name="quantity" class="form-control" id="number" value="0">
									</div>
							    </div>
							    <div class="col-md-2">
							        <div class="form-group">
										<label for="userinput2">Quantity In System</label>
										<input type="number" disabled="disabled" name="systemquantity" class="form-control" id="number" value="0">
									</div>
							    </div>
							    <div class="col-md-5">
							        <div class="form-group">
										<label for="userinput2"></label>
										<h4></h4>
										<button type="button" id="addCart" class="btn btn-info">
											<i class="icon-plus"></i> Add to cart
										</button>
										<a href="{{url('purchase')}}" class="btn btn-info btn-accent-2">
											<i class="icon-table"></i> Back To Purchase List
										</a>
									</div>
							    </div>
									
									
									
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Both borders end-->
	<form class="form" action="{{url('product/purchase/confirm')}}" method="post">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title"><i class="icon-upload22"></i> New Purchase Item List</h4>
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
										<th>Barcode</th>
										<th>Product Name</th>
										<th>Purchase Cost</th>
										<th>Sell Price</th>
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
					<button type="submit" class="btn btn-info btn-accent-3">
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
		$('input[name=barcode]').keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				//alert('You pressed a "enter" key in textbox');  
				loadBarcodeITem();
			}
		});

		$("#checkBarcode").click(function(){
			loadBarcodeITem();
		});
	});

    function dismissNotification()
    {
        setTimeout(function(){ $('.alert').hide(); }, 3000);
    }
    
    function loadingOrProcessing(sms)
    {
        dismissNotification();
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;
            
            

    }

    function warningMessage(sms)
    {
        dismissNotification();
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
        dismissNotification();
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }
	var productJson=<?=json_encode($productData)?>;
	function loadBarcodeITem()
	{
	    $("#addingMessageArea").html(loadingOrProcessing("Checking barcode..."));
	    var barcode=$("input[name=barcode]").val();
	    if(barcode.length>2)
	    {
	    	var found=0;
	        $.each(productJson,function(key,row){
	            if(row.barcode.toLowerCase()==barcode.toLowerCase())
	            {
					$('input[name=product_name]').hide();
					$('select[name=pid]').next(".select2-container").show();
				

	            	found=1;
	            	$("input[name=systemquantity]").val(row.quantity);
	            	$("input[name=barcode]").val(row.barcode);
	                var getOldSelected=$("select[name=pid]").val();
	                if(getOldSelected==row.id)
	                {
	                   var exQuantity=$("input[name=quantity]").val();
	                   var NewQuantity=(exQuantity-0)+(1-0);
	                   $("input[name=quantity]").val(NewQuantity);
	                   $("#addingMessageArea").html(successMessage("Product added in list with "+NewQuantity+" quantity successfully."));
	                }
	                else
	                {
	                    $("#addingMessageArea").html(successMessage("Product added in list with 1 quantity successfully."));
	                    $("input[name=quantity]").val(1);
    	                $("input[name=purchase_price]").val(row.cost);
    	                $("input[name=sell_price]").val(row.price);
    	                $("select[name=pid] option[value="+row.id+"]").attr('selected',true).trigger('change');
						$("select[name=cid] option[value="+row.category_id+"]").attr('selected',true).trigger('change');
	                }

					$("#addCart").click();
	            }
	        });

	        if(found==0)
	        {
				$('select[name=pid]').next(".select2-container").hide();
				$('input[name=product_name]').show();
				$('input[name=product_name]').focus();

	        	$("#addingMessageArea").html(warningMessage("No product found on this barcode."));
	        }
	    }
	    else
	    {
	    	$("#addingMessageArea").html(warningMessage("Please enter a valid barcode."));
	    }
	    console.log(barcode);
	    return false;
	}
	
	$(document).ready(function(){
	    
	    $("input[name=barcode]").focus();
	    
	    
	    
		var productQ=[];
		$("#addCart").click(function(){
			var pid=$("select[name=pid]").val();
			var cid=$("select[name=cid]").val();
			var quantity=$("input[name=quantity]").val();
			var price=$("select option[value="+pid+"]").attr("data-price");
			var product_name=$("select option[value="+pid+"]").html();
			var barcode=$("input[name=barcode]").val();
			var purchase_price=$("input[name=purchase_price]").val();
    	    var sell_price=$("input[name=sell_price]").val();

			//alert(price);

			if(cid==0)
			{
				alert('Please select category.');
				return false;
			}

			if(cid.length==0)
			{
				alert('Please select category.');
				return false;
			}

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

			var product_name=$("select option[value="+pid+"]").html();
			var fonPro=0;
	        $.each(productJson,function(key,row){
	            if(row.barcode.toLowerCase()==barcode.toLowerCase())
	            {
					fonPro=1;
				}
			});

			if(fonPro==0)
			{
				pid=0;
				product_name=$("input[name=product_name]").val();
			}
			else
			{
				if(pid==0)
				{
					alert('Please select product or enter barcode.');
					return false;
				}

				if(cid==0)
				{
					alert('Please select category.');
					return false;
				}
			}

			var barcExists=0;
			var roeID='';
			$.each($("#ShoppingCartList").children('tr'),function(key,row){
				var exbarcode=$(row).children('td:eq(1)').html();
				var curroeID=$(row).attr('id');
				if(exbarcode==barcode)
				{
					barcExists=1;
					roeID=curroeID;
				}
			});

			if(barcExists==1)
			{
				//alert(roeID);
				var exQuan=parseInt($("#"+roeID).children('td:eq(5)').html())+parseInt(quantity);
				$("#"+roeID).children('td:eq(5)').html(exQuan);
				$("#"+roeID).children('td:eq(2)').children('input:eq(4)').val(exQuan);
			}
			else
			{
				var timeStamp = Math.floor(Date.now() / 1000);
				var StrInputField='<input type="hidden" name="sell_price[]" value="'+sell_price+'"><input type="hidden" name="purchase_price[]" value="'+purchase_price+'"><input type="hidden" name="pid[]" value="'+pid+'"><input type="hidden" name="barcode[]" value="'+barcode+'"><input type="hidden" name="quantity[]" value="'+quantity+'"><input type="hidden" name="name[]" value="'+product_name+'"><input type="hidden" name="price[]" value="'+price+'"><input type="hidden" name="cid[]" value="'+cid+'">';
				strString='<tr id="row_'+timeStamp+'"><td width="100" class="sl">'+pid+'</td><td>'+barcode+'</td><td>'+product_name+' '+StrInputField+' </td><td width="150">'+purchase_price+'</td><td width="150">'+sell_price+'</td><td width="150">'+quantity+'</td><td width="50"><button type="button" data-id="'+pid+'" class="btn btn-sm btn-danger close-row" onclick="removeRowCart('+timeStamp+')"><i class="icon-cross"></i></button></td></tr>';
				$("#ShoppingCartList").append(strString);
			}
			
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