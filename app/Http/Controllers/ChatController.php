<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Chat Room";
    private $sdc;
    private $adminChatUserID;
    public function __construct(){ 
        $this->sdc = new StaticDataController();
        $this->adminChatUserID=99999;
         }

    public function index(Request $request)
    {

        $from_user_id=$request->loaUID;
        $chat =\DB::select("SELECT id,to_user_id,from_user_id,message_type,status,created_at,updated_at,deleted_at,DATE_FORMAT(created_at,'%H:%i %p') as sent_time, 
                         CASE 
                        WHEN message_type=0 THEN chat_message
                        ELSE CONCAT('<a target=_blank href=".url('chat_photo')."/',chat_message,'>','<img width=193 src=".url('chat_photo')."/',chat_message,' /></a>') END 
                        AS chat_message
                         FROM lsp_chats 
                         WHERE 
                         (to_user_id='".$this->adminChatUserID."' AND from_user_id='".$from_user_id."') 
                         OR 
                         (to_user_id='".$from_user_id."' AND from_user_id='".$this->adminChatUserID."') 
                         ORDER BY created_at ASC");

        return response()->json($chat);
    }

    public function master()
    {
        return view('chat.pages.master');
    }

    public function allchatUser()
    {
        $chat =\DB::select("SELECT a.id,a.chat_message,a.to_user_id,a.from_user_id,a.message_type,a.status,a.created_at,a.updated_at,a.deleted_at,
            CASE 
            WHEN message_type=0 THEN 'sent a message...'
            ELSE 'Send Photo' END 
            AS chat_message,
            DATE_FORMAT(a.created_at,'%H:%i %p') as sent_time,
                            (SELECT name FROM lsp_users WHERE id=a.from_user_id) AS user_name 
                            FROM lsp_chats a
                            WHERE a.from_user_id!=99999 AND a.id IN (
                                SELECT MAX(id)
                                FROM lsp_chats
                                GROUP BY from_user_id
                            ) ORDER BY a.created_at DESC");

        $array=array('total'=>count($chat),'data'=>$chat);

        //WHERE to_user_id != '99999'

        return response()->json($array);

    }

    public function loadMasterConversation(Request $request)
    {
        $from_user_id=$request->loaUID;
        $chat =\DB::select("SELECT a.id,a.to_user_id,a.from_user_id,a.message_type,a.status,a.created_at,a.updated_at,a.deleted_at,
                            DATE_FORMAT(a.created_at,'%H:%i %p') as sent_time, 
                            CASE 
                            WHEN a.from_user_id=".$this->adminChatUserID." THEN 'Admin'
                            ELSE (SELECT name FROM lsp_users WHERE id=a.from_user_id) END 
                            AS user_name,
                            CASE 
                            WHEN message_type=0 THEN chat_message
                            ELSE CONCAT('<a target=_blank href=".url('chat_photo')."/',chat_message,'>','<img width=193 src=".url('chat_photo')."/',chat_message,' /></a>') END 
                            AS chat_message
                            FROM lsp_chats a
                            WHERE 
                            (a.to_user_id='".$this->adminChatUserID."' AND a.from_user_id='".$from_user_id."') 
                            OR 
                            (a.to_user_id='".$from_user_id."' AND a.from_user_id='".$this->adminChatUserID."') 
                            ORDER BY a.created_at ASC");

        $dataArray=array('total'=>count($chat),'datas'=>$chat);
        return response()->json($dataArray);
    }

    public function saveConversation(Request $request)
    {
        $toUserID=$request->loaUID;
        $Chat = new Chat;
        $Chat->to_user_id = $toUserID;
        $Chat->from_user_id = '99999';
        $Chat->message_type = '0';
        $Chat->chat_message = $request->message;
        $Chat->status = '0';
        $Chat->save();

        $responseArray=array('status'=>1,'message'=>$request->message,'id'=>$Chat->id,'sendtime'=>date('H:i A',strtotime($Chat->created_at)));

        return response()->json($responseArray);
    }

    public function saveUserConvPhoto(Request $request)
    {

        $validator = Validator::make($request->all(),['file' => 'image',],
                                                     ['file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)']);
        if ($validator->fails())
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        $extension = $request->file('file')->getClientOriginalExtension();
        $dir = 'chat_photo/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $filesMoved=$request->file('file')->move($dir, $filename);
        if($filesMoved)
        {
            $Chat = new Chat;
            $Chat->to_user_id = '99999';
            $Chat->from_user_id = $this->sdc->UserID();
            $Chat->message_type = '1';
            $Chat->chat_message = $filename;
            $Chat->status = '0';
            $Chat->save();

            $messgePhoto="<a target='_blank' href='".url('chat_photo')."/".$filename."'><img src='".url('chat_photo')."/".$filename."' /></a>";

            $responseArray=array('status'=>1,'message'=>$messgePhoto,'id'=>$Chat->id,'sendtime'=>date('H:i A',strtotime($Chat->created_at)));
        }
        else
        {
            $responseArray=array('status'=>0,'id'=>0,'sendtime'=>'Send Failed');
        }

        return response()->json($responseArray);

        //return $filename;
    }

    public function saveMasterConvPhoto(Request $request)
    {

        $validator = Validator::make($request->all(),['file' => 'image',],
                                                     ['file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)']);
        if ($validator->fails())
            return array(
                'fail' => true,
                'errors' => $validator->errors()
            );
        $extension = $request->file('file')->getClientOriginalExtension();
        $dir = 'chat_photo/';
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $filesMoved=$request->file('file')->move($dir, $filename);
        if($filesMoved)
        {
            $userLOA=$request->userLOA;
            $Chat = new Chat;
            $Chat->to_user_id = $userLOA;
            $Chat->from_user_id = '99999';
            $Chat->message_type = '1';
            $Chat->chat_message = $filename;
            $Chat->status = '0';
            $Chat->save();

            $messgePhoto="<a target='_blank' href='".url('chat_photo')."/".$filename."'><img src='".url('chat_photo')."/".$filename."' /></a>";

            $responseArray=array('status'=>1,'message'=>$messgePhoto,'id'=>$Chat->id,'sendtime'=>date('H:i A',strtotime($Chat->created_at)));
        }
        else
        {
            $responseArray=array('status'=>0,'id'=>0,'sendtime'=>'Send Failed');
        }

        return response()->json($responseArray);

        //return $filename;
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
        //dd($request->$message);
        $Chat = new Chat;
        $Chat->to_user_id = '99999';
        $Chat->from_user_id = $this->sdc->UserID();
        $Chat->message_type = '0';
        $Chat->chat_message = $request->message;
        $Chat->status = '0';
        $Chat->save();

        $responseArray=array('status'=>1,'message'=>$request->message,'id'=>$Chat->id,'sendtime'=>date('H:i A',strtotime($Chat->created_at)));

        return response()->json($responseArray);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
