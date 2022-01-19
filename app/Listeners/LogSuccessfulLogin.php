<?php

namespace App\Listeners;

use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\LoginActivity;
use App\Category;
use App\Product;
use App\Customer;
use App\ProductStockin;
use App\WarrantyProduct;
use App\InvoiceProduct;
use App\Invoice;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user_id=\Auth::user()->id;
        $user_type=\Auth::user()->user_type;
        $user_name=\Auth::user()->name;
        $store_id=\Auth::user()->store_id;
        $today=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i:s');

        $tab=new LoginActivity;
        $tab->user_id=$user_id;
        $tab->store_id=$store_id;
        $tab->name=$user_name;
        $tab->activity="Login Successfully";
        $tab->activity_type="auth";
        $tab->ip_address=\Request::ip();
        $tab->user_agent=\Request::server('HTTP_USER_AGENT');
        $tab->save();

        $today=date('Y-m-d');

        if(RetailPosSummary::where('store_id',$store_id)->count()==0)
        {
            $totalProduct=Category::where('store_id',$store_id)->sum('product');
            $totalProductQuantity=Product::where('store_id',$store_id)->sum('quantity');
            $totalCustomer=Customer::where('store_id',$store_id)->count();
            $totalProductStockin=ProductStockin::where('store_id',$store_id)->sum('quantity');
            $totalWarrantyProduct=WarrantyProduct::where('store_id',$store_id)->count();
            $totalInvoiceSalesQuantity=InvoiceProduct::where('store_id',$store_id)->sum('quantity');
            $totalInvoiceSalesPrice=InvoiceProduct::where('store_id',$store_id)->sum('total_price');
            $totalInvoiceSalesCost=InvoiceProduct::where('store_id',$store_id)->sum('total_cost');
            $totalInvoiceQuantity=Invoice::where('store_id',$store_id)->count();
            $totalInvoiceSalesProfit=$totalInvoiceSalesPrice-$totalInvoiceSalesCost;

            $rps=new RetailPosSummary();
            $rps->store_id=$store_id;
            $rps->product_item_quantity=$totalProduct;
            $rps->product_quantity=$totalProductQuantity;
            $rps->customer_quantity=$totalCustomer;
            $rps->stockin_product_quantity=$totalProductStockin;
            $rps->warranty_product_quantity=$totalWarrantyProduct;

            $rps->sales_invoice_quantity=$totalInvoiceQuantity;
            $rps->sales_quantity=$totalInvoiceSalesQuantity;
            $rps->sales_amount=$totalInvoiceSalesPrice;
            $rps->sales_cost=$totalInvoiceSalesCost;
            $rps->sales_profit=$totalInvoiceSalesProfit;
            $rps->save();
        }

        if(RetailPosSummaryDateWise::where('store_id',$store_id)->where('report_date',$today)->count()==0)
        {
            $rpsdw=new RetailPosSummaryDateWise();
            $rpsdw->store_id=$store_id;
            $rpsdw->report_date=$today;
            $rpsdw->save();
        }
    }
}
