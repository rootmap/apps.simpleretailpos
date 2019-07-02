<?php

namespace App\Http\Controllers;

use App\InvoiceEmailTeamplate;
use Illuminate\Http\Request;

class InvoiceEmailTeamplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Invoice Email Template";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $emailLayoutData=$this->sdc->invoiceEmailTemplate();
        return view('apps.pages.InvoiceEmail.index',$emailLayoutData);
    }

    public function testEmailSendLoad()
    {
        $emailLayoutData=$this->sdc->invoiceEmailTemplate();
        return view('apps.pages.InvoiceEmail.testEmail',$emailLayoutData);
    }

    public function emailTime(Request $request)
    {
        $tab=InvoiceEmailTeamplate::where('store_id',$this->sdc->storeID())->first();
        $tab->updated_by=$this->sdc->UserID();
        $tab->email_time=$request->email_time;
        $tab->save();
  
        return redirect('settings/invoice/email')->with('status','Email Sending Time Added Successfully');
    }

    public function emailBCC(Request $request)
    {
        $tab=InvoiceEmailTeamplate::where('store_id',$this->sdc->storeID())->first();
        $tab->updated_by=$this->sdc->UserID();
        $tab->bcc=$request->bcc;
        $tab->save();
  
        return redirect('settings/invoice/email')->with('status','Email Sales Notifier Added Successfully');
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
     * @param  \App\InvoiceEmailTeamplate  $invoiceEmailTeamplate
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceEmailTeamplate $invoiceEmailTeamplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceEmailTeamplate  $invoiceEmailTeamplate
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceEmailTeamplate $invoiceEmailTeamplate)
    {
        $emailLayoutData=$this->sdc->invoiceEmailTemplate();
        return view('apps.pages.InvoiceEmail.edit',$emailLayoutData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceEmailTeamplate  $invoiceEmailTeamplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceEmailTeamplate $invoiceEmailTeamplate)
    {
            $tab=InvoiceEmailTeamplate::where('store_id',$this->sdc->storeID())->first();
            $tab->store_id=$this->sdc->storeID();
            $tab->updated_by=$this->sdc->UserID();
            $tab->company_name=$request->company_name;
            $tab->city=$request->city;
            $tab->address=$request->address;
            $tab->phone=$request->phone;
            $tab->terms_title=$request->terms_title;
            $tab->terms_text=$request->terms_text;
            $tab->save();
      
            return redirect('settings/invoice/email')->with('status','Successfully Update Data Saved');
       

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceEmailTeamplate  $invoiceEmailTeamplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceEmailTeamplate $invoiceEmailTeamplate)
    {
        //
    }
}
