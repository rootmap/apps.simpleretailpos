<?php

namespace App\Http\Controllers\LoyaltyProgram\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequest;
use App\Model\Loyalty\LoyaltyInvoice;
use App\Model\Loyalty\LoyaltyUser;
use App\Services\Loyalty\LoyaltyService;
use App\User;

class LoyaltyUserController extends Controller
{


    public function __construct(LoyaltyUser $user, StaticDataController $sdc)
    {
        $this->model = $user;
        $this->sdc = $sdc;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  $this->model
                //->where('store_id',$this->sdc->storeID())
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
                    $query->where('total_purchases', '>=', request()->get('purchase_amount') );
                })// query string search by greater then or equal purchase amount
                ->when(request()->get('earned_points'), function ($query) {
                    $query->where('total_points', '>=', request()->get('earned_points') );
                })// query string search by greater then or equal earned loyalty amount
                ->get();
        return $data;
        // return view('',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails($id)
    {
        //
        $user = User::find($id);
        $invoices = LoyaltyInvoice::
                        //where('store_id',$this->sdc->storeID())
                        where('user_id',$id)->get();

        return array("user_info" =>$user, $invoices => $invoices);
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
    public function assign(LoyaltyUserRequest $request)
    {
        $data = $this->makeDataArray($request);

        $service = new LoyaltyService();
        return $service
                    ->set($data)
                    ->join()
                    ->get();

    }

    public function cashWithdraw(LoyaltyUserRequest $request)
    {
        $data = $this->makeDataArray($request);

        $service = new LoyaltyService();
        return $service
                    ->set($data)
                    ->withdraw()
                    ->get();
    }

}
