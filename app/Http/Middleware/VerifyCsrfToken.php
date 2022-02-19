<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
                            'loyalty/users/Assign-to-Membership-program',
                            'loyalty/users/cash-withdrawal',
                            'loyalty/users/query-balance',
                            'loyalty/add-invoices'
                        ];
}
