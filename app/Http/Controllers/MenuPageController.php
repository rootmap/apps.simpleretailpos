<?php

namespace App\Http\Controllers;

use App\MenuPage;
use Illuminate\Http\Request;

class MenuPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="System Menu ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=\DB::table('menu_pages')->orderBy('id','DESC')->get();

        $tabParent=$this->parentMenus();
        return view('apps.pages.role.menu-item',['dataTable'=>$tab,'dataTableParent'=>$tabParent]);
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

    public function parentMenus()
    {
        $tab=\DB::table('menu_pages as mp')->select('mp.id','mp.name',\DB::Raw("(SELECT count(dd.id) FROM lsp_menu_pages as dd WHERE dd.parent_id=lsp_mp.id) as total"))->where('mp.is_parent',1)->get();

        return $tab;
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
            'name'=>'required',
            'menu_type'=>'required',
        ]);

        $menu_type=$request->menu_type;

        $is_parent=0;
        if($menu_type==1)
        {
            $is_parent=1;
        }

        $parent_id=0;
        if($menu_type==2)
        {
            $parent_id=$request->parent_id;
        }

        $tab=new MenuPage;
        $tab->name=$request->name;
        $tab->url=$request->url;
        $tab->is_parent=$is_parent;
        $tab->parent_id=$parent_id;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("System Menu","System Menu created");
        return redirect('menu-item')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuPage  $menuPage
     * @return \Illuminate\Http\Response
     */
    public function show(MenuPage $menuPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuPage  $menuPage
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        
        $tab=\DB::table('menu_pages')->find($id);
        //dd($tab);
        $tabParent=$this->parentMenus();
        $tabData=\DB::table('menu_pages')->where('store_id',$this->sdc->storeID())->get();
        //dd($tabData);
        return view('apps.pages.role.menu-item',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true,'dataTableParent'=>$tabParent]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuPage  $menuPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuPage $menuPage,$id=0)
    {
        $this->validate($request,[
            'name'=>'required',
            'menu_type'=>'required',
        ]);

        $menu_type=$request->menu_type;

        $is_parent=0;
        if($menu_type==1)
        {
            $is_parent=1;
        }

        $parent_id=0;
        if($menu_type==2)
        {
            $parent_id=$request->parent_id;
        }

        \DB::table('menu_pages')->where('id',$id)->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'is_parent'=>$is_parent,
            'parent_id'=>$parent_id,
            'updated_by'=>$this->sdc->UserID()
        ]);

        $this->sdc->log("System Menu","System Menu Updated");
        return redirect('menu-item')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuPage  $menuPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuPage $menuPage,$id=0)
    {
        $tab=\DB::table('menu_pages')->where('id',$id)->delete();
        $this->sdc->log("System Menu","System Menu deleted");
        return redirect('menu-item')->with('status', $this->moduleName.' Deleted Successfully !');
    }
}
