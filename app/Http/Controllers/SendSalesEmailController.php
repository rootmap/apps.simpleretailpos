<?php

namespace App\Http\Controllers;

use App\SendSalesEmail;
use App\Invoice;
use App\Customer;
use App\InvoicePayment;
use App\AuthorizeNetPayment;
use App\InvoiceProduct;
use App\User;
use Illuminate\Http\Request;

class SendSalesEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Invoice Email Send";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        //
    }

    public function InvoiceMailSend(Request $request)
    {
        $edQr=$this->sdc->invoiceEmailTemplate();
        $emaillayoutData=$edQr['editData'];
        $bcc=$emaillayoutData->bcc?$emaillayoutData->bcc:'';

        $invoiceID=$request->invoice_id;
        $email_address=$request->email_address;

        $tabsse=new SendSalesEmail;
        $tabsse->invoice_id=$invoiceID;
        $tabsse->email_address=$email_address;
        $tabsse->bcc_email_address=$bcc;
        $tabsse->email_process_type=1;
        $tabsse->store_id=$this->sdc->storeID();
        $tabsse->created_by=$this->sdc->UserID();
        $tabsse->save();

        $this->instantMailSendByInvoice($invoiceID);

        return redirect('sales/report')
                 ->with('status','Sales invoice in queue, E-mail will be send shortly.');
    }

    private function InvoicePaymentByInvoice($invoiceID,$storeID=0)
    {
        if(!empty($storeID))
        {
            $dataCount=InvoicePayment::where('invoice_id',$invoiceID)
                                 ->where('store_id',$storeID)
                                 ->count();
            $dataResult="";
            if($dataCount>0)
            {
                $data=InvoicePayment::where('invoice_id',$invoiceID)
                                     ->where('store_id',$storeID)
                                     ->get();

                $dataResult=$data;
                return $dataResult;
            }
            else
            {
                return $dataResult;
            }
        }
        else
        {
            $dataCount=InvoicePayment::where('invoice_id',$invoiceID)
                                 ->where('store_id',$this->sdc->storeID())
                                 ->count();
            $dataResult="";
            if($dataCount>0)
            {
                $data=InvoicePayment::where('invoice_id',$invoiceID)
                                     ->where('store_id',$this->sdc->storeID())
                                     ->get();

                $dataResult=$data;
                return $dataResult;
            }
            else
            {
                return $dataResult;
            }
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function instantMailSendByInvoice($invoiceID=0)
    {

        
        $dataCheck=SendSalesEmail::where('email_process_type',1)
                                 ->where('email_send_status','Not Send')
                                 ->where('invoice_id',$invoiceID)
                                 ->count();
        //dd($dataCheck);
        if($dataCheck>0)
        {
            $dataEmail=SendSalesEmail::where('email_process_type',1)
                       ->where('email_send_status','Not Send')
                       ->where('invoice_id',$invoiceID)
                       ->get();

            foreach($dataEmail as $dm)
            {   
                $invoice_id=$dm->invoice_id;
                $to_email=$dm->email_address;
                $bcc_email_address=$dm->bcc_email_address?$dm->bcc_email_address:'';
                $store_id=$dm->store_id?$dm->store_id:0;
                $created_by=$dm->created_by?$dm->created_by:0;

                $InvoiceInfo=Invoice::where('invoice_id',$invoice_id)
                            ->first();
                $TaxRate=$InvoiceInfo->tax_rate;



                $cashierInfo=User::find($created_by);
                $cashierName=$cashierInfo->name;
                //dd();
                $CustomerInfo=Customer::find($InvoiceInfo->customer_id);
                //dd($CustomerInfo);
                $CustomerName=substr($CustomerInfo->name,0,15);
                $CustomerAddress=substr($CustomerInfo->address,0,20);
                $CustomerPhone=$CustomerInfo->phone;
                $CustomerEmail=$CustomerInfo->email;

                

                $filename=$store_id.'.png';

                $edQr=$this->sdc->invoiceEmailTemplate($store_id,$created_by);

                $editData=$edQr['editData'];
                $qrCode=$edQr['qrCode'];

                //echo $filename; die();
        
                if($this->sdc->checkFile('./qrcode/'.$filename))
                {
                    //echo 1; die();
                    $imageName=$filename;
                }
                else
                {
                    //echo 2; die();
                    $imageName=$this->sdc->createImageFromBase64($filename,'qrcode',$qrCode['code']);
                }

                $tab_invoice_product=InvoiceProduct::join('products','invoice_products.product_id','=','products.id')
                                               ->where('invoice_products.invoice_id',$invoice_id)
                                               ->where('invoice_products.store_id',$store_id)
                                               ->select('invoice_products.*','products.name as product_name')
                                               ->get();
                
               //echo 1; die();
                $emailBody='';
                $emailBody.='<div class="col-md-12" 
                             style="font-family: serif; font-size:11pt;
                             padding:10px 15px;
                             border-top: 16px solid #3BAFDA;;
                             border-right: 6px solid #3BAFDA;
                             border-bottom: 6px solid #3BAFDA;
                             border-left: 6px solid #3BAFDA; border-radius: 3px; clear: both; display: block;">
                            <table width="100%" style="width: 100%;">
                                    <tr>
                                        <td align="left" style="font-size: large;"><b>'.$editData->company_name.'</b></td>
                                        <td align="center" style="font-size: large;"><b>Sales Receipt</b></td>
                                        <td align="right" style="font-size: large;"><b>Invoiced To</b></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="color:#999999;">
                                            <div>
                                            <span>'.$editData->city.'</span>
                                            </div>
                                            <div>
                                            <span>'.$editData->address.'</span>
                                            <br>
                                            </div>
                                            <div>
                                             <span>'.$editData->phone.'</span>
                                             <br>
                                         </div>

                                        </td>
                                        <td  valign="top" align="center" style="color:#999999;">
                                            '.date('d/m/Y h:i a',strtotime($dm->created_at)).'<br>
                                            <b style="color: #000;">Sales Rep </b> - '.$cashierName.'  <br>
                                            <b style="color: #000;">Sales ID</b> - INV'.$invoice_id.'<br>
                                            <b style="color: #000;">Sales Tax Rate</b> - '.$TaxRate.'%<br>


                                        </td>
                                        <td   valign="top"  align="right" style="color:#999999;">
                                            Customer:'.$CustomerName.'<br>
                                            Address:'.$CustomerAddress.'.<br>
                                            Phone Number:'.$CustomerPhone.'<br>
                                            E-Mail: '.$CustomerEmail.'

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
                                <tbody>';

                        $subTotal=0;
                        $total=0;
                        $tender='';
                        $ai=0;
                        $ai_quantity=0;
                        if(isset($tab_invoice_product)){
                            foreach($tab_invoice_product as $inv){  
                                  
                        $emailBody.='<tr>
                                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                                            '.($ai+1).'
                                        </td>
                                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                                            '.$inv->product_name.'
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                                            $'.number_format($inv->price,2).'
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                                            '.$inv->quantity.'
                                        </td>
                                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                                            $'.number_format($inv->total_price,2).'
                                        </td>
                                    </tr>';
                                $ai_quantity+=$inv->quantity;
                                $subTotal+=$inv->total_price;
                                $ai+=1;
                            }
                        }

                        $emailBody.='
                                    <tr>
                                        <td colspan="3" style="text-align: right; border-bottom:1px #ccc dotted; color:#999999;">
                                           Number of item sold =  
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted;  font-weight: 900; color:#000;">
                                            '.$ai_quantity.'
                                        </td>
                                        <td  style="text-align:right; font-weight: 900; color:#000; border-bottom: 1px #ccc dotted;">
                                            Sub-Total = $'.number_format($subTotal,2).'
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                            <br>

                            <table  align="right">
                                <tbody>
                                    <tr>
                                        <td rowspan="7" width="200" align="center" valign="middle">
                                        </td>
                                        <th  style="color: #000;  font-weight: 900; text-align: right;">Item Sub-Total</th>
                                        <td width="100" style="color: #000;  font-weight: 900; text-align: right;">$'.number_format($subTotal,2).'</td>
                                    </tr>
                                    <tr>
                                        <th style="color: #999999; text-align: right;">'.$TaxRate.'% Sales Tax</th>
                                        <td align="right" >$'.number_format($InvoiceInfo->total_tax,2).'</td>
                                    </tr>
                                    <tr>
                                        <th  style="text-align: right;">Net Total</th>
                                        <td align="right" style="color: #000; font-weight: 900;">$'.number_format(($subTotal+$InvoiceInfo->total_tax), 2).'</td>
                                    </tr>
                                    <tr>
                                        <th style="color: #999999; text-align: right;">Discount Amount</th>
                                        <td align="right" >$'.number_format($InvoiceInfo->discount_total, 2).'</td>
                                    </tr>
                                    <tr>
                                        <th  style="text-align: right;">Net Payable</th>
                                        <td align="right" style="color: #000; font-weight: 900;">$'.number_format((($subTotal+$InvoiceInfo->total_tax)-$InvoiceInfo->discount_total), 2).'</td>
                                    </tr>';
                                    $paidAll=0;
                                    $dataInvPa=$this->InvoicePaymentByInvoice($InvoiceInfo->invoice_id);
                                    if(isset($dataInvPa))
                                    {
                                        foreach($dataInvPa as $vpa):
                                    $emailBody.='   <tr>
                                                        <th  style="color: #999999; text-align: right;">Payment Method [ '.$vpa->tender_name.' ] - Paid</th>
                                                        <td align="right">$'.number_format($vpa->paid_amount,2).'</td>
                                                    </tr>';
                                        $paidAll+=$vpa->paid_amount;
                                        endforeach;
                                    }

                                    $leftDue=(($subTotal+$InvoiceInfo->total_tax)-$InvoiceInfo->discount_total)-$paidAll;
                                    if($leftDue<0)
                                    {
                                        $leftDue=0;
                                    }

                    $emailBody.='   <tr>
                                        <th  style="color: #000;  font-weight: 900; text-align: right;">Change Due</th>
                                        <td style="color: #000;  font-weight: 900; text-align: right;">$'.$leftDue.'</td>
                                    </tr>
                                </tbody>


                            </table>
                                <table style="width: 100%;">
                                <tbody>

                                    <tr>
                                        <td align="center" style="color: #999999;">
                                            <span style="font-weight: 700;">'.$editData->terms_title.'</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="color: #999999;">
                                            <span>'.$editData->terms_text.' </span>
                                        </td>
                                    </tr>';


                    $chkEmailInvoice=AuthorizeNetPayment::where('store_id',$InvoiceInfo->store_id)
                                                        ->where('active_module_for_email_invoice',1)
                                                        ->count();
                    if($chkEmailInvoice>0 && $leftDue > 1)
                    {
                        $emailBody.='   <tr>
                                        <td align="center" style="color: #999999;">
                                            <br />
                                            <br />
                                            <table border="0" cellpadding="0" cellspacing="0" style="background-color:#505050; border:1px solid #353535; border-radius:5px;">
                                              <tr>
                                                <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; letter-spacing:-.5px; line-height:100%; padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px;">
                                                  <a href="'.url('invoice/pay/'.$invoiceID).'" target="_blank" style="color:#FFFFFF; text-decoration:none;"> Pay online or Save </a>
                                                </td>
                                              </tr>
                                            </table>
                                        </td>
                                    </tr>';
                    }
                    
                                    
                    $emailBody.='   </tbody>


                            </table>

                            

                        </div>';


                       // echo $$emailBody; die();

                $mailSendStatus=$this->sdc->initMail($to_email,
                 $this->sdc->storeName().' - Invoice',
                 $emailBody);
                $tab=SendSalesEmail::find($dm->id);
                if($mailSendStatus==1)
                    { 
                        $tab->email_send_status='Send'; 
                        $tab->save();
                    }
                else
                    { 
                        $tab->email_send_status='Failed To Send';
                        $tab->save(); 
                    }
            }
        }

        //echo "Doing OOK....";

        
    }

    public function instantMailSend()
    {
        $dataCheck=SendSalesEmail::where('email_process_type',1)->where('email_send_status','Not Send')->count();
        //dd($dataCheck);
        if($dataCheck>0)
        {
            $dataEmail=SendSalesEmail::where('email_process_type',1)
                       ->where('email_send_status','Not Send')
                       ->take(100)
                       ->get();

            foreach($dataEmail as $dm)
            {   
                $invoice_id=$dm->invoice_id;
                $to_email=$dm->email_address;
                $bcc_email_address=$dm->bcc_email_address?$dm->bcc_email_address:'';
                $store_id=$dm->store_id?$dm->store_id:0;
                $created_by=$dm->created_by?$dm->created_by:0;

                $InvoiceInfo=Invoice::where('invoice_id',$invoice_id)
                            ->first();
                $TaxRate=$InvoiceInfo->tax_rate;

                $cashierInfo=User::find($created_by);
                $cashierName=$cashierInfo->name;
                //dd();
                $CustomerInfo=Customer::find($InvoiceInfo->customer_id);
                //dd($CustomerInfo);
                $CustomerName=substr($CustomerInfo->name,0,15);
                $CustomerAddress=substr($CustomerInfo->address,0,20);
                $CustomerPhone=$CustomerInfo->phone;
                $CustomerEmail=$CustomerInfo->email;

                

                $filename=$store_id.'.png';

                $edQr=$this->sdc->invoiceEmailTemplate($store_id,$created_by);

                $editData=$edQr['editData'];
                $qrCode=$edQr['qrCode'];
        
                if($this->sdc->checkFile('qrcode/'.$filename))
                {
                    $imageName=$filename;
                }
                else
                {
                    $imageName=$this->sdc->createImageFromBase64($filename,'qrcode',$qrCode['code']);
                }

                $tab_invoice_product=InvoiceProduct::join('products','invoice_products.product_id','=','products.id')
                                               ->where('invoice_products.invoice_id',$invoice_id)
                                               ->where('invoice_products.store_id',$store_id)
                                               ->select('invoice_products.*','products.name as product_name')
                                               ->get();
                
               
                $emailBody='';
                $emailBody.='<div class="col-md-12" 
                             style="font-family: serif; font-size:11pt;
                             padding:10px 15px;
                             border-top: 16px solid #3BAFDA;;
                             border-right: 6px solid #3BAFDA;
                             border-bottom: 6px solid #3BAFDA;
                             border-left: 6px solid #3BAFDA; border-radius: 3px; clear: both; display: block;">
                            <table width="100%" style="width: 100%;">
                                    <tr>
                                        <td align="left" style="font-size: large;"><b>'.$editData->company_name.'</b></td>
                                        <td align="center" style="font-size: large;"><b>Sales Receipt</b></td>
                                        <td align="right" style="font-size: large;"><b>Invoiced To</b></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="color:#999999;">
                                            <div>
                                            <span>'.$editData->city.'</span>
                                            </div>
                                            <div>
                                            <span>'.$editData->address.'</span>
                                            <br>
                                            </div>
                                            <div>
                                             <span>'.$editData->phone.'</span>
                                             <br>
                                         </div>

                                        </td>
                                        <td  valign="top" align="center" style="color:#999999;">
                                            '.date('d/m/Y h:i a',strtotime($dm->created_at)).'<br>
                                            <b style="color: #000;">Sales Rep </b> - '.$cashierName.'  <br>
                                            <b style="color: #000;">Sales ID</b> - INV'.$invoice_id.'<br>
                                            <b style="color: #000;">Sales Tax Rate</b> - '.$TaxRate.'%<br>


                                        </td>
                                        <td   valign="top"  align="right" style="color:#999999;">
                                            Customer:'.$CustomerName.'<br>
                                            Address:'.$CustomerAddress.'.<br>
                                            Phone Number:'.$CustomerPhone.'<br>
                                            E-Mail:'.$CustomerEmail.'

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
                                <tbody>';

                        $subTotal=0;
                        $total=0;
                        $tender='';
                        $ai=0;
                        $ai_quantity=0;
                        if(isset($tab_invoice_product)){
                            foreach($tab_invoice_product as $inv){  
                                  
                        $emailBody.='<tr>
                                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                                            '.($ai+1).'
                                        </td>
                                        <td  style="border-bottom:1px #ccc dotted; color:#999999;">
                                            '.$inv->product_name.'
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                                            $'.number_format($inv->price,2).'
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted; color:#999999;">
                                            '.$inv->quantity.'
                                        </td>
                                        <td  style="text-align:right; color:#999999; border-bottom: 1px #ccc dotted;">
                                            $'.number_format($inv->total_price,2).'
                                        </td>
                                    </tr>';
                                $ai_quantity+=$inv->quantity;
                                $subTotal+=$inv->total_price;
                                $ai+=1;
                            }
                        }

                        $emailBody.='
                                    <tr>
                                        <td colspan="3" style="text-align: right; border-bottom:1px #ccc dotted; color:#999999;">
                                           Number of item sold =  
                                        </td>
                                        <td  style="border-bottom: 1px #ccc dotted;  font-weight: 900; color:#000;">
                                            '.$ai_quantity.'
                                        </td>
                                        <td  style="text-align:right; font-weight: 900; color:#000; border-bottom: 1px #ccc dotted;">
                                            Sub-Total = $'.number_format($subTotal,2).'
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                            <br>

                            <table  align="right">
                                <tbody>
                                    <tr>
                                        <td rowspan="7" width="200" align="center" valign="middle">
                                            <img height="180" src="'.url('qrcode/'.$imageName).'" />
                                        </td>
                                        <th  style="color: #000;  font-weight: 900; text-align: right;">Item Sub-Total</th>
                                        <td width="100" style="color: #000;  font-weight: 900; text-align: right;">$'.number_format($subTotal,2).'</td>
                                    </tr>
                                    <tr>
                                        <th style="color: #999999; text-align: right;">'.$TaxRate.'% Sales Tax</th>
                                        <td align="right" >$'.number_format($InvoiceInfo->total_tax,2).'</td>
                                    </tr>
                                    <tr>
                                        <th  style="text-align: right;">Net Total</th>
                                        <td align="right" style="color: #000; font-weight: 900;">$'.number_format(($subTotal+$InvoiceInfo->total_tax), 2).'</td>
                                    </tr>
                                    <tr>
                                        <th style="color: #999999; text-align: right;">Discount Amount</th>
                                        <td align="right" >$'.number_format($InvoiceInfo->discount_total, 2).'</td>
                                    </tr>
                                    <tr>
                                        <th  style="text-align: right;">Net Payable</th>
                                        <td align="right" style="color: #000; font-weight: 900;">$'.number_format((($subTotal+$InvoiceInfo->total_tax)-$InvoiceInfo->discount_total), 2).'</td>
                                    </tr>';
                                    $paidAll=0;
                                    $dataInvPa=$this->InvoicePaymentByInvoice($InvoiceInfo->invoice_id);
                                    if(isset($dataInvPa))
                                    {
                                        foreach($dataInvPa as $vpa):
                                    $emailBody.='   <tr>
                                                        <th  style="color: #999999; text-align: right;">Payment Method [ '.$vpa->tender_name.' ] - Paid</th>
                                                        <td align="right">$'.number_format($vpa->paid_amount,2).'</td>
                                                    </tr>';
                                        $paidAll+=$vpa->paid_amount;
                                        endforeach;
                                    }

                                    $leftDue=(($subTotal+$InvoiceInfo->total_tax)-$InvoiceInfo->discount_total)-$paidAll;
                                    if($leftDue<0)
                                    {
                                        $leftDue=0;
                                    }

                    $emailBody.='   <tr>
                                        <th  style="color: #000;  font-weight: 900; text-align: right;">Change Due</th>
                                        <td style="color: #000;  font-weight: 900; text-align: right;">$'.$leftDue.'</td>
                                    </tr>
                                </tbody>


                            </table>
                                <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td align="center" style="color: #999999;">
                                            <span style="font-weight: 700;">'.$editData->terms_title.'</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" style="color: #999999;">
                                            <span>'.$editData->terms_text.' </span>
                                        </td>
                                    </tr>
                                    
                                </tbody>


                            </table>
                        </div>';

                $mailSendStatus=$this->sdc->initMail($to_email,
                 $this->sdc->storeName().' - Invoice',
                 $emailBody);
                $tab=SendSalesEmail::find($dm->id);
                if($mailSendStatus==1)
                    { 
                        $tab->email_send_status='Send'; 
                        $tab->save();
                    }
                else
                    { 
                        $tab->email_send_status='Failed To Send';
                        $tab->save(); 
                    }
            }
        }

        echo "Doing OOK....";

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SendSalesEmail  $sendSalesEmail
     * @return \Illuminate\Http\Response
     */
    public function show(SendSalesEmail $sendSalesEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SendSalesEmail  $sendSalesEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(SendSalesEmail $sendSalesEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SendSalesEmail  $sendSalesEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SendSalesEmail $sendSalesEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SendSalesEmail  $sendSalesEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SendSalesEmail $sendSalesEmail)
    {
        //
    }
}
