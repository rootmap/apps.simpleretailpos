<?php

namespace App\Model\Loyalty;

use App\Model\Loyalty\Traits\Rules\LoyaltyInvoiceRules;
use Illuminate\Database\Eloquent\Model;

class LoyaltyInvoice extends Model
{
    use LoyaltyInvoiceRules;

    protected $fillable = [
        'store_id',
        'user_id',
        'name',
        'email',
        'purchase_amount',
        'earned_point',
        'membership_card_type'
    ];
}
