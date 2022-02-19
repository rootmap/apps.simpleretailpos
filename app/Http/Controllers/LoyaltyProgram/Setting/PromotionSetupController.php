<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\Setup\LoyaltyPromotionSettingRequest;
use App\Model\Loyalty\LoyaltyCardSetting;
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
        $data =  $this->model
                ->where('store_id',$this->sdc->storeID())
                ->get();

        return view('apps.pages.loyalty_program.setting.promotion_setting_list',["dataTable" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $membership = LoyaltyCardSetting::
                            select('membership_name')
                            ->where('store_id',$this->sdc->storeID())
                            ->where('status', "active")
                            ->get();
        return view('apps.pages.loyalty_program.setting.promotion_setup', ["memberships" => $membership]);
    }

    public function store(LoyaltyPromotionSettingRequest $request)
    {
        $data = $request->only([
            'promotion_title', 'for_membership_type', 'currency_to_loyalty_conversion_rate',
            'start_at', 'end_at', 'status'
        ]);
        $result =new LoyaltyPromotionSetting();

        $result->store_id = $this->sdc->storeID();
        $result->promotion_title = $data['promotion_title'];
        $result->for_membership_type = $data['for_membership_type'];
        $result->currency_to_loyalty_conversion_rate = $data['currency_to_loyalty_conversion_rate'];
        $result->start_at = $data['start_at'];
        $result->end_at = $data['end_at'];
        $result->status = $data['status'];


        $result->save();

        return redirect()->route('loyalty.setting.promotion.index');
    }

    public function show($id)
    {
        $data = $this->model
                ->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
        $membership = LoyaltyCardSetting::select('membership_name')
                ->where('store_id',$this->sdc->storeID())
                ->where('status', "active")
                ->get();

        return view('apps.pages.loyalty_program.setting.view_promotion', ['data' => $data, 'memberships' => $membership]);
    }

    public function edit($id)
    {
        //
    }

    public function update(LoyaltyPromotionSettingRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    ->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();
        //$result->store_id = $this->sdc->storeID();
        $result->promotion_title = isset($data['promotion_title']) ? $data['promotion_title'] : $result->promotion_title;
        $result->for_membership_type = isset($data['for_membership_type']) ? $data['for_membership_type'] : $result->promotion_title;
        $result->currency_to_loyalty_conversion_rate = isset($data['currency_to_loyalty_conversion_rate']) ? $data['currency_to_loyalty_conversion_rate'] : $result->currency_to_loyalty_conversion_rate;
        $result->start_at = isset($data['start_at']) ? $data['start_at'] : $result->start_at;
        $result->end_at = isset($data['end_at']) ? $data['end_at'] : $result->end_at;
        $result->status = isset($data['status']) ? $data['status'] : $result->status;

        $result->save();

        return redirect()->route('loyalty.setting.promotion.show', [$result['id']]);
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
