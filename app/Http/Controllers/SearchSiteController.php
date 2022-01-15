<?php

namespace App\Http\Controllers;

use App\SearchSite;
use App\InvoiceProduct;
use App\InStoreRepair;
use App\InStoreTicket;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;

class SearchSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Search ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function dateParamCreate(Request $request, $tablePrefix='')
    {           
        $start_date='';
        if(isset($request->search_param['start_date']))
        {
            $start_date=$request->search_param['start_date'];
        }

        $end_date='';
        if(isset($request->search_param['end_date']))
        {
            $end_date=$request->search_param['end_date'];
        }

        $dateString='';
        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
            $dateString="CAST(".$tablePrefix."created_at as date)='".$end_date."'";
        }
        elseif(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
            $dateString="CAST(".$tablePrefix."created_at as date)='".$end_date."'";
        }
        elseif(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(".$tablePrefix."created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        return $dateString;
    } 

    public function search(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->search;

            //dd($request);
            $dateString = $this->dateParamCreate($request,'i.');
            if(!empty($dateString))
            {
                $dateString = " AND ".$dateString;
            }
            $invoices=\DB::select(\DB::raw("SELECT l.* FROM (
                SELECT 
                i.id, 
                lip.invoice_id, 
                lip.created_at, 
                p.name AS product_name, 
                c.name AS customer_name,
                i.tender_name,
                i.invoice_status,
                i.total_amount,
                '0' as paid_amount 
                FROM lsp_invoice_products AS lip
                INNER JOIN lsp_invoices AS i ON lip.invoice_id=i.invoice_id
                INNER JOIN lsp_products AS p ON lip.product_id=p.id
                INNER JOIN lsp_customers AS c ON i.customer_id=c.id
                WHERE i.store_id=".$this->sdc->storeID()." ".$dateString."
            ) AS l WHERE 
            l.product_name LIKE '%$search%' OR 
            l.customer_name LIKE '%$search%' OR 
            l.invoice_id LIKE '%$search%' ORDER BY l.created_at DESC LIMIT 30"));

            $total_data = count($invoices);

            return response()->json(['status'=>$total_data,'invoice'=>$invoices]);

            dd($invoices);
        }else{

           // dd($request);

            $data=[];
            if(isset($request->search))
            {
                $data=['search'=>$request->search,'search_param'=>json_encode(json_decode(stripslashes($request->search_param)))];
            }

            return view('apps.pages.search.search',$data);

           
        }
        
    }


    public function SearchinventoryRepair(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->search;

            $dateString = $this->dateParamCreate($request,'lsp_in_store_repairs.');

            $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select(
                              'in_store_repairs.id',
                              'in_store_repairs.product_name',
                              'in_store_repairs.payment_status',
                              'in_store_repairs.customer_name',
                              'in_store_repairs.price',
                              'in_store_repairs.imei',
                              'in_store_repairs.invoice_id',
                              'in_store_repairs.created_at',
                              'invoices.invoice_status'
                              )
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                          })

                     ->take(30)->get();

            $total_data = count($tab);

            return response()->json(['status'=>$total_data,'invoice'=>$tab]);

            dd($invoices);
        }else{
            return response()->json(['status'=>0,'invoice'=>[]]);
        }
        
    }

    public function SearchNoninventoryRepair(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->search;

            $dateString = $this->dateParamCreate($request);

            $tab=InStoreTicket::select(
                                    'id',
                                    'product_name',
                                    'customer_name',
                                    'problem_name',
                                    'payment_status',
                                    'our_cost',
                                    'retail_price',
                                    'imei',
                                    'invoice_id',
                                    'created_at'
                                )
                                ->where('store_id',$this->sdc->storeID())
                                ->orderBy('id','DESC')
                                ->when($search, function ($query) use ($search) {
                                    $query->where('id','LIKE','%'.$search.'%');
                                    $query->orWhere('product_name','LIKE','%'.$search.'%');
                                    $query->orWhere('customer_name','LIKE','%'.$search.'%');
                                    $query->orWhere('problem_name','LIKE','%'.$search.'%');
                                    $query->orWhere('payment_status','LIKE','%'.$search.'%');
                                    $query->orWhere('our_cost','LIKE','%'.$search.'%');
                                    $query->orWhere('retail_price','LIKE','%'.$search.'%');
                                    $query->orWhere('imei','LIKE','%'.$search.'%');
                                    $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                                    $query->orWhere('created_at','LIKE','%'.$search.'%');

                                    return $query;
                                })
                                ->when($dateString, function ($query) use ($dateString) {
                                            return $query->whereRaw($dateString);
                                })
                                ->take(30)->get();

            $total_data = count($tab);

            return response()->json(['status'=>$total_data,'invoice'=>$tab]);

            dd($invoices);
        }else{
            return response()->json(['status'=>0,'invoice'=>[]]);
        }
        
    }

    
    public function SearchCustomer(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->search;
            $dateString = $this->dateParamCreate($request);
            $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                        ->where('store_id',$this->sdc->storeID())
                        ->orderBy('id','DESC')
                        ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('address','LIKE','%'.$search.'%');
                            $query->orWhere('phone','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('last_invoice_no','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                        })
                        ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                        })
                        ->take(30)
                        ->get();

            $total_data = count($tab);

            return response()->json(['status'=>$total_data,'invoice'=>$tab]);

            dd($invoices);
        }else{
            return response()->json(['status'=>0,'invoice'=>[]]);
        }
        
    }


    public function SearchProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $search = $request->search;
            $dateString = $this->dateParamCreate($request);
            $tab=Product::select('id','category_name','barcode','name','quantity','price','cost','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->where('general_sale',0)
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category_name','LIKE','%'.$search.'%');
                            $query->orWhere('barcode','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('quantity','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                        })
                        ->take(30)
                        ->get();

            $total_data = count($tab);

            return response()->json(['status'=>$total_data,'invoice'=>$tab]);

            dd($invoices);
        }else{
            return response()->json(['status'=>0,'invoice'=>[]]);
        }
        
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
     * @param  \App\SearchSite  $searchSite
     * @return \Illuminate\Http\Response
     */
    public function show(SearchSite $searchSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SearchSite  $searchSite
     * @return \Illuminate\Http\Response
     */
    public function edit(SearchSite $searchSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SearchSite  $searchSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SearchSite $searchSite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SearchSite  $searchSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SearchSite $searchSite)
    {
        //
    }
}
