<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyPromotionalProgramRules
{

    public function createdRules()
    {
        return [
            "store_id" => "required|numeric",
            "promotion_id" => "required|numeric",
            "promotion_start_at" => "required|date_format:Y-m-d H:i:s",
            "promotion_end_at" => "required|date_format:Y-m-d H:i:s",
        ];
    }

    public function updatedRules()
    {
        return [
            "store_id" => "nullable|numeric",
            "promotion_id" => "nullable|numeric",
            "promotion_start_at" => "nullable|date_format:Y-m-d H:i:s",
            "promotion_end_at" => "nullable|date_format:Y-m-d H:i:s",
        ];
    }
}
