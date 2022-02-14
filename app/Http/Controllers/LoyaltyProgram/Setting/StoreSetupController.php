<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\Setup\LoyaltyStoreSetupRequest;
use App\Model\Loyalty\LoyaltyStoreSetting;

class StoreSetupController extends Controller
{

    public function __construct(LoyaltyStoreSetting $card, StaticDataController $sdc)
    {
        $this->model = $card;
        $this->sdc = $sdc;
    }


    public function index()
    {
        $data =  $this->model
                //->where('store_id',$this->sdc->storeID())
                ->get();
        return $data;
        //        return view('',['data' => $data]);
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

    public function store(LoyaltyStoreSetupRequest $request)
    {
        $data = $request->only([
            'is_in_loyalty_program', 'allow_cash_withdrawal_by_loyanty_point',
            'currency_to_loyalty_conversion_rate',
            'min_purchase_amount'
        ]);
        $result =new LoyaltyStoreSetting();

        $result->store_id = 1;
        //$result->store_id = $this->sdc->storeID();
        $result->is_in_loyalty_program = $data['is_in_loyalty_program'];
        $result->allow_cash_withdrawal_by_loyanty_point = $data['allow_cash_withdrawal_by_loyanty_point'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->min_purchase_amount  = $data['min_purchase_amount '];

        $result->save();
        return $result;
    }

    public function show($id)
    {
        return $this->model
                //->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
    }

    public function edit($id)
    {
        $data =  $this->model
                //->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
        return view('', ['data' => $data]);
    }

    public function update(LoyaltyStoreSetupRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();
        $result->is_in_loyalty_program = $data['is_in_loyalty_program'];
        $result->allow_cash_withdrawal_by_loyanty_point = $data['allow_cash_withdrawal_by_loyanty_point'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->min_purchase_amount  = $data['min_purchase_amount'];
        $result->save();
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->delete();
        return $data;
    }
}
