<?php

namespace App\Http\Controllers;

use App\AuthorizeNetPaymentHistory;
use Illuminate\Http\Request;
use DB;
class AuthorizeNetPaymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Authorize.net Payment History";
    private $sdc;
    public function __construct()
    { 
        $this->sdc = new StaticDataController();  
    }

    public function index()
    {
        $cardInfoData=AuthorizeNetPaymentHistory::select('*',\DB::Raw('(HOUR(TIMEDIFF(NOW(),created_at))) AS hour_gone'))
                                                ->where('store_id',$this->sdc->storeID())
                                                ->orderBy('id','DESC')
                                                ->get();
        return view('apps.pages.report.card-payment-history-authorizenet',
        	[
        		'dataTable'=>$cardInfoData
        	]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */
    public function show(AuthorizeNetPaymentHistory $authorizeNetPaymentHistory, request $request)
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
            $dateString="CAST(lsp_authorize_net_payment_histories.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =AuthorizeNetPaymentHistory::select(DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($code);
        $tab=AuthorizeNetPaymentHistory::select('authorize_net_payment_histories.*')
                     ->where('authorize_net_payment_histories.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('authorize_net_payment_histories.invoice_id','=', $invoice_id);
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
                     ->orderBy("authorize_net_payment_histories.id","DESC")
                     ->get();
         // dd($tab);                 
        return view('apps.pages.report.card-payment-history-authorizenet',
            [
                'dataTable'=>$tab,
                'invoice_id'=>$invoice_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */

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
            $dateString="CAST(lsp_authorize_net_payment_histories.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =AuthorizeNetPaymentHistory::select(DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($code);
        $tab=AuthorizeNetPaymentHistory::select('authorize_net_payment_histories.*')
                     ->where('authorize_net_payment_histories.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('authorize_net_payment_histories.invoice_id','=', $invoice_id);
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
                     ->orderBy("authorize_net_payment_histories.id","DESC")
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
	        $data=array();
	        $array_column=array('Invoice ID','Card Number','Card Type','Transaction ID','Paid Amount','Date');
	        array_push($data, $array_column);
	        $inv=$this->AuthReport($request);
	        foreach($inv as $voi):
	            $inv_arry=array(
	            	$voi->invoice_id,
	            	substr($voi->card_number,-4),
	            	$voi->CardType,
	            	$voi->transactionID,
	            	$voi->paid_amount,
	            	$voi->created_at
	            );
	            array_push($data, $inv_arry);
	        endforeach;

	        $reportName="Card Payment History Report";
	        $report_title="Card Payment History Report";
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
	        
	       
	        $reportName="Card Payment History Report";
	        $report_title="Card Payment History Report";
	        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

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



	                    $inv=$this->AuthReport($request);
	                    foreach($inv as $index=>$voi):
	    
	                        $html .='<tr>
	                        <td>'.$voi->invoice_id.'</td>
	                        <td>'.(substr($voi->card_number,-4)).'</td>
	                        <td>'.$voi->CardType.'</td>
	                        <td>'.$voi->transactionID.'</td>
	                        <td align="center">'.$voi->paid_amount.'</td>
	                        <td>'.date('Y-m-d',strtotime($voi->created_at)).'</td>
	                        </tr>';

	                    endforeach;



	                        

	             
	                /*html .='<tr style="border-bottom: 5px #000 solid;">
	                <td style="font-size:12px;">Subtotal </td>
	                <td style="font-size:12px;">Total Item : 4</td>
	                <td></td>
	                <td></td>
	                <td style="font-size:12px;" class="text-right">00</td>
	                </tr>';*/

	                $html .='</tbody></table>';

	                //echo $html; die();



	                $this->sdc->PDFLayout($reportName,$html);


	    }

    public function edit(AuthorizeNetPaymentHistory $authorizeNetPaymentHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthorizeNetPaymentHistory $authorizeNetPaymentHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuthorizeNetPaymentHistory $authorizeNetPaymentHistory)
    {
        //
    }
}
