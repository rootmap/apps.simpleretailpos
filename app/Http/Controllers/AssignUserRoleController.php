<?php

namespace App\Http\Controllers;

use App\AssignUserRole;
use Illuminate\Http\Request;

class AssignUserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Assign User Role ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $role=\DB::table('assign_user_roles')->where('store_id',$this->sdc->storeID())->get();
        $roleList=\DB::table('roles')->where('store_id',$this->sdc->storeID())->get(); 
        $userList=\DB::table('users')->where('store_id',$this->sdc->storeID())->get(); 
        return view('apps.pages.role.AssignUserRole',['role'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\AssignUserRole  $assignUserRole
     * @return \Illuminate\Http\Response
     */
    public function show(AssignUserRole $assignUserRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AssignUserRole  $assignUserRole
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignUserRole $assignUserRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AssignUserRole  $assignUserRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignUserRole $assignUserRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AssignUserRole  $assignUserRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignUserRole $assignUserRole)
    {
        //
    }
}
