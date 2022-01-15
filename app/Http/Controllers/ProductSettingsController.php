<?php

namespace App\Http\Controllers;

use App\ProductSettings;
use Illuminate\Http\Request;

class ProductSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Product Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        
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

        $chk=ProductSettings::where('store_id',$this->sdc->storeID())->count();
        if($chk==0)
        {
            $tab=new ProductSettings();
            $tab->product_image_status=$request->product_image_status;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }
        else
        {
            $tab=ProductSettings::where('store_id',$this->sdc->storeID())->first();
            $tab->product_image_status=$request->product_image_status;
            $tab->updated_by=$this->sdc->UserID();
            $tab->save();
        }

        return Response()->json(array('status'=>1,'product_image_status'=>$tab->product_image_status));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSettings  $productSettings
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSettings $productSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSettings  $productSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSettings $productSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSettings  $productSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSettings $productSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSettings  $productSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSettings $productSettings)
    {
        //
    }
}
