<?php

namespace App\Http\Requests\Loyalty;

use App\Http\Requests\BaseRequest;
use App\Model\Loyalty\LoyaltyPromotionalProgram;

class LoyaltyPromotionalProgramRequest extends BaseRequest
{
    public function rules()
    {
        return $this->initRules( new LoyaltyPromotionalProgram() );
    }
}
