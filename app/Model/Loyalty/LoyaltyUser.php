<?php

namespace App\Model\Loyalty;

use Illuminate\Database\Eloquent\Model;

class LoyaltyUser extends Model
{
    //use LoyaltyStoreSettingRules;

    protected $fillable = [
        'store_id',
        'user_id',
        'name',
        'phone',
        'total_invoices',
        'total_purchase_amount',
        'total_point',
        'membership_card_type'
    ];
}
