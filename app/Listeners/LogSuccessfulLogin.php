<?php

namespace App\Listeners;

use App\LoginActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user_id=\Auth::user()->id;
        $user_type=\Auth::user()->user_type;
        $user_name=\Auth::user()->name;
        $store_id=\Auth::user()->store_id;
        $today=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i:s');

        $tab=new LoginActivity;
        $tab->user_id=$user_id;
        $tab->store_id=$store_id;
        $tab->name=$user_name;
        $tab->activity="Login Successfully";
        $tab->activity_type="auth";
        $tab->ip_address=\Request::ip();
        $tab->user_agent=\Request::server('HTTP_USER_AGENT');
        $tab->save();
    }
}
