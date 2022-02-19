<?php

namespace App\Model\Loyalty\Traits\Rules;

trait LoyaltyCardSettingRules
{

    public function createdRules()
    {
        return [
            "membership_name" => "required|string|unique:loyalty_card_settings,membership_name",
            "card_pic_path" => "nullable|image|mimes:jpg,png",
            "card_display_config" => "nullable|array",
            "point_range_from" => "required|numeric",
            "point_range_to" => "required|numeric",
            //"created_by" => "required|exists:users,id",
            "status" => "required|string"
        ];
    }

    public function updatedRules()
    {
        return [
            "membership_name" => "nullable|string",
            "card_pic_path" => "nullable|image|mimes:jpg,png",
            "card_display_config" => "nullable|array",
            "point_range_from" => "nullable|numeric",
            "point_range_to" => "nullable|numeric",
            "status" => "nullable|string",
        ];
    }

    // public function messages()
    // {
    //     return [
    //         "membership_name" => "Must be a unique name",
    //         "card_pic_path" => "musht be image ",
    //         "card_display_config" => "Must choose configuration settings.",
    //         "point_range_from" => "Point Range from must be number and less then point range to",
    //         "point_range_to" => "Point Range from must be number and greater then point range from",
    //         "min_purchase_amount" => "Minimum purchase amount must be number and greater then or equal to 0",
    //         "purchase_amount_to_point_conversion_rate" => "required|number",
    //         "created_by" => "required|exists:users,id"
    //     ];
    // }
}
