<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ForceSSL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment() === 'production') {

            return redirect()->secure($request->getRequestUri());
        }
        elseif (!$request->secure() && App::environment() === 'local') {

            return redirect()->secure(str_replace("simpleretailpos/public/","",$request->getRequestUri()));
        }

        return $next($request);
    }
}
