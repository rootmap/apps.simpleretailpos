<?php

namespace App\Http\Controllers;

use App\ProductStockin;
use App\ProductStockinInvoice;
use App\Product;
use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\Vendor;
use Illuminate\Http\Request;

class ProductStockinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Product Stock In";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab_product=Product::where('store_id',$this->sdc->storeID())->get();
        $tab=ProductStockin::join('products as p','product_stockins.product_id','=','p.id')
                            ->where('product_stockins.store_id',$this->sdc->storeID())
                            ->select('product_stockins.*','p.name as product_name')
                            ->get();

        

        return view('apps.pages.product-stock-in.stock-in',
            [
                'dataTable'=>$tab,
                'productData'=>$tab_product
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendorInfo=Vendor::where('store_id',$this->sdc->storeID())->get();
        $tabSQL=ProductStockin::select('id')->orderBy('id','DESC')->first();
        $autoOrderID=1;
        if(isset($tabSQL))
        {
            $autoOrderID=($tabSQL->id)+1;
        }

        if(count($request->quantity)<1)
        {
            return redirect('product/stock/in')->with('error', $this->moduleName.' Failed to add in cart due to empty quantity. !'); 
        }

        return view('apps.pages.product-stock-in.confirm-stock-in',
            ['req_pid'=>$request->pid,'req_quantity'=>$request->quantity,'req_name'=>$request->name,'req_price'=>$request->price,'autoOrderID'=>$autoOrderID,'vendorData'=>$vendorInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profitQuery($request)
    {
        $invoice=ProductStockinInvoice::where('store_id',$this->sdc->storeID())->get();
        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $total_invoice_amount=0;
        $data=array();
        $array_column=array('ID','Order ID','Order Date','Invoice Total Quantity','Created At','Created By');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->order_no,$voi->order_date,$voi->total_quantity,$voi->created_at,$voi->created_by);

            $total_invoice_amount+=$voi->total_quantity;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','','Total =',$total_invoice_amount,'','');
        array_push($data, $array_column);

        $reportName="Stock In Order Eport Report";
        $report_title="Stock In Order Eport Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');
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
        $total_invoice_amount=0;
        $data=array();      
        $reportName="Stock In Order Eport Report";
        $report_title="Stock In Order Eport Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Order ID</th>
                <th class="text-center" style="font-size:12px;" >Order Date</th>
                <th class="text-center" style="font-size:12px;" >Invoice Total Quantity</th>
                <th class="text-center" style="font-size:12px;" >Created At</th>
                <th class="text-center" style="font-size:12px;" >Created By</th>
                </tr>
                </thead>
                <tbody>';

                $total_invoice_amount=0;
                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->order_no.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->order_date.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->total_quantity.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->created_at.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->created_by.'</td>
                        </tr>';
                        $total_invoice_amount+=$voi->total_quantity;
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
                <td>Total</td>
                <td align="center">'.$total_invoice_amount.'</td>
                <td></td>
                <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'order_no'=>'required',
            'order_date'=>'required',
            'vendor_id'=>'required'
        ]);

        

        $invoice_id=time();
        $total_quantity_invoice=0;
        foreach($request->pid as $key=>$pid):
            $pro=Product::find($pid);
            Product::find($pid)->increment('quantity',$request->quantity[$key]);
            $tab_stock=new ProductStockin;
            $tab_stock->order_tracking_id=$invoice_id;
            $tab_stock->product_id=$pid;
            $tab_stock->quantity=$request->quantity[$key];
            $tab_stock->price=$pro->price;
            $tab_stock->cost=$pro->cost;
            $tab_stock->store_id=$this->sdc->storeID();
            $tab_stock->created_by=$this->sdc->UserID();
            $tab_stock->save();
            $total_quantity_invoice+=$request->quantity[$key];
        endforeach;

        $tab=new ProductStockinInvoice;
        $tab->order_tracking_id=$invoice_id;
        $tab->order_date=$request->order_date;
        $tab->order_no=$request->order_no;
        $tab->vendor_id=$request->vendor_id;
        $tab->total_quantity=$total_quantity_invoice;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("product","Product stockin created");

        RetailPosSummary::where('id',1)
        ->update([
           'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity + 1'),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$total_quantity_invoice),
           'product_quantity' => \DB::raw('product_quantity + '.$total_quantity_invoice)
        ]);



        $Todaydate=date('Y-m-d');
        if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==0)
        {
            RetailPosSummaryDateWise::insert([
               'report_date'=>$Todaydate,
               'stockin_invoice_quantity' => \DB::raw('1'),
               'stockin_product_quantity' => \DB::raw($total_quantity_invoice),
               'product_quantity' => \DB::raw($total_quantity_invoice)
            ]);
        }
        else
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity + 1'),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$total_quantity_invoice),
               'product_quantity' => \DB::raw('product_quantity + '.$total_quantity_invoice)
            ]);
        }

        return redirect('product/stock/in')->with('status', $this->moduleName.' Saved & Genarated Successfully !'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    public function show(ProductStockin $productStockin)
    {
        
        $tab=ProductStockinInvoice::join('vendors','product_stockin_invoices.vendor_id','=','vendors.id')
                                    ->where('product_stockin_invoices.store_id',$this->sdc->storeID())
                                    ->select('product_stockin_invoices.*','vendors.name as vendor_name')
                                    ->orderBy('product_stockin_invoices.id','DESC') 
                                    ->take(100)
                                    ->get();
        return view('apps.pages.product-stock-in.list',['dataTable'=>$tab]);
    }

    public function report(Request $request)
    {
        $order_no='';
        if(isset($request->order_no))
        {
            $order_no=$request->order_no;
        }

        $vendor_id='';
        if(isset($request->vendor_id))
        {
            $vendor_id=$request->vendor_id;
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
            $dateString="CAST(lsp_product_stockin_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($order_no) && empty($vendor_id) && empty($start_date) && empty($end_date) && empty($dateString))
        {
            $invoice=ProductStockinInvoice::leftjoin('vendors','product_stockin_invoices.vendor_id','=','vendors.id')
                     ->select('product_stockin_invoices.*','vendors.name as vendor_name')
                     ->where('product_stockin_invoices.store_id',$this->sdc->storeID())
                     ->when($order_no, function ($query) use ($order_no) {
                            return $query->where('product_stockin_invoices.order_no','=', $order_no);
                     })
                     ->when($vendor_id, function ($query) use ($vendor_id) {
                            return $query->where('product_stockin_invoices.vendor_id','=', $vendor_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('product_stockin_invoices.id','DESC')
                     ->take(100)
                     ->get();
        }
        else
        {
            $invoice=ProductStockinInvoice::leftjoin('vendors','product_stockin_invoices.vendor_id','=','vendors.id')
                     ->select('product_stockin_invoices.*','vendors.name as vendor_name')
                     ->where('product_stockin_invoices.store_id',$this->sdc->storeID())
                     ->when($order_no, function ($query) use ($order_no) {
                            return $query->where('product_stockin_invoices.order_no','=', $order_no);
                     })
                     ->when($vendor_id, function ($query) use ($vendor_id) {
                            return $query->where('product_stockin_invoices.vendor_id','=', $vendor_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }

        // dd($dateString);
        
        // dd($invoice);

        $tab_vendor=Vendor::where('store_id',$this->sdc->storeID())->get();
       
        $tab=ProductStockinInvoice::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.report.stockin',
            [
                'dataTable'=>$invoice,
                'vendor'=>$tab_vendor,
                'order_no'=>$order_no,
                'vendor_id'=>$vendor_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

     public function StockInReport(Request $request)
    {
        $order_no='';
        if(isset($request->order_no))
        {
            $order_no=$request->order_no;
        }

        $vendor_id='';
        if(isset($request->vendor_id))
        {
            $vendor_id=$request->vendor_id;
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
            $dateString="CAST(lsp_product_stockin_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        // dd($dateString);
        $invoice=ProductStockinInvoice::leftjoin('vendors','product_stockin_invoices.vendor_id','=','vendors.id')
                     ->select('product_stockin_invoices.*','vendors.name as vendor_name')
                     ->where('product_stockin_invoices.store_id',$this->sdc->storeID())
                     ->when($order_no, function ($query) use ($order_no) {
                            return $query->where('product_stockin_invoices.order_no','=', $order_no);
                     })
                     ->when($vendor_id, function ($query) use ($vendor_id) {
                            return $query->where('product_stockin_invoices.vendor_id','=', $vendor_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        // dd($invoice);

      
        return $invoice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    public function ExcelReport(Request $request) 
    {

        //excel 
        $total_invoice_quantity=0;
        $data=array();
        $array_column=array('Order ID','Vendor Name','Invoice Total Quantity','Order Date');
        array_push($data, $array_column);
        $inv=$this->StockInReport($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->order_no,$voi->vendor_name,$voi->total_quantity,$voi->created_at);
            $total_invoice_quantity+=$voi->total_quantity;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','Total =',$total_invoice_quantity,'');
        array_push($data, $array_column);

        $reportName="Stock In Order Report";
        $report_title="Stock In Order Report";
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
        
       
        $reportName="Stock In Order Report";
        $report_title="Stock In Order Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Order ID</th>
                <th class="text-center" style="font-size:12px;" >Vendor Name</th>
                <th class="text-center" style="font-size:12px;" >Invoice Total Quantity</th>
                <th class="text-center" style="font-size:12px;" >Order Date</th>
                </tr>
                </thead>
                <tbody>';


                    $total_invoice_quantity=0;
                    $inv=$this->StockInReport($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->order_no.'</td>
                        <td>'.$voi->vendor_name.'</td>
                        <td>'.$voi->total_quantity.'</td>
                        <td>'.date('Y-m-d',strtotime($voi->created_at)).'</td>
                        </tr>';
                        $total_invoice_quantity+=$voi->total_quantity;
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
                <td>Total =</td>
                <td>'.$total_invoice_quantity.'</td>
                <td></td>
                
                </tr>';
                $html .='</table>';

                //echo $html; die();



                $this->sdc->PDFLayout($reportName,$html);


    }

    public function edit(ProductStockin $productStockin,$id=0)
    {
        $vendorInfo=Vendor::where('store_id',$this->sdc->storeID())->get();
        $tab_invoice=ProductStockinInvoice::where('id',$id)
                             ->where('store_id',$this->sdc->storeID())
                             ->first();
        $tab_invoice_product=$productStockin::join('products','product_stockins.product_id','=','products.id')
                                           ->where('product_stockins.order_tracking_id',$tab_invoice->order_tracking_id)
                                           ->where('product_stockins.store_id',$this->sdc->storeID())
                                           ->select('product_stockins.*','products.name as product_name')
                                           ->get();


        return view('apps.pages.product-stock-in.edit-stock-in',
            [
                'order'=>$tab_invoice,
                'order_product'=>$tab_invoice_product,
                'vendorData'=>$vendorInfo
            ]);
    }

    public function receipt(ProductStockin $productStockin,$id=0)
    {
        $tab_invoice=ProductStockinInvoice::join('vendors','product_stockin_invoices.vendor_id','=','vendors.id')->where('product_stockin_invoices.id',$id)
                             ->where('product_stockin_invoices.store_id',$this->sdc->storeID())
                             ->select('product_stockin_invoices.*','vendors.name as vendor_name')
                             ->first();
        $tab_invoice_product=$productStockin::join('products','product_stockins.product_id','=','products.id')->where('product_stockins.order_tracking_id',$tab_invoice->order_tracking_id)
                                           ->where('product_stockins.store_id',$this->sdc->storeID())
                                           ->select('product_stockins.*','products.name as product_name')
                                           ->get();

        //dd($tab_invoice);

        return view('apps.pages.product-stock-in.receipt-stock-in',
            [
                'order'=>$tab_invoice,
                'order_product'=>$tab_invoice_product
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductStockin $productStockin,$id=0)
    {
        $this->validate($request,[
            'order_no'=>'required',
            'order_date'=>'required',
            'vendor_id'=>'required'
        ]);

        $inv=ProductStockinInvoice::find($id);
        $invoice_id=$inv->order_tracking_id;
        $total_quantity_invoice=0;
        foreach($request->sid as $key=>$sid):
            $sqlInv=ProductStockin::find($sid);
            $quantity=$sqlInv->quantity;
            $pid=$sqlInv->product_id;
            Product::find($pid)->decrement('quantity',$quantity);
            $total_quantity_invoice+=$quantity;
        endforeach;

        $this->sdc->log("product","Product stockin updated");

        RetailPosSummary::where('id',1)
        ->update([
           'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity - 1'),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$total_quantity_invoice),
           'product_quantity' => \DB::raw('product_quantity - '.$total_quantity_invoice)
        ]);


        $invoice_date=date('Y-m-d',strtotime($inv->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity - 1'),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$total_quantity_invoice),
               'product_quantity' => \DB::raw('product_quantity - '.$total_quantity_invoice)
            ]);
        }

        $inbTab=$productStockin::where('store_id',$this->sdc->storeID())
                              ->where('order_tracking_id',$invoice_id)
                              ->delete();

        $total_quantity_invoice=0;
        foreach($request->pid as $key=>$pid):
            $pro=Product::find($pid);
            Product::find($pid)->increment('quantity',$request->quantity[$key]);
            $tab_stock=new ProductStockin;
            $tab_stock->order_tracking_id=$invoice_id;
            $tab_stock->product_id=$pid;
            $tab_stock->quantity=$request->quantity[$key];
            $tab_stock->price=$pro->price;
            $tab_stock->cost=$pro->cost;
            $tab_stock->store_id=$this->sdc->storeID();
            $tab_stock->created_by=$this->sdc->UserID();
            $tab_stock->updated_by=$this->sdc->UserID();
            $tab_stock->save();
            $total_quantity_invoice+=$request->quantity[$key];
        endforeach;

        $tab=ProductStockinInvoice::find($id);
        $tab->order_tracking_id=$invoice_id;
        $tab->order_date=$request->order_date;
        $tab->order_no=$request->order_no;
        $tab->vendor_id=$request->vendor_id;
        $tab->total_quantity=$total_quantity_invoice;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        RetailPosSummary::where('id',1)
        ->update([
           'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity + 1'),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$total_quantity_invoice),
           'product_quantity' => \DB::raw('product_quantity + '.$total_quantity_invoice)
        ]);

        if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==0)
        {
            RetailPosSummaryDateWise::insert([
               'report_date'=>$Todaydate,
               'stockin_invoice_quantity' => \DB::raw('1'),
               'stockin_product_quantity' => \DB::raw($total_quantity_invoice),
               'product_quantity' => \DB::raw($total_quantity_invoice)
            ]);
        }
        else
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity + 1'),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$total_quantity_invoice),
               'product_quantity' => \DB::raw('product_quantity + '.$total_quantity_invoice)
            ]);
        }

        return redirect('product/stock/in/list')->with('status', $this->moduleName.' Changed / Updated Successfully !'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductStockin $productStockin,$id=0)
    {
        $tab=ProductStockinInvoice::find($id);
        $invoice_id=$tab->order_tracking_id;


        $sqlLoopDel=$productStockin::where('store_id',$this->sdc->storeID())
                                   ->where('order_tracking_id',$invoice_id)
                                   ->get();
        $total_quantity_invoice=0;                           
        foreach($sqlLoopDel as $sqlInv):                           
            $quantity=$sqlInv->quantity;
            $pid=$sqlInv->product_id;
            Product::find($pid)->decrement('quantity',$quantity);
            $total_quantity_invoice+=$quantity;
        endforeach;

        $this->sdc->log("product","Product stockin deleted");

        RetailPosSummary::where('id',1)
        ->update([
           'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity - 1'),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$total_quantity_invoice),
           'product_quantity' => \DB::raw('product_quantity - '.$total_quantity_invoice)
        ]);

        $invoice_date=date('Y-m-d',strtotime($tab->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'stockin_invoice_quantity' => \DB::raw('stockin_invoice_quantity - 1'),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$pro->quantity),
               'product_quantity' => \DB::raw('product_quantity - '.$pro->quantity)
            ]);
        }

        $invoice_tab=$productStockin::where('store_id',$this->sdc->storeID())
                                   ->where('order_tracking_id',$invoice_id)
                                   ->delete();
        $tab->delete();
        return redirect('product/stock/in/list')->with('status', $this->moduleName.' Stock Order Deleted Successfully !');
    }
}
