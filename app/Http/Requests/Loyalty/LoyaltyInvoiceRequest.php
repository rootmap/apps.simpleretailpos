<?php

namespace App\Http\Requests\Loyalty;

use App\Http\Requests\BaseRequest;
use App\Model\Loyalty\LoyaltyInvoice;

class LoyaltyInvoiceRequest extends BaseRequest
{
    public function rules()
    {
        return $this->initRules( new LoyaltyInvoice() );
    }
}
