<?php

namespace App\Http\Controllers;

use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\Product;
use App\LoginActivity;
use App\CashierPunch;
use Illuminate\Http\Request;
use Auth;
class RetailPosSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Product";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index(RetailPosSummary $dashboard)
    {

        if(\Auth::check()){

            if(count($this->sdc->dataMenuAssigned())==0)
            {
                return redirect('login')->with(Auth::logout());
            }

        $dash=$dashboard::find(1);
        //print_r($dash); die();
        $Todaydate=date('Y-m-d');
        if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==0)
        {
            RetailPosSummaryDateWise::insert([
               'report_date'=>$Todaydate
            ]);
            $tabToday=RetailPosSummaryDateWise::where('report_date',$Todaydate)->first();
        }
        else
        {
            $tabToday=RetailPosSummaryDateWise::where('report_date',$Todaydate)->first();
        }

        $CashierPunch=CashierPunch::select('id',
                                            'name',
                                            'in_date',
                                            'in_time',
                                            'out_date',
                                            'out_time',\DB::raw('TIMEDIFF(updated_at,created_at) as elsp'))
                                    ->where('store_id',$this->sdc->storeID())
                                    ->orderBy('id','DESC')
                                    ->limit(24)
                                    ->get();

        $LoginActivity=LoginActivity::select('name','activity','created_at')->where('store_id',$this->sdc->storeID())
                                    ->orderBy('id','DESC')
                                    ->limit(24)
                                    ->get();

        //dd($CashierPunch);

        $product=Product::orderBy('sold_times','DESC')->limit(8)->get();
        return view('apps.pages.dashboard.index',[
            'dash'=>$dash,
            'product'=>$product,
            'tod'=>$tabToday,
            'cashier_punch'=>$CashierPunch,
            'loginactivity'=>$LoginActivity,
        ]);

        }
        else
        {
            return redirect(url('login'));
        }
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
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function show(RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetailPosSummary $retailPosSummary)
    {
        //
    }
}
