<?php

namespace App\Http\Controllers;

use App\ProductVariance;
use App\Product;
use App\ProductVarianceData;
use App\RetailPosSummary;
use Illuminate\Http\Request;

class ProductVarianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Product Variance";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=Product::where('store_id',$this->sdc->storeID())->select('id','name')->get();
        return view('apps.pages.variance.create',['dataTable'=>$tab]);
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
        $invoice=productVariance::where('store_id',$this->sdc->storeID())->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $data=array();
        $array_column=array('ID','Variance ID','Variance Date','Variance Quantity');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->variance_id,$voi->created_at,$voi->total_variance_quantity);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Variance Report";
        $report_title="Variance Report";
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

        $data=array();      
        $reportName="Variance Report";
        $report_title="Variance Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Variance ID</th>
                <th class="text-center" style="font-size:12px;" >Variance Date</th>
                <th class="text-center" style="font-size:12px;" >Variance Quantity</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->variance_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->created_at.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->total_variance_quantity.'</td>
                        </tr>';

                    endforeach;


                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody>
                
                </table>


                ';



                $this->sdc->PDFLayout($reportName,$html);


    }
    public function varianceReport(ProductVariance $productVariance,$id=0)
    {
        $tab=ProductVariance::find($id);
        $tab_variance=ProductVarianceData::join('products','product_variance_datas.product_id','=','products.id')
                                         ->select('product_variance_datas.*','products.name as product_name')
                                         ->where('product_variance_datas.variance_id',$tab->variance_id)
                                         ->get();

        return view('apps.pages.variance.report',['dataTable'=>$tab,'dataVariance'=>$tab_variance]);                                 
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
            'pid'=>'required'
        ]);

        $totalDataPost=count($request->quantity);
        if(!empty($totalDataPost))
        {

            $invoice_id=time();
            $total_amount_invoice=0;
            foreach($request->pid as $key=>$pid):
                if(!empty($request->quantity[$key]))
                {
                    $pro=Product::find($pid);
                    $tab_stock=new ProductVarianceData;
                    $tab_stock->variance_id=$invoice_id;
                    $tab_stock->product_id=$pid;
                    $tab_stock->quantity_in_system=$pro->quantity;
                    $tab_stock->quantity_in_hand=$request->quantity[$key];
                    $tab_stock->variance_quanity=($pro->quantity-$request->quantity[$key]);
                    $varianceCost=(($pro->quantity-$request->quantity[$key])*$pro->cost);
                    $tab_stock->cost=$pro->cost;
                    $tab_stock->variance_cost=$varianceCost;
                    $tab_stock->store_id=$this->sdc->storeID();
                    $tab_stock->created_by=$this->sdc->UserID();
                    $tab_stock->save();
                    $total_amount_invoice+=$request->quantity[$key];
                }
            endforeach;

            $this->sdc->log("variance","Product variance created");

            $tab=new ProductVariance;
            $tab->variance_id=$invoice_id;
            $tab->total_variance_quantity=$total_amount_invoice;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();

            RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['variance_quantity' => \DB::raw('variance_quantity + '.$total_amount_invoice)]);

            return redirect('variance/report')->with('status', $this->moduleName.' Genarated Successfully !'); 
        }
        else
        {
            return redirect('variance')->with('error', $this->moduleName.' Minimum one product quantity required to create report. !!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVariance  $productVariance
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVariance $productVariance)
    {
        $tab=$productVariance::where('store_id',$this->sdc->storeID())->take(100)->orderBy('id','DESC')->get();
        return view('apps.pages.variance.list',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVariance  $productVariance
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVariance $productVariance,$id=0)
    {
        $tab=Product::where('store_id',$this->sdc->storeID())->select('id','name')->get();
        $tab_invoice=ProductVariance::where('id',$id)
                             ->where('store_id',$this->sdc->storeID())
                             ->first();
        $tab_invoice_product=ProductVarianceData::join('products','product_variance_datas.product_id','=','products.id')
                                           ->where('product_variance_datas.variance_id',$tab_invoice->variance_id)
                                           ->where('product_variance_datas.store_id',$this->sdc->storeID())
                                           ->select('product_variance_datas.*','products.name as product_name')
                                           ->get();


        return view('apps.pages.variance.edit',
        [
            'invoice'=>$tab_invoice,
            'invoice_product'=>$tab_invoice_product,
            'dataTable'=>$tab
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVariance  $productVariance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVariance $productVariance,$id=0)
    {
        $this->validate($request,[
            'pid'=>'required'
        ]);

        $totalDataPost=count($request->quantity);
        if(!empty($totalDataPost))
        {
            $varianceSQL=ProductVariance::find($id);

            $invoice_id=$varianceSQL->variance_id;

            $inbPreTab=ProductVarianceData::where('store_id',$this->sdc->storeID())
                              ->where('variance_id',$invoice_id)
                              ->get();
            $total_amount_invoice=0;
            foreach($inbPreTab as $preTab):
                $total_amount_invoice+=$preTab->variance_quanity;                
            endforeach;
            
            $this->sdc->log("variance","Product variance updated");
            RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['variance_quantity' => \DB::raw('variance_quantity - '.$total_amount_invoice)]);

            //RetailPosSummary::where('id',1)->update(['variance_quantity' => \DB::raw('variance_quantity + '.$total_amount_invoice)]);

            $inbTab=ProductVarianceData::where('store_id',$this->sdc->storeID())
                              ->where('variance_id',$invoice_id)
                              ->delete();

            $total_amount_invoice=0;
            foreach($request->pid as $key=>$pid):
                if(!empty($request->quantity[$key]))
                {
                    $pro=Product::find($pid);
                    $tab_stock=new ProductVarianceData;
                    $tab_stock->variance_id=$invoice_id;
                    $tab_stock->product_id=$pid;
                    $tab_stock->quantity_in_system=$pro->quantity;
                    $tab_stock->quantity_in_hand=$request->quantity[$key];
                    $tab_stock->variance_quanity=($pro->quantity-$request->quantity[$key]);
                    $tab_stock->cost=$pro->cost;
                    $tab_stock->variance_cost=($request->quantity[$key]*$pro->cost);
                    $tab_stock->store_id=$this->sdc->storeID();
                    $tab_stock->created_by=$this->sdc->UserID();
                    $tab_stock->save();
                    $total_amount_invoice+=$request->quantity[$key];
                }
            endforeach;

            $tab=ProductVariance::find($id);
            $tab->total_variance_quantity=$total_amount_invoice;
            $tab->updated_by=$this->sdc->UserID();
            $tab->save();

            RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['variance_quantity' => \DB::raw('variance_quantity + '.$total_amount_invoice)]);

            return redirect('variance/report')->with('status', $this->moduleName.' Updated Successfully !'); 
        }
        else
        {
            return redirect('variance')->with('error', $this->moduleName.' Minimum one product quantity required to create report. !!!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVariance  $productVariance
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVariance $productVariance,$id=0)
    {
        $tab=ProductVariance::find($id);
        $invoice_id=$tab->variance_id;

        $inbPreTab=ProductVarianceData::where('store_id',$this->sdc->storeID())
                              ->where('variance_id',$invoice_id)
                              ->get();
            $total_amount_invoice=0;
            foreach($inbPreTab as $preTab):
                $total_amount_invoice+=$preTab->variance_quanity;                
            endforeach;
            
            $this->sdc->log("variance","Product variance deleted");

            RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['variance_quantity' => \DB::raw('variance_quantity - '.$total_amount_invoice)]);

        
        $invoice_tab=ProductVarianceData::where('store_id',$this->sdc->storeID())
                                        ->where('variance_id',$invoice_id)
                                        ->delete();
        $tab->delete();
        return redirect('variance/report')->with('status', $this->moduleName.' Variance Report Deleted Successfully !');
    }
}
