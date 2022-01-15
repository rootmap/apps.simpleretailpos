<?php

namespace App\Http\Controllers;

use App\CounterDisplay;
use App\CounterDisplayAuthorizedPC;
use Illuminate\Http\Request;
use App\Invoice;
use App\Product;
use App\Tender;
use App\Customer;
use App\InvoiceProduct;
use App\InvoicePayment;
use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\PosSetting;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Session;
use App\Pos;

class CounterDisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Counter Display";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function GenaratePageDataLimit($limit='')
    {
        if(!session::has('pagination_limit') && empty($limit))
        {
            $defaultLimit=16;
            $exSettingsCount=PosSetting::count();
            if($exSettingsCount>0)
            {
                $exSettings=PosSetting::find(1);
                $defaultLimit=$exSettings->pos_item;
            }

            session::put('pagination_limit',$defaultLimit);
        }
        elseif(!session::has('pagination_limit') && !empty($limit))
        {
            session::put('pagination_limit',$limit);
        }
        elseif(session::has('pagination_limit') && !empty($limit))
        {
            session::put('pagination_limit',$limit);
        }

        $newLimit=session::get('pagination_limit')?session::get('pagination_limit'):$limit;

        return $newLimit;
    }

    public function GenaratePageDataFilter($filter='')
    {
        if(!session::has('filter') && empty($filter))
        {
            session::put('filter','id-desc');
        }
        elseif(!session::has('filter') && !empty($filter))
        {
            session::put('filter',$filter);
        }
        elseif(session::has('filter') && !empty($filter))
        {
            session::put('filter',$filter);
        }

        $filterData=session::get('filter')?session::get('filter'):'id-desc';
       

        return $filterData;

    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

    
    
    public function counterDisplayMachineCheck()
    {
        $returnValue=0;
        $check=CounterDisplayAuthorizedPC::where('user_pc_ip',$_SERVER['REMOTE_ADDR'])->count();
        if($check>0)
        {
            $tab=CounterDisplayAuthorizedPC::where('user_pc_ip',$_SERVER['REMOTE_ADDR'])->first();
            $returnValue=$tab->user_pc_name;
        }

        return $returnValue;
    }

    public function index(Request $request)
    {

        $invoiceSalesAmount=0;
        $cart=[];
        $counterDisplayID=CounterDisplay::select('session_id')
                         ->where('user_id',\Auth::user()->id)
                         ->first();
        if(isset($counterDisplayID))
        {
            $datas=\DB::table('sessions')->where('id',trim($counterDisplayID->session_id))
                        ->where('user_id',\Auth::user()->id)
                        ->first();

            if(isset($datas))
            {
                if(isset($datas->payload))
                {
                    $data=unserialize(base64_decode($datas->payload));
                    //dd($data['Pos']);
                    $cart=$data['Pos'];
                    $invoiceSalesAmount=1;
                }
            }
        }



        //$paid=$data['Pos']->paid=10;
        //dd($data);




        if(!empty($this->counterDisplayMachineCheck()))
        {
            $filter=$this->GenaratePageDataFilter();
            $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
            $Cart = Session::has('Pos') ? Session::get('Pos') : null;
            if(isset($Cart))
            {
                if(empty($Cart->invoiceID))
                {
                    $Ncart = new Pos($Cart);
                    $Ncart->genarateInvoiceID();
                    Session::put('Pos', $Ncart);
                    $Cart = Session::has('Pos') ? Session::get('Pos') : null;
                }
            }
            else
            {
                $Ncart = new Pos($Cart);
                $Ncart->genarateInvoiceID();
                Session::put('Pos', $Ncart);
                $Cart = Session::has('Pos') ? Session::get('Pos') : null;
            }
            if(Invoice::count()>0)
            {
                $sql_invoice_id=Invoice::select("id")->orderBy("id","DESC")->first();
                $last_invoice_id=$sql_invoice_id->id;
            }
            else
            {
                $last_invoice_id=0;
            }

            $ps=PosSetting::find(1);
            $CounterDisplay=$this->counterDisplayCheck();
            $pro=Product::where('store_id',$this->sdc->storeID())
            ->when($filter, function($query) use ($filter){
                if($filter=='id-desc'){ return $query->orderby('id','desc'); }
                elseif($filter=='price:asc'){ return $query->orderby('price','asc'); }
                elseif($filter=='price:desc'){ return $query->orderby('price','desc'); }
                elseif($filter=='name:asc'){ return $query->orderby('name','asc'); }
                elseif($filter=='name:desc'){ return $query->orderby('name','desc'); }
                elseif($filter=='quantity:desc'){ return $query->orderby('quantity','desc'); }
                elseif($filter=='position:asc'){ return $query->orderby('id','desc'); }
                else{ return $query->orderby('id','desc'); }                    
            })
            ->paginate($this->GenaratePageDataLimit());

            //dd($Cart);

            $tender=Tender::where('store_id',$this->sdc->storeID())->get();
            return view('counter.pages.pos.index',['product'=>$pro,'tender'=>$tender,'ps'=>$ps,'cart'=>$Cart,'customerData'=>$tab_customer,"last_invoice_id"=>$last_invoice_id,'counter'=>$this->counterDisplayMachineCheck(),'CounterDisplayStatus'=>$CounterDisplay]);
        }
        else
        {
            return redirect('dashboard')->with('error','Machine for (Counter Display) not authorized !');
        }
        
    }

    private function counterDisplayCheck()
    {
        $session_id=Session::getId(); 
        $counterStatus=0;

        $counterDisplayIDCheck=CounterDisplay::where('user_id',\Auth::user()->id)->count();
        if($counterDisplayIDCheck==0)
        {
            $tab=new CounterDisplay;
            $tab->session_id=$session_id;
            $tab->counter_status=$counterStatus;
            $tab->user_id=\Auth::user()->id;
            $tab->save();
        }
        else
        {
            $tab=CounterDisplay::where('user_id',\Auth::user()->id)->first();
            $counterStatus=$tab->counter_status;
        }



        return $counterStatus;
    }

    public function getSalesCartCounter(Request $request)
    {

        $counterDisplayID=CounterDisplay::select('session_id')->where('user_id',\Auth::user()->id)->first();
        if(isset($counterDisplayID))
        {
            $datas=\DB::table('sessions')->where('id',trim($counterDisplayID->session_id))->where('user_id',\Auth::user()->id)->first();
            if(isset($datas))
            {
                if(isset($datas->payload))
                {
                    $data=unserialize(base64_decode($datas->payload));
                    //dd($data['Pos']);
                    return response()->json($data['Pos']);
                }
                else
                {
                    return response()->json(null);
                }
            }
            else
            {
                return response()->json(null);
            }
        }
        else
        {
            return response()->json(null);
        }
    }    

    public function getDBCartTokenID(Request $request)
    {

        $counterDisplayID=CounterDisplay::select('session_id')->where('user_id',\Auth::user()->id)->first();
        //dd($counterDisplayID);
        $datas=\DB::table('sessions')->where('id',trim($counterDisplayID->session_id))->where('user_id',\Auth::user()->id)->first();
        // /$data = Session::where('user_id',\Auth::user()->id)->first();
        $data=unserialize(base64_decode($datas->payload));
        dd($data['Pos']);
    }

    public function updateCounterStatus(Request $request)
    {
        $session_id=Session::getId(); 
        $counterStatus=$request->counterStatus?$request->counterStatus:0;

        $counterDisplayIDCheck=CounterDisplay::where('user_id',\Auth::user()->id)->count();
        if($counterDisplayIDCheck>0)
        {
            $tab=CounterDisplay::where('user_id',\Auth::user()->id)->first();
            $tab->session_id=$session_id;
            $tab->counter_status=$counterStatus;
            $tab->user_id=\Auth::user()->id;
            $tab->save();
        }
        else
        {
            $tab=new CounterDisplay;
            $tab->session_id=$session_id;
            $tab->counter_status=$counterStatus;
            $tab->user_id=\Auth::user()->id;
            $tab->save();
        }

        $this->sdc->log("counter-display","Counter display status updated.");

        return $tab->counter_status;
        
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
     * @param  \App\CounterDisplay  $counterDisplay
     * @return \Illuminate\Http\Response
     */
    public function show(CounterDisplay $counterDisplay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CounterDisplay  $counterDisplay
     * @return \Illuminate\Http\Response
     */
    public function edit(CounterDisplay $counterDisplay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CounterDisplay  $counterDisplay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CounterDisplay $counterDisplay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CounterDisplay  $counterDisplay
     * @return \Illuminate\Http\Response
     */
    public function destroy(CounterDisplay $counterDisplay)
    {
        //
    }
}
