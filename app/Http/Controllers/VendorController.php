<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Vendor";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index()
    {
        return view('apps.pages.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('apps.pages.vendor.vendor');
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
        'email'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zip'=>'required',
        'notes'=>'required',
        'website'=>'required'

    ]);

       $vendorInfo=new Vendor;
       $vendorInfo->name=$request->name;
       $vendorInfo->email=$request->email;
       $vendorInfo->phone=$request->phone;
       $vendorInfo->address=$request->address;
       $vendorInfo->city=$request->city;
       $vendorInfo->state=$request->state;
       $vendorInfo->zip=$request->zip;
       $vendorInfo->notes=$request->notes;
       $vendorInfo->website=$request->website;
       $vendorInfo->store_id=$this->sdc->storeID();
       $vendorInfo->save();
       return redirect('vendor/create')->with('status','Saved Successfully');
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {


       $vendorInfo=Vendor::where('store_id',$this->sdc->storeID())->take(100)->orderBy('id','DESC')->get();
       return view('apps.pages.vendor.list',['dataTable'=>$vendorInfo]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor,$id)
    {
        $vendorInfo=Vendor::find($id);
        return view('apps.pages.vendor.vendor',['dataRow'=>$vendorInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor,$id)
    {
       $this->validate($request,[
        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'zip'=>'required',
        'notes'=>'required',
        'website'=>'required'

    ]);

       $vendorInfo=Vendor::find($id);
       $vendorInfo->name=$request->name;
       $vendorInfo->email=$request->email;
       $vendorInfo->phone=$request->phone;
       $vendorInfo->address=$request->address;
       $vendorInfo->city=$request->city;
       $vendorInfo->state=$request->state;
       $vendorInfo->zip=$request->zip;
       $vendorInfo->notes=$request->notes;
       $vendorInfo->website=$request->website;
       $vendorInfo->store_id=$this->sdc->storeID();
       $vendorInfo->save();
       return redirect('vendor/list')->with('status','Updated Successfully');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor,$id)
    {
       $vendorInfo=Vendor::find($id);
       $vendorInfo->delete();
       return redirect('vendor/list')->with('status','Deleted Successfully');
   }
}
