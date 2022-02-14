<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyPromotionSettingRules
{

    public function createdRules()
    {
        return [
            //"store_id" => "required|numeric",
            "promotion_title" => "required|string",
            "for_membership_type" => "nullable|string",
            "start_at" => "required|string",
            "end_at" => "required|string",
            "currency_to_loyalty_conversion_rate" => "required|numeric",
            "status" => "required|numeric",

        ];
    }

    public function updatedRules()
    {
        return [
            "promotion_title" => "nullable|string",
            "for_membership_type" => "nullable|string",
            "start_at" => "nullable|string",
            "end_at" => "nullable|string",
            "currency_to_loyalty_conversion_rate" => "nullable|numeric",
            "status" => "nullable|numeric",
        ];
    }
}
