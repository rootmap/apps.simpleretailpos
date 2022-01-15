<?php

namespace App\Http\Controllers;

use App\InvoiceAttachment;
use Illuminate\Http\Request;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Invoice Attachment ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        //
    }

    public function attachment(Request $request){
        $this->validate($request,[
            'invoice_id'=>'required',
            'attachment'=>'required|file',
        ]);

        $filename = "";
        if (!empty($request->file('attachment'))) {
            $img = $request->file('attachment');
            $upload = 'upload/invoiceattachment/';
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
        }

       // dd($img->getClientOriginalName());

        $tab = new InvoiceAttachment();
        $tab->invoice_id=$request->invoice_id;
        $tab->orginal_file_name=$img->getClientOriginalName();
        $tab->attachment=$filename;
        $tab->store_id=$this->sdc->storeID();        
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("Invoice Attachment","Invoice Atatchment = ".$tab->id);
        return redirect(url('sales/report'))->with('status', $this->moduleName.' Added Successfully !');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($fileID=0) {

        $tabCount =InvoiceAttachment::where('id',$fileID)->where('store_id',$this->sdc->storeID())->count();
        if($tabCount>0){
            $tab =InvoiceAttachment::find($fileID);
            $file_path = public_path('upload/invoiceattachment/'.$tab->attachment);
            return response()->download($file_path);
        }
        else{
            $this->sdc->log("Trying To Access Other Store Files","Invoice Atatchment = ".$fileID);
            return redirect(url('sales/report'))->with('error', $this->moduleName.' failed to download !');
        }
    }    

    public function delete($fileID=0) {

        $tabCount =InvoiceAttachment::where('id',$fileID)->where('store_id',$this->sdc->storeID())->count();
        if($tabCount>0){
            $tab=InvoiceAttachment::find($fileID);
            $tab->delete();
            $this->sdc->log("InvoiceAttachment","Invoice Attachment deleted");
            return redirect('sales/report')->with('status', $this->moduleName.' Deleted Successfully !');
        }
        else{
            $this->sdc->log("Trying To Delete Other Store Files","Invoice Atatchment Delete= ".$fileID);
            return redirect(url('sales/report'))->with('error', $this->moduleName.' failed to delete !');
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
     * @param  \App\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_id=0)
    {
        $tab =InvoiceAttachment::where('invoice_id',$invoice_id)->get();
        if(count($tab)>0)
        {
            return json_encode(array('total'=>count($tab),'data'=>$tab));
        }else{
            return json_encode(array('total'=>count($tab)));
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceAttachment  $invoiceAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceAttachment $invoiceAttachment)
    {
        //
    }
}
