@extends('apps.layout.master')
@section('title','Update Invoice Email template')
@section('content')
        <form action="{{url('settings/invoice/email/update')}}" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            
        <div 
             style="margin-top:50px; font-family: serif; font-size:11pt;
             margin: 50px;
             padding:10px 15px;
             border-top: 16px solid #3BAFDA;;
             border-right: 6px solid #3BAFDA;
             border-bottom: 6px solid #3BAFDA;
             border-left: 6px solid #3BAFDA; border-radius: 3px; clear: both; display: block;">
            <table width="100%" style="width: 100%;">
                    <tr>
                        <td align="left">
                            <span>{{$editData->company_name}}</span>
                            <input size="40" type="text" class="text_changer" name="company_name" value="{{$editData->company_name}}" style="display: none;">
                            <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                        <td align="center">Sales Receipt</td>
                        <td align="right">Invoiced To:</td>
                    </tr>
                    <tr>
                        <td valign="top" style="color:#999999;">
                            <div>
                            <span>{{$editData->city}}</span>
                              
                                <input size="40" type="text" class="text_changer" name="city" value="{{$editData->city}}" style="display: none;">                         
                                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a><br>
                            </div>
                            <div>
                            <span>{{$editData->address}}</span>
                         
                             <input size="40" type="text" class="text_changer" name="address" value="{{$editData->address}}" style="display: none;">                          
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a><br>
                            </div>
                            <div>
                             <span>{{$editData->phone}}</span>
                             <input size="40" type="text" class="text_changer" name="phone" value="{{$editData->phone}}" style="display: none;">                           
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a><br>
                         </div>

                        </td>
                        <td  valign="top" align="center" style="color:#999999;">
                            12/08/2018 1:08pm<br>POS 19
                            Sale ID<br>silver
                            Tire Name<br>
                            Employee<br>
                            Merchant ID:<br>


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
                        <th style="text-align:left;border-bottom: 1px #ccc dotted;">Price</th>
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
                            20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            100
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
                            20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            100
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
                            20.22
                        </td>
                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                            1
                        </td>
                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                            100
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
                        <th  style="color: #999999; text-align: right;">Sub Total</th><td width="100" align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th style="color: #999999; text-align: right;">6% Sales Tax</th><td align="right" >$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Total</th><td align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Number of items sold</th><td align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Payment Type cash</th><td align="right">$20.28</td>
                    </tr>
                    <tr>
                        <th  style="color: #999999; text-align: right;">Change Due</th><td align="right">$20.28</td>
                    </tr>
                </tbody>


            </table>
                <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <span style="font-weight: 700;">{{$editData->terms_title}}</span>
                            <input class="text_changer" name="terms_title" style="display: none;" />
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <span>{{$editData->terms_text}} </span>
                            <textarea class="text_changer" name="terms_text" style="display: none; line-height: 1em; height: 100px; width: 100%;"></textarea>
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                    </tr>
                </tbody>


            </table>
             <div  align="center" style="padding-top: 15px;">
                 <button  class="btn btn-info">Update</button>
                 <a href="{{url('settings/invoice/email')}}" class="btn btn-info btn-lighten-2">Back</a>
             </div>
        </div>
        </form>
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