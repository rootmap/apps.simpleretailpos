<?php

namespace App\Http\Controllers;
use App\ReportSetting;
use Illuminate\Http\Request;

class ReportSettingController extends Controller
{
    private $moduleName="Report Settings ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $count=ReportSetting::count();
        if($count==0)
        {
            return view('apps.pages.settings.report_setting');
        }
        else
        {
            $rs=ReportSetting::find(1);
            return view('apps.pages.settings.report_setting',['rs'=>$rs]);
        }

    }
    public function store(Request $request)
    {
        $this->validate($request,['company_name'=>'required']);

        	$filename="";
		        if (!empty($request->file('logo'))) {
		            $img = $request->file('logo');
		            $upload = 'upload\report_setting';
		            //$filename=$img->getClientOriginalName();
		            $filename = time() . "." . $img->getClientOriginalExtension();
		            $success = $img->move($upload, $filename);

		        }
        	//print_r($filename); die();
            $tab=new ReportSetting;
            $tab->company_name=$request->company_name;
            $tab->phone=$request->phone ? $request->phone:0;
            $tab->email=$request->email ? $request->email:0;
            $tab->tax_id=$request->tax_id ? $request->tax_id:0;
            $tab->logo=$filename;
            $tab->address=$request->address ? $request->address:0;
            $tab->disclaimer=$request->disclaimer ? $request->disclaimer:0;
            $tab->signature=$request->signature ? $request->signature:0;
            $tab->store_id=$this->sdc->storeID();
        	$tab->created_by=$this->sdc->UserID();
            $tab->save();
        

        $this->sdc->log("Report","Report Settings Created");
        
        return redirect('site/report_setting')->with('status', $this->moduleName.' added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function show(ReportSetting $ReportSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ColorPlate  $colorPlate
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportSetting $ReportSetting)
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
    public function update(Request $request, ReportSetting $ReportSetting, $id=0)
    {
        $this->validate($request,['company_name'=>'required']);
        $filename=$request->eximage;
        if (!empty($request->file('logo'))) {
            $img = $request->file('logo');
            $upload = 'upload/report_setting';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
            unlink($upload.'/'.$request->eximage);
        }
        $tab=ReportSetting::find($id);
        $tab->company_name=$request->company_name;
        $tab->phone=$request->phone ? $request->phone:0;
        $tab->email=$request->email ? $request->email:0;
        $tab->tax_id=$request->tax_id ? $request->tax_id:0;
        $tab->logo=$filename;
        $tab->address=$request->address ? $request->address:0;
        $tab->disclaimer=$request->disclaimer ? $request->disclaimer:0;
        $tab->signature=$request->signature ? $request->signature:0;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("Report","Report Settings Updated");
        return redirect('site/report_setting')->with('status', $this->moduleName.' updated successfully !');
    }
}
