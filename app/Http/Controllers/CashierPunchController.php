<?php

namespace App\Http\Controllers;

use App\CashierPunch;
use Illuminate\Http\Request;
use Auth;
class CashierPunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Cashier Punch Login";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


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
        if(Auth::user()->user_type==1)
        {
            $tab=\DB::table("users")->orderBy('id','ASC')->get();
        }
        else
        {
            $tab=DB::table("users")->where('store_id',$this->sdc->storeID())->orderBy('id','ASC')->get();
        }
        
        return view('apps.pages.punch.index',['userL'=>$tab]);
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
            'user_id'=>'required',
            'in_date'=>'required',
            'in_time'=>'required',
            'out_date'=>'required',
            'out_time'=>'required'
        ]);
 
            $userInfo=\DB::table("users")
                        ->where('id',$request->user_id)
                        ->first();

            $tabCount=CashierPunch::where('store_id',$userInfo->store_id)
                                    ->where('user_id',$userInfo->id)
                                    ->whereRaw('in_date = CAST("'.$request->in_date.'" AS DATE)')
                                    ->count();

            if($tabCount>0)
            {
                return redirect('attendance/punch/manual')->with('error', 'Cashier Punch Already Exists This Day !');
            }
            else
            {
                $tab=new CashierPunch();
                $tab->user_id=$userInfo->id;
                $tab->name=$userInfo->name;
                $tab->user_type=$userInfo->user_type;
                $tab->in_date=$request->in_date;
                $tab->in_time=$request->in_time;                

                $tab->out_date=$request->out_date;
                $tab->out_time=$request->out_time;
                $tab->store_id=$userInfo->store_id;
                $tab->created_by=Auth::user()->id;
                $tab->save();

                return redirect('attendance/punch/manual')->with('status','Cashier Manual Punch Added Successfully !');
            }

           
    }    

    public function attendanceJson($storeId=0,$userID=0,$limit=0)
    {
        $tab=array();
        $tabCount=CashierPunch::where('store_id',$storeId)->where('user_id',$userID)->count();
        if($tabCount>0)
        {
            $tab=CashierPunch::select('*',\DB::Raw("CASE WHEN out_time = '00:00:00' THEN '00:00:00' 
ELSE IFNULL(TIME_FORMAT(TIMEDIFF(CONCAT(out_date, ' ', IF(LOCATE('PM',out_time) > 0, ADDTIME(TIME(REPLACE(out_time, ' PM','')), '12:00:00'),  TIME(REPLACE(out_time, ' AM','')))),CONCAT(in_date, ' ', IF(LOCATE('PM',in_time) > 0, ADDTIME(TIME(REPLACE(in_time, ' PM','')), '12:00:00'),  TIME(REPLACE(in_time, ' AM',''))))),'%H:%i:%s'),'00:00:00') END AS elapsed_time"))->where('store_id',$storeId)->where('user_id',$userID)->orderBy('id','DESC')->limit($limit)->get();
        }

        return $tab;
    }

    public function report(Request $request)
    {

        if(Auth::user()->user_type==1)
        {
            $userL=\DB::table("users")->orderBy('id','ASC')->get();
        }
        else
        {
            $userL=DB::table("users")->where('store_id',$this->sdc->storeID())->orderBy('id','ASC')->get();
        }

        $tab=$this->filterReport($request);


        $dataD=['dataTable'=>$tab,'userL'=>$userL];
        if(isset($request->start_date))
        {
            if(!empty($request->start_date))
            {
                $arr=['start_date'=>$request->start_date];
                $dataD=array_merge($dataD,$arr);
            }
            
        }

        if(isset($request->end_date))
        {
            if(!empty($request->end_date))
            {
                $arr=['end_date'=>$request->end_date];
                $dataD=array_merge($dataD,$arr);
            }
        }

        if(isset($request->user_id))
        {
            if(!empty($request->user_id))
            {
                $arr=['user_id'=>$request->user_id];
                $dataD=array_merge($dataD,$arr);
            }
            
        }

       // dd($dataD);
        
        return view('apps.pages.punch.report',$dataD);
    }

    public function filterReport(Request $request)
    {
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        $userID='';
        if(isset($request->user_id))
        {
            if(!empty($request->user_id))
            {
                $userID=$request->user_id;
            }
            
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString .="CAST(in_date as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $tab=array();
        if(Auth::user()->user_type==1)
        {
            $tabCount=CashierPunch::orderBy('id','ASC')->count();
            if($tabCount>0)
            {
                if(empty($dateString) && empty($userID))
                {
                    $tab=CashierPunch::select('*',\DB::Raw("CASE WHEN out_time = '00:00:00' THEN '00:00:00' 
    ELSE IFNULL(TIME_FORMAT(TIMEDIFF(CONCAT(out_date, ' ', IF(LOCATE('PM',out_time) > 0, ADDTIME(TIME(REPLACE(out_time, ' PM','')), '12:00:00'),  TIME(REPLACE(out_time, ' AM','')))),CONCAT(in_date, ' ', IF(LOCATE('PM',in_time) > 0, ADDTIME(TIME(REPLACE(in_time, ' PM','')), '12:00:00'),  TIME(REPLACE(in_time, ' AM',''))))),'%H:%i:%s'),'00:00:00') END AS elapsed_time"))
                    ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                    ->when($userID, function ($query) use ($userID) {
                            return $query->where('user_id',$userID);
                     })
                    ->take(100)
                    ->orderBy('id','DESC')
                    ->get();
                }
                else
                {
                    $tab=CashierPunch::select('*',\DB::Raw("CASE WHEN out_time = '00:00:00' THEN '00:00:00' 
    ELSE IFNULL(TIME_FORMAT(TIMEDIFF(CONCAT(out_date, ' ', IF(LOCATE('PM',out_time) > 0, ADDTIME(TIME(REPLACE(out_time, ' PM','')), '12:00:00'),  TIME(REPLACE(out_time, ' AM','')))),CONCAT(in_date, ' ', IF(LOCATE('PM',in_time) > 0, ADDTIME(TIME(REPLACE(in_time, ' PM','')), '12:00:00'),  TIME(REPLACE(in_time, ' AM',''))))),'%H:%i:%s'),'00:00:00') END AS elapsed_time"))
                    ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                    ->when($userID, function ($query) use ($userID) {
                            return $query->where('user_id',$userID);
                     })
                    ->orderBy('id','DESC')
                    ->get();
                }

                
            }
        }
        else
        {
            $tabCount=CashierPunch::where('store_id',$storeId)->count();
            if($tabCount>0)
            {

                if(empty($dateString) && empty($userID))
                {
                    $tab=CashierPunch::select('*',\DB::Raw("CASE WHEN out_time = '00:00:00' THEN '00:00:00' 
    ELSE IFNULL(TIME_FORMAT(TIMEDIFF(CONCAT(out_date, ' ', IF(LOCATE('PM',out_time) > 0, ADDTIME(TIME(REPLACE(out_time, ' PM','')), '12:00:00'),  TIME(REPLACE(out_time, ' AM','')))),CONCAT(in_date, ' ', IF(LOCATE('PM',in_time) > 0, ADDTIME(TIME(REPLACE(in_time, ' PM','')), '12:00:00'),  TIME(REPLACE(in_time, ' AM',''))))),'%H:%i:%s'),'00:00:00') END AS elapsed_time"))
                    ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->when($userID, function ($query) use ($userID) {
                            return $query->where('user_id',$userID);
                     })
                    ->where('store_id',$storeId)
                    ->take(100)
                    ->orderBy('id','DESC')
                    ->get();
                }
                else
                {
                    $tab=CashierPunch::select('*',\DB::Raw("CASE WHEN out_time = '00:00:00' THEN '00:00:00' 
    ELSE IFNULL(TIME_FORMAT(TIMEDIFF(CONCAT(out_date, ' ', IF(LOCATE('PM',out_time) > 0, ADDTIME(TIME(REPLACE(out_time, ' PM','')), '12:00:00'),  TIME(REPLACE(out_time, ' AM','')))),CONCAT(in_date, ' ', IF(LOCATE('PM',in_time) > 0, ADDTIME(TIME(REPLACE(in_time, ' PM','')), '12:00:00'),  TIME(REPLACE(in_time, ' AM',''))))),'%H:%i:%s'),'00:00:00') END AS elapsed_time"))
                    ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->when($userID, function ($query) use ($userID) {
                            return $query->where('user_id',$userID);
                     })
                    ->where('store_id',$storeId)
                    ->orderBy('id','DESC')
                    ->get();
                }

                
            }
        }


        return $tab;
    }


    public function saveattendance(Request $request)
    {
        $retData=array();
        if(!empty($request->date))
        {
            $tabCount=CashierPunch::where('store_id',$this->sdc->storeID())
                                    ->where('user_id',Auth::user()->id)
                                    ->whereRaw('in_date = CAST("'.$request->date.'" AS DATE)')
                                    ->count();

            if($tabCount>0)
            {
                $tab=CashierPunch::where('store_id',$this->sdc->storeID())
                                    ->where('user_id',Auth::user()->id)
                                    ->whereRaw('in_date = CAST("'.$request->date.'" AS DATE)')
                                    ->orderBy('id','DESC')
                                    ->first();
                $tab->out_date=date('Y-m-d',strtotime($request->date));
                $tab->out_time=date('H:i:s',strtotime($request->date));
                $tab->updated_by=Auth::user()->id;
                $tab->save();
            }
            else
            {
                $tab=new CashierPunch();
                $tab->user_id=Auth::user()->id;
                $tab->name=Auth::user()->name;
                $tab->user_type=Auth::user()->user_type;
                $tab->in_date=date('Y-m-d',strtotime($request->date));
                $tab->in_time=date('H:i:s',strtotime($request->date));
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=Auth::user()->id;
                $tab->save();
            }

            

            $retData=$this->attendanceJson($this->sdc->storeID(),Auth::user()->id,10);
            //

        }

        return response()->json($retData)->header('Content-Type','application/json');
    }


    public function ExcelReport(Request $request) 
    {
        // dd($request);
        //excel 
        $data=array();
        $array_column=array('ID','Name','In Date','In Time','Out Date','Out Time','Elapsed Time');
        array_push($data, $array_column);
        $inv=$this->filterReport($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,
                $voi->name,
                $voi->in_date,
                $voi->in_time,
                $voi->out_date,
                $voi->out_time,
                $voi->elapsed_time);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Attendance Punch Report";
        $report_title="Attendance Punch Report";
        $report_description="Attendance Punch Report Genarated : ".date('d-M-Y H:i:s a');
        /*$data = array(
            array('data1', 'data2'),
            array('data3', 'data4')
        );*/

        //array_unshift($data,$array_column);

       // dd($data);

        $excelArray=array(
            'report_name'=>$reportName,
            'report_title'=>$report_title,
            'report_description'=>$report_description,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }


    public function PdfReport(Request $request)
    {

        $data=array();
        
       
        $reportName="Attendance Punch  Report";
        $report_title="Attendance Punch  Report";
        $report_description="Attendance Punch Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Name</th>
                <th class="text-center" style="font-size:12px;" >In Date</th>
                <th class="text-center" style="font-size:12px;" >In Time</th>
                <th class="text-center" style="font-size:12px;" >Out Date</th>
                <th class="text-center" style="font-size:12px;" >Out Time</th>
                <th class="text-center" style="font-size:12px;" >Elapsed Time</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->filterReport($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->in_date.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->in_time.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->out_date.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->out_time.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->elapsed_time.'</td>
                        </tr>';

                    endforeach;



                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody></table>';

                //echo $html; die();



                $this->sdc->PDFLayout($reportName,$html);


    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\CashierPunch  $cashierPunch
     * @return \Illuminate\Http\Response
     */
    public function show(CashierPunch $cashierPunch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CashierPunch  $cashierPunch
     * @return \Illuminate\Http\Response
     */
    public function edit(CashierPunch $cashierPunch,$id=0)
    {
        if(Auth::user()->user_type==1)
        {
            $tab=\DB::table("users")->orderBy('id','ASC')->get();
        }
        else
        {
            $tab=DB::table("users")->where('store_id',$this->sdc->storeID())->orderBy('id','ASC')->get();
        }

        $edit=CashierPunch::find($id);
        
        return view('apps.pages.punch.index',['userL'=>$tab,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CashierPunch  $cashierPunch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashierPunch $cashierPunch,$id=0)
    {
        $this->validate($request,[
            'user_id'=>'required',
            'in_date'=>'required',
            'in_time'=>'required',
            'out_date'=>'required',
            'out_time'=>'required'
        ]);
 
            $userInfo=\DB::table("users")
                        ->where('id',$request->user_id)
                        ->first();

            $tabCount=CashierPunch::where('id',$id)
                                    ->count();

            if($tabCount==0)
            {
                return redirect('attendance/punch/edit/'.$id)->with('error', 'Cashier Punch Missing This Day !');
            }
            else
            {
                $tab=CashierPunch::find($id);
                $tab->user_id=$userInfo->id;
                $tab->name=$userInfo->name;
                $tab->user_type=$userInfo->user_type;
                $tab->in_date=$request->in_date;
                $tab->in_time=$request->in_time;                

                $tab->out_date=$request->out_date;
                $tab->out_time=$request->out_time;
                $tab->store_id=$userInfo->store_id;
                $tab->updated_by=Auth::user()->id;
                $tab->save();

                return redirect('attendance/punch/edit/'.$id)->with('status','Cashier Manual Punch Updated Successfully !');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CashierPunch  $cashierPunch
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashierPunch $cashierPunch)
    {
        //
    }
}
