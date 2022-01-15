
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
	@if(isset($invoiceSlip))
	<script type="text/javascript">
		function putInvoiceModal(invNo)
		{
			$(".invoice_slip_id").val(invNo);
			$("#slip").modal('show');
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
				$("form").attr("action",getURL)
				$("button[type=submit]").click();
			});
    	});
    </script>

@endsection