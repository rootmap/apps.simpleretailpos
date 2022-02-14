<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyCardSettingRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyCardSetting extends Model
{

    use SoftDeletes, LoyaltyCardSettingRules;
    protected $fillable = [
        'membership_name',
        'properties_object',
        'card_pic_path',
        'point_range_from',
        'point_range_to',
    ];


    protected $casts = [
        'store_id' => 'integer',
        //'created_at' => 'datetime:Y-m-d',
        //'properties_object' => 'object',
    ];
}
