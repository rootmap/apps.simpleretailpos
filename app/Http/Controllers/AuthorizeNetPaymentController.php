<?php

namespace App\Http\Controllers;

use App\AuthorizeNetPayment;
use App\Invoice;
use Illuminate\Http\Request;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", public_path("phplog"));

class AuthorizeNetPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Authorize.net Payment";
    private $sdc;
    public function __construct()
    { 
        $this->sdc = new StaticDataController();  

    }




    private $amount=10;
    //private $amount=10;
    //private $amount=10;
    //private $amount=10;
   // private $amount=10;

    public function index()
    {
        $refId = 123456;
        $transaction_id='BB0BE5CFD0F36F5D210F109213735B82';
        echo $this->AuthorizenetCardPayment();
    }

    public function setUserDynamicKey()
    {
        $chk=AuthorizeNetPayment::where('store_id',$this->sdc->storeID())->count();
        if($chk==0)
        {
            $tab=new AuthorizeNetPayment;
            $tab->api_login_id='APIID';
            $tab->transaction_key='testKey';
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }

        $data=AuthorizeNetPayment::where('store_id',$this->sdc->storeID())->first();

        return view('apps.pages.settings.authorizeNet-Settings',['edit'=>$data]);

    }

    public function UpdateUserDynamicKey(Request $request)
    {
        $tab=AuthorizeNetPayment::where('store_id',$this->sdc->storeID())->first();
        $active_module_for_email_invoice=$request->active_module_for_email_invoice?1:0;
        $tab->api_login_id=$request->api_login_id;
        $tab->transaction_key=$request->transaction_key;
        $tab->active_module_for_email_invoice=$active_module_for_email_invoice;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        return redirect('authorize/net/payment/setting')->with('status','Updated Successfully');

    }
    
    private function authorizeAccess($invoice_id=0)
    {
        if(empty($invoice_id))
        {
            $config=AuthorizeNetPayment::where('store_id',$this->sdc->storeID())->first();
        }
        else
        {
            $invoiceData=Invoice::where('invoice_id',$invoice_id)->first();
            $config=AuthorizeNetPayment::where('store_id',$invoiceData->store_id)->first();    
        }
        
        //dd($config);
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($config->api_login_id);
        $merchantAuthentication->setTransactionKey($config->transaction_key);
        return $merchantAuthentication;
    }

    public function refundTransaction($transactionID='',$cardNumber='',$expireDate='',$amount=0,$refTransId='')
    {
        /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
        $merchantAuthentication = $this->authorizeAccess();
        
        //dd($merchantAuthentication);
        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($expireDate);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //create a transaction
        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType("refundTransaction"); 
        $transactionRequest->setAmount($amount);
        $transactionRequest->setPayment($paymentOne);
        $transactionRequest->setRefTransId($transactionID);
        //$transactionRequest->setRefTransId("61636862839");
     

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequest);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
 
        if ($response != null) 
        {

            $tresponse = $response->getTransactionResponse();
            //dd($tresponse);
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }  
        else
        {
            return 0;
        }

    }

    public function voidTransactions($refId='',$refTransId='')
    {

        $merchantAuthentication = $this->authorizeAccess();

        $refId = 'ref' . time();
        //create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType( "voidTransaction"); 
        $transactionRequestType->setRefTransId($refTransId);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
          $request->setRefId($refId);
        $request->setTransactionRequest( $transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        
        if ($response != null) 
        {

            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }  
        else
        {
            return 0;
        }

    }

    public function captureCardPayment($refId=0,$cardNumber=0,$expireDate='',$amount=0,$invoice_id=0)
    {
       
         $merchantAuthentication = $this->authorizeAccess($invoice_id);
        // Create the payment data for a credit card
          $creditCard = new AnetAPI\CreditCardType();
          $creditCard->setCardNumber($cardNumber);  
          $creditCard->setExpirationDate($expireDate);
          $paymentOne = new AnetAPI\PaymentType();
          $paymentOne->setCreditCard($creditCard);

        // Create a transaction
          $transactionRequestType = new AnetAPI\TransactionRequestType();
          $transactionRequestType->setTransactionType("authCaptureTransaction");   
          $transactionRequestType->setAmount($amount);
          $transactionRequestType->setPayment($paymentOne);
          $request = new AnetAPI\CreateTransactionRequest();
          $request->setMerchantAuthentication($merchantAuthentication);
          $request->setRefId( $refId);
          $request->setTransactionRequest($transactionRequestType);
          $controller = new AnetController\CreateTransactionController($request);
          $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); //SANDBOX

          //print_r($response); die();

          if ($response != null) 
          {
                $tresponse = $response->getTransactionResponse();
                //dd($tresponse);
                if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
                {
                    //print_r($tresponse); die();
                    $authCode=$tresponse->getAuthCode();
                    $transactionID=$tresponse->getTransId();
                    $CardType=$tresponse->getAccountType();
                    $transactionHash=$tresponse->getTransHash();
                    $refTransID=$tresponse->getRefTransID();
                    $messageArray=$tresponse->getMessages();
                    $message=$messageArray[0]->getDescription();


                    $arrayReturn=[
                        'status'=>1,
                        'authCode'=>$authCode,
                        'transactionID'=>$transactionID,
                        'CardType'=>$CardType,
                        'transactionHash'=>$transactionHash,
                        'refTransID'=>$refTransID,
                        'message'=>$message
                    ];

                }
                else
                {
                    $arrayReturn=[
                        'status'=>2,
                        'actsms'=>$response,
                        'message'=>'Invalid Card / Insufficient Amount.'
                    ];
                }
          }  
          else
          {
                $arrayReturn=[
                        'status'=>4,
                        'message'=>'Invalid Card - Transaction Cancel'
                ];
          }

          return $arrayReturn;
    }

//SANDBOX
    private function ChargeCreditCard($refId='')
    {
       
         $merchantAuthentication = $this->authorizeAccess();
        // Create the payment data for a credit card
          $creditCard = new AnetAPI\CreditCardType();
          $creditCard->setCardNumber("4111111111111111" );  
          $creditCard->setExpirationDate( "2038-12");
          $paymentOne = new AnetAPI\PaymentType();
          $paymentOne->setCreditCard($creditCard);

        // Create a transaction
          $transactionRequestType = new AnetAPI\TransactionRequestType();
          $transactionRequestType->setTransactionType("authCaptureTransaction");   
          $transactionRequestType->setAmount($this->amount);
          $transactionRequestType->setPayment($paymentOne);
          $request = new AnetAPI\CreateTransactionRequest();
          $request->setMerchantAuthentication($merchantAuthentication);
          $request->setRefId( $refId);
          $request->setTransactionRequest($transactionRequestType);
          $controller = new AnetController\CreateTransactionController($request);
          $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); //SANDBOX

          //echo $response; die(); 

          if ($response != null) 
          {
            $tresponse = $response->getTransactionResponse();
            //dd($response);
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                //print_r($tresponse); die();
                echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
                echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
            }
            else
            {
                echo "Charge Credit Card ERROR :  Invalid response\n";
            }
          }  
          else
          {
            echo  "Charge Credit Card Null response returned";
          }
    }

    private function AuthorizeCreditCard($refId='')
    {
       
         $merchantAuthentication = $this->authorizeAccess();
        // Create the payment data for a credit card
          // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber("4111111111111111");
            $creditCard->setExpirationDate("2038-12");
            $creditCard->setCardCode("123");

            // Add the payment data to a paymentType object
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);

            // Create order information
            $order = new AnetAPI\OrderType();
            $order->setInvoiceNumber("10101");
            $order->setDescription("Golf Shirts");

            // Set the customer's Bill To address
            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName("Ellen");
            $customerAddress->setLastName("Johnson");
            $customerAddress->setCompany("Souveniropolis");
            $customerAddress->setAddress("14 Main Street");
            $customerAddress->setCity("Pecan Springs");
            $customerAddress->setState("TX");
            $customerAddress->setZip("44628");
            $customerAddress->setCountry("USA");

            // Set the customer's identifying information
            $customerData = new AnetAPI\CustomerDataType();
            $customerData->setType("individual");
            $customerData->setId("99999456654");
            $customerData->setEmail("EllenJohnson@example.com");

            // Add values for transaction settings
            $duplicateWindowSetting = new AnetAPI\SettingType();
            $duplicateWindowSetting->setSettingName("duplicateWindow");
            $duplicateWindowSetting->setSettingValue("60");

            // Add some merchant defined fields. These fields won't be stored with the transaction,
            // but will be echoed back in the response.
            $merchantDefinedField1 = new AnetAPI\UserFieldType();
            $merchantDefinedField1->setName("customerLoyaltyNum");
            $merchantDefinedField1->setValue("1128836273");

            $merchantDefinedField2 = new AnetAPI\UserFieldType();
            $merchantDefinedField2->setName("favoriteColor");
            $merchantDefinedField2->setValue("blue");

            // Create a TransactionRequestType object and add the previous objects to it
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authOnlyTransaction"); 
            $transactionRequestType->setAmount($this->amount);
            $transactionRequestType->setOrder($order);
            $transactionRequestType->setPayment($paymentOne);
            $transactionRequestType->setBillTo($customerAddress);
            $transactionRequestType->setCustomer($customerData);
            $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
            $transactionRequestType->addToUserFields($merchantDefinedField1);
            $transactionRequestType->addToUserFields($merchantDefinedField2);

            // Assemble the complete transaction request
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId($refId);
            $request->setTransactionRequest($transactionRequestType);

            // Create the controller and get the response
            $controller = new AnetController\CreateTransactionController($request);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION); //SANDBOX
 

          //echo $response; die(); 
          //print_r($response); die();
          if ($response != null) 
          {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
            }
            else
            {
                echo "Charge Credit Card ERROR :  Invalid response\n";
            }
          }  
          else
          {
            echo  "Charge Credit Card Null response returned";
          }
    }

    private function capturePreviouslyAuthorizedAmount($refId,$transactionid)
    {
        /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
        $merchantAuthentication = $this->authorizeAccess();
        
        // Set the transaction's refId

        // Now capture the previously authorized  amount
        echo "Capturing the Authorization with transaction ID : " . $transactionid . "\n";
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("priorAuthCaptureTransaction");
        $transactionRequestType->setRefTransId($transactionid);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setTransactionRequest( $transactionRequestType);

        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION); //SANDBOX
        //print_r($response); die();
        if ($response != null) 
        {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                echo " Transaction Response code : " . $tresponse->getResponseCode() . "\n";
                echo "Successful." . "\n";
                echo "Capture Previously Authorized Amount, Trans ID : " . $tresponse->getRefTransId() . "\n";
                echo " Code : " . $tresponse->getMessages()[0]->getCode() . "\n"; 
                echo " Description : " . $tresponse->getMessages()[0]->getDescription() . "\n";
            }
            else
            {
                echo "Charge Credit Card ERROR :  Invalid response\n";
            }
        }  
        else
        {
            echo  "Charge Credit Card Null response returned";
        }

        
    }

    

    private function checkServer()
    {
        $ch = curl_init('https://apitest.authorize.net/xml/v1/request.api');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }


}
