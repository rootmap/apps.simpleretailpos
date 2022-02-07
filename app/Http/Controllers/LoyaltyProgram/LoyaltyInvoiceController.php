<?php

namespace App\Http\Controllers\LoyaltyProgram;

use App\Http\Controllers\Controller;
use App\Model\Loyalty\LoyaltyInvoice;

class LoyaltyInvoiceController extends Controller
{

    public function __construct(LoyaltyInvoice $user)
    {
        $this->model = $user;

    }


    public function index()
    {

    }
}
