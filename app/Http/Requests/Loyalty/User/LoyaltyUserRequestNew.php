<?php

namespace App\Http\Requests\Loyalty\User;

use Illuminate\Foundation\Http\FormRequest;

class LoyaltyUserRequestNew extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
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
}
