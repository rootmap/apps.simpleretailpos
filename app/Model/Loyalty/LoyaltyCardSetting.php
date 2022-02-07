<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyCardSettingRules;
use Illuminate\Database\Eloquent\Model;

class LoyaltyCardSetting extends Model
{
    use LoyaltyCardSettingRules;
    protected $fillable = [
        'store_id',
        'membership_name',
        'properties_object',
        'card_pic_path',
        'purchase_amount_to_point_conversion_rate',
        'min_purchase_amount',
    ];


    protected $casts = [
        'store_id' => 'integer',
        //'created_at' => 'datetime:Y-m-d',
        //'properties_object' => 'object',
    ];
}
