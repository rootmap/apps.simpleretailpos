<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Product;
use App\Customer;
use App\Tender;
use App\InvoiceProfit;
use App\PartialPayment;
use Illuminate\Http\Request;

class PartialPaymentController extends Controller
{
    
    private $moduleName="Partial Payment ";
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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }


        if(empty($invoice_id) && empty($customer_id) && empty($tender_id) && empty($dateString))
        {
            $invoice=PartialPayment::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }
        else
        {
            $invoice=PartialPayment::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }

        
                     //->toSql();

        //dd($tender_id);              

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
        $tab_tender=Tender::where('store_id',$this->sdc->storeID())
                          ->orWhere('cardpointee',1)
                          ->orWhere('authorizenet',1)
                          ->orWhere('paypal',1)
                          ->orWhere('stripe',1)
                          ->orWhere('squareup',1)
                          ->get();

        return view('apps.pages.report.partial-payment',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'tenderData'=>$tab_tender,
                'tender_id'=>$tender_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }


    private function InvPaymentCount($search=''){

        $tab=PartialPayment::select('id','created_at','customer_name','tender_name','paid_amount','invoice_id')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('tender_name','LIKE','%'.$search.'%');
                        $query->orWhere('paid_amount','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function InvPayment($start, $length,$search=''){

        $tab=PartialPayment::select('id','created_at','customer_name','tender_name','paid_amount','invoice_id')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('tender_name','LIKE','%'.$search.'%');
                        $query->orWhere('paid_amount','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datajson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->InvPaymentCount($search); // get your total no of data;
        $members = $this->InvPayment($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $invoice=PartialPayment::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //excel 
        $total_paid_amount=0;
        $data=array();
        $array_column=array('Payment ID','Invoice ID','Customer Name','Tender','Paid Amount','Payment Date');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->tender_name,$voi->paid_amount,formatDate($voi->created_at));

            $total_paid_amount+= $voi->paid_amount;
            array_push($data, $inv_arry);

            
        endforeach;

        $array_column=array('','','','Total =',$total_paid_amount,'');
        array_push($data, $array_column);

        $reportName="Partial Payment Report";
        $report_title="Partial Payment Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));
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
        
       
        $reportName="Partial Payment Report";
        $report_title="Partial Payment Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Payment ID</th>
                <th class="text-center" style="font-size:12px;" >Payment Date</th>
                <th class="text-center" style="font-size:12px;" >Customer</th>
                <th class="text-center" style="font-size:12px;" >Tender</th>
                <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                </tr>
                </thead>
                <tbody>';

                $total_paid_amount=0;
                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.formatDate($voi->created_at).'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->tender_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->paid_amount.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->invoice_id.'</td>
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
                <td align="right">Total = </td>
                <td align="center">'.$total_paid_amount.'</td>
                <td></td>
                </tr>';
                $html .='</table>';


               



                $this->sdc->PDFLayout($reportName,$html);


    }

    public function Paypalindex(Request $request)
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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($invoice_id) && empty($customer_id) && empty($tender_id) && empty($dateString))
        {
            $invoice=PartialPayment::LeftJoin('invoices','invoice_payments.invoice_id','=','invoices.invoice_id')
                                 ->select(
                            'invoice_payments.id',
                            'invoice_payments.created_at',
                            'invoice_payments.customer_name',
                            'invoice_payments.tender_name',
                            'invoice_payments.paid_amount',
                            'invoice_payments.invoice_id',
                            'invoices.Invoice_status as Invoice_status')
                                 ->where('invoice_payments.store_id',$this->sdc->storeID())
                                 ->where('invoice_payments.tender_name','Paypal')
                                 ->when($invoice_id, function ($query) use ($invoice_id) {
                                        return $query->where('invoice_payments.invoice_id','=', $invoice_id);
                                 })
                                 ->when($customer_id, function ($query) use ($customer_id) {
                                        return $query->where('invoice_payments.customer_id','=', $customer_id);
                                 })
                                 ->when($tender_id, function ($query) use ($tender_id) {
                                        return $query->where('invoice_payments.tender_id','=', $tender_id);
                                 })
                                 ->when($dateString, function ($query) use ($dateString) {
                                        return $query->whereRaw($dateString);
                                 })
                                 ->get();
        }
        else
        {
            $invoice=PartialPayment::LeftJoin('invoices','invoice_payments.invoice_id','=','invoices.invoice_id')
                                 ->select(
                            'invoice_payments.id',
                            'invoice_payments.created_at',
                            'invoice_payments.customer_name',
                            'invoice_payments.tender_name',
                            'invoice_payments.paid_amount',
                            'invoice_payments.invoice_id',
                            'invoices.Invoice_status as Invoice_status')
                                 ->where('invoice_payments.store_id',$this->sdc->storeID())
                                 ->where('invoice_payments.tender_name','Paypal')
                                 ->when($invoice_id, function ($query) use ($invoice_id) {
                                        return $query->where('invoice_payments.invoice_id','=', $invoice_id);
                                 })
                                 ->when($customer_id, function ($query) use ($customer_id) {
                                        return $query->where('invoice_payments.customer_id','=', $customer_id);
                                 })
                                 ->when($tender_id, function ($query) use ($tender_id) {
                                        return $query->where('invoice_payments.tender_id','=', $tender_id);
                                 })
                                 ->when($dateString, function ($query) use ($dateString) {
                                        return $query->whereRaw($dateString);
                                 })
                                 ->get();
        }


        
                                 //->toSql();

        //dd($tender_id);              

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
        $tab_tender=Tender::where('store_id',$this->sdc->storeID())
                            ->orWhere('cardpointee',1)
                            ->orWhere('authorizenet',1)
                            ->orWhere('paypal',1)
                            ->orWhere('stripe',1)
                            ->orWhere('squareup',1)
                            ->get();

        return view('apps.pages.report.partial-payment',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'tenderData'=>$tab_tender,
                'tender_id'=>$tender_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }


    private function paypalPaymentReportCount($search=''){

        $tab=PartialPayment::LeftJoin('invoices','invoice_payments.invoice_id','=','invoices.invoice_id')
                          ->select(
                            'invoice_payments.id',
                            'invoice_payments.created_at',
                            'invoice_payments.customer_name',
                            'invoice_payments.tender_name',
                            'invoice_payments.paid_amount',
                            'invoice_payments.invoice_id',
                            'invoices.Invoice_status as Invoice_status')
                          ->where('invoice_payments.store_id',$this->sdc->storeID())
                          ->where('invoice_payments.tender_name','Paypal')
                          ->orderBy('invoice_payments.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('invoice_payments.id','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.created_at','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.tender_name','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.paid_amount','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('invoices.Invoice_status as Invoice_status','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function paypalPaymentReport($start, $length,$search=''){

        $tab=PartialPayment::LeftJoin('invoices','invoice_payments.invoice_id','=','invoices.invoice_id')
                          ->select(
                            'invoice_payments.id',
                            'invoice_payments.created_at',
                            'invoice_payments.customer_name',
                            'invoice_payments.tender_name',
                            'invoice_payments.paid_amount',
                            'invoice_payments.invoice_id',
                            'invoices.Invoice_status as Invoice_status')
                          ->where('invoice_payments.store_id',$this->sdc->storeID())
                          ->where('invoice_payments.tender_name','Paypal')
                          ->orderBy('invoice_payments.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('invoice_payments.id','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.created_at','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.tender_name','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.paid_amount','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_payments.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('invoices.Invoice_status as Invoice_status','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function paypalPaymentReportjson(Request $request){

        

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->paypalPaymentReportCount($search); // get your total no of data;
        $members = $this->paypalPaymentReport($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }


    public function PaypalprofitQuery($request)
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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $invoice=PartialPayment::where('store_id',$this->sdc->storeID())
                     ->where('tender_name','Paypal')
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        return $invoice;
    }

    public function PaypalexportExcel(Request $request) 
    {
        //excel 
        $total_paid_amount=0;
        $data=array();
        $array_column=array('Payment ID','Invoice ID','Customer Name','Tender','Paid Amount','Payment Date');
        array_push($data, $array_column);
        $inv=$this->PaypalprofitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->tender_name,$voi->paid_amount,formatDate($voi->created_at));

            $total_paid_amount+=$voi->paid_amount;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','','','Total =',$total_paid_amount,'');
        array_push($data, $array_column);

        $reportName="Paypal Payment Report";
        $report_title="Paypal Payment Report";
        $report_description="Paypal Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));
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

    public function PaypalinvoicePDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Paypal Payment Report";
        $report_title="Paypal Payment Report";
        $report_description="Paypal Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Payment ID</th>
                <th class="text-center" style="font-size:12px;" >Payment Date</th>
                <th class="text-center" style="font-size:12px;" >Customer</th>
                <th class="text-center" style="font-size:12px;" >Tender</th>
                <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                </tr>
                </thead>
                <tbody>';

                    $total_paid_amount=0;
                    $inv=$this->PaypalprofitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.formatDate($voi->created_at).'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->tender_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->paid_amount.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->invoice_id.'</td>
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
                <td>Total =</td>
                <td>'.$total_paid_amount.'</td>
                <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


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
     * @param  \App\PartialPayment  $PartialPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PartialPayment $PartialPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PartialPayment  $PartialPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PartialPayment $PartialPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PartialPayment  $PartialPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartialPayment $PartialPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PartialPayment  $PartialPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartialPayment $PartialPayment)
    {
        //
    }


}
