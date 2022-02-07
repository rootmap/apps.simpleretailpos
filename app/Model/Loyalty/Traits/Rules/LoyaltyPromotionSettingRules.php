<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyPromotionSettingRules
{

    public function createdRules()
    {
        return [
            "store_id" => "required|numeric",
            "created_by" => "required|numeric",
            "promotion_title" => "required|string",
            "for_membership_type" => "required|string",
            "promotion_type" => "required|string",
            "promotion_value" => "nullable|string",

        ];
    }

    public function updatedRules()
    {
        return [
            "store_id" => "nullable|numeric",
            "created_by" => "nullable|numeric",
            "promotion_title" => "nullable|string",
            "for_membership_type" => "nullable|string",
            "promotion_type" => "nullable|string",
            "promotion_value" => "nullable|string",
        ];
    }
}
