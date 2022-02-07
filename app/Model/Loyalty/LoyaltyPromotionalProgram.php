<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyPromotionalProgramRules;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPromotionalProgram extends Model
{
    use LoyaltyPromotionalProgramRules;
    protected $fillable = [
        'store_id',
        'promotion_id',
        'promotion_start_at',
        'promotion_end_at',
        'total_invoices',
        'total_purchase_amount',
        'total_loyalty_points'
    ];
}
