<?php

namespace App\Http\Controllers\LoyaltyProgram\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequest;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequestNew;
use App\Model\Loyalty\LoyaltyInvoice;
use App\Model\Loyalty\LoyaltyUser;
use App\Services\Loyalty\LoyaltyService;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                ->where('store_id',$this->sdc->storeID())
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
        $data = $this->model->get();

        return view('apps.pages.loyalty_program.user.user',
        ['dataTable'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails($id)
    {
        //
        $user = User::select('users.*','roles.name as role_name','stores.name as store_name',
                            'loyalty_users.total_invoices', 'loyalty_users.total_purchase_amount',
                            'loyalty_users.total_point', 'loyalty_users.membership_card_type' )
                    ->join('loyalty_users','users.id','=','loyalty_users.user_id')
                    ->leftJoin('roles','users.user_type','=','roles.id')
                    ->leftJoin('stores','users.store_id','=','stores.store_id')
                    ->where('users.id',$id)
                    ->first();

        $invoices = LoyaltyInvoice::
                        where('store_id',$this->sdc->storeID())
                        ->where('user_id',$id)->get();

        return view('apps.pages.loyalty_program.user.user_details',
        ["edit"=> $user,'dataTable'=>$invoices]);
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
    public function assign(LoyaltyUserRequestNew $request)
    {
        $data = $this->makeDataArray($request);
        // dd($data);
        if($data){
            $service = new LoyaltyService($data);
            $data = $service->join();

            $service->setInvoice();
            return $data;
        }
        return [
            "status" => "400",
            "message" => "Invalid Argument Pass"
        ];

    }

    public function cashWithdraw(LoyaltyUserRequestNew $request)
    {
        $data = $this->makeDataArray($request);
        if($data){
        $service = new LoyaltyService($data);
        return $service->withdraw();
        }
        return [
            "status" => "400",
            "message" => "Invalid Argument Pass"
        ];
    }

}
