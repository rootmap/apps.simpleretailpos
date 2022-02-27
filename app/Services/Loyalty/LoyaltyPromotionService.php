<?php
namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyPromotionalProgram;
use App\Model\Loyalty\LoyaltyPromotionSetting;

class LoyaltyPromotionService{
    private $config = [];
    private $store_id ="";

    public function __construct($config)
    {
        $this->config =$config;
        $this->store_id =$config['store_id'];
        // {
            //     "store_id"  :"",
            //     'user_info' :{
            //         'name':"",
            //         'email':"",
            //         'phone':"",
            //         'id':"",
            //     },
            //     "invoice_info" : {
            //         "invoice_id":"",
            //         "purchase_amount":"",
            //         "tender_id":"",
            //         "tender_name":"",
            //     },
            //     "withdeaw" : {
            //         "amount" : "",
            //          "ref_id"   : ""
            //     }
            //}
    }

    public function getPromotionsForMembership($membershipType = "")
    {
        return LoyaltyPromotionSetting::
                            where('store_id',$this->store_id)
                            ->where('status','active')
                            ->where('membership_name', $membershipType)
                            ->get();
    }

    public function getLatestPromotionRate ($membershipType, $date = "")
    {
        if($date == ""){
            $date =date("Y-m-d h:m:s");
        }
        return LoyaltyPromotionSetting::select('currency_to_loyalty_conversion_rate')
                            ->where('store_id',$this->store_id)
                            ->where('status','active')
                            ->whereRaw(' ? BETWEEN start_at AND end_at',[$date])
                            ->whereRaw(' 1 = IF(`for_membership_type` is NULL, 1, for_membership_type = ? )',[$membershipType])
                            ->orderBy('currency_to_loyalty_conversion_rate', 'desc')
                            ->first();
    }

    public function convert( $purchaseAmount, $membershipType)
    {
        $store = $this->getLatestPromotionRate($membershipType, "");
        return (isset($store['currency_to_loyalty_conversion_rate'])) ? $purchaseAmount * $store['currency_to_loyalty_conversion_rate'] : false;
    }

    public function getLatestPromotionDetails ($purchaseAmount, $membershipType, $date = "")
    {
        if($date == "")
        {
            $date =date("Y-m-d");
        }
        
        $data = LoyaltyPromotionSetting::
                            where('store_id',$this->store_id)
                            ->where('status','active')
                            ->whereRaw(' ? BETWEEN start_at AND end_at',[$date])
                            ->whereRaw(' 1 = IF(`for_membership_type` is NULL OR `for_membership_type`="",1 ,for_membership_type = ? )',[$membershipType])
                            ->orderBy('currency_to_loyalty_conversion_rate', 'desc')
                            ->first();
        if(isset($data->id)){
            return [
                "point" => $purchaseAmount * $data['currency_to_loyalty_conversion_rate'],
                'data' => $data
            ];
        }
        return false;
    }

    public function updatePromotionProgram($promotionId, $invoiceId, $purchaseAmount,$point)
    {
        $result = LoyaltyPromotionalProgram::
                            where('store_id',$this->store_id)
                            ->where('promotion_id',$promotionId)
                            ->first();
        if(isset($result->id)){
            $result->total_invoices = $result->total_invoices + 1;
            $result->total_purchase_amount = $result->total_purchase_amount + $purchaseAmount;
            $result->total_loyalty_points = $result->total_loyalty_points + $point;

            $result->save();
            return $result;
        }
        return $this->insertPromotionProgram($promotionId, $invoiceId, $purchaseAmount,$point);
    }

    private function insertPromotionProgram($promotionId, $invoiceId, $purchaseAmount,$point)
    {
        $result = new LoyaltyPromotionalProgram();
        $result->promotion_id =  $promotionId;
        $result->total_invoices =  1;
        $result->total_purchase_amount =  $purchaseAmount;
        $result->total_loyalty_points =  $point;

        $result->save();
        return $result;
    }

}
