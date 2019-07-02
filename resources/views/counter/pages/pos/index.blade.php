@extends('counter.layout.master')
@section('title','Point of Sales')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		
        @if($CounterDisplayStatus==0)
            <h1 class="text-xs-center text-md-center text-sm-center danger" style="padding-top: 6rem;">
                Counter is offline now.
            </h1>
        @endif

        <div class="col-lg-7 col-md-12 pos-product-display counter-display">

            <div class="row">
                @if($CounterDisplayStatus==1)
                <style type="text/css">
                    .pagination
                    {
                        margin-top: 0px !important; 
                    }
                </style>
                <div class="col-md-12 col-xs-12 col-sm-12">
                        <h1 class="text-xs-center text-md-center text-sm-center" style="color: #F5F5F5;">
                            <a href="javascript:void(0);" id="full-screen-system" class="nav-link dropdown-user-link" style=" padding-top: 20px; color: #fff;">
                                  <i style="font-size: 25px;" class="icon-desktop"></i>
                            </a> Shop Name 
                            
                        </h1>
                        <h4 class="text-xs-center text-md-center text-sm-center" style="color: #F5F5F5;"><i class="icon-android-contact"></i> Served By : {{Auth::user()->name}} 
                            <br>
                            <small>{{$_SERVER['REMOTE_ADDR']}}</small>
                        </h4>
                </div>
                <div class="offset-xl-2 offset-lg-2 offset-md-2 col-xl-8 col-lg-8 col-md-8 counter-display-customer">
                    <div class="card border-info border-lighten-1">
                        <div class="card-header">
                            <h4 class="card-title text-xs-center text-md-center text-sm-center info">
                                <i class="icon-user4"></i> Customer Info
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <fieldset>
                                    <div class="position-relative has-icon-left mb-1">
                                        <input type="text" id="timesheetinput1" class="form-control" placeholder="Customer Name" name="name">
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                    </div>
                                    <div class="position-relative has-icon-left mb-1">
                                        <input type="text" id="timesheetinput1" class="form-control" placeholder="Email Address" name="email">
                                        <div class="form-control-position">
                                            <i class="icon-email2"></i>
                                        </div>
                                    </div>
                                    <div class="input-group" style="padding-top: 20px;">
                                        <div class="text-xs-center">
                                            <button type="submit" class="btn btn-info btn-block send-invoice"><strong><i class="icon-send"></i> SEND RECEIPT / INVOICE</strong></button>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>


                @endif


            </div>
    	</div>
        <style type="text/css">
        /* Desktop */
            @media (min-width:960px) {

                .testerPickup {
                    position: fixed; 
                    top:0px;
                    right: 0px;
                }   

                .counter-display-customer {
                    margin-top: 4rem;
                }   

            }
            .table td, .table th
            {
                padding: 0.1rem .75rem;
            }
        </style>
    	<div class="col-lg-5 col-md-12">
        <!-- CSS Classes -->
        @if($CounterDisplayStatus==1)

        <div class="card testerPickup" style="-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);">
            <div class="card-header rep_cart">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h5>
                        </h5>
                        
                        <div class="form-group" style="margin-bottom: 0px !important;">
                            <!-- basic buttons -->
                            

                            <h3 class="info" align="center">
                                <i class="icon-shopping-basket"></i>
                                Sales Receipt
                            </h3>
                            <h4 align="center">
                                <i class="icon-qrcode"></i>
                                <span>@if(isset($cart->invoiceID))    
                                {{$cart->invoiceID}}
                                @else
                                0
                                @endif</span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <style type="text/css">
                .rep_cart_table{  }
                .rep_cart_table thead tr th{ font-size: 18px; padding-top:5px; padding-bottom:5px; text-transform: uppercase;  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize; font-weight:bolder; color: #fff;  }
                .rep_cart_table tbody tr td{ font-size: 17px; padding-top:5px; padding-bottom:5px; font-weight:600; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize; }
                .rep_cart_table tbody tr > td {
                    border-bottom: 1px #ccc solid;  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize; 
                     font-size: 16px;
                }
                .rep_cart_table thead tr:first-child > th {
                    border-top: 3px #ccc solid;
                    border-bottom: 3px #ccc solid;  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize;
                } 
                .rep_cart_table tbody tr:last-child > td {
                    border-bottom: 3px #3BAFDA solid;  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize;
                }
                .rep_cart_table tfoot tr > td{
                    border-bottom:1px #ccc solid; font-size: 18px;
                    text-transform: uppercase;
                    padding-top:5px; padding-bottom:5px; 
                    font-weight: 600;  font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize;
                } 
                .rep_cart_table tfoot tr > th {
                    border-bottom:1px #ccc solid; font-size: 18px;
                    text-transform: uppercase;
                    padding-top:5px; padding-bottom:5px;   font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif; text-transform: capitalize;
                }

                .rep_cart_table tfoot tr:last-child > td{
                    border-bottom: 3px #3BAFDA solid;
                } 
                .rep_cart_table tfoot tr:last-child > th {
                    border-bottom: 3px #3BAFDA solid;
                } 
            </style>
      
            <div class="card-body collapse in rep_cart">
                <div class="card-blockf">
                    <div class="card-text">
                        <div class="table-responsive">
                            <table class="table table-hover rep_cart_table">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody id="dataCart">
                                    @if(isset($cart->items))
                                        @foreach($cart->items as $index=>$row)
                                            <tr id="{{$row['item_id']}}">
                                                <td>{{$row['item']}}</td>
                                                <td>{{$row['unitprice']}}</td>
                                                <td>{{$row['qty']}}</td>
                                                <td data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{$row['price']}}</span></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot id="posCartSummary" style="padding-top: 20px;">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th data-id="0">Discount : <span>0</span><span>%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>
                                            @if(isset($cart->paid))
                                            {{$cart->paid}}
                                            @else
                                            0.00
                                            @endif
                                        </span></td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                        
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
            <div class="card-header getpaid" style="padding-top:20%;">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h5 align="center">
                            <i style="font-size: 100px;" class="icon-android-checkmark-circle  info"></i>
                            <div class="row" style="padding-top: 10%;">
                                <div style="border-right: 2px #ccc solid;" class="col-xs-6 col-sm-6 col-md-6">
                                    <h1 align="center">
                                        <div class="col-md-12" style="font-size: 40px;">$<span id="rep_total">0</span></div>
                                        <small>Total</small>
                                    </h1>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <h1 align="center">
                                        <div class="col-md-12" style="font-size: 40px;">$<span id="rep_paid">0</span></div>
                                        <small>Paid</small>
                                    </h1>
                                </div>
                            </div>
                        </h5>
                        <h4 style="font-size: 40px; padding-top: 5%; padding-bottom: 5%;" class="info" align="center">Thank You</h4>
                    </div>
                </div>
            </div>
        </div>
        

            @endif                        
    	</div>
	</div>
</section>
@endsection

@section('css')

        <link rel="stylesheet" type="text/css" href="{{url('assets/css/pos.css')}}">
        <style type="text/css">
            .one-make-full
            {
                line-height:3.8rem !important;
            }

            .two-make-full
            {
                line-height:1.8rem !important;
            }

            .third-make-full
            {
                line-height:1.3rem !important;
            }
            .getpaid{
                display: none;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
@endsection

@section('js')

<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
<script>
    function alignProductLine()
    {
        $.each($(".add-pos-cart"),function(index,row){
            var charStr=$.trim($(row).html()).length;
            if(charStr<=15)
            {
                $(row).addClass('one-make-full');
            }
        });
    }


    
    function loadSalesINIT()
    {
        //------------------------Ajax Sales Start-------------------------//
        var AddHowMowKhaoUrlSalesJson="{{url('counter-display/sales/json')}}";
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrlSalesJson,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                console.log("Sales Json : "+data);
                var obj=data;
                if(obj.totalQty)
                {
                    if(obj.totalQty==0)
                    {
                        $("#dataCart").html("");
                    }
                    else
                    {
                        var itemArr=obj.items;
                        var paidAmount=obj.paid?obj.paid:'0.00';
                        var itemArrLength=$.map(itemArr, function(n, i) { return i; }).length;
                        if(itemArrLength>0)
                        {

                            $.each(obj.items,function(index,row){
                                if($("#dataCart tr[id="+row.item_id+"]").length)
                                {
                                    $("#dataCart tr[id="+row.item_id+"]").find("td:eq(2)").html(row.qty);
                                    $("#dataCart tr[id="+row.item_id+"]").find("td:eq(3)").children("span").html(row.price);
                                    $("#dataCart tr[id="+row.item_id+"]").find("td:eq(3)").attr("data-tax",row.tax);
                                }
                                else
                                {
                                    var strHTML='<tr id="'+row.item_id+'"><td>'+row.item+'</td><td>$<span>'+row.unitprice+'</span></td><td>'+row.qty+'</td><td data-tax="'+row.tax+'">$<span>'+row.price+'</span></td></tr>';
                                    $("#dataCart").append(strHTML);
                                }
                            });

                            //console.log("SALES DIS : "+obj.sales_discount);

                            $("#posCartSummary tr:eq(2)").find("th").children("span:eq(0)").html(obj.sales_discount);
                            
                            $("#posCartSummary tr:eq(2)").find("th").attr("data-id",obj.discount_type);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(paidAmount);

                            var invoiceID=$("h4").children("span").html();
                            if(invoiceID!=obj.invoiceID)
                            {
                                $(".send-invoice").fadeIn();
                                $("input[name=name]").val("");
                                $("input[name=email]").val("");
                                $("h4").children("span").html(obj.invoiceID);
                            }





                        }
                        else
                        {
                            $("#dataCart").html("");
                        } 
                    }
                    
                }
                else
                {

                    $("#dataCart").html("");
                }

                genarateSalesTotalCart();
            }
        });
        //------------------------Ajax Sales End---------------------------//
    }


    $(document).ready(function() {
        alignProductLine();
        genarateSalesTotalCart();
        loadSalesINIT();
        setInterval(function(){

            console.log('Initializing...');

            loadSalesINIT();

        }, 3000);


        
        $(".send-invoice").click(function(){
            var name=$("input[name=name]").val();
            var email=$("input[name=email]").val();
            var invoiceID=$.trim($("h4").children("span").html());
            if(invoiceID.length<1)
            {
                alert("Please try again.");
                window.location.reload();
                return false;
            }

            if(name.length<1)
            {
                alert("Please type customer name.");
                return false;
            }

            if(email.length<1)
            {
                alert("Please type your email.");
                return false;
            }
            
            //------------------------Ajax New Product Start-------------------------//
            var AddProductUrl="{{url('counter-display/customer/save')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'name':name,'email':email,'invoiceID':invoiceID,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Saving Customer New Invoice Link : "+data);
                    $(".send-invoice").fadeOut();
                }
            });
            //------------------------Ajax New Product End---------------------------//

        });


        $(".make-payment").click(function(){


            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }

            var payment_id=$(this).attr("data-id");
            var payment_text=$(this).html();
            var c=confirm("Are you sure to proced with "+$.trim(payment_text)+" ?.");
            if(c)
            {
                var amount_to_pay=$("input[name=amount_to_pay]").val();
                console.log(amount_to_pay,payment_id,$.trim(payment_text));
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(parseNewPayment);
                }
                genarateSalesTotalCart();
                $("#payModal").modal("hide");
                //------------------------Ajax POS Start-------------------------//
                var AddPOSUrl="{{url('sales/cart/payment')}}";
                $.post(AddPOSUrl,{'paymentID':payment_id,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                    console.log(response);
                });
                //------------------------Ajax POS End---------------------------//
            }
            
        });

        $(".amountextract").click(function(){
            console.log($(this).parent().html());
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }
            genarateSalesTotalCart();
        });

        $("#discount_amount").keyup(function(){
            var amp=$(this).val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            $(this).val(newAMP);
        });

        $(".apply-discount").click(function(){
            var amp=$("#discount_amount").val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            var discount_type=0;
            discount_type=$("select[name=discount_type]").val();
            


            genarateSalesTotalCart();
            $("#Discount").modal("hide");

            //------------------------Ajax New Product Start-------------------------//
            var AddProductUrl="{{url('sales/cart/assign/discount')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'discount_type':discount_type,'discount_amount':newAMP,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Assigning Discount : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//


        });

        $(".edit_pos_item").click(function(){
            console.log("WW");
        });


        $(".GAddProductToCart").click(function(){
            @if(isset($ps))
            var taxRate="{{$ps->sales_tax}}";
            @else
            var taxRate=0;
            @endif
            var ProductName=$.trim($("input[name=gName]").val());
            var ProductPrice=$.trim($("input[name=gPrice]").val());
            var ProductDesc=$.trim($("textarea[name=gDetail]").val());

            if(ProductName.length==0)
            {
                alert("Please name should not be empty..");
                return false;
            }

            if(ProductPrice.length==0)
            {
               alert("Please price should not be empty..");
                return false;
            }

            if(ProductDesc.length==0)
            {
               ProductDesc="General Sales.";
            }
            else
            {
                ProductDesc='General Sales : '+ProductDesc;
            }
            

            console.log(ProductName,ProductPrice,ProductDesc);
            $("#General_Sale").modal("hide");
            //------------------------Ajax New Product Start-------------------------//
            var ProductID; 
            var AddProductUrl="{{url('product/ajax/save')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'name':ProductName,'price':ProductPrice,'detail':ProductDesc,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    ProductID=data; 
                    //console.log("Adding New Product : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//
            //console.log(ProductID);

            if($("#dataCart tr").length > 0)
            {
                
                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//

        });


        

        $("input[name=amount_to_pay]").keyup(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }
            console.log($(this).val());
            var dues=$("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html();
            var amp=$(this).val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            $(this).val(newAMP);

            var mkdues=$.trim(dues)-$.trim(newAMP);
            var newdues=parseFloat(mkdues).toFixed(2);

            $("#prmDue").html(newdues);

        });
    });

    function editRowLive(id)
    {
        @if(isset($ps))
        var taxRate="{{$ps->sales_tax}}";
        @else
        var taxRate=0;
        @endif
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        var unitPrice=$("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price");
        var edit_quantity=$("input[name=edit_quantity]").val();
        if($.isNumeric(edit_quantity))
        {
            if(edit_quantity>=0)
            {
                var totalPrice=unitPrice*edit_quantity;    
            }
            else
            {
                edit_quantity=0;
                $("input[name=edit_quantity]").val(edit_quantity);
                var totalPrice=unitPrice*edit_quantity;    
            }
        }
        else
        {
            edit_quantity=0;
            $("input[name=edit_quantity]").val(edit_quantity);
            var totalPrice=unitPrice*edit_quantity;    
        }
        
        var taxAmount=parseFloat((totalPrice*taxRate)/100).toFixed(2);
        
        $("#dataCart tr[id="+id+"]").find("td:eq(1)").html(edit_quantity);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html(totalPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-tax",taxAmount);
        genarateSalesTotalCart();
        //need to incorporate witth ajax

        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl="{{url('sales/cart/custom/add')}}/"+id+"/"+edit_quantity;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                //tmp = data;
                console.log("Custom Quantity Processing : "+data)
            }
        });
        //------------------------Ajax POS End---------------------------//
    }

    function delposSinleRow(ID)
    {
        var c=confirm("Are you sure to delete this item.");
        if(c)
        {
            $("#dataCart tr[id="+ID+"]").remove();
            genarateSalesTotalCart();
            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/row/delete')}}/"+ID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Delete Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//
        }

    }

    function edit_pos_item(id)
    {
        //console.log(id);
        
        //console.log($("#dataCart tr[id="+id+"]").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(0)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(1)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price"));
        var edit_product_name=$("#dataCart tr[id="+id+"]").find("td:eq(0)").html();
        var edit_quantity=$("#dataCart tr[id="+id+"]").find("td:eq(1)").html();
        //var edit_unit_price=$("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html();
        $("input[name=edit_product_name]").val($.trim(edit_product_name));
        $("input[name=edit_quantity]").val($.trim(edit_quantity));
        $("input[name=edit_quantity]").attr("onkeyup","editRowLive("+id+")");
        $("input[name=edit_quantity]").attr("onchange","editRowLive("+id+")");
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        $("input[name=edit_id]").val(id);
        $('#editProduct').modal('show');
        //$('#myModal').modal('hide');
    }

    
    function genarateSalesTotalCart()
    {
        if($("#dataCart tr").length > 0)
        {
            var subTotalPrice=0;
            var TotalTax=0;
            var priceTotal=0;
            var due=0;
            var discount=0;
            var discount_type=0;

            discount_type=$("#posCartSummary tr:eq(2)").find("th").attr("data-id");

            console.log("Discount Type : "+discount_type);
            
            var expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(3)").children("span").html();
                var rowTax=$(row).find("td:eq(3)").attr("data-tax");
                subTotalPrice+=(rowPrice-0);    
                TotalTax+=(rowTax-0);    
            });

            var calcDisc=0;
            var sales_discount=$("#posCartSummary tr:eq(2)").find("th").children("span:eq(0)").html();
            if(sales_discount.length>0)
            {
                discount=$.trim(sales_discount);
                if(discount_type==1)
                {
                    calcDisc=$.trim(sales_discount);
                }
                else if(discount_type==2)
                {
                    calcDisc=((subTotalPrice*$.trim(sales_discount))/100);
                }
                else
                {
                    calcDisc=0;
                }
            }
            else
            {
                discount=0;
            }

            var sumPriceTotal=((subTotalPrice-0)+(TotalTax-0));
            //var calcDisc=((sumPriceTotal*discount)/100);
            sumPriceTotal=sumPriceTotal-calcDisc;
            var sumdues=sumPriceTotal-paid;
            var newdues=parseFloat(sumdues).toFixed(2);
            var newPriceTotal=sumPriceTotal.toFixed(2);
            var newDiscount=calcDisc.toFixed(2);
            var newsubTotalPrice=subTotalPrice.toFixed(2);
            var newTotalTax=TotalTax.toFixed(2);

            if(newdues<0){ newdues="0.00"; }
            else if(newdues=="-0.00"){ newdues="0.00"; }



            $("#posCartSummary tr:eq(2)").find("th").children("span:eq(0)").html(discount);

            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html(newsubTotalPrice);
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html(newTotalTax);
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html(newDiscount);
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html(newPriceTotal);
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(paid);
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html(newdues);


            if(paid>0)
            {
                $(".rep_cart").fadeOut();
                $(".getpaid").fadeIn();
                $("#rep_total").html(newPriceTotal);
                $("#rep_paid").html(paid);
            }
            else
            {
                 $(".rep_cart").fadeIn();
                 $(".getpaid").fadeOut();
                 $("#rep_total").html("0.00");
                 $("#rep_paid").html("0.00");
            }

        }
        else
        {
            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("th").children("span:eq(0)").html("0");
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html("0.00");

        }
                
                
    }

</script>
<!-- <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                </tfoot> -->
                      
@endsection

