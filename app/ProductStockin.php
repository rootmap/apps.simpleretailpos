<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductStockin extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
