<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyPromotionSettingRules;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPromotionSetting extends Model
{
    use LoyaltyPromotionSettingRules;
    protected $fillable = [
        'store_id',
        'created_by',
        'promotion_title',
        'for_membership_type',
        'promotion_type'
    ];
}
