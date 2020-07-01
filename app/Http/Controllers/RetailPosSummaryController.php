<?php

namespace App\Http\Controllers;

use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\Product;
use App\LoginActivity;
use App\CashierPunch;
use App\Invoice;
use App\SalesReturn;
use App\InvoiceProduct;
use App\Expense;
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

    public function analytical_dashboard(Request $request){
        return view('apps.pages.dashboard.analytical_dashboard');
    }

    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    private function getContrastColor($hexColor) {

        // hexColor RGB
            $R1 = hexdec(substr($hexColor, 1, 2));
            $G1 = hexdec(substr($hexColor, 3, 2));
            $B1 = hexdec(substr($hexColor, 5, 2));

            // Black RGB
            $blackColor = "#000000";
            $R2BlackColor = hexdec(substr($blackColor, 1, 2));
            $G2BlackColor = hexdec(substr($blackColor, 3, 2));
            $B2BlackColor = hexdec(substr($blackColor, 5, 2));

             // Calc contrast ratio
             $L1 = 0.2126 * pow($R1 / 255, 2.2) +
                   0.7152 * pow($G1 / 255, 2.2) +
                   0.0722 * pow($B1 / 255, 2.2);

            $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
                  0.7152 * pow($G2BlackColor / 255, 2.2) +
                  0.0722 * pow($B2BlackColor / 255, 2.2);

            $contrastRatio = 0;
            if ($L1 > $L2) {
                $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
            } else {
                $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
            }

            // If contrast is more than 5, return black color
            if ($contrastRatio > 5) {
                return '#000000';
            } else { 
                // if not, return white color.
                return '#FFFFFF';
            }
    }

    private function defineDateParam($start_date,$end_date)
    {
        $curdate=strtotime($start_date);
        $mydate=strtotime($end_date);
        $dateArray=['start_date'=>'','end_date'=>''];
        if($curdate > $mydate)
        {
            $now = strtotime($start_date); // or your date as well
            $your_date = strtotime($end_date);
            $datediff = $now - $your_date;
            $total_day = round($datediff / (60 * 60 * 24));
            $dateArray=['start_date'=>$start_date,'end_date'=>$end_date,'day_total'=>$total_day-1,'actual_day'=>$total_day];
        }
        else
        {
            $now = strtotime($end_date); // or your date as well
            $your_date = strtotime($start_date);
            $datediff = $now - $your_date;
            $total_day = round($datediff / (60 * 60 * 24));
            $dateArray=['start_date'=>$end_date,'end_date'=>$start_date,'day_total'=>$total_day-1,'actual_day'=>$total_day];
        }

        return $dateArray;
    }

    public function analyticsRepairInventory(Request $request){

        $today = date('Y-m-d');
        $dateParam = $this->defineDateParam($today,'2020-06-17');
        $repair = [];
        $repair[] = ['daily', 'Sales', 'Expense'];
        for($i=0; $i<=$dateParam['actual_day']; $i++){
            $actual_date = date('Y-m-d',strtotime($dateParam['start_date'].'-'.$i.' day'));
            $Invoice = Invoice::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->sum('total_amount');
            $InStoreTicket = Expense::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->sum('expense_amount');
            $repair[]= [$actual_date,$Invoice,$InStoreTicket];
        }

        return response()->json($repair);
    }

    public function analyticsSalesNBuyback(Request $request){

        $today = date('Y-m-d');
        $dateParam = $this->defineDateParam($today,'2020-06-17');
        $repair = [];
        $repair[] = ['Date', 'Sales', 'Return'];
        for($i=0; $i<=$dateParam['actual_day']; $i++){
            $actual_date = date('Y-m-d',strtotime($dateParam['start_date'].'-'.$i.' day'));
            $Invoice = InvoiceProduct::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->sum('quantity');
            $Buyback = SalesReturn::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->count();
            $repair[]= [$actual_date,$Invoice,$Buyback];
        }

        return response()->json($repair);
    }

    public function analyticsSalesvsProfit(Request $request){

        $today = date('Y-m-d');
        $dateParam = $this->defineDateParam($today,'2020-06-17');
        $repair = [];
        $repair[] = ['daily', 'Sales','Profit'];
        for($i=0; $i<=$dateParam['actual_day']; $i++){
            $actual_date = date('Y-m-d',strtotime($dateParam['start_date'].'-'.$i.' day'));
            $Invoice = Invoice::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->sum('total_amount');
            $Profit = Invoice::where('store_id',$this->sdc->storeID())->whereDate('created_at', $actual_date)->sum('total_profit');
            $repair[]= [$actual_date,$Invoice,$Profit];
        }

        return response()->json($repair);
    }

    public function analyticsTopCashierProducts(Request $request){

        $today = date('Y-m-d');
        //$dateParam = $this->defineDateParam($today,'2020-05-25');
        $repair = [];
        $repair[] = ['Task', 'Sales Invoice Quantity'];

        if(Auth::user()->user_type==1)
        {
            $Invoice = \DB::Select(\DB::raw("SELECT a.id,count(a.product_id) AS total_sold,u.name FROM lsp_invoice_products AS a
            INNER JOIN lsp_users AS u ON a.created_by=u.id
            WHERE a.store_id!=".$this->sdc->storeID()." 
            
            GROUP BY a.created_by
            ORDER BY total_sold DESC LIMIT 5"));
        }
        else{
            $Invoice = \DB::Select(\DB::raw("SELECT a.id,count(a.product_id) AS total_sold,u.name FROM lsp_invoice_products AS a
            INNER JOIN lsp_users AS u ON a.created_by=u.id
            WHERE a.store_id=".$this->sdc->storeID()." AND cast(a.created_at AS DATE)='".$today."'
            GROUP BY a.created_by
            ORDER BY total_sold DESC LIMIT 5"));
        }

        foreach($Invoice as $pro){
            $repair[]= [$pro->name." - ".$pro->total_sold.' Products',$pro->total_sold];
        }
        

        return response()->json($repair);
    }


    public function analyticsTopProducts(Request $request){

        

        $today = date('Y-m-d');
        //$dateParam = $this->defineDateParam($today,'2020-05-25');
        $repair = [];
        $repair[] = ["Element", "Sold Quantity",['role'=>"style"]];
        $Invoice = Product::where('store_id',$this->sdc->storeID())->orderBy('sold_times','DESC')->take('10')->get();
        foreach($Invoice as $pro){

            $randomString = md5($this->generateRandomString()); // like "d73a6ef90dc6a ..."
            $r = substr($randomString,0,2); //1. and 2.
            $g = substr($randomString,2,2); //3. and 4.
            $b = substr($randomString,4,2); //5. and 6.
            $fontCOlor="#".$r."".$g."".$b;

            $repair[]= [$pro->name,$pro->sold_times,$fontCOlor];
        }
        

        return response()->json($repair);
    }


    public function analyticsTodaySalesnTotalInventory(Request $request){
        $today = date('Y-m-d');
        $totalSold = Invoice::where('store_id',$this->sdc->storeID())->whereDate('created_at', $today)->sum('total_amount');
        $totalProduct = Product::where('store_id',$this->sdc->storeID())->where('general_sale',0)->sum('quantity');

        
        

        return response()->json(['sold'=>intval($totalSold),'product'=>intval($totalProduct)]);
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
