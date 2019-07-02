<?php

namespace App\Http\Controllers;

use App\CardInfo;
use Illuminate\Http\Request;

class CardInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $moduleName="CardInfo";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        return view('apps.pages.card.card');
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
           
           'number'=>'required',
           'name'=>'required',
           'expiry'=>'required',
           'pin_cvc'=>'required'


        ]);

        $cardInfoData=new CardInfo;
        $cardInfoData->card_info=$request->cardinfo;
        $cardInfoData->card_number=$request->number;
        $cardInfoData->card_name=$request->name;
        $cardInfoData->expriy_date=$request->expiry;
        $cardInfoData->pin_number=$request->pin_cvc;
        $cardInfoData->store_id=$this->sdc->storeID();
        $cardInfoData->created_by=$this->sdc->UserID();
        $cardInfoData->save();

       return redirect('card')->with('status','Saved Successfully');
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */

  

    public function show(CardInfo $cardInfo)
    {
        $cardInfoData=CardInfo::where('store_id',$this->sdc->storeID())->orderBy('id','DESC')->get();
       return view('apps.pages.card.list',['dataTable'=>$cardInfoData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(CardInfo $cardInfo,$id)
    {
        $cardInfoData=CardInfo::find($id);
        return view('apps.pages.card.card',['dataRow'=>$cardInfoData]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardInfo $cardInfo,$id)
    {
        $this->validate($request,[
           
           'number'=>'required',
           'name'=>'required',
           'expiry'=>'required',
           'pin_cvc'=>'required'


        ]);

        $cardInfoData=CardInfo::find($id);
        $cardInfoData->card_info=$request->cardinfo;
        $cardInfoData->card_number=$request->number;
        $cardInfoData->card_name=$request->name;
        $cardInfoData->expriy_date=$request->expiry;
        $cardInfoData->pin_number=$request->pin_cvc;
        $cardInfoData->store_id=$this->sdc->storeID();
        $cardInfoData->created_by=$this->sdc->UserID();
        $cardInfoData->save();

       return redirect('card')->with('status','Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardInfo  $cardInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $cardInfoData=CardInfo::find($id);
         $cardInfoData->delete();
         return redirect('card/list')->with('status','Deleted Successfully');

         
    }
}
