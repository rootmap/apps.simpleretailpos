<?php
namespace App\Http\Controllers\LoyaltyProgram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }
}
