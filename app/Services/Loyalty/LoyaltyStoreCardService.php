<?php
namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyCardSetting;
use App\Model\Loyalty\LoyaltyStoreSetting;

class LoyaltyStoreCardService{
    private $config = [];
    private $store_id ="";

    public function __construct($config)
    {
        // dd($config);
        $this->config =$config;
        $this->store_id =$config['store_id'];
        // {
        //     "store_id"  :"241",
        //     "user_info" :{
        //         "name":"Md. Mohiuddin khan",
        //         "email":"mohiuddin@mail.com",
        //         "phone":"017283848494",
        //         "id":"36"
        //     },
        //     "invoice_info" : {
        //         "invoice_id":"12",
        //         "purchase_amount":"100",
        //         "tender_id":"1",
        //         "tender_name":"Debit Card"
        //     },
        //     "withdeaw" : {
        //         "amount" : "10",
        //             "ref_id"   : "1"
        //         }
        // }
    }

    public function getMinPurchaseAmount($amount= "")
    {

        $record = LoyaltyStoreSetting::
                        //select('min_purchase_amount')
                        where('store_id',$this->store_id)
                        ->first();

        if($amount != ""){
            return ($record['min_purchase_amount'] >= $amount) ? true : false;
        }
        return $record['min_purchase_amount'];

    }

    private function store_details()
    {

        return LoyaltyStoreSetting::
                        where('store_id',$this->store_id)
                        ->first();

    }

    public function convert($value, $convertTo = "point")
    {

        $store = $this->store_details();
        // dd($convertTo);
        $convertionRate = $store['currency_to_loyalty_conversion_rate'];
        return [
            "total_point" => ($convertTo === "point") ? $value / $convertionRate : $value ,
            "conversion_rate" => $convertionRate,
            "balance" => ($convertTo === "point") ? $value : $value * $convertionRate
        ];
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
        $data = LoyaltyCardSetting::select('membership_name')
                            ->where('store_id',$this->store_id)
                            ->where('status','active')
                            ->whereRaw('? BETWEEN point_range_from AND point_range_to',[$point])
                            ->first();

        if(isset($data['membership_name'])){
            
            return $data;
        }
        return LoyaltyCardSetting::select('membership_name')
                            ->where('store_id',$this->store_id)
                            ->where('status','active')
                            ->orderBy('point_range_to','DESC')
                            ->first();

    }




}
