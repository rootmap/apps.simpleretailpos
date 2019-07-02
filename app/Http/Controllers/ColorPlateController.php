<?php

namespace App\Http\Controllers;

use App\ColorPlate;
use Illuminate\Http\Request;

class ColorPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Color ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        return view('apps.pages.settings.color');
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
        $this->validate($request,['color_name'=>'required','color_value'=>'required']);

        for($i=1; $i<=4; $i++)
        {
            $color_name=$request->color_name.' '.$i;
            $color_value=$request->color_value.'-'.$i;
            $tab=new ColorPlate;
            $tab->color_name=$color_name;
            $tab->color_value=$color_value;
            $tab->save();
        }

        $this->sdc->log("color","Color Created");
        
        return redirect('site/color')->with('status', $this->moduleName.' added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function show(ColorPlate $colorPlate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorPlate $colorPlate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColorPlate $colorPlate)
    {
        $this->validate($request,['nav_class_name'=>'required']);
        $tab=SiteSetting::find($id);
        $tab->nav_class_name=$request->nav_class_name;
        $tab->outline_border_name=$request->outline_border_name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("color","Color Updated");
        return redirect('site/color')->with('status', $this->moduleName.' color updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColorPlate $colorPlate)
    {
        //
    }
}
