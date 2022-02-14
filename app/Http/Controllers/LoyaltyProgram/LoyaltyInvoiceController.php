<?php

namespace App\Http\Controllers\LoyaltyProgram;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Model\Loyalty\LoyaltyInvoice;
use App\Services\Loyalty\LoyaltyService;
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
        return $data;
        // return view('',['data' => $data]);
    }

    private function makeDataArray($request)
    {
        $data = $request->only([
            'user_id', 'email', "name", "phone"
            ,"invoice_id","purchase_amount", "tender_id", "tender_name"
            ,"withdraw_amount", "withdraw_ref_id"
        ]);

        return [
            "store_id"  => $this->sdc->storeID(),
            'user_info' =>[
                'id'=>$data['user_id'],
                'name'=> $data['name'],
                'email'=> $data['email'],
                'phone'=>$data['phone']
            ],
            "invoice_info" => [
                "invoice_id"=>$data['invoice_id'],
                "purchase_amount"=>$data['purchase_amount'],
                "tender_id"=>$data['tender_id'],
                "tender_name"=>$data['tender_name'],
            ],
            "withdeaw" => [
                "amount" => $data['withdraw_amount'],
                    "ref_id"   => $data['withdraw_ref_id']
            ]
        ];

    }

    public function addInvoiceToLoyaltyProgram(Request $request)
    {
        $data = $this->makeDataArray($request);

        $service = new LoyaltyService();
        return $service
                    ->set($data)
                    ->setInvoice()
                    ->get();
    }
}
