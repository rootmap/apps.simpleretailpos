@extends('apps.layout.master')
@section('title','Invoice Email template')
@section('content')
   
            <div class="col-md-12">
                <a style="border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;" href="{{url('settings/invoice/email/edit')}}" class="btn btn-info">
                    <i class="icon-edit"></i> Edit email invoice
                </a>
                <button style="border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;" type="button" class="btn btn-info" data-toggle="modal" data-target="#Discount">
                    <i class="icon-circle-o"></i> Set send email time
                </button>
                <button style="border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;" type="button" class="btn btn-info"  data-toggle="modal" data-target="#BCC">
                    <i class="icon-cogs"></i> Enable receipt BCC  
                </button>
                <a style="border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important;" href="{{url('settings/invoice/email/edit')}}" class="btn btn-info pull-right" data-toggle="modal" data-target="#testMail">
                    <i class="icon-email2"></i> Send test email  
                </a>
            </div>
        
            
        <div class="col-md-12" 
             style="font-family: serif; font-size:11pt;
             
             padding:10px 15px;
             border-top: 16px solid #3BAFDA;;
             border-right: 6px solid #3BAFDA;
             border-bottom: 6px solid #3BAFDA;
             border-left: 6px solid #3BAFDA; border-radius: 3px; clear: both; display: block;">
            <table width="100%" style="width: 100%;">
                    <tr>
                        <td align="left" style="font-size: large;"><b>{{$editData->company_name}}</b></td>
                        <td align="center" style="font-size: large;"><b>Sales Receipt</b></td>
                        <td align="right" style="font-size: large;"><b>Invoiced To</b></td>
                    </tr>
                    <tr>
                        <td valign="top" style="color:#999999;">
                            <div>
                            <span>{{$editData->city}}</span>
                            </div>
                            <div>
                            <span>{{$editData->address}}</span>
                            <br>
                            </div>
                            <div>
                             <span>{{$editData->phone}}</span>
                             <br>
                         </div>

                        </td>
                        <td  valign="top" align="center" style="color:#999999;">
                            12/08/2018 1:08pm<br>
                            <b style="color: #000;">Sales Rep </b> - Cashier name  <br>
                            <b style="color: #000;">Sales ID</b> - INV001<br>
                            <b style="color: #000;">Sales Tax Rate</b> - 6%<br>


                        </td>
                        <td   valign="top"  align="right" style="color:#999999;">
                            Customer:Velma .C Colone.888<br>
                            Address:348,Mesa Drive.<br>
                            Lass Veg NV,845697<br>
                            Phone Number:555-00-8999<br>
                            E-Mail:velma@gmail.com

                        </td>
                    </tr>

            </table>
            
            <br>
            <br>

            <table width="100%">
                <thead>
                    <tr>
                        <th style="text-align:left; border-bottom: 1px #ccc dotted;">SL</th>
                        <th style="text-align:left; border-bottom: 1px #ccc dotted;">Item Name</th>
                        <th style="text-align:left; border-bottom: 1px #ccc dotted;">Price</th>
                        <th style="text-align:left; border-bottom: 1px #ccc dotted;">Qty:</th>
                        <th style="text-align:right; border-bottom: 1px #ccc dotted;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            Default
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            $20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            $100.00
                        </td>
                    </tr>
                    <tr>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            2
                        </td>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            Default
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            $20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            $100.00
                        </td>
                    </tr>
                    <tr>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            3
                        </td>
                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                            Default
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            $20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            $100.00
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right; border-bottom:1px #ccc dotted; color:#999999;">
                           Number of item sold =  
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted;  font-weight: 900; color:#000;">
                            12
                        </td>
                        <td  style="text-align:right; font-weight: 900; color:#000; border-bottom: 1px #ccc dotted;">
                            Sub-Total = $200.00
                        </td>
                    </tr>
                </tbody>


            </table>
            <br>

            <table  align="right">
                <tbody>
                    <tr>
                        <td rowspan="6" width="200" align="center" valign="middle">
                            <img height="180" src="data:image/png;base64,{{$qrCode['code']}}" />
                        </td>
                        <th  style="color: #000;  font-weight: 900; text-align: right;">Item Sub-Total</th>
                        <td width="100" style="color: #000;  font-weight: 900; text-align: right;">$20.28</td>
                    </tr>
                    <tr>
                        <th style="color: #999999; text-align: right;">6% Sales Tax</th>
                        <td align="right" >$20.28</td>
                    </tr>
                    <tr>
                        <th  style="text-align: right;">Total</th>
                        <td align="right" style="color: #000; font-weight: 900;">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Number of items sold</th>
                        <td align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Payment Method [ Cash ] - Paid</th>
                        <td align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #000;  font-weight: 900; text-align: right;">Change Due</th>
                        <td style="color: #000;  font-weight: 900; text-align: right;">$20.28</td>
                    </tr>
                </tbody>


            </table>
                <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <span style="font-weight: 700;">{{$editData->terms_title}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <span>{{$editData->terms_text}} </span>
                        </td>
                    </tr>
                    
                </tbody>


            </table>
        </div>
        @include('apps.include.modal.InvoiceEmailSendTimeModal')
        @include('apps.include.modal.InvoiceEmailSendBCCModal')
        @include('apps.include.modal.InvoiceEmailSendTestModal')
@endsection


@section("js")
<script type="text/javascript">
$(document).ready(function(e){
   $(".text_changer_field").click(function(){
        $(this).parent().children("span").toggle();
        $(this).parent().children("input").toggle();
        $(this).parent().children("textarea").toggle();
    });

    $(".text_changer").keyup(function(){
        var textData=$(this).val();
        $(this).parent().children("span").html(textData);
    });

 
});
</script>
@endsection