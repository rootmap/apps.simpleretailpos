<?php

namespace App\Http\Controllers;

use App\CustomerInvoiceEmail;
use Illuminate\Http\Request;

class CustomerInvoiceEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Product";
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
    public function store(Request $request,CustomerInvoiceEmail $customerInvoiceEmail)
    {
        $returnID=0;
        $ex=$customerInvoiceEmail::where('email',$request->email)
                             ->where('invoice_id',$request->invoiceID)
                              ->count();
        if($ex==0)
        {
            $tab=new CustomerInvoiceEmail;
            $tab->name=$request->name;
            $tab->email=$request->email;
            $tab->invoice_id=$request->invoiceID;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
            $returnID=$tab->id;
        }

        $this->sdc->log("customer","Customer invoice account created.");

        return $returnID;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerInvoiceEmail  $customerInvoiceEmail
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerInvoiceEmail $customerInvoiceEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerInvoiceEmail  $customerInvoiceEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerInvoiceEmail $customerInvoiceEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerInvoiceEmail  $customerInvoiceEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerInvoiceEmail $customerInvoiceEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerInvoiceEmail  $customerInvoiceEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerInvoiceEmail $customerInvoiceEmail)
    {
        //
    }
}
