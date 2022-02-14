<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyStoreSettingRules;
use Illuminate\Database\Eloquent\Model;

class LoyaltyStoreSetting extends Model
{
    use LoyaltyStoreSettingRules;

    protected $fillable = [
        'store_id',
        'is_in_loyalty_program',
        'allow_cash_withdrawal_by_loyanty_point',
        'currency_to_loyalty_conversion_rate',
        'min_purchase_amount'
    ];
}
