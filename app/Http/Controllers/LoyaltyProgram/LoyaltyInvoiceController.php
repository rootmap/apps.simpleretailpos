<?php

namespace App\Http\Controllers\LoyaltyProgram;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequestNew;
use App\Model\Loyalty\LoyaltyInvoice;
use App\Services\Loyalty\LoyaltyService;
use Exception;
use Illuminate\Http\Request;

class LoyaltyInvoiceController extends Controller
{

    public function __construct(LoyaltyInvoice $user, StaticDataController $sdc)
    {
        $this->model = $user;
        $this->sdc = $sdc;
    }


    public function index()
    {
        $data =  $this->model
                //->where('store_id',$this->sdc->storeID())
                ->when(request()->get('invoice_id'), function ($query) {
                    $query->where('invoice_id', '=', request()->get('invoice_id') );
                })  // query string search by invoice id
                ->when(request()->get('membership_type'), function ($query) {
                    $query->where('membership_card_type', '=', request()->get('membership_type') );
                })  // query string search by membership type
                ->when(request()->get('email'), function ($query) {
                    $query->where('email', '=', request()->get('email') );
                })  // query string search by email
                ->when(request()->get('user_name'), function ($query) {
                    $query->where('name', 'LIKE', "%".request()->get('user_name')."%" );
                })// query string search by Customer name
                ->when(request()->get('purchase_amount'), function ($query) {
                    $query->where('purchase_amount', '>=', request()->get('purchase_amount') );
                })// query string search by greater then or equal purchase amount
                ->get();

            return view('apps.pages.loyalty_program.invoice', ['dataTable'=>$data]);
    }

    private function makeDataArray($request)
    {

        $data = $request->all();
        // dd($data);
        try{
            return [
                "store_id"  =>$data['store_id'],
                'user_info' =>[
                    'id'=>$data['user_info']['id'],
                    'name'=> $data['user_info']['name'],
                    'email'=> $data['user_info']['email'],
                    'phone'=>$data['user_info']['phone']
                ],
                "invoice_info" => [
                    "invoice_id"=>$data['invoice_info']['invoice_id'],
                    "purchase_amount"=>$data['invoice_info']['purchase_amount'],
                    "tender_id"=>$data['invoice_info']['tender_id'],
                    "tender_name"=>$data['invoice_info']['tender_name'],
                ],
                "withdraw" => [
                    "amount" => $data['withdeaw']['amount'],
                    "ref_id"   => $data['withdeaw']['ref_id']
                ]
            ];
        }
        catch(Exception $e){
            return false;
        }

    }

    public function addInvoiceToLoyaltyProgram(LoyaltyUserRequestNew $request)
    {
        $data = $this->makeDataArray($request);
        if($data){
            $service = new LoyaltyService($data);
            $result = $service->setInvoice();
            return ($result) ? $result : ["status" => false, "message" => "Invalid Request paremeters." ];
        }

        return [
            "status" => "400",
            "message" => "Invalid Argument Pass"
        ];
    }
}
