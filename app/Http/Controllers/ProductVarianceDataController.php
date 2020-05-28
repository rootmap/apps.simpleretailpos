<?php

namespace App\Http\Controllers;

use App\ProductVarianceData;
use Illuminate\Http\Request;

class ProductVarianceDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $moduleName="ProductVarianceData";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }
    public function index()
    {
        return view('apps.pages.calculatevariance');
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
        $tab=new ProductVarianceData;

        $tab->quantity_in_hand=[
            
        ];
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        //$tab->save();


        $name = 'fakhrul';
        echo '<pre>';
        print_r($tab);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVarianceData  $productVarianceData
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVarianceData $productVarianceData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVarianceData  $productVarianceData
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVarianceData $productVarianceData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVarianceData  $productVarianceData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVarianceData $productVarianceData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVarianceData  $productVarianceData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductVarianceData $productVarianceData)
    {
        //
    }
}
