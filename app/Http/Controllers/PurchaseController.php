<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseItem;
use App\Product;
use App\Category;
use App\Vendor;
use Illuminate\Http\Request;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName = "Purchase";
    private $sdc;
    public function __construct()
    {
        $this->sdc = new StaticDataController();
    }


    public function index(Request $request)
    {
        //dd(url()->current());
        $order_no = '';
        if (isset($request->order_no)) {
            $order_no = $request->order_no;
        }

        $vendor_id = '';
        if (isset($request->vendor_id)) {
            $vendor_id = $request->vendor_id;
        }

        $start_date = '';
        if (isset($request->start_date)) {
            $start_date = $request->start_date;
        }

        $end_date = '';
        if (isset($request->end_date)) {
            $end_date = $request->end_date;
        }

        if (empty($start_date) && !empty($end_date)) {
            $start_date = $end_date;
        }

        if (!empty($start_date) && empty($end_date)) {
            $end_date = $start_date;
        }

        $dateString = '';
        if (!empty($start_date) && !empty($end_date)) {
            $dateString = "CAST(lsp_purchases.order_date as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        }

        $vendor=Vendor::where('store_id', $this->sdc->storeID())->get();
        //$pro = Purchase::where('store_id', $this->sdc->storeID())->get();


        $pro = Purchase::when($order_no, function ($query) use ($order_no) {
                return $query->where('order_no', '=', $order_no);
            })
                ->when($vendor_id, function ($query) use ($vendor_id) {
                    return $query->where('vendor_id', '=', $vendor_id);
                })
                ->when($dateString, function ($query) use ($dateString) {
                    return $query->whereRaw($dateString);
                })
                ->orderBy('id', 'DESC')
                ->get();

        return view('apps.pages.purchase.list', 
            [
            'dataTable' => $pro,
            'vendor'=> $vendor,
            'order_no' => $order_no,
            'vendor_id' => $vendor_id,
            'start_date' => $start_date,
            'end_date' => $end_date]);
    }

    public function indexItem(Request $request)
    {
        //dd(url()->current());
        $order_no = '';
        if (isset($request->order_no)) {
            $order_no = $request->order_no;
        }

        $vendor_id = '';
        if (isset($request->vendor_id)) {
            $vendor_id = $request->vendor_id;
        }

        $start_date = '';
        if (isset($request->start_date)) {
            $start_date = $request->start_date;
        }

        $end_date = '';
        if (isset($request->end_date)) {
            $end_date = $request->end_date;
        }

        if (empty($start_date) && !empty($end_date)) {
            $start_date = $end_date;
        }

        if (!empty($start_date) && empty($end_date)) {
            $end_date = $start_date;
        }

        $dateString = '';
        if (!empty($start_date) && !empty($end_date)) {
            $dateString = "CAST(lsp_purchases.order_date as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        }

        $vendor=Vendor::where('store_id', $this->sdc->storeID())->get();
        //$pro = Purchase::where('store_id', $this->sdc->storeID())->get();


        $proItem = Purchase::when($order_no, function ($query) use ($order_no) {
                return $query->where('order_no', '=', $order_no);
            })
                ->when($vendor_id, function ($query) use ($vendor_id) {
                    return $query->where('vendor_id', '=', $vendor_id);
                })
                ->when($dateString, function ($query) use ($dateString) {
                    return $query->whereRaw($dateString);
                })
                ->where('store_id', $this->sdc->storeID())
                ->orderBy('id', 'DESC')
                ->get();

        $pro = [];
        if(count($proItem)>0){
            foreach($proItem as $itm){
                $order_tracking_id=$itm->order_tracking_id;
                $prItem=PurchaseItem::leftJoin('products', 'products.id', '=', 'purchase_items.product_id')
                                    ->leftJoin('purchases', 'purchases.order_tracking_id','=', 'purchase_items.order_tracking_id')
                                    ->select(
                                        'purchase_items.*', 
                                        'products.name as product_name', 
                                        'products.barcode as product_barcode',
                                        'purchases.order_date',
                                        'purchases.order_no',
                                        'purchases.vendor_name'
                                    )
                                    ->where('purchase_items.store_id', $this->sdc->storeID())
                                    ->where('purchase_items.order_tracking_id', $order_tracking_id)
                                    ->first();
                $pro[]= $prItem;
            }
        }

        //dd($pro);

        return view('apps.pages.purchase.item-list', 
            [
            'dataTable' => $pro,
            'vendor'=> $vendor,
            'order_no' => $order_no,
            'vendor_id' => $vendor_id,
            'start_date' => $start_date,
            'end_date' => $end_date]);
    }

    public function purchaseItemReport(Request $request)
    {
        $order_no = '';
        if (isset($request->order_no)) {
            $order_no = $request->order_no;
        }

        $vendor_id = '';
        if (isset($request->vendor_id)) {
            $vendor_id = $request->vendor_id;
        }

        $start_date = '';
        if (isset($request->start_date)) {
            $start_date = $request->start_date;
        }

        $end_date = '';
        if (isset($request->end_date)) {
            $end_date = $request->end_date;
        }

        if (empty($start_date) && !empty($end_date)) {
            $start_date = $end_date;
        }

        if (!empty($start_date) && empty($end_date)) {
            $end_date = $start_date;
        }

        $dateString = '';
        if (!empty($start_date) && !empty($end_date)) {
            $dateString = "CAST(lsp_purchases.order_date as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        }
        // dd($dateString);
        $proItem = Purchase::when($order_no, function ($query) use ($order_no) {
                    return $query->where('order_no', '=', $order_no);
            })
            ->when($vendor_id, function ($query) use ($vendor_id) {
                return $query->where('vendor_id', '=', $vendor_id);
            })
            ->when($dateString, function ($query) use ($dateString) {
                return $query->whereRaw($dateString);
            })
            ->orderBy('id', 'DESC')
            ->get();
        // dd($invoice);

        $pro = [];
        if (count($proItem) > 0) {
            foreach ($proItem as $itm) {
                $order_tracking_id = $itm->order_tracking_id;
                $prItem = PurchaseItem::leftJoin('products', 'products.id', '=', 'purchase_items.product_id')
                    ->leftJoin('purchases', 'purchases.order_tracking_id', '=', 'purchase_items.order_tracking_id')
                    ->select(
                        'purchase_items.*',
                        'products.name as product_name',
                        'products.barcode as product_barcode',
                        'purchases.order_date',
                        'purchases.order_no',
                        'purchases.vendor_name'
                    )
                    ->where('purchase_items.store_id', $this->sdc->storeID())
                    ->where('purchase_items.order_tracking_id', $order_tracking_id)
                    ->first();
                $pro[] = $prItem;
            }
        }


        return $pro;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    public function ExcelItemReport(Request $request)
    {

        //excel 
        $data = array();
        $array_column = array('ID', 'Order No', 'Order Date', 'Barcode', 'Product Name', 'Quantity', 'Purchase Cost', 'Sell Price', 'Supplier / Vendor');
        array_push($data, $array_column);
        $inv = $this->purchaseItemReport($request);
        $total_quantity = 0;
        $total_costamount = 0;
        $total_purchaseamount = 0;

        foreach ($inv as $voi) :
            $inv_arry = array(
                $voi->id,
                $voi->order_no,
                $voi->order_date,
                $voi->product_barcode,
                $voi->product_name,
                $voi->quantity, 
                number_format($voi->cost, 2), 
                number_format($voi->price, 2),
                $voi->vendor_name
            );
            array_push($data, $inv_arry);
            $total_quantity += $voi->quantity;
            $total_costamount += $voi->cost * $voi->quantity;
            $total_purchaseamount += $voi->price * $voi->quantity;
        endforeach;
        $inv_arry = array('','','','', 'Total=', $total_quantity, number_format($total_costamount, 2), number_format($total_purchaseamount, 2), '');
        array_push($data, $inv_arry);

        $reportName = "Purchase Item Order Report";
        $report_title = "Purchase Item Order Report";
        $report_description = "Report Genarated : " . date('d-M-Y H:i:s a');
        /*$data = array(
            array('data1', 'data2'),
            array('data3', 'data4')
        );*/

        //array_unshift($data,$array_column);

        // dd($data);

        $excelArray = array(
            'report_name' => $reportName,
            'report_title' => $report_title,
            'report_description' => $report_description,
            'data' => $data
        );

        $this->sdc->ExcelLayout($excelArray);
    }

    public function PdfItemReport(Request $request)
    {

        $data = array();


        $reportName = "Purchase Order Report";
        $report_title = "Purchase Order Report";
        $report_description = "Report Genarated : " . date('d-M-Y H:i:s a');

        $html = '<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th>ID</th>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Barcode</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Purchase Cost</th>
                <th>Sell Price</th>
                <th>Supplier / Vendor</th>
                </tr>
                </thead>
                <tbody>';



        $inv = $this->purchaseItemReport($request);
        $total_quantity = 0;
        $total_costamount = 0;
        $total_purchaseamount = 0;
        foreach ($inv as $index => $voi) :

            $html .= '<tr>
                        <td>' . $voi->id . '</td>
                        <td>' . $voi->order_no . '</td>
                        <td>' . $voi->order_date . '</td>
                        <td>' . $voi->product_barcode . '</td>
                        <td>' . $voi->product_name . '</td>
                        <td>' . $voi->quantity . '</td>
                        <td>' . number_format($voi->cost,2) . '</td>
                        <td>' . number_format($voi->price,2) . '</td>
                        <td>' . $voi->vendor_name . '</td>
                        </tr>';
            $total_quantity += $voi->quantity;
            $total_costamount += ($voi->cost * $voi->quantity);
            $total_purchaseamount += ($voi->price * $voi->quantity);

        endforeach;

        $html .= '<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>' . $total_quantity . '</td>
                        <td>' . number_format($total_costamount, 2) . '</td>
                        <td>' . number_format($total_purchaseamount, 2) . '</td>
                        <td></td>
                        </tr>';






        /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

        $html .= '</tbody></table>';

        //echo $html; die();



        $this->sdc->PDFLayout($reportName, $html);
    }

    public function purchaseReport(Request $request)
    {
        $order_no = '';
        if (isset($request->order_no)) {
            $order_no = $request->order_no;
        }

        $vendor_id = '';
        if (isset($request->vendor_id)) {
            $vendor_id = $request->vendor_id;
        }

        $start_date = '';
        if (isset($request->start_date)) {
            $start_date = $request->start_date;
        }

        $end_date = '';
        if (isset($request->end_date)) {
            $end_date = $request->end_date;
        }

        if (empty($start_date) && !empty($end_date)) {
            $start_date = $end_date;
        }

        if (!empty($start_date) && empty($end_date)) {
            $end_date = $start_date;
        }

        $dateString = '';
        if (!empty($start_date) && !empty($end_date)) {
            $dateString = "CAST(lsp_purchases.order_date as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        }
        // dd($dateString);
        $pro = Purchase::when($order_no, function ($query) use ($order_no) {
            return $query->where('order_no', '=', $order_no);
        })
            ->when($vendor_id, function ($query) use ($vendor_id) {
                return $query->where('vendor_id', '=', $vendor_id);
            })
            ->when($dateString, function ($query) use ($dateString) {
                return $query->whereRaw($dateString);
            })
            ->orderBy('id', 'DESC')
            ->get();
        // dd($invoice);


        return $pro;
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
        $data = array();
        $array_column = array('Order ID', 'Vendor Name', 'Total Quantity', 'Total Amount', 'Order Date');
        array_push($data, $array_column);
        $inv = $this->purchaseReport($request);
        $total_quantity = 0;
        $total_amount = 0;
        foreach ($inv as $voi) :
            $inv_arry = array($voi->order_no, $voi->vendor_name, $voi->total_quantity,number_format($voi->total_amount,2), $voi->order_date);
            array_push($data, $inv_arry);
            $total_quantity += $voi->total_quantity;
            $total_amount += $voi->total_amount;
        endforeach;
        $inv_arry = array('','Total=', $total_quantity, number_format($total_amount, 2),'');
        array_push($data, $inv_arry);

        $reportName = "Purchase Order Report";
        $report_title = "Purchase Order Report";
        $report_description = "Report Genarated : " . date('d-M-Y H:i:s a');
        /*$data = array(
            array('data1', 'data2'),
            array('data3', 'data4')
        );*/

        //array_unshift($data,$array_column);

        // dd($data);

        $excelArray = array(
            'report_name' => $reportName,
            'report_title' => $report_title,
            'report_description' => $report_description,
            'data' => $data
        );

        $this->sdc->ExcelLayout($excelArray);
    }

    public function PdfReport(Request $request)
    {

        $data = array();


        $reportName = "Purchase Order Report";
        $report_title = "Purchase Order Report";
        $report_description = "Report Genarated : " . date('d-M-Y H:i:s a');

        $html = '<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Order ID</th>
                <th class="text-center" style="font-size:12px;" >Vendor Name</th>
                <th class="text-center" style="font-size:12px;" >Total Quantity</th>
                <th class="text-center" style="font-size:12px;" >Total Amount</th>
                <th class="text-center" style="font-size:12px;" >Order Date</th>
                </tr>
                </thead>
                <tbody>';



        $inv = $this->purchaseReport($request);
        $total_quantity=0;
        $total_amount=0;
        foreach ($inv as $index => $voi) :

            $html .= '<tr>
                        <td>' . $voi->order_no . '</td>
                        <td>' . $voi->vendor_name . '</td>
                        <td>' . $voi->total_quantity . '</td>
                        <td>' . number_format($voi->total_amount,2) . '</td>
                        <td>' . date('Y-m-d', strtotime($voi->order_date)) . '</td>
                        </tr>';
            $total_quantity += $voi->total_quantity;
            $total_amount += $voi->total_amount;

        endforeach;

        $html .= '<tr>
                        <td></td>
                        <td></td>
                        <td>' . $total_quantity . '</td>
                        <td>' . number_format($total_amount, 2) . '</td>
                        <td></td>
                        </tr>';






        /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

        $html .= '</tbody></table>';

        //echo $html; die();



        $this->sdc->PDFLayout($reportName, $html);
    }

    public function confirm(Request $request)
    {
        $vendorInfo = Vendor::where('store_id', $this->sdc->storeID())->get();
        $tabSQL = Purchase::select('id')->where('store_id', $this->sdc->storeID())->orderby('id','DESC')->first();
        $autoOrderID = 1;
        if (isset($tabSQL)) {
            $autoOrderID = intval($tabSQL->id) + 1;
        }

        if (count($request->quantity) < 1) {
            return redirect('purchase/create')->with('error', $this->moduleName . ' Failed to add in cart due to empty quantity. !');
        }

        return view(
            'apps.pages.purchase.confirm-purchase',
            [
                'sell_price' => $request->sell_price,
                'purchase_price' => $request->purchase_price,
                'barcode' => $request->barcode,
                'req_pid' => $request->pid,
                'req_cid' => $request->cid,
                'req_quantity' => $request->quantity,
                'req_name' => $request->name,
                'req_price' => $request->price,
                'autoOrderID' => $autoOrderID,
                'vendorData' => $vendorInfo
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro=Product::where('store_id', $this->sdc->storeID())->where('vt_product',0)->get();
        $cat=Category::where('store_id', $this->sdc->storeID())->get();
        return view('apps.pages.purchase.purchase',['productData'=> $pro,'catData'=>$cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchaseSave(Request $request)
    {
        $this->validate($request, [
            'order_no' => 'required',
            'order_date' => 'required',
        ]);



        $invoice_id = time();
        $total_quantity_invoice = 0;
        $total_amount_invoice = 0;
        foreach ($request->pid as $key => $pid) :

            if($pid==0)
            {

                $cat=Category::find($request->cid[$key]);
                $catName=$cat->name;
                $pro =new Product();
                $pro->category_id = $request->cid[$key];
                $pro->category_name = $catName;
                $pro->barcode = $request->barcode[$key];
                $pro->name = $request->p_name[$key];
                $pro->cost = $request->purchase_price[$key];
                $pro->price = $request->sell_price[$key];
                $pro->quantity = 0;
                $pro->store_id = $this->sdc->storeID();
                $pro->created_by = $this->sdc->UserID();
                $pro->save();
                $pid=$pro->id;
            }
            else
            {
                $pro = Product::find($pid);
                $pro->cost = $request->purchase_price[$key];
                $pro->price = $request->sell_price[$key];
                $pro->save();
            }

            Product::find($pid)->increment('quantity', $request->quantity[$key]);
            $tab_stock = new PurchaseItem;
            $tab_stock->order_tracking_id = $invoice_id;
            $tab_stock->product_id = $pid;
            $tab_stock->quantity = $request->quantity[$key];
            $tab_stock->price = $request->sell_price[$key];
            $tab_stock->cost = $request->purchase_price[$key];
            $tab_stock->store_id = $this->sdc->storeID();
            $tab_stock->created_by = $this->sdc->UserID();
            $tab_stock->save();
            $total_quantity_invoice += $request->quantity[$key];
            $total_amount_invoice+= $request->quantity[$key] * $request->purchase_price[$key];
        endforeach;

        if($request->vendor_id=="new")
        {
            $vendor =new Vendor();
            $vendor->name = $request->new_vendor_name;
            $vendor->store_id = $this->sdc->storeID();
            $vendor->created_by = $this->sdc->UserID();
            $vendor->save();

            $vendor_name=$vendor->name;
        }
        else 
        {
            $vendor = Vendor::find($request->vendor_id);
            $vendor_name = $vendor->name;
        }

        //die();

        $tab = new Purchase;
        $tab->order_tracking_id = $invoice_id;
        $tab->order_date = $request->order_date;
        $tab->order_no = $request->order_no;
        $tab->vendor_id = $request->vendor_id;
        $tab->vendor_name = $vendor_name;
        $tab->total_quantity = $total_quantity_invoice;
        $tab->total_amount = $total_amount_invoice;
        $tab->store_id = $this->sdc->storeID();
        $tab->created_by = $this->sdc->UserID();
        $tab->save();

        $this->sdc->log("product", "Product purchase created.");
        return redirect('purchase/create')->with('status', $this->moduleName . ' invoice Successfully !'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase,$id=0)
    {
        $pro = $purchase::where('store_id', $this->sdc->storeID())->where('id',$id)->first();
        $proItem = PurchaseItem::leftJoin('products', 'products.id','=', 'purchase_items.product_id')
                               ->select('purchase_items.*', 'products.name as product_name', 'products.barcode as product_barcode')
                               ->where('purchase_items.store_id', $this->sdc->storeID())
                               ->where('purchase_items.order_tracking_id', $pro->order_tracking_id)
                               ->get();
        //dd($proItem);
        return view('apps.pages.purchase.view-purchase', ['pro' => $pro, 'proItem' => $proItem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase,$id=0)
    {
        $tab = Purchase::find($id);
        $invoice_id = $tab->order_tracking_id;

        $invoice_tab = PurchaseItem::where('store_id', $this->sdc->storeID())
            ->where('order_tracking_id', $invoice_id)
            ->delete();

        $tab->delete();

        return redirect('purchase')->with('status', $this->moduleName . ' invoice Successfully !');
    }
}
