<?php

namespace App\Http\Controllers;

use App\Warranty;
use App\WarrantyProduct;
use App\WarrentyBatch;
use App\Invoice;
use App\Product;
use App\Tender;
use App\Customer;
use App\InvoiceProduct;
use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\Cart;
use Session;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName=" Product Warranty ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        $tab=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->take(100)
                     ->orderBy('invoices.id','DESC')
                     ->get();
        return view('apps.pages.warranty.list',['dataTable'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profitQuery($request)
    {
        $invoice=warranty::select('id','invoice_id','warranty_date','warranty_batch_quantity','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $data=array();
        $array_column=array('Warranty ID','Invoice ID','Warranty Date','Warranty Total Product','Created Time');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->warranty_date,$voi->warranty_batch_quantity,$voi->created_at);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Warranty Product Invoice Report";
        $report_title="Warranty Product Invoice Report";
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
        $reportName="Warranty Product Invoice Report";
        $report_title="Warranty Product Invoice Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Warranty ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Warranty Date</th>
                <th class="text-center" style="font-size:12px;" >Warranty Total Product</th>
                <th class="text-center" style="font-size:12px;" >Created Time</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->warranty_date.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->warranty_batch_quantity.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->created_at.'</td>
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
    public function create($id=0)
    {
        $tab=Invoice::select('invoices.id','invoices.invoice_id')
                     ->where('invoices.id',$id)
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->first();

        

        //print_r($tabInvoiceProduct); die();             

        $tab_product=Product::select('id','name','quantity')->where('vt_product',0)->where('store_id',$this->sdc->storeID())->get();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        //dd();
        $arrayExProduct=array();
        $cartItems=array();
        if(!empty($oldCart))
        {
            if(count($oldCart->items)>0)
            {
                foreach($oldCart->items as $cat):
                    $oldPID=$cat['old_product_id'];
                    array_push($arrayExProduct,$oldPID);
                endforeach;
            }

            $cartItems=$oldCart->items;
        }
        

        //dd($arrayExProduct);

        $tabInvoiceProduct=InvoiceProduct::select('invoice_products.*','products.name as product_name')
                     ->join('products','invoice_products.product_id','=','products.id')
                     ->where('invoice_products.invoice_id',$tab->invoice_id)
                     ->where('invoice_products.store_id',$this->sdc->storeID())
                     ->when($arrayExProduct, function ($query) use ($arrayExProduct) {
                            return $query->whereNotIn('invoice_products.product_id', $arrayExProduct);
                     })
                     ->get();
                     
        return view('apps.pages.warranty.warranty-invoice',[
            'dataTable'=>$tab,
            'dataInvoiceProduct'=>$tabInvoiceProduct,
            'dataProduct'=>$tab_product,
            'cartData'=>$cartItems
        ]);
    }

    public function batchOut()
    {
        $tab='';
        $tabCount=WarrentyBatch::where('store_id',$this->sdc->storeID())->count();
        if($tabCount>0)
        {
            $tab=WarrentyBatch::where('store_id',$this->sdc->storeID())->get();
            //dd($tab);
        }
        else
        {
            return redirect('warranty')->with('error', $this->moduleName.' Failed to load batch warranty, Please try again. !');
        }

        return view('apps.pages.warranty.warranty-batch-out',[
            'dataTable'=>$tab
        ]);
    }

    public function getAddToCart(Request $request,$uniqid=0) {
/*        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($request->new_product, $request->old_product,$uniqid);
        $request->session()->put('cart', $cart);*/

        $p_one=Product::find($request->old_product);
        $p_one_name=$p_one->name;

        $p_two=Product::find($request->new_product);
        $p_two_name=$p_two->name;

        $tab=new WarrentyBatch();
        $tab->warranty_date=date('Y-m-d');
        $tab->invoice_id=$uniqid;
        $tab->old_product_id=$request->old_product;
        $tab->new_product_id=$request->new_product;

        $tab->old_product_html=$p_one_name;
        $tab->new_product_html=$p_two_name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        return 1;
    }

    public function getDelToCart(Request $request,$uniqid=0) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->del($request->new_product, $request->old_product,$uniqid);
        $request->session()->put('cart', $cart);
        return 1;
    }

    public function getCart() {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        echo "<pre>";
        print_r($oldCart); die();
    }

    public function getClearCart(Request $request) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->ClearCart();
        $request->session()->put('cart', $cart);

        return 1;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request,[
            'invoice_id'=>'required',
            'invoice_uid'=>'required'
        ]);*/

        $countOLDPid=count($request->old_pid);
        if($countOLDPid!=0)
        {
            $tab=new Warranty;
            $tab->invoice_id=time();
            $tab->warranty_date=date('Y-m-d');
            $tab->warranty_batch_quantity=$countOLDPid;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();



            $warranty_id=$tab->id;
            foreach($request->old_pid as $index=>$old_pid):
                $tabWP=new WarrantyProduct;
                $tabWP->warranty_id=$warranty_id;
                $tabWP->invoice_id=$request->invoice_id[$index];
                $tabWP->warranty_date=$request->warranty_date[$index];
                $tabWP->old_product_id=$old_pid;
                $tabWP->new_product_id=$request->new_pid[$index];
                $tabWP->store_id=$this->sdc->storeID();
                $tabWP->created_by=$this->sdc->UserID();
                $tabWP->save();
                Product::find($request->new_pid[$index])->decrement('quantity',1);
            endforeach;

            //$this->getClearCart($request);

            $this->sdc->log("warranty","Product Warranty created");

            RetailPosSummary::where('store_id',$this->sdc->storeID())
            ->update([
               'warranty_invoice_quantity' => \DB::raw('warranty_invoice_quantity + 1'),
               'warranty_product_quantity' => \DB::raw('warranty_product_quantity + '.$countOLDPid),
               'product_quantity' => \DB::raw('product_quantity - '.$countOLDPid),
            ]);

            $Todaydate=date('Y-m-d');
            if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())->count()==0)
            {
                RetailPosSummaryDateWise::insert([
                   'report_date'=>$Todaydate,
                   'store_id'=>$this->sdc->storeID(),
                   'warranty_invoice_quantity' => \DB::raw('1'),
                   'warranty_product_quantity' => \DB::raw($countOLDPid)
                ]);
            }
            else
            {
                RetailPosSummaryDateWise::where('report_date',$Todaydate)
                ->where('store_id',$this->sdc->storeID())
                ->update([
                   'warranty_invoice_quantity' => \DB::raw('warranty_invoice_quantity + 1'),
                   'warranty_product_quantity' => \DB::raw('warranty_product_quantity + '.$countOLDPid)
                ]);
            }



            WarrentyBatch::where('store_id',$this->sdc->storeID())->delete();


            return redirect('warranty/report')->with('status', $this->moduleName.' Genarated Successfully !');

            
        }
        else
        {
            return redirect('warranty')->with('error', $this->moduleName.' Failed to save batch warranty, Please try again. !');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function show(Warranty $warranty)
    {
        $tab=$warranty::select('id','invoice_id','warranty_date','warranty_batch_quantity','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->take(100)
                     ->orderBy('id','DESC')
                     ->get();
        return view('apps.pages.warranty.list-report',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function edit(Warranty $warranty,$id=0)
    {
        $tab=$warranty::select('id','invoice_id','warranty_date','warranty_batch_quantity','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->where('id',$id)
                     ->first();
        $tab_warranty=WarrantyProduct::join('products','warranty_products.old_product_id','=','products.id')
        ->join('products as p','warranty_products.new_product_id','=','p.id')
        ->select('warranty_products.*','products.name as product_name','p.name as new_product_name')
        ->where('warranty_products.warranty_id',$id)
        ->where('warranty_products.store_id',$this->sdc->storeID())
        ->get();

        //dd($tab_warranty);
        return view('apps.pages.warranty.edit-warranty-invoice',['dataTable'=>$tab,'dataProduct'=>$tab_warranty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warranty $warranty,$id=0)
    {
        $this->validate($request,[
            'invoice_id'=>'required',
            'invoice_uid'=>'required'
        ]);

        if(count($request->wfid)>0)
        {
            $tab=$warranty::find($id);
            $tab->updated_by=$this->sdc->UserID();
            $tab->save();



            foreach($request->wfid as $index=>$wfid):
                $tabWP=WarrantyProduct::find($wfid);

                if(empty($request->warranty_date[$index]))
                {
                    $tabWP->warranty_date=$request->ex_warranty_date[$index];
                }
                else
                {
                    $tabWP->warranty_date=$request->warranty_date[$index];
                }

                if(empty($request->new_product_id[$index]))
                {
                    $tabWP->new_product_id=$request->ex_new_product_id[$index];
                }
                else
                {
                    $tabWP->new_product_id=$request->new_product_id[$index];
                    Product::find($request->ex_new_product_id[$index])->increment('quantity',1);
                    Product::find($request->new_product_id[$index])->decrement('quantity',1);
                }
                
                $tabWP->updated_by=$this->sdc->UserID();
                $tabWP->save();
            endforeach;

            $this->sdc->log("warranty","Product Warranty updated");

            return redirect('warranty/report')->with('status', $this->moduleName.' updated successfully. !');

        }
        else
        {
            return redirect('warranty/report')->with('error', $this->moduleName.' failed to update, Please try again. !');
        }
        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warranty  $warranty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warranty $warranty,$id=0)
    {
        $tab=$warranty::find($id);
        $invoice_id=$tab->invoice_id;

        $allpidSQL=WarrantyProduct::where('store_id',$this->sdc->storeID())
                                   ->where('invoice_id',$invoice_id)
                                   ->get();
        foreach($allpidSQL as $pidSQL):
            Product::find($pidSQL->new_product_id)->increment('quantity',1);
        endforeach;
        
        $countOLDPid=count($allpidSQL);

        RetailPosSummary::where('store_id',$this->sdc->storeID())
        ->update([
           'warranty_invoice_quantity' => \DB::raw('warranty_invoice_quantity - 1'),
           'warranty_product_quantity' => \DB::raw('warranty_product_quantity - '.$countOLDPid),
           'product_quantity' => \DB::raw('product_quantity + '.$countOLDPid),
        ]);

        $invoice_date=date('Y-m-d',strtotime($tab->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->where('store_id',$this->sdc->storeID())
            ->update([
               'warranty_invoice_quantity' => \DB::raw('warranty_invoice_quantity - 1'),
               'warranty_product_quantity' => \DB::raw('warranty_product_quantity - '.$pro->quantity)
            ]);
        }


        $this->sdc->log("warranty","Product Warranty deleted");


        $invoice_tab=WarrantyProduct::where('store_id',$this->sdc->storeID())
                                   ->where('invoice_id',$invoice_id)
                                   ->delete();
        $tab->delete();
        return redirect('warranty/report')->with('status', $this->moduleName.' Invoices Deleted Successfully !');
    }
}
