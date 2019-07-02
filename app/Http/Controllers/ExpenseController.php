<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseHead;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Expense Voucher ";
    private $sdc;
    public function __construct(){ 
        $this->sdc = new StaticDataController(); 
    }

    public function index()
    {
        $ExpenseHead=ExpenseHead::where('store_id',$this->sdc->storeID())->get();
        $tab=Expense::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.expense.expense',['dataTable'=>$tab,'expenseHead'=>$ExpenseHead]);
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
        $this->validate($request,[
            'expense_description' => 'required',
            'expense_date' => 'required',
            'expense_amount' => 'required'
        ]);

        if(empty($request->expense_id) || $request->expense_id==0)
        {
            $this->validate($request,[
                'expense_head_name' => 'required'
            ]);

            $expense_name=$request->expense_head_name;
            $exHeadN=new ExpenseHead();
            $exHeadN->name=$expense_name;
            $exHeadN->store_id=$this->sdc->storeID();
            $exHeadN->created_by=$this->sdc->UserID();
            $exHeadN->save();
            $expense_id=$exHeadN->id;

        }
        else
        {
            $expense_id=$request->expense_id;
            $exHeadN=ExpenseHead::find($expense_id);
            $expense_name=$exHeadN->name;
        }


        $tab=new Expense();
        $tab->expense_id=$expense_id;
        $tab->expense_name=$expense_name;
        $tab->expense_description=$request->expense_description;
        $tab->expense_date=$request->expense_date;
        $tab->expense_amount=$request->expense_amount;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        return redirect('expense/voucher')->with('status', $this->moduleName.' Created Successfully !'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense, Request $request)
    {
        $expense_id='';
        if(isset($request->expense_id))
        {
            $expense_id=$request->expense_id;
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


        $invoice=$this->filterDataExpense($request);

        $ExpenseHead=ExpenseHead::where('store_id',$this->sdc->storeID())->get();
   

        return view('apps.pages.report.expense',
            [
                'expense_id'=>$expense_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'expenseHead'=>$ExpenseHead,
                'invoice'=>$invoice
            ]);
    }

    public function filterDataExpense($request)
    {
        $expense_id='';
        if(isset($request->expense_id))
        {
            $expense_id=$request->expense_id;
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
            $dateString="CAST(lsp_expenses.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }




        $invoice=Expense::where('store_id',$this->sdc->storeID())
                         ->when($expense_id, function ($query) use ($expense_id) {
                                return $query->where('expense_id','=', $expense_id);
                         })
                         ->when($dateString, function ($query) use ($dateString) {
                                return $query->whereRaw($dateString);
                         })
                         ->get();

        return $invoice;
    }

    public function Excelexport(Request $request) 
    {

        //excel 
        $data=array();
        $array_column=array('Voucher ID','Expense Head','Expense DATE','Description','Expense AMOUNT','Created at');
        array_push($data, $array_column);
        $inv=$this->filterDataExpense($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->expense_name,date('Y-m-d',strtotime($voi->expense_date)),$voi->expense_description,$voi->expense_amount,date('Y-m-d',strtotime($voi->created_at)));
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Expense Voucher Report";
        $report_title="Expense Voucher Report";
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

     public function ExpensePDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Expense Voucher Report";
        $report_title="Expense Voucher Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Voucher ID</th>
                <th class="text-center" style="font-size:12px;" >Expense Head</th>
                <th class="text-center" style="font-size:12px;" >Expense DATE</th>
                <th class="text-center" style="font-size:12px;" >Description</th>
                <th class="text-center" style="font-size:12px;" >Expense AMOUNT</th>
                <th class="text-center" style="font-size:12px;" >Created at</th>
                </tr>
                </thead>
                <tbody>';



                    $inv=$this->filterDataExpense($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->id.'</td>
                        <td>'.$voi->expense_name.'</td>
                        <td>'.date('Y-m-d',strtotime($voi->expense_date)).'</td>
                        <td>'.$voi->expense_description.'</td>
                        <td>'.$voi->expense_amount.'</td>
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
