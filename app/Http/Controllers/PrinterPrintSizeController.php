<?php

namespace App\Http\Controllers;

use App\PrinterPrintSize;
use Illuminate\Http\Request;

class PrinterPrintSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Printer Print Size";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $data=$this->sdc->DefaultPrinterPrintSize();
        return view('apps.pages.settings.printer-print-size',['ps'=>$data]);
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
        $tab=PrinterPrintSize::find($id);
        $tab->pos_width=$request->pos_width;
        $tab->pos_height=$request->pos_height;
        $tab->thermal_width=$request->thermal_width;
        $tab->thermal_height=$request->thermal_height;
        $tab->barcode_width=$request->barcode_width;
        $tab->barcode_height=$request->barcode_height;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        return redirect('setting/printer/print-paper/size')->with('status',$this->moduleName.' Saved Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrinterPrintSize  $printerPrintSize
     * @return \Illuminate\Http\Response
     */
    public function show(PrinterPrintSize $printerPrintSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrinterPrintSize  $printerPrintSize
     * @return \Illuminate\Http\Response
     */
    public function edit(PrinterPrintSize $printerPrintSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrinterPrintSize  $printerPrintSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrinterPrintSize $printerPrintSize,$id)
    {
        $tab=PrinterPrintSize::find($id);
        $tab->pos_width=$request->pos_width;
        $tab->pos_height=$request->pos_height;
        $tab->thermal_width=$request->thermal_width;
        $tab->thermal_height=$request->thermal_height;
        $tab->barcode_width=$request->barcode_width;
        $tab->barcode_height=$request->barcode_height;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        return redirect('setting/printer/print-paper/size')->with('status',$this->moduleName.' Modified Successfully !'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrinterPrintSize  $printerPrintSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrinterPrintSize $printerPrintSize)
    {
        //
    }
}
