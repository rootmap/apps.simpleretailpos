<?php

namespace App\Http\Controllers\LoyaltyProgram\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\LoyaltyPromotionalProgramRequest;
use App\Model\Loyalty\LoyaltyPromotionalProgram;

class LoyaltyPromotionController extends Controller
{
    public function __construct(LoyaltyPromotionalProgram $promotion, StaticDataController $sdc)
    {
        $this->model = $promotion;
        $this->sdc = $sdc;

    }
    public function index()
    {
        $data = $this->model
                ->select('loyalty_promotion_settings.*','loyalty_promotional_programs.total_invoices', 'loyalty_promotional_programs.total_purchase_amount', 'loyalty_promotional_programs.total_loyalty_points')
                ->join('loyalty_promotion_settings','loyalty_promotion_settings.id','=','loyalty_promotional_programs.promotion_id')
                ->where('loyalty_promotion_settings.store_id',$this->sdc->storeID())
                ->where('loyalty_promotion_settings.status','active')
                ->get();

        return view('apps.pages.loyalty_program.promotions', ['dataTable'=>$data]);
    }

    public function store(LoyaltyPromotionalProgramRequest $request)
    {
        $data = $request->only([
            'promotion_id', 'promotion_start_at', 'promotion_end_at'
        ]);
        $result =new LoyaltyPromotionalProgram();

        //$result->store_id = $this->sdc->storeID();
        $result->promotion_id = $data['promotion_id'];
        $result->promotion_start_at = $data['promotion_start_at'];
        $result->promotion_end_at = $data['promotion_end_at'];
        $result->total_invoices = 0;
        $result->total_purchase_amount = 0;
        $result->total_loyalty_points = 0;

        //$result->created_by = Auth::id();
        //$result->created_by = 1;

        $result->save();
        return $result;

    }

    public function show($id)
    {
        return $this->model
                //->where('store_id',$this->sdc->storeID())
                ->find($id)->first();
    }

    public function extend(LoyaltyPromotionalProgramRequest $request,$id)
    {
        $data = $request->only([
            'promotion_end_at'
        ]);
        $result = $this->model
                //->where('store_id',$this->sdc->storeID())
                ->find($id)->first();
        $result =new LoyaltyPromotionalProgram();

        //$result->store_id = $this->sdc->storeID();
        $result->promotion_end_at = $data['promotion_end_at'];
        $result->save();
    }

    public function delete($id)
    {
        $result = $this->model
                //->where('store_id',$this->sdc->storeID())
                ->find($id)->delete();
    }
}