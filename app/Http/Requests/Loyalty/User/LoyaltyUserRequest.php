<?php
namespace App\Http\Requests\Loyalty\User;

use App\Http\Requests\BaseRequest;
use App\Model\Loyalty\LoyaltyUser;

class LoyaltyUserRequest extends BaseRequest
{
    public function rules()
    {
        return $this->initRules( new LoyaltyUser() );
    }
}
