<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoyaltyCardSetting extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'properties_object',
        'card_pic_path'
    ];
}
