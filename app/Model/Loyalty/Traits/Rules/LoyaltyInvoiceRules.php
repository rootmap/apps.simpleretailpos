<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyInvoiceRules
{

    public function createdRules()
    {
        return [
            'store_id'=> "required|numeric",
            'user_id'=> "required|numeric",
            'name'=> "required|string",
            'email' => "required|email",
            'purchase_amount'=> "required|numeric",
            'earned_point'=> "required|numeric",
            'membership_card_type'=> "required|string| exists_in: loyalty_card_settings,membership_name",
        ];
    }

    public function updatedRules()
    {
        return [
            'store_id'=> "nullable|numeric",
            'user_id'=> "nullable|numeric",
            'name'=> "nullable|string",
            'email' => "nullable|email",
            'purchase_amount'=> "nullable|numeric",
            'earned_point'=> "nullable|numeric",
            'membership_card_type'=> "nullable|string|exists_in: loyalty_card_settings,membership_name",
        ];
    }
}
