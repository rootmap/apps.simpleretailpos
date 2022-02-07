<?php

namespace App\Http\Requests\Loyalty\Setup;

use App\Http\Requests\BaseRequest;
use App\Model\Loyalty\LoyaltyPromotionSetting;

class LoyaltyPromotionSettingRequest extends BaseRequest
{
    public function rules()
    {
        return $this->initRules( new LoyaltyPromotionSetting() );
    }
}
