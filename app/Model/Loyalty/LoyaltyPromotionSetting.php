<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyPromotionSettingRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyPromotionSetting extends Model
{
    use LoyaltyPromotionSettingRules, SoftDeletes;
    protected $fillable = [
        'store_id',
        'created_by',
        'currency_to_loyalty_conversion_rate',
        'status',
        'promotion_title',
        'start_at',
        'end_at'
    ];
}
