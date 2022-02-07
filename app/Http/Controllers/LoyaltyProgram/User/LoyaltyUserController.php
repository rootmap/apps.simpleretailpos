<?php

namespace App\Http\Controllers\LoyaltyProgram\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequest;
use App\Model\Loyalty\LoyaltyUser;

class LoyaltyUserController extends Controller
{


    public function __construct(LoyaltyUser $user)
    {
        $this->model = $user;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign(LoyaltyUserRequest $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchase(LoyaltyUserRequest $request, $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cashWithdraw(LoyaltyUserRequest $request, $id)
    {
        //
    }

}
