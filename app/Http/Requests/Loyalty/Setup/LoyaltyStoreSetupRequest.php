<?php

namespace App\Http\Requests\Loyalty\Setup;

use App\Http\Requests\BaseRequest;
use App\Model\Loyalty\LoyaltyStoreSetting;

class LoyaltyStoreSetupRequest extends BaseRequest
{
    public function rules()
    {
        return $this->initRules( new LoyaltyStoreSetting() );
    }

}
