<?php

namespace App\Http\Controllers;

use App\Store;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Tender;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Store-Shop ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        $tab=Store::all();
        // dd($tab);
        return view('apps.pages.store.list',['dataTable'=>$tab]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $NewStoreIDCount=Store::OrderBy('id','DESC')->count();
        if($NewStoreIDCount==0)
        {
            $NewStoreID=1;
        }
        else
        {
            $NewStoreIDSQL=Store::select('id')->OrderBy('id','DESC')->first();
            $NewStoreIDParse=$NewStoreIDSQL->id;
            $NewStoreID=$NewStoreIDParse+1;
        }

        $userID=Auth::user()->id;
        //dd($userID);

        $genAutoStID=$NewStoreID.''.$userID;



/*        \DB::statement("INSERT INTO lsp_roles (name, store_id, created_by)
                        SELECT * FROM (SELECT name, '2' as store_id, '".$this->sdc->UserID()."' as created_by FROM lsp_roles WHERE id!='1') AS tmp
                        WHERE NOT EXISTS (
                            SELECT name FROM lsp_roles WHERE store_id = '2'
                        )");
*/
        return view('apps.pages.store.index',['store_id'=>$genAutoStID]);

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
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'store_id'=>'required|unique:stores|max:255',
        ]);

        $is_loyalty_program=$request->is_loyalty_program?1:0;

        $tab=new Store;
        $tab->name=$request->name;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->store_id=$request->store_id;
        $tab->is_loyalty_program=$is_loyalty_program;
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        
        $loyaltyTender="Loyalty Points";
        $checkLoyaltyTender=Tender::where('store_id',$request->store_id)->where('name',$loyaltyTender)->count();
        //dd($checkLoyaltyTender);
        if($checkLoyaltyTender==0)
        {

            $tab_tender=new Tender;
            $tab_tender->name=$loyaltyTender;
            $tab_tender->store_id=$request->store_id;
            $tab_tender->tender_class='customer_loyalty';
            $tab_tender->created_by=$this->sdc->UserID();
            $tab_tender->save();
        }



        
        /*\DB::statement("INSERT INTO lsp_roles (name, store_id, created_by)
                        SELECT * FROM (SELECT name, '".$request->store_id."' as store_id, '".$this->sdc->UserID()."' as created_by FROM lsp_roles WHERE id!='1') AS tmp
                        WHERE NOT EXISTS (
                            SELECT name FROM lsp_roles WHERE store_id = '".$request->store_id."'
                        )");*/
        /*//Store Admin
        $RolesStoreAdminNewIDSQL=\DB::table('roles')
                                    ->select('id')
                                    ->where('name','Shop Admin')
                                    ->where('store_id',$request->store_id)
                                    ->first();
        $RolesStoreAdminNewID=$RolesStoreAdminNewIDSQL->id;
        \DB::statement("INSERT INTO lsp_role_wise_menus (role_id,menu_id, store_id, created_by)
                        SELECT * FROM (SELECT '".$RolesStoreAdminNewID."' as role_id,menu_id, '".$request->store_id."' as store_id, '".$this->sdc->UserID()."' as created_by FROM lsp_role_wise_menus WHERE role_id='4') AS tmp
                        WHERE NOT EXISTS (
                            SELECT menu_id FROM lsp_role_wise_menus WHERE store_id = '".$request->store_id."' AND  role_id='".$RolesStoreAdminNewID."'
                        )");

        //StoreManager
        $RolesStoreManagerNewIDSQL=\DB::table('roles')
                                    ->select('id')
                                    ->where('name','Store Manager')
                                    ->where('store_id',$request->store_id)
                                    ->first();
        $RolesStoreManagerNewID=$RolesStoreManagerNewIDSQL->id;
        \DB::statement("INSERT INTO lsp_role_wise_menus (role_id,menu_id, store_id, created_by)
                        SELECT * FROM (SELECT '".$RolesStoreManagerNewID."' as role_id,menu_id, '".$request->store_id."' as store_id, '".$this->sdc->UserID()."' as created_by FROM lsp_role_wise_menus WHERE role_id='2') AS tmp
                        WHERE NOT EXISTS (
                            SELECT menu_id FROM lsp_role_wise_menus WHERE store_id = '".$request->store_id."' AND  role_id='".$RolesStoreManagerNewID."'
                        )");

        //Cashier
        $RolesCashierNewIDSQL=\DB::table('roles')
                                    ->select('id')
                                    ->where('name','Cashier')
                                    ->where('store_id',$request->store_id)
                                    ->first();
        $RolesCashierNewID=$RolesCashierNewIDSQL->id;
        \DB::statement("INSERT INTO lsp_role_wise_menus (role_id,menu_id, store_id, created_by)
                        SELECT * FROM (SELECT '".$RolesCashierNewID."' as role_id,menu_id, '".$request->store_id."' as store_id, '".$this->sdc->UserID()."' as created_by FROM lsp_role_wise_menus WHERE role_id='3') AS tmp
                        WHERE NOT EXISTS (
                            SELECT menu_id FROM lsp_role_wise_menus WHERE store_id = '".$request->store_id."' AND  role_id='".$RolesCashierNewID."'
                        )");*/
        $this->sdc->log("Store","Store info created.");

        return redirect('store-shop/list')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tab=Store::find($id);
        return view('apps.pages.store.index',['edit'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        $is_loyalty_program=$request->is_loyalty_program?1:0;

        $tab=Store::find($id);
        $tab->name=$request->name;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->is_loyalty_program=$is_loyalty_program;
        $tab->store_id=$request->store_id;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        $loyaltyTender="Loyalty Points";
        $checkLoyaltyTender=Tender::where('store_id',$request->store_id)->where('name',$loyaltyTender)->count();
        //dd($checkLoyaltyTender);
        if($checkLoyaltyTender==0)
        {

            $tab_tender=new Tender;
            $tab_tender->name=$loyaltyTender;
            $tab_tender->store_id=$request->store_id;
            $tab_tender->tender_class='customer_loyalty';
            $tab_tender->created_by=$this->sdc->UserID();
            $tab_tender->save();
        }
        

        
        $this->sdc->log("Store","Store info updated.");

        return redirect('store-shop/list')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tab=Store::find($id);
        $tab->delete();
        $this->sdc->log("Store","Store account deleted.");

        return redirect('store-shop/list')->with('status', $this->moduleName.' Deleted Successfully !');
    }

    public function storeInfo(Request $request)
    {
        $id=$this->sdc->storeID();
        $tab=Store::where('store_id',$id)->first();
        return view('apps.pages.user_info.index',['edit'=>$tab,'store_id'=>$id]);
    }
}
