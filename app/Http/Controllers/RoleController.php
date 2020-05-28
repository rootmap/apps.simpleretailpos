<?php

namespace App\Http\Controllers;

use App\Role;
use App\Store;
use Illuminate\Http\Request;
use Auth;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Role";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
       
            $role=\DB::table('roles')
                     ->select('roles.id','roles.name')
                     ->get();
            return view('apps.pages.role.role',['role'=>$role]);
        
        //dd($role);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'name'=>'required'
         ]);

        $tab=new Role;
        $tab->name=$request->name;
        $tab->store_id=$this->sdc->storeID();        
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("Role","Role Type created");
        return redirect('role')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //$tab=$tender::where('store_id',$this->sdc->storeID())->get();
        //return view('apps.pages.tender.list',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role,$id=0)
    {
            $tab=\DB::table('roles')->find($id);
            $tabData=\DB::table('roles')
                        ->select('roles.id','roles.name')
                        ->get();
            return view('apps.pages.role.role',['dataRow'=>$tab,'role'=>$tabData,'edit'=>true]);        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role,$id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        
            \DB::table('roles')
                ->where('id',$id)
                ->update(['name'=>$request->name,'updated_by'=>$this->sdc->UserID()]);

        
        
        $this->sdc->log("Role","Role name updated");
        return redirect('role')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,$id=0)
    {
        if($id==1)
        {
            $this->sdc->log("Role","Role name Failed to deleted (Super Admin)");
            return redirect('role')->with('error', $this->moduleName.' Super Admin not deleteable.');
        }
        else
        {
            $tab=\DB::table('roles')->where('id',$id)->delete();
            $this->sdc->log("Role","Role name deleted");
            return redirect('role')->with('status', $this->moduleName.' Deleted Successfully !');
        }
        
    }
}
