<?php
namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyCardSetting;
use App\Model\Loyalty\LoyaltyStoreSetting;

class LoyaltyStoreCardService{
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
            // }
    }

    public function getMinPurchaseAmount($amount= "")
    {

        $record = LoyaltyStoreSetting::
                        //select('min_purchase_amount')
                        where('sore_id',$this->store_id)
                        ->first();

        if($amount != ""){
            return ($record['min_purchase_amount'] >= $amount) ? true : false;
        }
        return $record['min_purchase_amount'];

    }

    private function store_details()
    {

        return LoyaltyStoreSetting::
                        where('sore_id',$this->store_id)
                        ->first();

    }

    public function convert($value, $convertTo = "point")
    {
        $store = $this->store_details();
        $convertionRate = $store['currency_to_loyalty_conversion_rate'];
        return ($convertTo = "point") ? $value * $convertionRate : $value / $convertionRate;
    }

    public function getCardDetails($membershipType)
    {
        return LoyaltyCardSetting::
                            where('store_id',$this->store_id)
                            ->where('status','active')
                            ->where('membership_name', $membershipType)
                            ->first();
    }
    public function getMembershipByPoint($point)
    {
        return LoyaltyCardSetting::select('membership_name')
                            ->where('store_id',$this->store_id)
                            ->where('status','active')
                            ->whereRaw('? BETWEEN point_range_from AND point_range_to',[$point])
                            ->first();
    }




}
