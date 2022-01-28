<?php

namespace App\Http\Controllers;

use App\PosSetting;
use App\InvoiceLayoutOne;
use App\InvoiceLayoutTwo;
use App\Customer;
use Illuminate\Http\Request;

class PosSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="POS Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $store_id=$this->sdc->storeID();
        $user_id=$this->sdc->UserID();
        $InvoiceLayout=1;
        $countInvoiceLayout=PosSetting::where('store_id',$store_id)->count();
        if($countInvoiceLayout<1)
        {
            $tab=new PosSetting;
            $tab->invoice_layout="1";
            $tab->pos_item="16";
            $tab->sales_tax="3.00";
            $tab->sales_discount="5.00";
            $tab->discount_type="2";
            $tab->store_id=$store_id;
            $tab->created_by=$user_id;
            $tab->save();
            $InvoiceLayout=$tab->invoice_layout;
        }

        $ps=PosSetting::where('store_id',$store_id)->orderBy("id","DESC")->first();

            return view('apps.pages.settings.pos',['ps'=>$ps]);
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

    public function invoiceLayoutSave(Request $request,$id)
    {

        $destinationPath = './company';
        if($id==1)
        {
            $logo=$request->ex_logo;
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $logo = time().'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $logo);  
                if(!empty($request->ex_logo))
                {
                    @unlink($destinationPath."/".$request->ex_logo); 
                }                   
            }

            $logo_fotter=$request->ex_logo_fotter;
            if ($request->hasFile('logo_fotter')) {
                $fotimage = $request->file('logo_fotter');
                $logo_fotter = time().'f.'.$fotimage->getClientOriginalExtension();
                $fotimage->move($destinationPath, $logo_fotter);
                if(!empty($request->ex_logo_fotter))
                {
                    @unlink($destinationPath."/".$request->ex_logo_fotter); 
                }              
            }


            $tabCheck=InvoiceLayoutOne::where('store_id',$this->sdc->storeID())->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutOne;
                $tab->store_id=$this->sdc->storeID();
                $tab->company_name=$request->company_name;
                $tab->company_thank_you_message=$request->company_thank_you_message;
                $tab->company_services=$request->company_services;
                $tab->logo=$logo;
                $tab->logo_fotter=$logo_fotter;
                $tab->mm_one=$request->mm_one;
                $tab->mm_two=$request->mm_two;
                $tab->mm_three=$request->mm_three;
                $tab->mm_four=$request->mm_four;
                $tab->fotter_company_name=$request->fotter_company_name;
                $tab->c_one=$request->c_one;
                $tab->c_two=$request->c_two;
                $tab->c_three=$request->c_three;
                $tab->c_four=$request->c_four;
                $tab->c_five=$request->c_five;
                $tab->c_six=$request->c_six;
                $tab->terms=$request->terms;
                $tab->save();
            }
            else
            {
                $tab=InvoiceLayoutOne::where('store_id',$this->sdc->storeID())->first();
                $tab->store_id=$this->sdc->storeID();
                $tab->company_name=$request->company_name;
                $tab->company_thank_you_message=$request->company_thank_you_message;
                $tab->company_services=$request->company_services;
                $tab->logo=$logo;
                $tab->logo_fotter=$logo_fotter;
                $tab->mm_one=$request->mm_one;
                $tab->mm_two=$request->mm_two;
                $tab->mm_three=$request->mm_three;
                $tab->mm_four=$request->mm_four;
                $tab->fotter_company_name=$request->fotter_company_name;
                $tab->c_one=$request->c_one;
                $tab->c_two=$request->c_two;
                $tab->c_three=$request->c_three;
                $tab->c_four=$request->c_four;
                $tab->c_five=$request->c_five;
                $tab->c_six=$request->c_six;
                $tab->terms=$request->terms;
                $tab->save();
            }

            return redirect('pos/settings/invoice/'.$request->id)->with('status','Invoice Info Saved Successfully !'); 
        }
        elseif($id==2)
        {
            $logo=$request->ex_logo;
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $logo = time().'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $logo);  
                if(!empty($request->ex_logo))
                {
                    @unlink($destinationPath."/".$request->ex_logo); 
                }                   
            }

            


            $tabCheck=InvoiceLayoutTwo::where('store_id',$this->sdc->storeID())->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutTwo;
                $tab->store_id=$this->sdc->storeID();
                $tab->company_name=$request->company_name;
                $tab->company_thank_you_message=$request->company_thank_you_message;
                $tab->address=$request->address;
                $tab->city=$request->city;
                $tab->state=$request->state;
                $tab->country=$request->country;
                $tab->logo=$logo;
                $tab->mm_one=$request->mm_one;
                $tab->mm_two=$request->mm_two;
                $tab->mm_three=$request->mm_three;
                $tab->mm_four=$request->mm_four;
                $tab->terms=$request->terms;
                $tab->save();
            }
            else
            {
                $tab=InvoiceLayoutTwo::where('store_id',$this->sdc->storeID())->first();
                $tab->store_id=$this->sdc->storeID();
                $tab->company_name=$request->company_name;
                $tab->company_thank_you_message=$request->company_thank_you_message;
                $tab->address=$request->address;
                $tab->city=$request->city;
                $tab->state=$request->state;
                $tab->country=$request->country;
                $tab->logo=$logo;
                $tab->mm_one=$request->mm_one;
                $tab->mm_two=$request->mm_two;
                $tab->mm_three=$request->mm_three;
                $tab->mm_four=$request->mm_four;
                $tab->terms=$request->terms;
                $tab->save();
            }

            return redirect('pos/settings/invoice/'.$request->id)->with('status', 'Invoice Info Saved Successfully !'); 
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
        $sales_tax=$request->sales_tax?$request->sales_tax:0;
        $sales_discount=$request->sales_discount?$request->sales_discount:0;
        $pos_item=$request->pos_item?$request->pos_item:0;
        $invoice_layout=$request->invoice_layout?$request->invoice_layout:0;
        $discount_type=$request->discount_type?$request->discount_type:0;

        $tab=new PosSetting;
        $tab->pos_item=$pos_item;
        $tab->sales_tax=$sales_tax;
        $tab->invoice_layout=$invoice_layout;
        $tab->sales_discount=$sales_discount;
        $tab->discount_type=$discount_type;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("sales","POS settings created.");

        return redirect('pos/settings')->with('status', $this->moduleName.' Info Saved Successfully !'); 
        
    }

    public function invoiceLayout($id=0)
    {
        $customer=Customer::first();
        if($id==1)
        {
            $tabCheck=InvoiceLayoutOne::where('store_id',$this->sdc->storeID())->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutOne;
                $tab->store_id=$this->sdc->storeID();
                $tab->save();
            }
            $tabData=InvoiceLayoutOne::where('store_id',$this->sdc->storeID())->first();
            return view('apps.pages.invoice_layout.layout_one',['customer'=>$customer,'id'=>$id,'edit'=>$tabData]);
        }
        elseif($id==2)
        {
            $tabCheck=InvoiceLayoutTwo::where('store_id',$this->sdc->storeID())->count();
            if($tabCheck==0)
            {
                $tab=new InvoiceLayoutTwo;
                $tab->store_id=$this->sdc->storeID();
                $tab->save();
            }
            $tabData=InvoiceLayoutTwo::where('store_id',$this->sdc->storeID())->first();
            return view('apps.pages.invoice_layout.layout_two',['customer'=>$customer,'id'=>$id,'edit'=>$tabData]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function show(PosSetting $posSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(PosSetting $posSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSetting $posSetting,$id=0)
    {
        $sales_tax=$request->sales_tax?$request->sales_tax:0;
        $sales_discount=$request->sales_discount?$request->sales_discount:0;
        $pos_item=$request->pos_item?$request->pos_item:0;
        $invoice_layout=$request->invoice_layout?$request->invoice_layout:0;
        $discount_type=$request->discount_type?$request->discount_type:0;
        $vt_item_name=$request->vt_item_name;

        $tab=$posSetting::find($id);
        $tab->pos_item=$pos_item;
        $tab->vt_item_name=$vt_item_name;
        $tab->sales_tax=$sales_tax;
        $tab->invoice_layout=$invoice_layout;
        $tab->sales_discount=$sales_discount;
        $tab->discount_type=$discount_type;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("sales","POS settings updated.");
        return redirect('pos/settings')->with('status', $this->moduleName.' Info Modified Successfully !'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSetting $posSetting)
    {
        //
    }
}
