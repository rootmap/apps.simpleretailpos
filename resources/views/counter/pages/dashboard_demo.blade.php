@extends('apps.layout.master')
@section('title','Dashboard demo')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-lg-7 col-md-12 pos-product-display">
            <style type="text/css">
                .pure 
                {
                    display: inline-block;
                    line-height: 1.25;
                    text-align: center;
                    vertical-align: middle;
                    cursor: pointer;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    border: 1px solid transparent;
                    padding: .2rem .2rem;
                    font-size: 1rem;
                    border-radius: .18rem;
                    -webkit-transition: all .2s ease-in-out;
                    -moz-transition: all .2s ease-in-out;
                    -o-transition: all .2s ease-in-out;
                    transition: all .2s ease-in-out;
                }
                .pure-info
                {
                    border-color: #3BAFDA;
                    background-color: #3BAFDA;
                    color: #FFF;
                }

                .pure-info:hover
                {
                        border-color: #4FC1E9;
                        background-color: #4FC1E9;
                        color: #FFF!important;

                        -webkit-box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                        -moz-box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                        box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                }

                .margin-all-bottom-button
                {
                    margin-bottom: 10px !important;
                }

                .pure-red-info
                {
                    border-color: #3BAFDA;
                    background-color: #3BAFDA;
                    color: #FFF;
                }

                .pure-red-info:hover
                {
                        border-color: #4FC1E9;
                        background-color: #4FC1E9;
                        color: #FFF!important;

                        -webkit-box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                        -moz-box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                        box-shadow: inset 0px 0px 0px 0px rgba(0,0,0,0.5);
                }


                .pos-product-display > div > div{ margin-bottom: 10px; }
                .pos-product-display > div > div > a,.pos-product-display > div > div > a:hover,.pos-product-display > div > div > a:visited { height: 65px;
                    word-wrap: break-word;
                    white-space: normal;
                        line-height: 1.25;
    text-align: center;
    vertical-align: middle;
                 text-decoration: none; color: #fff; }
                .clearfix::after {
                    content: "";
                    clear: both;
                    display: table;
                }
            </style>
            <div class="row">
              @if(isset($product))
                @foreach($product as $pro)
                    <div class="col-md-3 col-xs-6 col-sm-3">
                        <a href="javascript:void(0);" data-id="{{$pro->id}}" data-price="{{$pro->price}}" class="pure pure-info btn-block add-pos-cart">
                            {{$pro->name}}
                        </a>
                    </div>   

                @endforeach
              @endif  
              
                <div class="col-md-3 col-xs-6 col-sm-3"> 
                    <a class="thumbnail btn-block  bg-primary" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#General_Sale">General Sale </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-3"> 
                    <a class="thumbnail btn-block bg-warning" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;">Open Drawer </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-3"> 
                    <a class="thumbnail btn-block bg-success" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#Cash_Out">Cash Out </a>
                </div>

    <!--             <div class="col-md-3 col-xs-6 col-sm-3"> 
                    <a class="thumbnail btn-block bg-success" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" href="javascript:alignProductLine();">Tester </a>
                </div> -->
            </div>

      




                                    


        	
    	</div>
        <style type="text/css">
        /* Desktop */
            @media (min-width:960px) {

                .testerPickup {
                    position: fixed; top:22px;
                }   

            }
            .table td, .table th
            {
                padding: 0.1rem .75rem;
            }
        </style>
    	<div class="col-lg-5 col-md-12">
        <!-- CSS Classes -->
        <div class="card testerPickup" style="">
            <div class="card-header">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h5>Invoice No #27</h5>
                        
                        <div class="form-group" style="margin-bottom: 0px !important;">
                            <!-- basic buttons -->
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#Discount"><i class="icon-pencil2"></i> Discount</button>
                            <button type="button" class="btn btn-secondary btn-sm"> <i class="icon-printer"></i> Last Receipt</button>
                            <button type="button" class="btn btn-secondary btn-sm" id="description"><i class="icon-edit2"></i> <span id="npt">Note</span></button>
                            <div class="form-group row" style="margin-top: 5px; display: none;" id="show_description">
                                    <textarea class="form-control" id="title1" rows="2" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-blockf">
                    <div class="card-text">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart">
                                    <!-- <tr>
                                        <td>FreshUp A&O 500ml</td>
                                        <td>1</td>
                                        <td>$4.78</td>
                                        <td style="width: 81px;"> 
                                             <a href="" title="Edit" class="btn btn-sm btn-outline-info"><i class="icon-pencil22"></i></a>
                                            <a href="" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>FreshUp A&O 500ml</td>
                                        <td>1</td>
                                        <td>$4.78</td>
                                        <td style="width: 81px;"> 
                                             <a href="" title="Edit" class="btn btn-sm btn-outline-info"><i class="icon-pencil22"></i></a>
                                            <a href="" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                        </td>
                                    </tr> -->
                                </tbody>
                                <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Discount : <span>0%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td></td>
                                        <td colspan="3">$<span>0.00</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-xs-12 button-group">
                            <div class="col-xs-6 col-sm-3 col-md-6 col-lg-6 button button1">
                                <button id="btn-payment-modal" type="button" class="btn btn-success btn-responsive btn1" data-toggle="modal" data-target="#payModal">MAKE PAYMENT</button>      
                            </div>                                
                            <div class="col-xs-6 col-sm-3 col-md-6 col-lg-6 button button2">
                                <button id="charge-to-member-btn" type="button" class="btn btn-primary btn-responsive btn-charge-to-member btn1" data-toggle="modal" data-target="#chargeToMemberModal" disabled="">CHARGE TO MEMBER</button>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-6 col-lg-6 button button4">
                                <button id="cancelsale" type="button" class="btn btn-danger btn-responsive btn1">CANCEL</button>
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-6 col-lg-6 button button6">
                                <button id="completesale" type="button" class="btn btn-success btn-responsive btn1">COMPLETE SALE</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--/ All Modal -->
        <!--Edit Product Start-->
        <div class="modal fade text-xs-left" id="editProduct" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel35"> Edit Item Quantity</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" value="0" placeholder="Product Name" readonly="readonly" name="edit_product_name">
                                                        <input type="hidden" name="edit_id" value="0">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Quantity</label>
                                                    <div class="col-md-8">
                                                        <input type="number" onkeyup="editRowLive(0);" onchange="editRowLive(0);" id="edit_quantity" class="form-control" value="0"  name="edit_quantity">
                                                    </div>
                                                </div>                                                
                                            </div>
                                            
                                          </form>
                                        </div>
                                      </div>
                                    </div>
        <!--Edit Product End-->

        <!-- Modal for General Sale-->
                                    <div class="modal fade text-xs-left" id="General_Sale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel35"> General Sale</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Amount (Tax Inclusive)</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="projectinput1" class="form-control" placeholder="Amount (Tax Inclusive)." name="Amount">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Tax Rate</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" placeholder="0">
                                                            <option value="-1">Select Tax Rate</option>
                                                            <option value="0">Sales Tax</option>
                                                            <option value="1">Sales Tax, 0.15</option>
                                                            <option value="2">Sales Tax, 0.15</option>
                                                            <option value="3">Sales Tax, 0.15</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label class="col-md-4 label-control" for="Description">Description</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" id="title1" rows="3" placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group center">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="icon-check2"></i> Add Product
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                               
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                <!-- Modal for Cash Out-->
                                    <div class="modal fade text-xs-left" id="Cash_Out" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel35"> Cash Out</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Amount To Pay Today</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="0.00" aria-describedby="button-addon2" data-amount="">
                                                            <span class="input-group-btn" id="button-addon2">
                                                                <button class="btn btn-primary amountextract" type="button">Exact</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Remaining</label>
                                                    
                                                </div>

                                                <div class="form-group row">
                                                  <label class="col-md-4 label-control" for="Description">Payment Due</label>
                                                    <div class="col-md-8">
                                                        <span>$0.00</span>
                                                    </div>
                                                </div>
                                                <div class="form-group center">
                                                    <button type="submit" class="btn-lg btn-primary">
                                                        <i class="icon-check2"></i> Proceed
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                               
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>

                                <!-- Modal for Discount-->
                                    <div class="modal fade text-xs-left" id="Discount" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel35"> Discount For Sale</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Percentage</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="discount_amount" class="form-control" value="0" placeholder="%" name="Percentage">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                                                    <div class="col-md-8">
                                                        <button type="button" class="btn btn-primary apply-discount">
                                                            <i class="icon-check2"></i> Apply Discount
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
<!--                                             <div class="modal-footer">
                                                <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                                               
                                            </div> -->
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal for Make Payment-->
                                    <div class="modal fade text-xs-left" id="payModal" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h3 class="modal-title" id="myModalLabel35"> Payment</h3>
                                          </div>
                                          <form>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-md-4 label-control" for="projectinput1">Amount To Pay Today</label>
                                                    <div class="col-md-8">
                                                        <div class="input-group">
                                                            <input type="text"  name="amount_to_pay"  class="form-control" placeholder="0.00" aria-describedby="button-addon2" data-amount="">
                                                            <span class="input-group-btn" id="button-addon2">
                                                                <button class="btn btn-primary amountextract" type="button">Exact</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label class="col-md-4 label-control" for="Description">Payment Due</label>
                                                    <div class="col-md-8">
                                                        <span id="prmDue">$0.00</span>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                @if(isset($tender))
                                                    @foreach($tender as $ten)
                                                        <button id="btn-payment-modal" data-id="{{$ten->id}}" type="button" class="btn btn-success btn-responsive margin-all-bottom-button make-payment" >
                                                            {{$ten->name}}
                                                        </button>  
                                                    @endforeach
                                                @endif 
                                               
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
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
    </style>
@endsection

@section('js')
<script>
    function alignProductLine()
    {
        //add-pos-cart
        $.each($(".add-pos-cart"),function(index,row){
            /*console.log(row);
           // console.log($(row).height());
            if($(row).height()<20)
            {
                $(row).addClass('one-make-full');
            }
            else
            {
                $(row).css('height',"65px");
            }*/
            var charStr=$.trim($(row).html()).length;
            if(charStr<=15)
            {
                $(row).addClass('one-make-full');
            }
            //console.log();
            //total height 57.4
            //height: 65px;
        });
    }
    $(document).ready(function() {
        alignProductLine();
        genarateSalesTotalCart();
        $('#description').click(function() {
                $('#show_description').toggle("slide");
        });



        $(".make-payment").click(function(){
            //var modalOBJ=$(this).parent().parent().parent().parent().parent();
            //console.log($(modalOBJ).html());
            //console.log($(modalOBJ).attr("id"));

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

            $("#discount_amount").val(newAMP);

            genarateSalesTotalCart();
            $("#Discount").modal("hide");
        });

        $(".edit_pos_item").click(function(){
            console.log("WW");
        });


        $(".add-pos-cart").click(function(){
            //alert('sss');
            var ProductID=$(this).attr('data-id');
            var ProductPrice=$(this).attr('data-price');
            var ProductName=$(this).html();



            if($("#dataCart tr").length > 0)
            {
                
                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);

                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html(NewPrice);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {

                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="1"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="1"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-info" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.post(AddPOSUrl,{'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},function(response){
                console.log(response);
            });
            //------------------------Ajax POS End---------------------------//

        });

        $("input[name=amount_to_pay]").keyup(function(){
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
        
        
        $("#dataCart tr[id="+id+"]").find("td:eq(1)").html(edit_quantity);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html(totalPrice)
        genarateSalesTotalCart();
    }

    function delposSinleRow(ID)
    {
        var c=confirm("Are you sure to delete this item.");
        if(c)
        {
            $("#dataCart tr[id="+ID+"]").remove();
            genarateSalesTotalCart();
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
            if($("#discount_amount").length>0)
            {
                discount=$("#discount_amount").val();
            }
            var expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                var rowTax=$(row).find("td:eq(2)").attr("data-tax");
                subTotalPrice+=(rowPrice-0);    
                TotalTax+=(rowTax-0);    
            });


            var sumPriceTotal=((subTotalPrice-0)+(TotalTax-0));
            var calcDisc=((sumPriceTotal*discount)/100);
            sumPriceTotal=sumPriceTotal-calcDisc;
            var sumdues=sumPriceTotal-paid;
            var newdues=sumdues.toFixed(2);
            var newPriceTotal=sumPriceTotal.toFixed(2);
            var newDiscount=calcDisc.toFixed(2);
            var newsubTotalPrice=subTotalPrice.toFixed(2);
            var newTotalTax=TotalTax.toFixed(2);

            $("#posCartSummary tr:eq(2)").find("th").children("span").html(discount+"%");

            $("#posCartSummary tr:eq(0)").find("td:eq(1)").children("span").html(newsubTotalPrice);
            $("#posCartSummary tr:eq(1)").find("td:eq(1)").children("span").html(newTotalTax);
            $("#posCartSummary tr:eq(2)").find("td:eq(1)").children("span").html(newDiscount);
            $("#posCartSummary tr:eq(3)").find("td:eq(1)").children("span").html(newPriceTotal);
            $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html(paid);
            $("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html(newdues);

            $("input[name=amount_to_pay]").val(newdues);
            console.log($("input[name=amount_to_pay]").val());
            $("#prmDue").html(newdues);

        }
        else
        {
            $("#posCartSummary tr:eq(0)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(1)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("th").children("span").html("0%");
            $("#posCartSummary tr:eq(3)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html("0.00");
            $("#posCartSummary tr:eq(5)").find("td:eq(1)").children("span").html("0.00");
            $("input[name=amount_to_pay]").val("0.00");
            $("#prmDue").html("0.00");
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

