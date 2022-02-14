<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\Setup\LoyaltyPromotionSettingRequest;
use App\Model\Loyalty\LoyaltyPromotionSetting;
use Illuminate\Http\Request;

class PromotionSetupController extends Controller
{


    public function __construct(LoyaltyPromotionSetting $promotion, StaticDataController $sdc)
    {
        $this->model = $promotion;
        $this->sdc = $sdc;

    }

    public function index()
    {
        return $this->model
                //->where('store_id',$this->sdc->storeID())
                ->get();
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

    public function store(LoyaltyPromotionSettingRequest $request)
    {
        $data = $request->only([
            'promotion_title', 'for_membership_type', 'currency_to_loyalty_conversion_rate',
            'start_at', 'end_at', 'status'
        ]);
        $result =new LoyaltyPromotionSetting();

        //$result->store_id = $this->sdc->storeID();
        $result->promotion_title = $data['promotion_title'];
        $result->for_membership_type = $data['for_membership_type'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->start_at = $data['start_at'];
        $result->end_at = $data['end_at'];
        $result->status = $data['status'];

        //$result->created_by = Auth::id();
        //$result->created_by = 1;

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
        //
    }

    public function update(LoyaltyPromotionSettingRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();
        //$result->store_id = $this->sdc->storeID();
        $result->promotion_title = $data['promotion_title'];
        $result->for_membership_type = $data['for_membership_type'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->start_at = $data['start_at'];
        $result->end_at = $data['end_at'];
        $result->status = $data['status'];

        //$result->created_by = Auth::id();
        //$result->created_by = 1;

        $result->save();
        return $data;
    }
    public function changePromotionStatus(LoyaltyPromotionSettingRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();
        //$result->store_id = $this->sdc->storeID();
        $result->status = $data['status'];

        //$result->created_by = Auth::id();
        //$result->created_by = 1;

        $result->save();
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->delete();
    }
}
