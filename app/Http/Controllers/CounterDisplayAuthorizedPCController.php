<?php

namespace App\Http\Controllers;

use App\CounterDisplayAuthorizedPC;
use Illuminate\Http\Request;

class CounterDisplayAuthorizedPCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Counter Display Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=CounterDisplayAuthorizedPC::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.settings.counter-display',['dataTable'=>$tab]);
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
        $this->validate($request,[
            'user_pc_ip'=>'required'
        ]);


        $tab=new CounterDisplayAuthorizedPC;
        $tab->user_id=\Auth::user()->id;
        $tab->user_pc_ip=$request->user_pc_ip;
        $tab->user_pc_name=$request->user_pc_name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("counter-display","PC Authorized created for counter display.");

        return redirect('counter/display/add')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CounterDisplayAuthorizedPC  $counterDisplayAuthorizedPC
     * @return \Illuminate\Http\Response
     */
    public function show(CounterDisplayAuthorizedPC $counterDisplayAuthorizedPC)
    {
        $tab=$CounterDisplayAuthorizedPC::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.settings.counter-display',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CounterDisplayAuthorizedPC  $counterDisplayAuthorizedPC
     * @return \Illuminate\Http\Response
     */
    public function edit(CounterDisplayAuthorizedPC $counterDisplayAuthorizedPC,$id=0)
    {
       $tab=$counterDisplayAuthorizedPC::find($id);
        $tabData=$counterDisplayAuthorizedPC::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.settings.counter-display',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CounterDisplayAuthorizedPC  $counterDisplayAuthorizedPC
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CounterDisplayAuthorizedPC $counterDisplayAuthorizedPC,$id=0)
    {
        $this->validate($request,[
            'user_pc_ip'=>'required',
        ]);

        $tab=$counterDisplayAuthorizedPC::find($id);
        $tab->user_id=\Auth::user()->id;
        $tab->user_pc_ip=$request->user_pc_ip;
        $tab->user_pc_name=$request->user_pc_name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("counter-display","PC Authorized updated for counter display.");
        return redirect('counter/display/add')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CounterDisplayAuthorizedPC  $counterDisplayAuthorizedPC
     * @return \Illuminate\Http\Response
     */
    public function destroy(CounterDisplayAuthorizedPC $counterDisplayAuthorizedPC,$id=0)
    {
        $tab=$counterDisplayAuthorizedPC::find($id);
        $tab->delete();
        $this->sdc->log("counter-display","PC Authorized deleted for counter display.");
        return redirect('counter/display/add')->with('status', $this->moduleName.' Deleted Successfully !');
    }
}
