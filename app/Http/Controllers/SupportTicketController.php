<?php

namespace App\Http\Controllers;

use App\SupportTicket;
use Illuminate\Http\Request;
use DB;
use Auth;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Support Ticket ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }
    public function index()
    {
        if(Auth::user()->user_type==1)
        {
            $ticket = \DB::table('support_tickets as f')
             //->where('f.store_id',$this->sdc->storeID())
             ->orderBy('f.id','DESC')
             ->get();
        }
        else
        {
            $ticket = \DB::table('support_tickets as f')
             ->where('f.store_id',$this->sdc->storeID())
             ->orderBy('f.id','DESC')
             ->get();
        }

        //dd($ticket);

        return view('apps.pages.SupportTicket.ticketlist',
        [
            'ticket'=>$ticket,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dep = \DB::table('departments')
             ->select('departments.id','departments.name')
             ->get();
        $menu_pages = \DB::table('menu_pages')
             ->select('menu_pages.id','menu_pages.name','menu_pages.is_parent')
             ->where('menu_pages.is_parent','=',1)
             ->get();
        // dd($menu_pages);
        return view('apps.pages.SupportTicket.index',
        [
            'dep'=>$dep,
            'menu_pages'=>$menu_pages,
        ]);
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
            'subject'=>'required',
            'department_id'=>'required',
            'related_service_id'=>'required',
            'priority'=>'required',
            'message'=>'required',
         ]);
        $dep=\DB::table('departments')->where('departments.id','=',$request->department_id)->first();
        $dep_name = $dep->name;
        $menu=\DB::table('menu_pages')->where('menu_pages.id','=',$request->related_service_id)->first();
        $menu_name = $menu->name;
        
        $filename = "";
            if (!empty($request->file('attachment'))) {
                $img = $request->file('attachment');
                $upload = 'upload/SupportTicket/';
                $filename = time() . "." . $img->getClientOriginalExtension();
                $success = $img->move($upload, $filename);
            }
            

        //dd($filename);

        $tabRole=\DB::table("roles")->where("id",Auth::user()->user_type)->first();
        $roles=$tabRole->name;

        DB::table('support_tickets')->insert(
                 array(
                       'name'=>$request->name,
                       'email'=>$request->email,
                       'subject'=>$request->subject,
                        'related_service_id'=>$request->related_service_id,
                        'related_service_name'=>$menu_name,
                        'department_id'=>$request->department_id,
                        'department_name'=>$dep_name,
                        'priority'=>$request->priority,
                        'message'=>$request->message,
                        'attachment'=>$filename,
                        'last_ticket_action'=>'Ticket Created By '.$roles,
                        'store_id'=>$this->sdc->storeID(),
                        'created_by'=>$this->sdc->UserID(),
                 )
            );



        $this->sdc->log("Support Ticket","Support Ticket Name created");
        return redirect('SupportTicket')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = \DB::table('support_tickets')
             ->select('support_tickets.*')
             ->where('support_tickets.id','=',$id)
             ->first();
        // dd($ticket);
        return view('apps.pages.SupportTicket.support_detail',['ticket'=>$ticket,'sid'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function AjaxTicket(Request $request)
    {
        // dd($this->sdc->storeName());

        $tabRole=\DB::table("roles")->where("id",Auth::user()->user_type)->first();
        $roles=$tabRole->name;

        $json = DB::table('support_comment')->insert(
                 array(
                       'sid'=>$request->msgID,
                       'comment'=>$request->msg,
                       'store_id'=>$this->sdc->storeID(),
                       'created_by'=>$this->sdc->UserID(),
                 )
            );

        \DB::table('support_tickets')
        ->where(array('id'=>$request->msgID))
        ->update(['last_ticket_action'=>$roles.' Replied']);

        $this->sdc->log("Support Ticket Message Reply","Support Ticket Reply created");

        $jsoncount = DB::table('support_comment')
                    ->leftjoin('users','support_comment.created_by','=','users.id')
                    ->leftjoin('roles','users.user_type','=','roles.id')
                    ->select('support_comment.*','roles.name as role_name','users.name as user_name')
                    ->where('support_comment.sid','=',$request->msgID)
                    ->where('support_comment.created_by','=',$this->sdc->UserID())
                    ->orderBy('id','DESC')
                    ->first();
                    // dd($jsoncount);
        return response()->json($jsoncount);
    }

    public function AjaxCommentTicket($commentid=0)
    {

        $ar=array('total'=>0);
        $jsoncount = DB::table('support_comment')
                    ->where('support_comment.sid','=',$commentid)
                    ->count();
        
        if($jsoncount>0)
        {
            $json = DB::table('support_comment')
                    
                    ->leftjoin('users','support_comment.created_by','=','users.id')
                    ->leftjoin('roles','users.user_type','=','roles.id')
                    ->select('support_comment.*','roles.name as role_name','users.name as user_name')
                    ->where('support_comment.sid','=',$commentid)
                    ->get();


            $ar=array('total'=>$jsoncount,'datas'=>$json);
                    // dd($jsoncount);
            
        }

        return response()->json($ar);
        
    }

    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }
}
