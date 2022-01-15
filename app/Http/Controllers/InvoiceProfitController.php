<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Product;
use App\Customer;
use App\InvoiceProfit;
use Illuminate\Http\Request;

class InvoiceProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Sales";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index(Request $request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }

        $customer_id='';
        if(isset($request->customer_id))
        {
            $customer_id=$request->customer_id;
        }

        
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

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(lsp_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }


        if(empty($invoice_id) && empty($customer_id) && empty($start_date) && empty($end_date) && empty($dateString))
        {
            $invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('invoices.id','DESC')
                     ->take(100)
                     ->get();

        }
        else
        {
            $invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        }


        
        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
   

        return view('apps.pages.report.profit',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
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


    public function profitQuery($request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }

        $customer_id='';
        if(isset($request->customer_id))
        {
            $customer_id=$request->customer_id;
        }

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

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(lsp_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }




        $invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        return $invoice;
    }

    public function export(Request $request) 
    {

        //excel 
        $total_invoice_amount=0;
        $total_cost_amount=0;
        $total_profit_amount=0;
        $data=array();
        $array_column=array('Invoice ID','Customer Name','Total Amount','Total Cost','Total Profit','Invoice Date');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->invoice_id,$voi->customer_name,$voi->total_amount,$voi->total_cost,$voi->total_profit,$voi->created_at);
            $total_invoice_amount+=$voi->total_amount;
            $total_cost_amount+=$voi->total_cost;
            $total_profit_amount+=$voi->total_profit;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','Total =',$total_invoice_amount,$total_cost_amount,$total_profit_amount,'');
        array_push($data, $array_column);
        $reportName="Profit Report";
        $report_title="Profit Report";
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

    public function invoicePDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Profit Report";
        $report_title="Profit Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice Date</th>
                <th class="text-center" style="font-size:12px;" >Sold To</th>
                <th class="text-center" style="font-size:12px;" >Invoice Total Amount</th>
                <th class="text-center" style="font-size:12px;" >Total Cost Amount</th>
                <th class="text-center" style="font-size:12px;" >Profit</th>
                </tr>
                </thead>
                <tbody>';


                    $total_invoice_amount=0;
                    $total_cost_amount=0;
                    $total_profit_amount=0;
                    $inv=$this->profitQuery($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->invoice_id.'</td>
                        <td>'.date('Y-m-d',strtotime($voi->created_at)).'</td>
                        <td>'.$voi->customer_name.'</td>
                        <td>'.$voi->total_amount.'</td>
                        <td>'.$voi->total_cost.'</td>
                        <td>'.$voi->total_profit.'</td>
                        </tr>';
                        $total_invoice_amount+=$voi->total_amount;
                        $total_cost_amount+=$voi->total_cost;
                        $total_profit_amount+=$voi->total_profit;
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
                <td>Total =</td>
                <td>'.$total_invoice_amount.'</td>
                <td>'.$total_cost_amount.'</td>
                <td>'.$total_profit_amount.'</td>
                </tr>';
                $html .='</table>';

                //echo $html; die();



                $this->sdc->PDFLayout($reportName,$html);


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
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceProfit $invoiceProfit)
    {
        //
    }
}
