<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PartialPayment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = "partial_payments";
}
