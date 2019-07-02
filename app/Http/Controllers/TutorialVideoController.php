<?php

namespace App\Http\Controllers;

use App\TutorialVideo;
use Illuminate\Http\Request;
use DB;

class TutorialVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Tutorial Video ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        
       
        $vdo = \DB::table('tutorial_video')
             ->select('tutorial_video.*')
             ->get();
        return view('apps.pages.TutorialVideo.index',['dataTable'=>$vdo]);

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
            'title'=>'required',
            'name'=>'required',
            'thumb'=>'required',
            'status'=>'required',
         ]);
        
        $filename = "";
            if (!empty($request->file('name'))) {
                $img = $request->file('name');
                $upload = 'upload/TutorialVideo/Video';
                $filename = time() . "." . $img->getClientOriginalExtension();
                $success = $img->move($upload, $filename);
            }
        $filenameImg = "";
            if (!empty($request->file('thumb'))) {
                $img = $request->file('thumb');
                $upload = 'upload/TutorialVideo/thumb';
                $filenameImg = time() . "." . $img->getClientOriginalExtension();
                $success = $img->move($upload, $filenameImg);
            }
            // dd($filenameImg);
        DB::table('tutorial_video')->insert(
                 array(
                       'title'=>$request->title,
                       'name'=>$filename,
                       'thumb'=>$filenameImg,
                       'status'=>$request->status,
                       'store_id'=>$this->sdc->storeID(),
                       'created_by'=>$this->sdc->UserID(),
                 )
            );
        $this->sdc->log("Tutorial Video","Tutorial Video created");
        return redirect('TutorialVideo')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TutorialVideo  $tutorialVideo
     * @return \Illuminate\Http\Response
     */
    public function show(TutorialVideo $tutorialVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TutorialVideo  $tutorialVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vdo = \DB::table('tutorial_video')
             ->select('tutorial_video.*')
             ->get();
        $ticket = \DB::table('tutorial_video')
             ->select('tutorial_video.*')
             ->where('tutorial_video.id','=',$id)
             ->first();
        // dd($ticket);
        return view('apps.pages.TutorialVideo.index',['edit'=>$ticket,'dataTable'=>$vdo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TutorialVideo  $tutorialVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filename = $request->exname;
            if (!empty($request->file('name'))) {
                $img = $request->file('name');
                $upload = 'upload/TutorialVideo/Video';
                $filename = time() . "." . $img->getClientOriginalExtension();
                $success = $img->move($upload, $filename);
            }
        $filenameImg = $request->exthumb;
            if (!empty($request->file('thumb'))) {
                $img = $request->file('thumb');
                $upload = 'upload/TutorialVideo/thumb';
                $filenameImg = time() . "." . $img->getClientOriginalExtension();
                $success = $img->move($upload, $filenameImg);
            }
            // dd($filenameImg);
        DB::table('tutorial_video')->where('id', $id)->update(
                 array(
                       'title'=>$request->title,
                       'name'=>$filename,
                       'thumb'=>$filenameImg,
                       'status'=>$request->status,
                       'store_id'=>$this->sdc->storeID(),
                       'created_by'=>$this->sdc->UserID(),
                 )
            );
        $this->sdc->log("Tutorial Video","Tutorial Video created");
        return redirect('TutorialVideo')->with('status', $this->moduleName.' Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TutorialVideo  $tutorialVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vdo = \DB::table('tutorial_video')->where('id',$id)->delete();
        return redirect('TutorialVideo')->with('status', $this->moduleName.' Deleted Successfully !');
    }

    public function helpDesk()
    {
        $vdo = \DB::table('tutorial_video')
             ->select('tutorial_video.*')
             ->where('tutorial_video.status','=',1)
             ->get();
             // dd($vdo);
        return view('apps.pages.TutorialVideo.helpdesk',['data'=>$vdo]);
    }
    public function helpDeskDetail($id)
    {
        $vdo = \DB::table('tutorial_video')
             ->select('tutorial_video.*')
             ->where('id',$id)
             ->first();
        // dd($vdo);
        return view('apps.pages.TutorialVideo.helpdesk_detail',['data'=>$vdo,'vid'=>$id]);
    }
    public function AjaxhelpDesk(Request $request)
    {
        // dd($this->sdc->storeName());
        $json = DB::table('tutorial_video_comment')->insert(
                 array(
                       'vid'=>$request->msgID,
                       'comment'=>$request->msg,
                       'store_id'=>$this->sdc->storeID(),
                       'created_by'=>$this->sdc->UserID(),
                 )
            );
        $this->sdc->log("Support Ticket Message Reply","Support Ticket Reply created");

        $jsoncount = DB::table('tutorial_video_comment')
                    
                    ->leftjoin('users','tutorial_video_comment.created_by','=','users.id')
                    ->leftjoin('roles','users.user_type','=','roles.id')
                    ->select('tutorial_video_comment.*','roles.name as role_name','users.name as user_name')
                    ->where('tutorial_video_comment.vid','=',$request->msgID)
                    ->where('tutorial_video_comment.created_by','=',$this->sdc->UserID())
                    ->orderBy('id','DESC')
                    ->first();
                    // dd($jsoncount);
        return response()->json($jsoncount);
    }

    public function AjaxCommenthelpDesk($commentid=0)
    {

        $ar=array('total'=>0);
        $jsoncount = DB::table('tutorial_video_comment')
                    ->where('tutorial_video_comment.vid','=',$commentid)
                    ->count();
        
        if($jsoncount>0)
        {
            $json = DB::table('tutorial_video_comment')
                    
                    ->leftjoin('users','tutorial_video_comment.created_by','=','users.id')
                    ->leftjoin('roles','users.user_type','=','roles.id')
                    ->select('tutorial_video_comment.*','roles.name as role_name','users.name as user_name')
                    ->where('tutorial_video_comment.vid','=',$commentid)
                    ->get();


            $ar=array('total'=>$jsoncount,'datas'=>$json);
                    // dd($jsoncount);
            
        }

        return response()->json($ar);
        
    }
}
