<?php

namespace App\Http\Controllers;

use App\UserTour;
use Illuminate\Http\Request;

class UserTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="User Tour";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index($seriURL='')
    {
        $replaceableURL=$this->sdc->urlForChangeData();
        $newURL=unserialize(str_replace("100000032156","/",$seriURL));
        $saveAbleURL=str_replace($replaceableURL,"",$newURL);
        $chkeck=UserTour::where('user_id',$this->sdc->UserID())->where('page_name',$saveAbleURL)->count();
        if($chkeck==0)
        {
            $tab=new UserTour();
            $tab->user_tour_status=1;
            $tab->user_id=$this->sdc->UserID();
            $tab->page_name=$saveAbleURL;
            $tab->save();
        }
        else
        {
            $tab=UserTour::where('user_id',$this->sdc->UserID())->where('page_name',$saveAbleURL)->first();
            $tab->user_tour_status=1;
            $tab->save();
        }
        
        return redirect(url($saveAbleURL));
    }

    public function systemTour(Request $request)
    {

        $chkeck=UserTour::where('user_id',$this->sdc->UserID())->where('page_name',$request->page_name)->count();
        if($request->systour==2)
        {
            if($chkeck==0)
            {
                $tab=new UserTour();
                $tab->user_tour_status=$request->systour;
                $tab->user_id=$this->sdc->UserID();
                $tab->page_name=$request->page_name;
                $tab->save();
            }
            else
            {
                $tab=UserTour::where('user_id',$this->sdc->UserID())->where('page_name',$request->page_name)->first();
                $tab->user_tour_status=$request->systour;
                $tab->save();
            }
        }
        else
        {
            
            if($chkeck==0)
            {
                $tab=new UserTour();
                $tab->user_tour_status=$request->systour;
                $tab->user_id=$this->sdc->UserID();
                $tab->page_name=$request->page_name;
                $tab->save();
            }
            else
            {
                $tab=UserTour::where('user_id',$this->sdc->UserID())->where('page_name',$request->page_name)->first();
                $tab->user_tour_status=2;
                $tab->save();
            }
        }
        
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
     * @param  \App\UserTour  $userTour
     * @return \Illuminate\Http\Response
     */
    public function show(UserTour $userTour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserTour  $userTour
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTour $userTour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTour  $userTour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTour $userTour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserTour  $userTour
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTour $userTour)
    {
        //
    }
}
