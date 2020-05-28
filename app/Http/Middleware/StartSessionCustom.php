<?php
namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;
use Illuminate\Http\Request;
use Closure;

class StartSessionCustom extends StartSession
{

    protected $init_cookie = false;
    public function handle($request, Closure $next)
    {
        $this->sessionHandled = true;
        if ($this->sessionConfigured()) {
          $session = $this->startSession($request);
          $request->setSession($session);
          /*CUSTOM CODE STARTS HERE */
          \Session::forget('init_cookie');
          if($this->init_cookie){
            session( [ 'init_cookie' => 1 ] );
          }
          /* CUSTOM CODE ENDS HERE */
          $this->collectGarbage($session);
        }
        $response = $next($request);
        if ($this->sessionConfigured()) {
          $this->storeCurrentUrl($request, $session);
          $this->addCookieToResponse($response, $session);
        }
        return $response;
    }
    public function getSession(Request $request)
    {
        $session = $this->manager->driver();
        /*CUSTOM CODE STARTS HERE */
        if( $request->has('ck') )
        {
            $session->setId( \Crypt::decrypt($request->ck) );
        }
        else
        {
            $cookie_from_request = $request->cookies->get($session->getName());
            if( empty($cookie_from_request) ){
                $this->init_cookie = true;
            }
            $session->setId($cookie_from_request);
        }
        /*CUSTOM CODE ENDS HERE */
        return $session;
    }
}