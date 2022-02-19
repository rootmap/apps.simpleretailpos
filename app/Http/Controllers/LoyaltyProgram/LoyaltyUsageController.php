<?php

namespace App\Http\Controllers\LoyaltyProgram;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Model\Loyalty\LoyaltyPointUsage;

class LoyaltyUsageController extends Controller
{

    public function __construct(LoyaltyPointUsage $user, StaticDataController $sdc)
    {
        $this->model = $user;
        $this->sdc = $sdc;
    }


    public function index()
    {
        $data =  $this->model
                ->where('store_id',$this->sdc->storeID())
                ->when(request()->get('used_for'), function ($query) {
                    $query->where('used_for', '=', request()->get('used_for') );
                })  // query string search by membership type
                ->when(request()->get('email'), function ($query) {
                    $query->where('email', '=', request()->get('email') );
                })  // query string search by email
                ->when(request()->get('user_id'), function ($query) {
                    $query->where('user_id', '=', request()->get('user_id') );
                })  // query string search by user_id
                ->when(request()->get('user_name'), function ($query) {
                    $query->where('name', 'LIKE', "%".request()->get('user_name')."%" );
                })// query string search by Customer name
                ->when(request()->get('purchase_amount'), function ($query) {
                    $query->where('purchase_amount', '>=', request()->get('purchase_amount') );
                })// query string search by greater then or equal purchase amount
                ->get();

        return view('apps.pages.loyalty_program.loyalty_usage', ['dataTable'=>$data]);
    }

}
