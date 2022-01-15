<?php

namespace App\Http\Controllers;

use App\RoleWiseMenu;
use App\Role;
use Illuminate\Http\Request;
use Auth;
class RoleWiseMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Role Wise Menu ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        
        $role=\DB::table('roles')->orderBy('id','ASC')->get();
        
        $menus=$this->parentMenus();
        // dd($role);
        return view('apps.pages.role.RoleWiseMenu',['role'=>$role,'menus'=>$menus]);
    }

    public function parentMenus()
    {
        $tab=\DB::table('menu_pages as mp')->select('mp.id','mp.name',\DB::Raw("(SELECT count(dd.id) FROM lsp_menu_pages as dd WHERE dd.parent_id=lsp_mp.id) as total"))
                ->where('mp.is_parent',1)
                //->where('mp.store_id',$this->sdc->storeID())
                ->get();
        $dataTab=[];
        if(count($tab)>0)
        {
            
            foreach($tab as $row)
            {
                $submenu=[];
                if($row->total>0)
                {
                    $submenu=\DB::table('menu_pages as mp')
                                ->select('mp.id','mp.name')
                                ->where('mp.parent_id',$row->id)
                                //->where('mp.store_id',$this->sdc->storeID())
                                ->get();
                }

                $dataTab[]=array(
                    'id'=>$row->id,
                    'name'=>$row->name,
                    'total'=>$row->total,
                    'submenu'=>$submenu,
                    );
            }
        }

        //dd($dataTab);

        return $dataTab;
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

    public function showAjax(Request $request)
    {
        $tab=\DB::table('role_wise_menus')
                ->where('role_id',$request->role_id)
                //->where('store_id',$this->sdc->storeID())
                ->get();
        $tabCount=\DB::table('role_wise_menus')
                    ->where('role_id',$request->role_id)
                    //->where('store_id',$this->sdc->storeID())
                    ->count();
        $dataarray=array('total'=>$tabCount,'datas'=>$tab);
        return response()->json($dataarray);
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
            'role_id'=>'required'
        ]);

        $count=count($request->menu_id);
        \DB::table('role_wise_menus')
            ->where('role_id',$request->role_id)
            ->delete();
        foreach($request->menu_id as $menu)
        {
            $tab=new RoleWiseMenu;
            $tab->role_id=$request->role_id;
            $tab->menu_id=$menu;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }

        if($count>0)
        {
            $this->sdc->log("Role Wise Menu Setting","Role Wise Menu Setting created");
            return redirect('RoleWiseMenu')->with('status', $this->moduleName.' Added Successfully !');
        }
        else
        {
            $this->sdc->log("Role Wise Menu Setting","Role Wise Menu Setting failed to create due to empty menu select.");
            return redirect('RoleWiseMenu')->with('error', $this->moduleName.' failed to create, please try again');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoleWiseMenu  $roleWiseMenu
     * @return \Illuminate\Http\Response
     */
    public function show(RoleWiseMenu $roleWiseMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoleWiseMenu  $roleWiseMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleWiseMenu $roleWiseMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoleWiseMenu  $roleWiseMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleWiseMenu $roleWiseMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoleWiseMenu  $roleWiseMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleWiseMenu $roleWiseMenu)
    {
        //
    }
}
