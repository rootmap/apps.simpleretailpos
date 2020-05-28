@extends('apps.layout.master')
@section('title','invoice template')
@section('content')
<section id="form-action-layouts">


	<div class="row">
        <div class="col-lg-3">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; font-size: 25px; font-weight: bold; padding-left: 0px;">
                14.02.2018            </div>
            <div class="col-md-12" style="padding-top: 20px; padding-bottom: 4px; color: #000; padding-left: 0px;">
                <b>Customer Info</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->email}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->phone}}            
            </div>

            <div class="col-md-12" style="padding-top: 21px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Ship To :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                {{$customer->name}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                {{$customer->address}}            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                sales@igeekrepaircenter.com            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                111111111            
            </div>


            <div class="col-md-12" style="padding-top: 35px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Payment Method :</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                Credit            
            </div>

            <div class="col-md-12" style="padding-top: 30px; padding-bottom: 4px; padding-left: 0px;">
                <img src="{{url('images/invoice_r.png')}}">
            </div>

        </div>
        <div class="col-lg-9">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; color: #008000; font-size: 25px; font-weight: bold; padding-left: 0px;">
                WIRELESS GEEKS WHOLESALE
            </div>
            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Thank You for your Business!</b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                Wireless Geeks - LCD Refurbishing | Apple Parts | Samsung Parts | LCD Buyback | Wholesale Repairs | Factory Unlocks
            </div>
            <style type="text/css">
                table{ border: 1px #000 solid !important; }
                .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
                    border: 1px solid #000;
                }
            </style>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; padding-left: 0px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-xs-center">Item Number</th>
                            <th class="text-xs-center">Description</th>
                            <th class="text-xs-center">Price</th>
                            <th class="text-xs-center">Quantity</th>
                            <th class="text-xs-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                                                    <tr>
                                <td class="text-xs-center">20</td>
                                <td>iPhone 5 LCD Black - Premium</td>
                                <td class="text-xs-center">19.00</td>
                                <td class="text-xs-center">0</td>
                                <td class="text-right">0.00</td>
                            </tr>
                                                                                <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                        <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                                                    <tr style="border-bottom: 5px #000 solid;">
                            <td>Subtotal </td>
                            <td>Total Item : 0</td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><b>0.00</b></td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="3"> Sales  Tax Rate: 0% </td>
                            <td colspan="2" class="text-right">Sales Tax  (-)</td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Less Deposit Received  (-)</td>
                            <td class="text-right">0</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Invoice Total</td>
                            <td class="text-right" style="border-bottom: 5px #000 solid;"><b>0.00</b></td>
                        </tr>
                    </tfoot>


                </table>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-lg-12" style="padding-left: 5px; padding-top: 15px;">
            <div class="col-md-12 text-xs-center">
                <b>We Buy Broken LCD’s | We Refurbish Your LCD’s | We Sell Parts!</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>7 Years of Experience!</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>Visit our Local Warehouse today at:</b>
            </div>
            <div class="col-md-12 text-xs-center">
                <b>1820 E. 11 Mile Rd. Madison Heights MI 48071</b>
            </div>
            <div class="col-md-11 text-left" style="padding-left: 0px; border-bottom: 3px #000 solid; font-size: 28px; color: #008000;">
                <b>Wireless Geeks Inc.</b>
            </div>
            <div class="col-md-1 text-left" style="padding-left: 0px; font-size: 28px; color: #008000;">
                <img src="{{url('images/invoice_b.png')}}" style="margin-top: 21px;">
            </div>
            <div class="col-md-12" style="clear: both;">
                <div class="col-md-3 text-xs-center">
                    Tel (586)333-4005
                </div>
                <div class="col-md-5 text-xs-center">
                    1820 E. 11 Mile Rd. Madison Heights MI 48071
                </div>
                <div class="col-md-4 text-xs-center">
                    Visit our Sites Below!
                </div>

                <div class="col-md-3 text-xs-center">
                    http://nucleuspos.com
                </div>
                <div class="col-md-5 text-xs-center">
                    http://wirelessgeekswholesale.com
                </div>
                <div class="col-md-4 text-xs-center">
                    http://geekunlocks.com
                </div>
            </div>
            <div class="col-md-12" style="border-bottom: 5px #000 solid; clear: both; margin-top: 15px;">

            </div>
        </div>
    </div><br>
    
	<!-- Invoice Footer -->
	<div id="invoice-footer">
		<div class="row">
			<div class="text-xs-center">
			    <a class="btn btn-info" href=""> <i class="icon-open"></i>  View Invoice</a>

			    <a class="btn btn-info" href=""> <i class="icon-printer3"></i>  Print</a>
			</div>
	</div>
	<!--/ Invoice Footer -->


</div>
</div>
</div>
</div>
</div>








</section>
@endsection
