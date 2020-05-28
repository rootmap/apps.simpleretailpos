<?php

namespace App\Listeners;
use App\LoginActivity;
use App\CashierPunch;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
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

        

        /*$chk=CashierPunch::where('user_id',$user_id)->where('in_date',$today)->count();
        if($chk<1)
        {
            $punch=new CashierPunch;
            $punch->user_id=$user_id;
            $punch->name=$user_name;
            $punch->user_type=$user_type;
            $punch->in_date=$today;
            $punch->in_time=$time;
            $punch->store_id=$store_id;
            $punch->save();
        }
        else
        {
            $punch=CashierPunch::where('user_id',$user_id)->where('in_date',$today)->first();
            $punch->out_date=$today;
            $punch->out_time=$time;
            $punch->save();
        }
*/
    }
}
