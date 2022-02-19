<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyPromotionalProgramRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyPromotionalProgram extends Model
{
    use SoftDeletes, LoyaltyPromotionalProgramRules;
    protected $fillable = [
        'store_id',
        'promotion_id',
        'total_invoices',
        'total_purchase_amount',
        'total_loyalty_points'
    ];
}
