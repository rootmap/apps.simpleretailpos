<?php

namespace App\Http\Controllers;
use App\SquareConnect;
use App\SquareAccount;
use App\Pos;
use App\SessionInvoice;
use App\Invoice;
use App\Customer;
use App\Tender;
use App\InvoicePayment;
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\InvoiceProductController;

class SquareConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $InvoiceProductCntr;
    public function __construct(InvoiceProductController $invProduct)
    {
      $this->InvoiceProductCntr = $invProduct;
      $this->sdc = new StaticDataController();
    }

    public function init(){
        $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
        if ($squareAccount->module_status == 0) {
            echo "<h3 class='danger'>Failed, Please active your Square account from settings.</h3>";
            die();
        }
        return view('apps.pages.intregation.squareup.form',['squareAccount'=> $squareAccount]);
    }

    public function capturePayment(Request $request){

        $squareAccountCheck = SquareAccount::where('store_id', $this->sdc->storeID())->count();
        if ($squareAccountCheck == 0) {
            $array = array('status' => 0, 'msg' => 'Failed, Please Setup your square account.');
            return response()->json($array);
        }

        $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
        if ($squareAccount->module_status == 0) {
          $array = array('status' => 0, 'msg' => 'Failed, Please active your Square account from settings.');
          return response()->json($array);
        }

        $access_token = $squareAccount->access_token;
        $host_url = (env('USE_PROD') == 'true')  ?  "https://connect.squareup.com" :  "https://connect.squareupsandbox.com";
        $api_config = new \SquareConnect\Configuration();
        $api_config->setHost($host_url);
        $api_config->setAccessToken($access_token);
        $api_client = new \SquareConnect\ApiClient($api_config);

        if (!$request->isMethod('post')) {
          $array=array('status'=>0,'msg'=>'Invalid Request');
          return response()->json($array);
        }

        $nonce = $request->nonce;
        if (is_null($nonce)) {
            $array = array('status' => 0, 'msg' => 'Failed to validate card info. Please try different card.');
            return response()->json($array);
        }

        $card_amount = $request->card_amount;
        if (is_null($card_amount)) {
            $array = array('status' => 0, 'msg' => 'Invalid Invoice Amount, Please Try Again .');
            return response()->json($array);
        }

        $payments_api = new \SquareConnect\Api\PaymentsApi($api_client);

        $request_body = array(
          "source_id" => $nonce,
          "amount_money" => array(
            "amount" => 100 * $request->card_amount,
            "currency" => "USD"
          ),
          "idempotency_key" => uniqid()
        );

        try {
          $result = $payments_api->createPayment($request_body);

          $resultResponse=json_decode($result,true);
          
          if($resultResponse['payment']['status']== "COMPLETED"){
              $this->savePaymentLog($request, $resultResponse);
              //dd($resultResponse);
              $tender = Tender::where('squareup',1)->first();

              try {
                 // dd($tender);
                  $request->request->add(['paymentID' => $tender->id, 'paidAmount' => $request->card_amount]); //add request
                  $getPaidCart = $this->InvoiceProductCntr->getPaidCart($request);
                  $getPaidCartResponse = json_decode($getPaidCart->content(), true);
                  if ($getPaidCartResponse == 1) {
                    $array = array('status' => 1, 'msg' => 'Transaction / Payment Capture, Complete', 'data' => $resultResponse);
                    return response()->json($array);
                  } else {
                    $array = array('status' => 1, 'msg' => 'Transaction / Payment Capture, But failed to save record.', 'data' => $result);
                    return response()->json($array);
                  }
              } catch (\Exception $e) {

                    $array = array('status' => 0, 'msg' => 'Failed,  Card API Declined.', 'data' => $result);
                    return response()->json($array);

              }

              dd($request);

              
          }
          else {
            $array = array('status' => 0, 'msg' => 'Failed,  Card is Declined.', 'data' => $result);
            return response()->json($array);
          }

          dd($resultResponse);

          
        } catch (\SquareConnect\ApiException $e) {
            $error= $e->getResponseBody();
            $errorMsg= "Card API failed.";
            if(isset($error->errors[0]->detail))
            {
                $errorMsg = $error->errors[0]->detail;
            }

            $array = array('status' => 0, 'msg' => $errorMsg, 'data' => $e->getResponseBody(), 'data_2' => $e->getResponseHeaders());
            return response()->json($array);
          /* echo "Caught exception!<br/>";
          print_r("<strong>Response body:</strong><br/>");
          echo "<pre>";
          var_dump($e->getResponseBody());
          echo "</pre>";
          echo "<br/><strong>Response headers:</strong><br/>";
          echo "<pre>";
          var_dump($e->getResponseHeaders());
          echo "</pre>"; */
        }

    }

    private function savePaymentLog($request,$paymentArray){

      if(isset($request->card_invoice))
      {
          $invoice_id = $request->card_invoice;
      }
      else {
      $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
      $cart = new Pos($oldCart);
      if (empty($oldCart->invoiceID)) {
        $cart->genarateInvoiceID();
      }
      $invoice_id = $cart->invoiceID;
      }

      //dd($paymentArray);
      $payment_id= $paymentArray['payment']['id'];
      $payment_status= $paymentArray['payment']['status'];
      $order_id= $paymentArray['payment']['order_id'];
      $receipt_number= $paymentArray['payment']['receipt_number'];
      $receipt_url= $paymentArray['payment']['receipt_url'];
      $total_money= $paymentArray['payment']['total_money']['amount'];
      $card_brand= $paymentArray['payment']['card_details']['card']['card_brand'];
      $last_4= $paymentArray['payment']['card_details']['card']['last_4'];
      $exp_month= $paymentArray['payment']['card_details']['card']['exp_month'];
      $exp_year= $paymentArray['payment']['card_details']['card']['exp_year'];
      $responseJson= serialize(json_encode($paymentArray));

      $sq=new SquareConnect();
      $sq->invoice_id= $invoice_id;
      $sq->payment_id= $payment_id;
      $sq->status= $payment_status;
      $sq->order_id= $order_id;
      $sq->receipt_number= $receipt_number;
      $sq->receipt_url= $receipt_url;
      $sq->responseJson= $responseJson;
      $sq->card_number= $last_4;
      $sq->card_last_4= $last_4;
      $sq->card_brand= $card_brand;
      $sq->card_holder_name="";
      $sq->card_expire_month= $exp_month;
      $sq->card_expire_year= $exp_year;
      $sq->card_cvc="";
      $sq->amount= $total_money/100;
      $sq->store_id= $this->sdc->storeID();
      $sq->created_by=$this->sdc->UserID();
      $sq->save();
    }

    public function refund(Request $request){

        $squareConnectCount = SquareConnect::where('id',$request->rid)->where('store_id', $this->sdc->storeID())->count();
        if($squareConnectCount > 0){
            $squareConnect = SquareConnect::where('id', $request->rid)->where('store_id', $this->sdc->storeID())->first();
            
            $data=[
              'payment_id'=> $squareConnect->payment_id,
              'idempotency_key'=> uniqid(),
              'reason'=> 'Product Return, due to customer mistakenly choose the product.',
              'amount_money'=> $squareConnect->amount,
            ];

            $squareAccountCheck = SquareAccount::where('store_id', $this->sdc->storeID())->count();
            if ($squareAccountCheck == 0) {
              $array = array('status' => 0, 'msg' => 'Failed, Please Setup your square account.');
              return response()->json($array);
            }

            $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
            if ($squareAccount->module_status == 0) {
              $array = array('status' => 0, 'msg' => 'Failed, Please active your Square account from settings.');
              return response()->json($array);
            }

            $access_token = $squareAccount->access_token;
            $host_url = (env('USE_PROD') == 'true')  ?  "https://connect.squareup.com" :  "https://connect.squareupsandbox.com";
            
            $curl = curl_init();
            $amount_refund= $squareConnect->amount * 100;
            curl_setopt_array($curl, array(
              CURLOPT_URL => $host_url."/v2/refunds",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\r\n  \"idempotency_key\": \"".uniqid()."\",\r\n  \"payment_id\": \"".$squareConnect->payment_id."\",\r\n  \"amount_money\": {\r\n    \"amount\": ".$amount_refund.",\r\n    \"currency\": \"USD\"\r\n  }\r\n}",
              CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer ". $access_token,
                "Cache-Control: no-cache",
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
      
            $refund_response=json_decode($response,true);
            if(isset($refund_response['refund'])){
                $squareConnect->refund_status=1;  
                $squareConnect->save();  
                return response()->json(['status'=>1,'msg'=>'Refund Completed Successfully.']);
            }
            elseif(isset($refund_response['errors'])){
                return response()->json(['status'=>2,'msg'=>'Refund Failed, Please try again.','error'=> $refund_response]);
            }
            else {
                return response()->json(['status' => 0, 'msg' => 'Refund Failed, Please try again.']);
            }

            
            
        }
        else {
            return response()->json(['status' => 0, 'msg' => 'Refund Failed, Please try again.']);
        }
        
    }

    public function storeAccount(Request $request){
        $data=[];
        if($request->isMethod('post')){
            $module_status = $request->module_status ? 1 : 0;
            $squareAccountCheck = SquareAccount::where('store_id', $this->sdc->storeID())->count();
            if ($squareAccountCheck > 0) {
              $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
              $squareAccount->access_token = $request->access_token;
              $squareAccount->app_id = $request->app_id;
              $squareAccount->location_id = $request->location_id;
              $squareAccount->module_status = $module_status;
              $squareAccount->save();
              $data = ['edit' => $squareAccount];
            }
            else {
        
                $squareAccount = new SquareAccount();
                $squareAccount->access_token = $request->access_token;
                $squareAccount->app_id = $request->app_id;
                $squareAccount->location_id = $request->location_id;
                $squareAccount->module_status = $module_status;
                $squareAccount->created_by = $this->sdc->UserID();
                $squareAccount->store_id = $this->sdc->storeID();
                $squareAccount->save();
                $data = ['edit' => $squareAccount];
            }
        }
        else{
            $squareAccountCheck = SquareAccount::where('store_id', $this->sdc->storeID())->count();
            if($squareAccountCheck > 0){
                $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
                $data=['edit'=> $squareAccount];
            }
        }
        return view('apps.pages.intregation.squareup.squareAccount', $data);
    }

    public function squareMnaulPartialCardPayment(Request $request)
    {


        $squareAccountCheck = SquareAccount::where('store_id', $this->sdc->storeID())->count();
        if ($squareAccountCheck == 0) {
          $array = array('status' => 0, 'msg' => 'Failed, Please Setup your square account.');
          return response()->json($array);
        }

        $squareAccount = SquareAccount::where('store_id', $this->sdc->storeID())->first();
        if ($squareAccount->module_status == 0) {
          $array = array('status' => 0, 'msg' => 'Failed, Please active your Square account from settings.');
          return response()->json($array);
        }

        $access_token = $squareAccount->access_token;
        $host_url = (env('USE_PROD') == 'true')  ?  "https://connect.squareup.com" :  "https://connect.squareupsandbox.com";
        $api_config = new \SquareConnect\Configuration();
        $api_config->setHost($host_url);
        $api_config->setAccessToken($access_token);
        $api_client = new \SquareConnect\ApiClient($api_config);

        if (!$request->isMethod('post')) {
          $array = array('status' => 0, 'msg' => 'Invalid Request');
          return response()->json($array);
        }

        $nonce = $request->nonce;
        if (is_null($nonce)) {
          $array = array('status' => 0, 'msg' => 'Failed to validate card info. Please try different card.');
          return response()->json($array);
        }

        $card_amount = $request->card_amount;
        if (is_null($card_amount)) {
          $array = array('status' => 0, 'msg' => 'Invalid Invoice Amount, Please Try Again .');
          return response()->json($array);
        }




     

        $invoice_id = $request->card_invoice;
        $partial_today_paid = $card_amount;
        $refId = $invoice_id;

        $invoice = Invoice::where('invoice_id', $invoice_id)->first();
        $customerInfo = Customer::find($invoice->customer_id);
        $customerName = $customerInfo->name;
        $totalInvoicePayable = $partial_today_paid;
        if (empty($totalInvoicePayable)) {
            $array = array('status' => 0, 'msg' => 'Invalid Invoice Amount, Please Try Again .');
            return response()->json($array);
        }

        $payments_api = new \SquareConnect\Api\PaymentsApi($api_client);

        $request_body = array(
          "source_id" => $nonce,
          "amount_money" => array(
            "amount" => 100 * $totalInvoicePayable,
            "currency" => "USD"
          ),
          "idempotency_key" => uniqid()
        );

        try {
          $result = $payments_api->createPayment($request_body);

          $resultResponse = json_decode($result, true);

          if ($resultResponse['payment']['status'] == "COMPLETED") {
            $this->savePaymentLog($request, $resultResponse);
            $amountPaid = $totalInvoicePayable;
            $paid_amount = $amountPaid;
            //dd($amountPaid);

            $tenderData = Tender::where('squareup', 1)->first();
            $payment_method = $tenderData->id;

            $loadInvoices = Invoice::join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->select(
              'invoices.id',
              'invoices.invoice_id',
              'invoices.total_amount',
              'customers.name as customer_name',
              \DB::Raw("(SELECT SUM(lsp_invoice_payments.paid_amount) FROM lsp_invoice_payments WHERE lsp_invoice_payments.invoice_id=lsp_invoices.invoice_id) as paid_amount"),
              'invoices.created_at'
            )
            ->where('invoices.store_id', $this->sdc->storeID())
              ->where('invoices.invoice_id', $invoice_id)
              ->whereRaw("lsp_invoices.invoice_status!='Paid'")
              ->first();

            $invoice = Invoice::where('invoice_id', $invoice_id)->first();
            $cusInfo = Customer::find($invoice->customer_id);
            $load_total_amount = $loadInvoices->total_amount;
            $load_absPaid = $loadInvoices->paid_amount + $paid_amount;
            $load_due = $load_total_amount - $load_absPaid;
            if ($load_due > 0) {
              $load_invoice_status = "Partial";
            } elseif ($load_due <= 0) {
              $load_invoice_status = "Paid";
              $load_due = "0.00";
            } else {
              $load_invoice_status = "Partial";
            }


            $tender_name = $tenderData->name;
            $tender_id = $tenderData->id;

            $invoice->tender_id = $tender_id;
            $invoice->tender_name = $tender_name;
            $invoice->save();


            $invoicePay = new InvoicePayment;
            $invoicePay->invoice_id = $invoice_id;
            $invoicePay->customer_id = $invoice->customer_id;
            $invoicePay->customer_name = $cusInfo->name;
            $invoicePay->tender_id = $tenderData->id;
            $invoicePay->tender_name = $tenderData->name;
            $invoicePay->total_amount = $invoice->total_amount;
            $invoicePay->paid_amount = $amountPaid;
            $invoicePay->store_id = $this->sdc->storeID();
            $invoicePay->created_by = $this->sdc->UserID();
            $invoicePay->save();

            $invoice->invoice_status = $load_invoice_status;
            $invoice->save();



            $array = array('status' => 1, 'msg' => 'Partial Transaction / Payment Capture Complete', 'data' => $resultResponse);
            return response()->json($array);

          }else{
              $array = array('status' => 1, 'msg' => 'Failed, Please try again.', 'data' => $resultResponse);
              return response()->json($array);
          }


            dd($request);
        } catch (\SquareConnect\ApiException $e) {

            $error = $e->getResponseBody();
            $errorMsg = "Card API failed.";
            if (isset($error->errors[0]->detail)) {
              $errorMsg = $error->errors[0]->detail;
            }

            $array = array('status' => 0, 'msg' => $errorMsg, 'data' => $e->getResponseBody(), 'data_2' => $e->getResponseHeaders());
            return response()->json($array);

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
     * @param  \App\ $squareConnect
     * @return \Illuminate\Http\Response
     */
    private function methodToGetMembersCount($search = '')
    {

      $tab = SquareConnect::select('id')
        ->where('store_id', $this->sdc->storeID())
        ->orderBy('id', 'DESC')
        ->when($search, function ($query) use ($search) {
          $query->where('id', 'LIKE', '%' . $search . '%');
          $query->orWhere('invoice_id', 'LIKE', '%' . $search . '%');
          $query->orWhere('created_at', 'LIKE', '%' . $search . '%');
          $query->orWhere('card_last_4', 'LIKE', '%' . $search . '%');
          $query->orWhere('card_brand', 'LIKE', '%' . $search . '%');
          $query->orWhere('payment_id', 'LIKE', '%' . $search . '%');
          return $query;
        })
        ->count();
      return $tab;
    }

    private function methodToGetMembers($start, $length, $search = '')
    {

      $tab = SquareConnect::select('id', 'invoice_id', 'created_at','card_last_4 as card_number', \DB::Raw('(HOUR(TIMEDIFF(NOW(),created_at))) AS hour_gone'), 'card_brand as CardType', 'payment_id as transactionID', 'amount as paid_amount', 'refund_status')
        ->where('store_id', $this->sdc->storeID())
        ->orderBy('id', 'DESC')
        ->when($search, function ($query) use ($search) {
          $query->where('id', 'LIKE', '%' . $search . '%');
          $query->orWhere('invoice_id', 'LIKE', '%' . $search . '%');
          $query->orWhere('created_at', 'LIKE', '%' . $search . '%');
          $query->orWhere('card_last_4', 'LIKE', '%' . $search . '%');
          $query->orWhere('card_brand', 'LIKE', '%' . $search . '%');
          $query->orWhere('payment_id', 'LIKE', '%' . $search . '%');
          return $query;
        })
        ->skip($start)->take($length)->get();
      return $tab;
    }


    public function datajson(Request $request)
    {

      $draw = $request->get('draw');
      $start = $request->get('start');
      $length = $request->get('length');
      $search = $request->get('search');

      $search = (isset($search['value'])) ? $search['value'] : '';

      $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
      $members = $this->methodToGetMembers($start, $length, $search); //supply start and length of the table data

      $data = array(
        'draw' => $draw,
        'recordsTotal' => $total_members,
        'recordsFiltered' => $total_members,
        'data' => $members,
      );

      echo json_encode($data);
    }

    public function show(request $request){
      $invoice_id = '';
      if (isset($request->invoice_id)) {
        $invoice_id = $request->invoice_id;
      }
      // $customer_id='';
      // if(isset($request->customer_id))
      // {
      //     $customer_id=$request->customer_id;
      // }
      // dd($invoice_id);
      $start_date = '';
      if (isset($request->start_date)) {
        $start_date = $request->start_date;
      }

      $end_date = '';
      if (isset($request->end_date)) {
        $end_date = $request->end_date;
      }

      if (empty($start_date) && !empty($end_date)) {
        $start_date = $end_date;
      }

      if (!empty($start_date) && empty($end_date)) {
        $end_date = $start_date;
      }

      $card_number = '';
      if (isset($request->card_number)) {
        $card_number = $request->card_number;
      }
      // dd($card_number);
      $dateString = '';
      if (!empty($start_date) && !empty($end_date)) {
        $dateString = "CAST(created_at as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
      }
      
      if (empty($invoice_id) && empty($start_date) && empty($end_date) && empty($card_number) && empty($dateString)) {
          $tab = SquareConnect::select('id', 'invoice_id', 'created_at', 'card_last_4 as card_number', \DB::Raw('(HOUR(TIMEDIFF(NOW(),created_at))) AS hour_gone'), 'card_brand as CardType', 'payment_id as transactionID', 'amount as paid_amount', 'refund_status')
            ->where('store_id', $this->sdc->storeID())
            ->orderBy("id", "DESC")
            ->get();
      } else {
        $tab = SquareConnect::select('id', 'invoice_id', 'created_at', 'card_last_4 as card_number', \DB::Raw('(HOUR(TIMEDIFF(NOW(),created_at))) AS hour_gone'), 'card_brand as CardType', 'payment_id as transactionID', 'amount as paid_amount', 'refund_status')
          ->where('store_id', $this->sdc->storeID())
          ->when($invoice_id, function ($query) use ($invoice_id) {
            return $query->where('invoice_id', '=', $invoice_id);
          })
          // ->when($card_number, function ($query) use ($card_number) {
          //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
          // })
          ->when($card_number, function ($query) use ($card_number) {
            return $query->where('card_last_4', '=', $card_number);
          })
          ->when($dateString, function ($query) use ($dateString) {
            return $query->whereRaw($dateString);
          })
          ->orderBy("id", "DESC")
          ->get();
      }





      // dd($tab);                 
      return view(
        'apps.pages.intregation.squareup.report',
        [
          'dataTable' => $tab,
          'invoice_id' => $invoice_id,
          'start_date' => $start_date,
          'card_number' => $card_number,
          'end_date' => $end_date
        ]
      );
    }

    public function AuthReport(Request $request){

      $invoice_id = '';
      if (isset($request->invoice_id)) {
        $invoice_id = $request->invoice_id;
      }
      // $customer_id='';
      // if(isset($request->customer_id))
      // {
      //     $customer_id=$request->customer_id;
      // }
      // dd($invoice_id);
      $start_date = '';
      if (isset($request->start_date)) {
        $start_date = $request->start_date;
      }

      $end_date = '';
      if (isset($request->end_date)) {
        $end_date = $request->end_date;
      }

      if (empty($start_date) && !empty($end_date)) {
        $start_date = $end_date;
      }

      if (!empty($start_date) && empty($end_date)) {
        $end_date = $start_date;
      }

      $card_number = '';
      if (isset($request->card_number)) {
        $card_number = $request->card_number;
      }
      // dd($card_number);
      $dateString = '';
      if (!empty($start_date) && !empty($end_date)) {
        $dateString = "CAST(created_at as date) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
      }
      
      $tab = SquareConnect::where('store_id', $this->sdc->storeID())
        ->when($invoice_id, function ($query) use ($invoice_id) {
          return $query->where('invoice_id', '=', $invoice_id);
        })
        // ->when($card_number, function ($query) use ($card_number) {
        //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
        // })
        ->when($card_number, function ($query) use ($card_number) {
          return $query->where('card_last_4', '=', $card_number);
        })
        ->when($dateString, function ($query) use ($dateString) {
          return $query->whereRaw($dateString);
        })
        ->orderBy("id", "DESC")
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

    public function ExcelReport(Request $request){
      // dd($request);
      //excel 
      $data = array();
      $array_column = array('Invoice ID', 'Card Number', 'Card Type', 'Transaction ID', 'Paid Amount', 'Date', 'Status');
      array_push($data, $array_column);
      $inv = $this->AuthReport($request);
      $total_amount=0;
      foreach ($inv as $voi) :
        $inv_arry = array(
          $voi->invoice_id,
          $voi->card_last_4,
          $voi->card_brand,
          $voi->payment_id,
          number_format($voi->amount,2),
          formatDateTime($voi->created_at),
          $voi->refund_status==0 ? 'Payment Captured' : 'Refunded'
        );
        array_push($data, $inv_arry);
        $total_amount += $voi->amount;
      endforeach;
      $array_column = array('', '', '', 'Total = ', number_format($total_amount,2), '', '');
      array_push($data, $array_column);

      $reportName = "Square - Card Payment History Report";
      $report_title = "Square - Card Payment History Report";
      $report_description = "Report Genarated : " . date('d-M-Y H:i:s a');
      /*$data = array(
                  array('data1', 'data2'),
                  array('data3', 'data4')
              );*/

      //array_unshift($data,$array_column);

      // dd($data);

      $excelArray = array(
        'report_name' => $reportName,
        'report_title' => $report_title,
        'report_description' => $report_description,
        'data' => $data
      );

      $this->sdc->ExcelLayout($excelArray);
    }


    public function PdfReport(Request $request)
    {

      $data = array();
      $reportName = "Square - Card Payment History Report";
      $report_title = "Square - Card Payment History Report";
      $report_description = "Report Genarated : " . formatDateTime(date('d-M-Y H:i:s a'));

      $html = '<table class="table table-bordered" style="width:100%;">
                      <thead>
                      <tr>
                      <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                      <th class="text-center" style="font-size:12px;" >Card Number</th>
                      <th class="text-center" style="font-size:12px;" >Card Type</th>
                      <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                      <th class="text-center" style="font-size:12px;" >Date</th>
                      <th class="text-center" style="font-size:12px;" >Status</th>
                      </tr>
                      </thead>
                      <tbody>';



      $inv = $this->AuthReport($request);
      $total_amount = 0;
      foreach ($inv as $index => $voi) :
        $refund_status= $voi->refund_status == 0 ? 'Payment Captured' : 'Refunded';
        $html .= '<tr>
                              <td>' . $voi->invoice_id . '</td>
                              <td>' . $voi->card_last_4 . '</td>
                              <td>' . $voi->card_brand . '</td>
                              <td align="center">' . number_format($voi->amount,2) . '</td>
                              <td>' . formatDateTime($voi->created_at) . '</td>
                              <td>' . $refund_status . '</td>
                              </tr>';

      $total_amount += $voi->amount;

      endforeach;

      $html .= '</tbody>';

      $html .= '<tfoot>
                      <tr>
                      <th class="text-center" style="font-size:12px;" ></th>
                      <th class="text-center" style="font-size:12px;" ></th>
                      <th class="text-center" style="font-size:12px;" >Total = </th>
                      <th class="text-center" style="font-size:12px;" >' . number_format($total_amount,2) . '</th>
                      <th class="text-center" style="font-size:12px;" ></th>
                      <th class="text-center" style="font-size:12px;" ></th>
                      </tr>
                      </tfoot>';

      $html .= '</table>';

      //echo $html; die();



      $this->sdc->PDFLayout($reportName, $html);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ $squareConnect
     * @return \Illuminate\Http\Response
     */
    public function edit($squareConnect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ $squareConnect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $squareConnect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ $squareConnect
     * @return \Illuminate\Http\Response
     */
    public function destroy($squareConnect)
    {
        //
    }
}
