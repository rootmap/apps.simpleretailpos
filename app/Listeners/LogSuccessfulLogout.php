<?php

namespace App\Listeners;

use App\LoginActivity;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
    public function handle(Logout $event)
    {
        $user_id=\Auth::user()->id;
        $user_type=\Auth::user()->user_type;
        $store_id=\Auth::user()->store_id;
        $today=\Carbon\Carbon::now()->format('Y-m-d');
        $time=\Carbon\Carbon::now()->format('H:i:s');
        $user_name=\Auth::user()->name;

        $tab=new LoginActivity;
        $tab->user_id=$user_id;
        $tab->store_id=$store_id;
        $tab->name=$user_name;
        $tab->activity="Logout Successfully";
        $tab->activity_type="auth";
        $tab->ip_address=\Request::ip();
        $tab->user_agent=\Request::server('HTTP_USER_AGENT');
        $tab->save();
    }
}
