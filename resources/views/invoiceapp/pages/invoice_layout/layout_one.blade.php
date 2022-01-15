@extends('apps.layout.master')
@section('title','invoice template')
@section('content')
<section id="form-action-layouts">

    <style type="text/css">
    
    .box-overflow
    {
        height:  100%;
        width:  100%;
        background: #f00;
        position: absolute;
        top: 0px;
        opacity: 0.2;
        color: #000;
        text-align: center;
        font-weight: 900;
    }

    .box-overflow > a
    {
        opacity: 1;
        background: #000;
        display: block;
        height: 100%;
        padding-top: 5px;
    }    
    
    .uploadNewImage
    {
        opacity: 0;
    }

    .make-def-photo > img
    {
        width: 80%;
        height: 80%;

    }

    </style>

    <form  enctype="multipart/form-data" action="{{url('pos/settings/invoice/save/'.$id)}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
	<div class="row">
        <div class="col-lg-3">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; font-size: 25px; font-weight: bold; padding-left: 0px;">
                14.02.2018            </div>
            <div class="col-md-12" style="padding-top: 20px; padding-bottom: 4px; color: #000; padding-left: 0px;">
                <b>Customer Info <code>Not Editable</code></b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                Customer Name          
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                Customer Address           
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
               Customer Email          
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
               Customer Phone           
            </div>

            <div class="col-md-12" style="padding-top: 21px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Ship To   <code>Not Editable</code></b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                Ship To Name       
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                Ship To Address          
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                Ship To E-Mail            
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px;  color: #008000; padding-left: 0px;">
                Ship To Phone            
            </div>


            <div class="col-md-12" style="padding-top: 35px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <b>Payment Method <br><code>Not Editable</code></b>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                Cash            
            </div>

            <div class="col-md-12 make-def-photo" style="padding-top: 30px; padding-bottom: 4px; padding-left: 0px;">
                <img id="logo" src="{{url('company/'.$edit->logo)}}">
                <input type="file" data-id="logo" name="logo" class="uploadNewImage"  accept="image/*" onchange="loadFile(event,this)">
                <input type="hidden" name="ex_logo" value="{{$edit->logo}}">
                <div class="box-overflow"><a href="javascript:void(0);" class="upload_image"><i class="icon-edit2"></i> Upload</a></div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="col-md-12" style="border-bottom: 5px #000 solid; color: #008000; font-size: 25px; font-weight: bold; padding-left: 0px;">
                <span>{{$edit->company_name}}</span> 
                
                <input size="40" type="text" class="text_changer" value="{{$edit->company_name}}" name="company_name" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-12" style="padding-top: 10px; padding-bottom: 5px; padding-left: 0px; font-size: 15px;">
                <span style="font-weight: bold;">{{$edit->company_thank_you_message}}</span>
                <input size="40" type="text" class="text_changer" value="{{$edit->company_thank_you_message}}" name="company_thank_you_message" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-12" style="padding-top: 4px; padding-bottom: 4px; color: #008000; padding-left: 0px;">
                <span>{{$edit->company_services}}</span>
                <input size="100" type="text" class="text_changer" value="{{$edit->company_services}}" name="company_services" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
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
                <span style="font-weight: bolder;">{{$edit->mm_one}}</span>
                <input size="80" type="text" class="text_changer" value="{{$edit->mm_one}}" name="mm_one" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-12 text-xs-center">
                <span style="font-weight: bolder;">{{$edit->mm_two}}</span>
                <input size="80" type="text" class="text_changer" value="{{$edit->mm_two}}" name="mm_two" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-12 text-xs-center">
                <span style="font-weight: bolder;">{{$edit->mm_three}}</span>
                <input size="80" type="text" class="text_changer" value="{{$edit->mm_three}}" name="mm_three" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-12 text-xs-center">
                <span style="font-weight: bolder;">{{$edit->mm_four}}</span>
                <input size="80" type="text" class="text_changer" value="{{$edit->mm_four}}" name="mm_four" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-11 text-left" style="padding-left: 0px; border-bottom: 3px #000 solid; font-size: 28px; color: #008000;">
                <span style="font-weight: bolder;">{{$edit->fotter_company_name}}</span>
                <input size="30" type="text" class="text_changer" value="{{$edit->fotter_company_name}}" name="fotter_company_name" style="display: none;">
                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
            </div>
            <div class="col-md-1 text-left make-def-photo" style="padding-left: 0px; font-size: 28px; color: #008000;">
                <img id="logo_fotter" src="{{url('company/'.$edit->logo_fotter)}}" style="margin-top: 21px;">
                <input type="file" data-id="logo_fotter" name="logo_fotter" class="uploadNewImage"  accept="image/*" onchange="loadFile(event,this)">
                <input type="hidden" name="ex_logo_fotter" value="{{$edit->ex_logo_fotter}}">
                <div class="box-overflow"><a href="javascript:void(0);" style="font-size: 14px;" class="upload_image"><i class="icon-edit2"></i> Upload</a></div>
            </div>
            <div class="col-md-12" style="clear: both;">
                <div class="col-md-3 text-xs-center">
                    <span>{{$edit->c_one}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_one}}" name="c_one" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>
                <div class="col-md-5 text-xs-center">
                    <span>{{$edit->c_two}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_two}}" name="c_two" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>
                <div class="col-md-4 text-xs-center">
                    <span>{{$edit->c_three}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_three}}" name="c_three" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>

                <div class="col-md-3 text-xs-center">
                    <span>{{$edit->c_four}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_four}}" name="c_four" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>
                <div class="col-md-5 text-xs-center">
                    <span>{{$edit->c_five}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_five}}" name="c_five" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>
                <div class="col-md-4 text-xs-center">
                    <span>{{$edit->c_six}}</span>
                    <input size="25" type="text" class="text_changer" value="{{$edit->c_six}}" name="c_six" style="display: none;">
                    <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                </div>
            </div>
            <div class="col-md-12" style="border-bottom: 5px #000 solid; clear: both; margin-top: 15px;">
                
            </div>
        </div>
    </div><br>

    <div class="col-md-12" style=" clear: both; margin-bottom: 15px;">
        <div class="col-md-12 text-xs-center">Terms &amp; Condition </div>
        <div class="col-md-12 text-xs-center">
            <span>{{$edit->terms}}</span>
            <textarea cols="100" type="text" class="text_changer" name="terms" style="display: none; line-height: 1em; height: 100px;">{{$edit->terms}}</textarea>
            <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
        </div>
    </div>
    
	<!-- Invoice Footer -->
	<div id="invoice-footer" style="padding-bottom: 50px;">
		<div class="row">
			<div class="text-xs-center">
			    <button class="btn btn-primary" type="submit"> <i class="icon-file"></i> Save Invoice One </button>
			</div>
	</div>
	<!--/ Invoice Footer -->


</div>
</div>
</div>
</div>
</div>



</form>




</section>
@endsection

@section('js')
    @include('apps.include.invoice_one_js')
@endsection