<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\StripeStoreSetting;
use App\StripeTransactionHistory;
   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Stripe ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function stripe()
    {
        return view('stripe');
    }

    public function stripeSettings()
    {
        $countData=\DB::table('stripe_store_settings')->where('store_id',$this->sdc->storeID())->count();
        if($countData>0)
        {
           $edit=\DB::table('stripe_store_settings')->where('store_id',$this->sdc->storeID())->first();
           return view('apps.pages.settings.stripeSettings',compact('edit'));
        }
        else
        {
            return view('apps.pages.settings.stripeSettings');
        }
        
    }

    public function stripeSettingsSave(Request $request)
    {
        $module_status=$request->module_status?1:0;
        \DB::table('stripe_store_settings')->insert(
            [
                'publishable_key'=>$request->publishable_key,
                'secret_key'=>$request->secret_key,
                'module_status'=>$module_status,
                'store_id'=>$this->sdc->storeID()
            ]);

        return redirect(url('stripe/account/setting'))->with('status', $this->moduleName.' Added Successfully !');;
    }

    public function stripeSettingsUpdate(Request $request)
    {
        $module_status=$request->module_status?1:0;
        \DB::table('stripe_store_settings')->where('store_id',$this->sdc->storeID())->update(
            [
                'publishable_key'=>$request->publishable_key,
                'secret_key'=>$request->secret_key,
                'module_status'=>$module_status
            ]);

        return redirect(url('stripe/account/setting'))->with('status', $this->moduleName.' Modified Successfully !');;
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function stripePost(Request $request)
    {


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment=Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from v4.nucleuspos.com." 
        ]);

        dd($payment);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }*/

    public function show(request $request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(lsp_stripe_transaction_histories.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =StripeTransactionHistory::select('card_number')->groupBy('card_number')->get();
        // dd($code);
        $tab=StripeTransactionHistory::select('stripe_transaction_histories.*')
                     ->where('stripe_transaction_histories.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('stripe_transaction_histories.invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("stripe_transaction_histories.id","DESC")
                     ->get();
         // dd($tab);                 
        return view('apps.pages.report.card-payment-history-stripe',
            [
                'dataTable'=>$tab,
                'invoice_id'=>$invoice_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    public function AuthReport(Request $request)
        {

            $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(lsp_stripe_transaction_histories.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =StripeTransactionHistory::select('card_number')->groupBy('card_number')->get();
        // dd($code);
        $tab=StripeTransactionHistory::select('stripe_transaction_histories.*')
                     ->where('stripe_transaction_histories.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('stripe_transaction_histories.invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("stripe_transaction_histories.id","DESC")
                     ->get();

          // dd($tab);
            return $tab;
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\ProductStockin  $productStockin
         * @return \Illuminate\Http\Response
         */
        
        public function ExcelReport(Request $request) 
        {
            // dd($request);
            //excel 
            $total_paid_amount=0;
            $data=array();
            $array_column=array('Invoice ID','Card Number','Card Type','Transaction ID','Paid Amount','Date');
            array_push($data, $array_column);
            $inv=$this->AuthReport($request);
            foreach($inv as $voi):
                $inv_arry=array(
                    $voi->invoice_id,
                    $voi->card_number,
                    $voi->CardType,
                    $voi->transactionID,
                    $voi->paid_amount,
                    formatDateTime($voi->created_at)
                );
                $total_paid_amount+=$voi->paid_amount;
                array_push($data, $inv_arry);
            endforeach;

            $array_column=array('','','','Total =',$total_paid_amount,'');
            array_push($data, $array_column);

            $reportName="Stripe Card Payment History Report";
            $report_title="Stripe Card Payment History Report";
            $report_description="Report Genarated : ".date('d-M-Y H:i:s a');
            /*$data = array(
                array('data1', 'data2'),
                array('data3', 'data4')
            );*/

            //array_unshift($data,$array_column);

           // dd($data);

            $excelArray=array(
                'report_name'=>$reportName,
                'report_title'=>$report_title,
                'report_description'=>$report_description,
                'data'=>$data
            );

            $this->sdc->ExcelLayout($excelArray);
            
        }


        public function PdfReport(Request $request)
        {

            $data=array();
            
           
            $reportName="Stripe Card Payment History Report";
            $report_title="Stripe Card Payment History Report";
            $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

            $html='<table class="table table-bordered" style="width:100%;">
                    <thead>
                    <tr>
                    <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                    <th class="text-center" style="font-size:12px;" >Card Number</th>
                    <th class="text-center" style="font-size:12px;" >Card Type</th>
                    <th class="text-center" style="font-size:12px;" >Transaction ID</th>
                    <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                    <th class="text-center" style="font-size:12px;" >Date</th>
                    </tr>
                    </thead>
                    <tbody>';


                        $total_paid_amount=0;
                        $inv=$this->AuthReport($request);
                        foreach($inv as $index=>$voi):
        
                            $html .='<tr>
                            <td>'.$voi->invoice_id.'</td>
                            <td>'.$voi->card_number.'</td>
                            <td>'.$voi->CardType.'</td>
                            <td>'.$voi->transactionID.'</td>
                            <td align="center">'.$voi->paid_amount.'</td>
                            <td>'.formatDateTime($voi->created_at).'</td>
                            </tr>';
                            $total_paid_amount+=$voi->paid_amount;
                        endforeach;



                            

                 
                    /*html .='<tr style="border-bottom: 5px #000 solid;">
                    <td style="font-size:12px;">Subtotal </td>
                    <td style="font-size:12px;">Total Item : 4</td>
                    <td></td>
                    <td></td>
                    <td style="font-size:12px;" class="text-right">00</td>
                    </tr>';*/

                    $html .='</tbody>';
                    $html .='<tfoot>';
                    $html .='<tfoot>';
                    $html .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td align="center">'.$total_paid_amount.'</td>
                    <td></td>
                    </tr>';
                    $html .='</table>';

                    //echo $html; die();



                    $this->sdc->PDFLayout($reportName,$html);


        }
}