<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use App\ColorPlate;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Site ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function navigation()
    {
        $tabColorPlate=ColorPlate::all();
        $tabCount=SiteSetting::where('store_id',$this->sdc->storeID())->count();
        if($tabCount>0)
        {
            $tab=SiteSetting::where('store_id',$this->sdc->storeID())->orderBy("id","DESC")->first();
            return view('apps.pages.settings.navigation',['tab'=>$tab,'color'=>$tabColorPlate]);
        }
        else
        {
            return view('apps.pages.settings.navigation',['color'=>$tabColorPlate]);
        }
    }

    public function navigationstore(Request $request)
    {
        $this->validate($request,['nav_class_name'=>'required']);
        $tab=new SiteSetting;
        $tab->nav_class_name=$request->nav_class_name;
        $tab->outline_border_name=$request->outline_border_name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("navigation","Navigation change created");

        return redirect('site/navigation')->with('status', $this->moduleName.' Navigation Added Successfully !');
    }

    public function navigationupdate(Request $request,$id=0)
    {
        $this->validate($request,['nav_class_name'=>'required']);
        $tab=SiteSetting::find($id);
        $tab->nav_class_name=$request->nav_class_name;
        $tab->outline_border_name=$request->outline_border_name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("navigation","Navigation change updated");

        return redirect('site/navigation')->with('status', $this->moduleName.' Navigation Updated Successfully !');
    }


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
    public function store(Request $request)
    {
        //
    }

    public function printerPrintPaperSize(Request $request)
    {
        return view('apps.pages.settings.printer-print-size');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        //
    }
}
