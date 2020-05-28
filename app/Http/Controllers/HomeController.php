<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Tender;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $moduleName="Sales";
    private $sdc;

    public function __construct()
    {
        $this->middleware('auth');
        $this->sdc = new StaticDataController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apps.pages.dashboard');
    }

    public function soon()
    {
        return view('apps.comingsoon.layout');
    }

    public function form()
    {
        return view('apps.pages.fresh-form');
    }

    public function DemoDashboard()
    {
        return view('apps.pages.dashboard.index');
    }

    /*public function login()
    {
        return view('login.pages.login');
    }*/

    public function reset()
    {
         return view('login.pages.login');
    }

    public function register()
    {
        return view('login.pages.register');
    }
    public function product()
    {
        return view('apps.pages.product');
    }
    public function productinventory()
    {
        return view('apps.pages.productinventory');
    }
    public function customer()
    {
        
        //echo StaticDataController::storeID(); die();
        return view('apps.pages.customer');
    }
    public function addsales()
    {
        return view('apps.pages.addsales');
    }
    public function calculatevariance()
    {
        return view('apps.pages.calculatevariance');
    }
    public function variancereport()
    {
        return view('apps.pages.variance-report.variancereport');
    }
    public function variancereportdetail()
    {
        return view('apps.pages.variance-report/variancereportdetail');
    }
    public function invoice()
    {
        return view('apps.pages.invoice');
    }
    public function profitList()
    {
        return view('apps.pages.profitList');
    }
    public function warranty()
    {
        return view('apps.pages.warranty.list');
    }
    public function warrantyInvoice()
    {
        return view('apps.pages.warranty.warrantyInvoice');
    }
    public function warrantyBatchOut()
    {
        return view('apps.pages.warranty.warrantyBatchOut');
    }
    public function invoicetemplate()
    {
        return view('apps.pages.invoice-template.invoice_template_one');
    }
    public function invoicesummary()
    {
        return view('apps.pages.invoice-template.invoice-summary');
    }
    public function invoicetemplateprint()
    {
        return view('apps.pages.invoice-template.invoice-template');
    }
    public function setting()
    {
        return view('apps.pages.setting');
    }
    public function possetting()
    {
        return view('apps.pages.possetting');
    }
    public function dashboard_demo()
    {
        $pro=Product::where('store_id',$this->sdc->storeID())->get();
        $tender=Tender::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.dashboard_demo',['product'=>$pro,'tender'=>$tender]);
    }

    public function chart()
    {
        
        return view('apps.pages.chart.init');
    }
}
