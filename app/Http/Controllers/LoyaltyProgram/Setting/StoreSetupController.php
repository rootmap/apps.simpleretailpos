<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\Setup\LoyaltyStoreSetupRequest;
use App\Model\Loyalty\LoyaltyStoreSetting;
use LDAP\Result;

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
                ->where('store_id',$this->sdc->storeID())
                ->first();
        return view('apps.pages.loyalty_program.setting.store_setup',["edit" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apps.pages.loyalty_program.setting.store_setup');
    }

    public function store(LoyaltyStoreSetupRequest $request)
    {
        $data = $request->only([
            'is_in_loyalty_program', 'allow_cash_withdrawal_by_loyanty_point',
            'currency_to_loyalty_conversion_rate',
            'min_purchase_amount'
        ]);

        $result = LoyaltyStoreSetting::where("store_id",$this->sdc->storeID())->first();
        if(! isset($result['store_id'])){
            $result =new LoyaltyStoreSetting();
        }
        $result->store_id = $this->sdc->storeID();
        $result->is_in_loyalty_program = $data['is_in_loyalty_program'];
        $result->allow_cash_withdrawal_by_loyanty_point = $data['allow_cash_withdrawal_by_loyanty_point'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->min_purchase_amount  = $data['min_purchase_amount'];

        $result->save();
        return redirect()->route('loyalty.setting.store.index');
    }

    public function show($id)
    {
        $data =  $this->model
                ->where('store_id',$id)
                ->get();
        return $data;
        return view('apps.pages.loyalty_program.setting.store_setup',["edit" => $data]);
    }

    public function edit($id)
    {
        $data =  $this->model
                //->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
        return view('apps.pages.loyalty_program.setting.store_setup',["edit" => $data]);
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
        return redirect()->route('loyalty.setting.store.index');
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
