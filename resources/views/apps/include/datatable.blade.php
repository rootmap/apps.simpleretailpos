
@section('css')
	@if(isset($JDataTable))
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <style type="text/css">
		div.dataTables_length{
				padding-left: 10px;
				padding-top: 15px;
		}

		.dataTables_length>label{
			margin-bottom: 0px !important;
			display:block; !important;
		}

		div.dataTables_filter
		{
			padding-right: 10px;
		}

		div.dataTables_info{
			padding-left: 10px;
		}

		div.dataTables_paginate{
			padding-right: 10px;
			padding-top: 5px;
		}
	</style>
	@endif
	@if(isset($switchery))
	<link rel="stylesheet" type="text/css" href=".{{url('theme/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <style>.custom-file-control:lang(en)::after { content: 'Choose Image file...'; }</style>
	@endif
	@if(isset($selectTwo))
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
    @endif

    @if(isset($dateDrop))
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/pace.css')}}">
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/datedropper.min.css')}}">
    @endif

    @if(isset($eventCalender))
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/calendars/fullcalendar.min.css')}}">
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/calendars/fullcalendar.min.css')}}">
    @endif

@endsection

@section('js')

	@if(isset($cardpointe))

    <script type="text/javascript">
		function refundTransaction(id)
		{
			var c=confirm('Are you sure to refund this transaction ?');
			if(c)
			{
				//------------------------Ajax Customer Start-------------------------//
		         var AddHowMowKhaoUrl="{{url('cardpointe/payment/refund')}}";
		         $.ajax({
		            'async': true,
		            'type': "POST",
		            'global': false,
		            'dataType': 'json',
		            'url': AddHowMowKhaoUrl,
		            'data': {'rid':id,'_token':"{{csrf_token()}}"},
		            'success': function (data) {
		            	console.log(data);
		                if(data.status==1)
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
	@endif

	@if(isset($switchery))
	<script src="{{url('theme/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
	<script src="{{url('theme/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>

	<script src="{{url('theme/app-assets/js/scripts/forms/checkbox-radio.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/scripts/forms/switch.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/scripts/forms/input-groups.min.js')}}" type="text/javascript"></script>

	@endif

	@if(isset($addproduct))
	<script src="{{url('js/product.js')}}" type="text/javascript"></script>
	@endif

	@if(isset($invoiceSlip))
	<script type="text/javascript">
		function putInvoiceModal(invNo)
		{
			$(".invoice_slip_id").val(invNo);
			$("#slip").modal('show');
		}

		function attachmentAddView(attachmentAddView){
			console.log('attachmentAddView',attachmentAddView);
			$(".invoice_attachment_id").val(attachmentAddView);
			$("#attachmentAddInvoice").modal('show');


			//------------------------Ajax Customer Start-------------------------//
            var getInvoiceAttachment="{{url('sales/attachment')}}/"+attachmentAddView;
            var getAttachmentFIleDownload="{{url('sales/attachment/download')}}";
            var getAttachmentFIleDelete="{{url('sales/attachment/delete')}}";
            htrHtml='<tr><td colspan="3" align="center"> Loading please wait... </td></tr>';
            $("#loadAttachmentinSalesReport").html(htrHtml);
            $.ajax({
                'async': false,
                'type': "GET",
                'global': false,
                'dataType': 'json',
                'url': getInvoiceAttachment,
                'success': function (masterData) {
                    console.log("gET attachment to SALES : "+masterData);
                    //loadAttachmentinSalesReport
                    var htrHtml="";
                    	if(masterData.total==0){
                    		htrHtml='<tr><td colspan="3" align="center"> No Record Found </td></tr>';
                    	}else{
                    		var i=1;
                    		$.each(masterData.data,function(key,row){
                    			htrHtml+='<tr><td>'+i+'</td><td>'+row.orginal_file_name+'</td><td><a target="_blank" href="'+getAttachmentFIleDownload+'/'+row.id+'" class="btn btn-success"><i class="icon-download"></i></a> <a href="'+getAttachmentFIleDelete+'/'+row.id+'" class="btn btn-danger"><i class="icon-cross2"></i></a></td></tr>';
                    			i++;
                    		});
                    	}

                    	$("#loadAttachmentinSalesReport").html(htrHtml);

                }
            });
            //------------------------Ajax Customer End---------------------------//

		}
	</script>
	@endif

	@if(isset($JDataTable))
    <script src="{{url('theme/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('theme/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    @endif
    @if(isset($selectTwo))
    	<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
		<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
    @endif
    @if(isset($eventCalender))
    	<script src="{{url('theme/app-assets/vendors/js/extensions/moment.min.js')}}" type="text/javascript"></script>
    	<script src="{{url('theme/app-assets/vendors/js/extensions/fullcalendar.min.js')}}" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var calDatra= jQuery.parseJSON('<?php echo $calData; ?>');
				console.log(calDatra);
			    $("#fc-simplePOS").fullCalendar({
			        defaultDate: "{{date('Y-m-d')}}",
			        editable: !0,
			        eventLimit: !0,
			        events: calDatra
			    });
			});
		</script>
    @endif

    @if(isset($expenseHeadCreate))
    	<script type="text/javascript">
			$(document).ready(function() {
				$(".expense_head_name").hide();
			    $("select[name=expense_id]").change(function(){
			    	var expenseId=$(this).val();
			    	if(expenseId=='00')
			    	{
			    		$(".expense_id").fadeOut('fast');
			    		$(".expense_head_name").fadeIn('slow');

			    	}
			    });
			});
	    </script>
    @endif

    @if(isset($customer_lead))
    	<script type="text/javascript">
			$(document).ready(function(){
				$("select[name=customer_id]").change(function(){
		            var customerID=$.trim($(this).val());
		            console.log(customerID);
		            if(customerID.length==0)
		            {
		            	$(".nameField").hide();
		                alert("Please select a customer.");
		                return false;
		            }
		            else if(customerID==0)
		            {
		            	$(".nameField").show();
		                //$("#NewCustomerDash").modal('show');
		                return false;
		            }


		            //------------------------Ajax Customer Start-------------------------//
		            var AddCustomerUrl="{{url('customer/getInfo/json')}}/"+customerID;
		            $.ajax({
		                'async': false,
		                'type': "GET",
		                'global': false,
		                'dataType': 'json',
		                'url': AddCustomerUrl,
		                'success': function (data) {
		                    console.log("Assigning custome to cart : "+data);
		                    var obj=data;
		                    console.log(obj);
		                    var customerID=obj.id;
		                    //var customerIDLebgth=customerID.length;
		                    console.log(obj.id);
		                    if(obj.id)
		                    {
		                    	$(".nameField").hide();
		                    	$("input[name=name]").val(obj.name);
		                    	$("input[name=address]").val(obj.address);
		                    	$("input[name=phone]").val(obj.phone);
		                    	$("input[name=email]").val(obj.email);
		                    }
		                }
		            });
		            //------------------------Ajax Customer End---------------------------//
		        });
			});
		</script>
    @endif

    @if(isset($dateDrop))
    	<script src="{{url('theme/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
	    <!-- /build-->
	    <!-- BEGIN VENDOR JS-->
	    <!-- BEGIN PAGE VENDOR JS-->
	    <script src="{{url('theme/app-assets/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
	    <!-- END PAGE VENDOR JS-->

	    <!-- BEGIN PAGE LEVEL JS-->
	     <script type="text/javascript">
			$(document).ready(function() {
			    $(".DropDateWithformat").dateDropper({
			        dropWidth: 200,
			        maxYear: "<?=date('Y')?>",
			        minYear: "2010",
			        format: "Y-m-d",
			        init_animation: "bounce",
			        dropPrimaryColor: "#fa4420",
			        dropBorder: "1px solid #fa4420",
			        dropBorderRadius: "20",
			        dropShadow: "0 0 10px 0 rgba(250, 68, 32, 0.6)"
			    });
			});
	    </script>
	    <!-- END PAGE LEVEL JS-->
    @endif

    @if(isset($confirmStockIN))
    	<script type="text/javascript">
			$(document).ready(function(){
				$(".typed_quantity").keyup(function(){
					var currrentQty=$(this).val();
					if(currrentQty.length==0)
					{
						currrentQty=0;
						$(this).val('0');
					}

					if(currrentQty<=0)
					{
						currrentQty=0;
						$(this).val('0');
					}
					//alert(unitPrice);
					genarateSL();
				});
				$(".typed_quantity").change(function(){
					var currrentQty=$(this).val();
					if(currrentQty.length==0)
					{
						currrentQty=0;
						$(this).val('0');
					}

					if(currrentQty<=0)
					{
						currrentQty=0;
						$(this).val('0');
					}
					genarateSL();
				});

				$("#invoiceSubmit").click(function(){
					var order_no=$("input[name=order_no]").val();
					var order_date=$("input[name=order_date]").val();

					if(order_no.length==0)
					{
						alert('Please Type a Order No.!!!');
						return false;
					}

					if(order_date.length==0)
					{
						alert('Please select a Date.!!!');
						return false;
					}

					$("#createInvoice").submit();
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
						var rowtotal=$(this).parent('tr').find('.typed_quantity').val();
						if(rowtotal<=0)
						{
							totalQuantity+=0;
							$(this).parent('tr').find('.typed_quantity').val('0');
						}
						else{
							totalQuantity+=(rowtotal-0);
						}

					});
				}
				$("#shoppingCartQuantityTotal").html(totalQuantity);
			}


		</script>
    @endif

    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".change-action").click(function(){
				var getURL=$(this).attr("data-url");
				console.log(getURL);
				//return false;

				$("form").attr("action",getURL);
				//console.log($("select[name=customer_id]").val());

				$("button[type=submit]").click();
			});
    	});
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".change-action-export-sales").click(function(){
				var getURL=$(this).attr("data-url");
				console.log(getURL);
				//return false;

				$("#salesSu").attr("action",getURL);
				//console.log($("select[name=customer_id]").val());

				$("#salesSUSub").click();
			});
    	});
    </script>

@endsection
