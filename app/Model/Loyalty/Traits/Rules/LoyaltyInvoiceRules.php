<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyInvoiceRules
{

    public function createdRules()
    {
        return [
            'user_id'=> "required|numeric",
            'name'=> "required|string",
            'email' => "nullable|email",
            'phone' => "required|email",
            'purchase_amount'=> "required|numeric",
            'earned_point'=> "required|numeric",
            'membership_card_type'=> "required|string| exists_in: loyalty_card_settings,membership_name",
        ];
    }

    public function updatedRules()
    {
        return [
            'user_id'=> "nullable|numeric",
            'name'=> "nullable|string",
            'email' => "nullable|email",
            'phone' => "nullable|email",
            'purchase_amount'=> "nullable|numeric",
            'earned_point'=> "nullable|numeric",
            'membership_card_type'=> "nullable|string|exists_in: loyalty_card_settings,membership_name",
        ];
    }
}
