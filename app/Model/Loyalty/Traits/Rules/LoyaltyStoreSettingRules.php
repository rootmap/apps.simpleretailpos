<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyStoreSettingRules
{

    public function createdRules()
    {
        return [
            //"store_id" => "nullable|numeric",
            "is_in_loyalty_program" => "required|boolean",
            "allow_cash_withdrawal_by_loyanty_point" => "required|boolean",
            "currency_to_loyalty_conversion_rate" => "required|numeric",
            "min_purchase_amount" => "required|numeric",
        ];
    }

    public function updatedRules()
    {
        return [
            "store_id" => "nullable|numeric",
            "is_in_loyalty_program" => "nullable|boolean",
            "allow_cash_withdrawal_by_loyanty_point" => "nullable|boolean",
            "currency_to_loyalty_conversion_rate" => "nullable|numeric",
        ];
    }
}
