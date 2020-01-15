<?php

namespace App\Http\Controllers;

use App\CardpointeStoreSetting;
use App\CardPointee;
use Session;
use DB;
use App\Pos;
use Illuminate\Http\Request;
class CardPointeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="CardPointe ";
    private $sdc;
    public function __construct(){ 
        $this->sdc = new StaticDataController(); 
    }

    
    public function boltPing(Request $request){

            $storeMerchantSetBoltCheck=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->count();
            if($storeMerchantSetBoltCheck>0){


                    $storeBolt=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->first();

                    $merchantId=$storeBolt->merchant_id;
                    $hsn=$storeBolt->hsn;
                    $Authorization=$storeBolt->authkey;

                    //echo $merchantId; die();
                    //return response()->json(['connected'=>true]);
                    //die();

                    if(!empty($merchantId) && !empty($hsn) && !empty($Authorization)){



                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "https://bolt.cardpointe.com/api/v1/ping",
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "POST",
                              CURLOPT_POSTFIELDS =>"{\r\n    \"merchantId\": \"$merchantId\",\r\n    \"hsn\": \"$hsn\"\r\n}",
                              CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/json",
                                "Authorization: ".$Authorization
                              ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            
                            return response()->json(json_decode($response,true));
                            


                            
                            //return response()->json(['connected'=>true]);
                    }
                    else
                    {
                        return response()->json(['connected'=>false]);
                    }

            }
            else
            {
                return response()->json(['connected'=>false]);
            }
    }

    public function boltGenarateNewToken(Request $request){
            $storeMerchantSetBoltCheck=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->count();
            if($storeMerchantSetBoltCheck>0){


                    $storeBolt=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->first();

                    $merchantId=$storeBolt->merchant_id;
                    $hsn=$storeBolt->hsn;
                    $Authorization=$storeBolt->authkey;

                    //echo $merchantId; die();


                    if(!empty($merchantId) && !empty($hsn) && !empty($Authorization)){

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                  CURLOPT_URL => "https://bolt.cardpointe.com/api/v2/connect",
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_VERBOSE => 1,
                                  CURLOPT_HEADER => 1,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => "POST",
                                  CURLOPT_POSTFIELDS =>"{\r\n\"merchantId\": \"$merchantId\",\r\n\"hsn\": \"$hsn\",\r\n\"force\": \"true\"\r\n}",
                                  CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/json",
                                    "Authorization: ".$Authorization
                                  ),
                                ));

                                $response = curl_exec($curl);

                                $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
                                $header = substr($response, 0, $header_size);
                                $body = substr($response, $header_size);

                                curl_close($curl);

                                //echo $response; die();

                                if(empty($response))
                                {
                                    $retArray=array('connected'=>false);
                                    return response()->json($retArray);
                                }else{
                                    $data = explode("\r\n", $header, 2);
                                    $dataExPull = explode("\r\n", $data[1]);
                                    $dataToken = explode(":",$dataExPull[6]);
                                    $CardConnectdataToken =substr(trim($dataToken[1]),0,32);
                                    $retArray=array('connected'=>true,'token'=>$CardConnectdataToken);
                                    return response()->json($retArray);
                                }
                    }
                    else
                    {
                        return response()->json(['connected'=>false]);
                    }

            }
            else
            {
                return response()->json(['connected'=>false]);
            }
    }

    public function boltCaptureCard(Request $request){
            ini_set('max_execution_time', '300');
            $storeMerchantSetBoltCheck=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->count();
            if($storeMerchantSetBoltCheck>0){


                    $storeBolt=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->where('bolt_status',1)->first();

                    $merchantId=$storeBolt->merchant_id;
                    $hsn=$storeBolt->hsn;
                    $Authorization=$storeBolt->authkey;

                    //echo $merchantId; die();

                    $dayDate=date('Y-m-d', strtotime('+1 day')); 
                    $dayDateTime=date('H:i:s'); 

                    $dayString=$dayDate."T".$dayDateTime."Z";

                    //die();

                    //echo rand(); die();
                    //echo md5(time()); die();

                    if(!empty($merchantId) && !empty($hsn) && !empty($Authorization)){


                            $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
                            $cart = new Pos($oldCart);
                            if(empty($oldCart->invoiceID))
                            {
                                $cart->genarateInvoiceID();
                            }


                            $invoiceID=$cart->invoiceID;
                            $amountToPay=$request->amountToPay*100;

                            //dd($amountToPay);

                            $cardsession=$request->cardsession;

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                  CURLOPT_URL => "https://bolt.cardpointe.com/api/v3/authCard",
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => "POST",
                                  CURLOPT_POSTFIELDS =>"{\r\n\"merchantId\" : \"$merchantId\",\r\n\"hsn\" : \"$hsn\",\r\n\"amount\" : \"$amountToPay\",\r\n\"includeSignature\" : \"false\",\r\n\"includeAmountDisplay\" : \"true\",\r\n\"beep\" : \"true\",\r\n\"aid\" : \"credit\",\r\n\"includeAVS\" : \"true\",\r\n\"capture\" : \"true\",\r\n\"orderId\" : \"$invoiceID\",\r\n\"clearDisplayDelay\" : \"500\"\r\n}",
                                  CURLOPT_HTTPHEADER => array(
                                    "Content-Type: application/json",
                                    "Authorization: ".$Authorization,
                                    "X-CardConnect-SessionKey: ".$cardsession
                                  ),
                                ));




                                $response = curl_exec($curl);

                                curl_close($curl);

                                $gCAT=json_decode($response,true);
                                //dd($gCAT);
                               //s echo "<pre>";
                               // print_r($gCAT); die();
                                if(isset($gCAT['errorCode'])){
                                    return response()->json(['status'=>0,'message'=>$gCAT['errorMessage'],'datares'=>$gCAT]);
                                }
                                else
                                {
                                    if($gCAT['resptext']=="Approval" && $gCAT['respstat']=="A"){
             //dd($gCAT);
                                        //dd($gCAT);
                                        $tab=new CardPointee;
                                        $tab->invoice_id=$invoiceID;
                                        $tab->responseJson=json_encode($gCAT);
                                        $tab->card_number="bolt";
                                        $tab->card_holder_name="bolt";
                                        $tab->card_expire_month="bolt";
                                        $tab->card_expire_year="bolt";
                                        $tab->card_cvc="bolt";
                                        $tab->amount=$request->amountToPay;
                                        $tab->authCode=$gCAT['authcode'];
                                        $tab->token=$gCAT['token'];
                                        $tab->account="";
                                        $tab->retref=$gCAT['retref'];
                                        $tab->resptext=$gCAT['resptext'];
                                        $tab->respstat=$gCAT['respstat'];
                                        $tab->commcard="";
                                        $tab->respcode=$gCAT['respcode'];
                                        $tab->refund_status=0;
                                        $tab->store_id=$this->sdc->storeID();
                                        $tab->created_by=$this->sdc->UserID();
                                        $tab->save();

                                        return response()->json(['status'=>1,'message'=>$gCAT['resptext'],'datares'=>$gCAT]);

                                        //dd($gCAT);
                                    }
                                    else
                                    {
                                         return response()->json(['status'=>0,'message'=>$gCAT['resptext'],'datares'=>$gCAT]);
                                       // dd($gCAT->resptext);
                                    }
                                }


                                

                                //echo $response;

                    }
                    else
                    {
                        return response()->json(['status'=>0,'message'=>"Invalid Bolt Info"]);
                    }




            }
            else
            {
                return response()->json(['status'=>0,'message'=>"Missing Bolt Info"]);
            }
    }




    public function cardpointePayment(Request $request){

        $cart = Session::has('Pos') ? Session::get('Pos') : null;
        $invoice_id=$cart->invoiceID;
        $refId=$invoice_id;
        $cardNumber=trim(str_replace(" ","",$request->cardNumber)); 
        $cardMonth=trim($request->cardMonth);
        $cardYear=trim($request->cardYear);

        $yy="";
        if(strlen($cardYear)==4){
            $yy=substr($cardYear,2);
        }

        $expireDate=$cardMonth."".$yy;


        $posData=serialize(json_encode($cart));


        if(!$expireDate)
        {
           return response()->json(['status'=>0,'message'=>'Card Expire date invalid.']);
        }

        if(empty($request->amountToPay))
        {
            return response()->json(['status'=>0,'message'=>'Pay amount should not be empty.']);
        }

        $gCAT=$this->makePayment($cardNumber,$request->amountToPay,$expireDate,$cart->invoiceID,$request);
        


        if(isset($gCAT->datares))
        {
            return response()->json(['status'=>0,'message'=>$gCAT->resptext,'datares'=>$gCAT]);
        }

        //dd($gCAT); die();
     
        if(isset($gCAT['respstat']))
        {
            if($gCAT['resptext']=="Approval" && $gCAT['respstat']=="A"){
             //dd($gCAT);

                $tab=new CardPointee;
                $tab->invoice_id=$refId;
                $tab->responseJson=json_encode($gCAT);
                $tab->card_number=$cardNumber;
                $tab->card_holder_name=$request->cardHName;
                $tab->card_expire_month=$request->cardMonth;
                $tab->card_expire_year=$request->cardYear;
                $tab->card_cvc=$request->cardcvc;
                $tab->amount=$request->amountToPay;
                $tab->authCode=$gCAT['authcode'];
                $tab->token=$gCAT['token'];
                $tab->account=$gCAT['account'];
                $tab->retref=$gCAT['retref'];
                $tab->resptext=$gCAT['resptext'];
                $tab->respstat=$gCAT['respstat'];
                $tab->commcard="";
                $tab->respcode=$gCAT['respcode'];
                $tab->refund_status=0;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();

                return response()->json(['status'=>1,'message'=>$gCAT['resptext'],'datares'=>$gCAT]);

                //dd($gCAT);
            }
            else
            {
                 return response()->json(['status'=>0,'message'=>$gCAT['resptext'],'datares'=>$gCAT]);
               // dd($gCAT->resptext);
            }
        }
        else
        {
            return response()->json(['status'=>0,'message'=>$gCAT['resptext'],'datares'=>$gCAT]);
               // dd($gCAT->resptext);
        }

        

    }

    private function makeRefund($auth_retref=''){

        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){

            $merchant_id = '496160873888';
            $user        = 'testing';
            $pass        = 'testing123';
            $server      = 'https://fts.cardconnect.com:6443';

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $pass        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com:6443';

            //dd($storeMerchantSet);
        }

        
        $client = new CardPointe($merchant_id, $user, $pass, $server);


        $boolean = $client->testAuth();

        if($boolean==true){
            $obj=$this->reFundTrans($client,$auth_retref);
            return $obj;
                        
        }
        else
        {
            return (object)array('status'=>0,'message'=>'Invalid credentials.');
                die();
        }

        //dd($boolean);
    }

    private function makePayment($cardNum='',$amount='',$expiry='',$invoice_id=0,$request){

        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){

            return (object)array('status'=>0,'message'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $authkey        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com/cardconnect/rest/auth';


            $amountReady=number_format($amount,2);

            $cardHName=$request->cardHName;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"account\": \"$cardNum\",\n    \"expiry\": \"$expiry\",\n    \"amount\": \"$amountReady\",\n    \"orderid\": \"$invoice_id\",\n    \"currency\": \"USD\",\n    \"name\": \"$cardHName\",\n    \"capture\": \"y\",\n    \"receipt\": \"y\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;

            $gCAT=json_decode($response,true);
            //dd($gCAT);
            if($gCAT['resptext']=="Approval" && $gCAT['respstat']=="A"){

                    return $gCAT;

            }
            else{

                //dd($gAT);
                return (object)array('status'=>0,'message'=>$gCAT['resptext'],'resptext'=>$gCAT['resptext'],'datares'=>$gCAT);
                die();
                //return $gAT;
            }

            //dd($storeMerchantSet);
        }

      
    }

    

    private function captureAuthTrans($client,$auth_retref=""){
        $params = []; // optional
        $capture_response = $client->capture($auth_retref, $params);
        return $capture_response;
    }

    private function VoidTrans($client,$auth_retref=""){
        $params=[];
        $capture_response = $client->void($auth_retref, $params);
        return $capture_response;
    }

    private function inQueryTrans($client,$auth_retref=""){
        $capture_response = $client->inquire($auth_retref);

        return $capture_response;
    }

    private function reFundTrans($client,$auth_retref=""){
        $params = []; // optional
        $void_response = $client->refund(array('retref'=>$auth_retref));

        return $void_response;
    }

    /*  Store Settings Start */

    public function cardPointeSettings()
    {
        $countData=\DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->count();
        if($countData>0)
        {
           $edit=\DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->first();
           return view('apps.pages.settings.cardPointeSettings',compact('edit'));
        }
        else
        {
            return view('apps.pages.settings.cardPointeSettings');
        }
    }

    public function cardPointeSettingsSave(Request $request)
    {
        $module_status=$request->module_status?1:0;
        \DB::table('cardpointe_store_settings')->insert(
            [
                'merchant_id'=>$request->merchant_id,
                'username'=>$request->username,
                'password'=>$request->password,
                'module_status'=>$module_status,
                'store_id'=>$this->sdc->storeID()
            ]);

        return redirect(url('cardpointe/account/setting'))->with('status', $this->moduleName.' Added Successfully !');;
    }

    public function cardPointeSettingsUpdate(Request $request)
    {
        $module_status=$request->module_status?1:0;
        $bolt_status=$request->bolt_status?1:0;
        \DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->update(
            [
                'merchant_id'=>$request->merchant_id,
                'username'=>$request->username,
                'password'=>$request->password,
                'hsn'=>$request->hsn,
                'authkey'=>$request->authkey,
                'module_status'=>$module_status,
                'bolt_status'=>$bolt_status
            ]);

        return redirect(url('cardpointe/account/setting'))->with('status', $this->moduleName.' Modified Successfully !');;
    }

    /*  Store Settings End */

    private function methodToGetMembersCount($search=''){

        $tab=CardPointee::select('id')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere(\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'LIKE','%'.$search.'%');
                        $query->orWhere('retref','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=CardPointee::select('id','invoice_id','created_at',\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'amount','retref','refund_status')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere(\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'LIKE','%'.$search.'%');
                        $query->orWhere('retref','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datajson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function refund(Request $request)
    {
        $id=$request->rid;
        if(!empty($request->rid))
        {
            $refId='ref' .time();
            $aNpH=CardPointee::find($id);
            //die($aNpH);
            $retData=$this->makeRefund($aNpH->retref);
            //dd($retData);

            $statusReturn=0;
            if($retData->resptext=="Approval" && $retData->respstat=="A")
            {
                $aNpH->refund_status=1;
                $statusReturn=1;
            }
            else
            {
                $aNpH->refund_status=0;
            }
            $aNpH->save();
            //return $statusReturn;

            return response()->json(['status'=>$statusReturn,'res'=>$retData]);
        }
        else
        {
            return 0;
        }
        
           
    }

    public function index()
    {
        $tab=CardPointee::select('id','invoice_id','created_at',\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'amount','retref','refund_status')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->limit(100)
                     ->get();
        return view('apps.pages.report.card-payment-history-cardpointe',['dataTable'=>$tab]);
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
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function show(CardPointee $cardPointee, request $request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
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

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =CardPointee::select(\DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($dateString);
        $tab=CardPointee::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("id","DESC")
                     ->get();
         // dd($tab);                 
        return view('apps.pages.report.card-payment-history-cardpointe',
            [
                'dataTable'=>$tab,
                'invoice_id'=>$invoice_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'card_number'=>$card_number
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */

    public function AuthReport(Request $request)
        {

            $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
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

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =CardPointee::select(DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($code);
        $tab=CardPointee::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("id","DESC")
                     ->get();

          // dd($tab);
            return $tab;
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\ProductStockin  $productStockin
         * @return \Illuminate\Http\Response
         */
        
        public function ExcelReport(Request $request) 
        {
            // dd($request);
            //excel 
            $data=array();
            $array_column=array('Invoice ID','Card Number','Transaction ID','Paid Amount','Date');
            array_push($data, $array_column);
            $inv=$this->AuthReport($request);
            foreach($inv as $voi):
                $inv_arry=array(
                    $voi->invoice_id,
                    "************".substr($voi->card_number,-4),
                    $voi->retref,
                    $voi->amount,
                    date('Y-m-d',strtotime($voi->created_at))
                );
                array_push($data, $inv_arry);
            endforeach;

            $reportName="CardPointe Payment History Report";
            $report_title="CardPointe Payment History Report";
            $report_description="Report Genarated : ".date('d-M-Y H:i:s a');
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
            
           
            $reportName="CardPointe Payment History Report";
            $report_title="CardPointe Payment History Report";
            $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

            $html='<table class="table table-bordered" style="width:100%;">
                    <thead>
                    <tr>
                    <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                    <th class="text-center" style="font-size:12px;" >Card Number</th>
                    <th class="text-center" style="font-size:12px;" >Transaction ID</th>
                    <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                    <th class="text-center" style="font-size:12px;" >Date</th>
                    </tr>
                    </thead>
                    <tbody>';



                        $inv=$this->AuthReport($request);
                        foreach($inv as $index=>$voi):
        
                            $html .='<tr>
                            <td>'.$voi->invoice_id.'</td>
                            <td>************'.(substr($voi->card_number,-4)).'</td>
                            <td>'.$voi->retref.'</td>
                            <td align="center">'.$voi->amount.'</td>
                            <td>'.date('Y-m-d',strtotime($voi->created_at)).'</td>
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function edit(CardPointe $cardPointe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardPointe $cardPointe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardPointe $cardPointe)
    {
        //
    }
}
