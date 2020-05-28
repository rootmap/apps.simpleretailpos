<?php

namespace App\Http\Controllers;

use App\EventCalender;
use Illuminate\Http\Request;

class EventCalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Event Calender";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $data=$this->eventJson();
        return view('apps.pages.event.index',['calData'=>$data]);
    }

    public function eventJson()
    {

        $tab=EventCalender::select('id','event_name as title',
            \DB::Raw("CASE WHEN event_start_time IS NULL THEN event_start_date
                ELSE CONCAT(event_start_date,'T',event_start_time)
                END as start"),
            \DB::Raw("
                CASE WHEN event_end_time IS NULL THEN event_end_date
                ELSE CONCAT(event_end_date,'T',event_end_time)
                END as end"),
            'event_url as url',
            'event_start_date as start')->where('store_id',$this->sdc->storeID())->get();
        //dd($tab);
        return $tab;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('apps.pages.event.create');
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
            'event_name'=>'required',
            'event_start_date'=>'required',
            'event_end_date'=>'required'

        ]);

        $eventCalenderInfo=new EventCalender;
        $eventCalenderInfo->event_name=$request->event_name;
        $eventCalenderInfo->event_url=$request->event_url;
        $eventCalenderInfo->event_start_date=$request->event_start_date;
        $eventCalenderInfo->event_start_time=$request->event_start_time;
        $eventCalenderInfo->event_end_date=$request->event_end_date;
        $eventCalenderInfo->event_end_time=$request->event_end_time;
        $eventCalenderInfo->store_id=$this->sdc->storeID();
        $eventCalenderInfo->save();
        return redirect('event/calendar/create')->with('status','Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventCalender  $eventCalender
     * @return \Illuminate\Http\Response
     */
    public function show(EventCalender $eventCalender)
    {
        $eventCalenderInfo=EventCalender::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.event.list',['dataTable'=>$eventCalenderInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventCalender  $eventCalender
     * @return \Illuminate\Http\Response
     */
    public function edit(EventCalender $eventCalender,$id)
    {
         $eventCalenderInfo=EventCalender::find($id);
         return view('apps.pages.event.create',['editData'=>$eventCalenderInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventCalender  $eventCalender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventCalender $eventCalender,$id)
    {
         $this->validate($request,[
            'event_name'=>'required',
            'event_start_date'=>'required',
            'event_end_date'=>'required'

        ]);

        $eventCalenderInfo=EventCalender::find($id);
        $eventCalenderInfo->event_name=$request->event_name;
        $eventCalenderInfo->event_url=$request->event_url;
        $eventCalenderInfo->event_start_date=$request->event_start_date;
        $eventCalenderInfo->event_start_time=$request->event_start_time;
        $eventCalenderInfo->event_end_date=$request->event_end_date;
        $eventCalenderInfo->event_end_time=$request->event_end_time;
        $eventCalenderInfo->updated_by=$this->sdc->UserID();
        $eventCalenderInfo->save();
        return redirect('event/calendar/list')->with('status','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventCalender  $eventCalender
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventCalenderInfo=EventCalender::find($id);
        $eventCalenderInfo->delete();
         return redirect('event/calendar/list')->with('status','Deleted Successfully');
    }
}
