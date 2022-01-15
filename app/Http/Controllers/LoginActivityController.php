<?php

namespace App\Http\Controllers;

use App\LoginActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginActivities = LoginActivity::whereUserId(auth()->user()->id)->latest()->paginate(10);
        return view('login-activity', compact('loginActivities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function forceLogout()
    {
        $userAuth=Auth::logout();
        if($userAuth)
        {
            
        }
        else
        {
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoginActivity  $loginActivity
     * @return \Illuminate\Http\Response
     */
    public function show(LoginActivity $loginActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoginActivity  $loginActivity
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginActivity $loginActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoginActivity  $loginActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginActivity $loginActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoginActivity  $loginActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginActivity $loginActivity)
    {
        //
    }
}
