<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Department ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
       
            $role=\DB::table('departments')
                     ->select('departments.id','departments.name')
                     ->get();
            return view('apps.pages.SupportTicket.department',['role'=>$role]);
        
        //dd($role);
        
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
            'name'=>'required'
         ]);

        $tab=new Department;
        $tab->name=$request->name;
        $tab->store_id=$this->sdc->storeID();        
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("Department","Department Name created");
        return redirect('Department')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department,$id=0)
    {
        $tab=\DB::table('departments')->find($id);
            $tabData=\DB::table('departments')
                        ->select('departments.id','departments.name')
                        ->get();
            return view('apps.pages.SupportTicket.department',['dataRow'=>$tab,'role'=>$tabData,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department,$id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        
            \DB::table('departments')
                ->where('id',$id)
                ->update(['name'=>$request->name,'updated_by'=>$this->sdc->UserID()]);

        
        
        $this->sdc->log("Departments","Departments name updated");
        return redirect('Department')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department,$id=0)
    {
        if($id==1)
        {
            $this->sdc->log("Department","Department name Failed to deleted (Super Admin)");
            return redirect('Department')->with('error', $this->moduleName.' Super Admin not deleteable.');
        }
        else
        {
            $tab=\DB::table('departments')->where('id',$id)->delete();
            $this->sdc->log("Department","Department name deleted");
            return redirect('Department')->with('status', $this->moduleName.' Deleted Successfully !');
        }
    }
}
