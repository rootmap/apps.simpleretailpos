<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyUserRules
{

    public function createdRules()
    {
        dd("Hello World");
        return [
            'store_id'=> "required|numeric",
            'user_info'=> "required|array",
                'user_info.id'=> "required|numeric",
                'user_info.name'=> "required|string",
                'user_info.email' => "nullable|email",
                'user_info.phone' => "required|string",
            'invoice_info'=> "nullable|array",
                'invoice_info.invoice_id'=> "nullable|numeric",
                'invoice_info.purchase_amount'=> "nullable|numeric",
                'invoice_info.tender_id' => "nullable|numeric",
                'inoice_info.tender_name' => "nullable|string",
            'withdeaw'=> "nullable|array",
                'withdeaw.withdeaw'=> "nullable|numeric",
                'withdeaw.ref_id'=> "nullable|numeric"


        ];
    }

    public function updatedRules()
    {
        return [

        ];
    }
}
