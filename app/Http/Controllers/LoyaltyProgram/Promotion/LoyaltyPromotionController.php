<?php

namespace App\Http\Controllers\LoyaltyProgram\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loyalty\LoyaltyPromotionalProgramRequest;
use App\Model\Loyalty\LoyaltyPromotionalProgram;

class LoyaltyPromotionController extends Controller
{

    public function __construct(LoyaltyPromotionalProgram $promotion)
    {
        $this->model = $promotion;

    }

    public function store(LoyaltyPromotionalProgramRequest $request)
    {


    }

    public function show()
    {


    }

    public function extend(LoyaltyPromotionalProgramRequest $request)
    {

    }

    public function delete()
    {


    }
}
