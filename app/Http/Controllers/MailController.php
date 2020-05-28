<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class MailController extends Controller {
  

   private $moduleName="Mail Sender";
   private $sdc;
   public function __construct(){ $this->sdc = new StaticDataController(); }

  public function basic_email()
  {

      echo $this->sdc->initMail(
         'f.bhuyian@gmail.com',
         'Testing Mail From Static Data Controller',
         '<div 
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
                            <span>PHP LILC,POS</span>
                            <input size="40" type="text" class="text_changer" name="company_name" value="PHP LILC,POS" style="display: none;">
                            <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                        <td align="center">Sales Receipt</td>
                        <td align="right">Invoiced To:</td>
                    </tr>
                    <tr>
                        <td valign="top" style="color:#999999;">
                            <div>
                            <span>Dhaka.Bangladesh</span>
                              
                                <input size="40" type="text" class="text_changer" name="city" value="Dhaka.Bangladesh" style="display: none;">                         
                                <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a><br>
                            </div>
                            <div>
                            <span>Mirpur,Dhaka ,Bangladhesh</span>
                         
                             <input size="40" type="text" class="text_changer" name="address" value="Mirpur,Dhaka ,Bangladhesh" style="display: none;">                          
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a><br>
                            </div>
                            <div>
                             <span>555-555-555*************</span>
                             <input size="40" type="text" class="text_changer" name="phone" value="555-555-555*************" style="display: none;">                           
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
                            <span style="font-weight: 700;">Treams &amp; Condation 1</span>
                            <input class="text_changer" name="terms_title" style="display: none;" />
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <span>Thanks Sir, You Are Good </span>
                            <textarea class="text_changer" name="terms_text" style="display: none; line-height: 1em; height: 100px; width: 100%;"></textarea>
                             <a href="javascript:void(0);" class="text_changer_field"><i class="icon-edit2"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #999999;">
                            <br>
                            <img height="130" src="data:image/png;base64,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" />
                        </td>
                    </tr>
                </tbody>


            </table>
             <div  align="center" style="padding-top: 15px;">
                 <button  class="btn btn-info">Update</button>
             </div>
        </div>
');
  }


}


