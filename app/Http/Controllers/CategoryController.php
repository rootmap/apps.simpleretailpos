<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Category Info ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        if(Auth::user()->user_type==1)
        {
            $tab=Category::all();
        }
        else
        {
            $tab=Category::where('store_id',$this->sdc->storeID())->get();
        }
        
        return view('apps.pages.settings.category',['dataTable'=>$tab]);
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
        $this->validate($request,[
            'name'=>'required',
        ]);


        $tab=new Category;
        $tab->name=$request->name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("category",$this->moduleName." created");
        return redirect('category')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,$id=0)
    {
        $tab=$category::find($id);
        $tabData=$category::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.settings.category',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,$id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $tab=$category::find($id);
        $tab->name=$request->name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("category",$this->moduleName." updated");
        return redirect('category')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id=0)
    {
        $tab=$category::find($id);
        $tab->delete();
        $this->sdc->log("category",$this->moduleName." deleted");
        return redirect('category')->with('status', $this->moduleName.' Deleted Successfully !');
    }
}
