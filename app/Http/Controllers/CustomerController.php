<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Role;
use App\User;
use App\Store;
use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use Illuminate\Http\Request;
use App\Invoice;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\StaticDataController;
use App\Http\Controllers\LoyaltyProgram\User\LoyaltyUserController;
use App\Http\Requests\Loyalty\User\LoyaltyUserRequestNew;
use App\Services\Loyalty\LoyaltyService;


use Excel;
use Auth;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    private $moduleName="Customer";
    private $sdc;
    public function __construct(LoyaltyUserController $loyaltyProgram, StaticDataController $sdc){ 
        $this->loyalty = $loyaltyProgram;
        $this->sdc = $sdc;
    }

    public function user()
    {
        if(Auth::user()->user_type==1)
        {
            $storeList = Store::all();
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',1)->orderBy('id','DESC')->get();
        }
        elseif(Auth::user()->user_type==2)
        {
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',2)->orderBy('id','DESC')->get();
        }
        else
        {
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',3)->get();
        }

        if(Auth::user()->user_type==1)
        {
            return view('apps.pages.user.index',['role'=>$role,'storeList'=>$storeList]);
        }
        else
        {
            return view('apps.pages.user.index',['role'=>$role]);
        }
        
    }

    public function getCustomer($id=0)
    {
        $cus=array();
        if($id>0)
        {
            $tab=Customer::find($id);
            $cus=$tab;
        }
        return response()->json($cus);
    }

    public function userList()
    {
        if(Auth::user()->user_type==1)
        {
            $user = User::leftjoin('roles','users.user_type','=','roles.id')
                        ->select('users.*','roles.name as user_type_name')
                        //->where('users.store_id',$this->sdc->storeID())
                        ->get();
        }
        else
        {
            $user = User::leftjoin('roles','users.user_type','=','roles.id')
                        ->select('users.*','roles.name as user_type_name')
                        ->where('users.store_id',$this->sdc->storeID())->get();
        }
        return view('apps.pages.user.userlist',['dataTable'=>$user]);
    }

    public function userSave(Request $request)
    {

       if(Auth::user()->user_type==1)
        {
           $this->validate($request,[
                'user_type'=>'required',
                'store_id'=>'required',
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email'=>'required|string|email|max:255',
                'password' => 'min:4',
                'password_confirmation' => 'required_with:password|same:password|min:4'
            ]);
        }
        else
        {
           $this->validate($request,[
                'user_type'=>'required',
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email'=>'required|string|email|max:255',
                'password' => 'min:4',
                'password_confirmation' => 'required_with:password|same:password|min:4'
            ]); 
        }


        $tab=new User;
        $tab->name=$request->name;
        $tab->user_type=$request->user_type;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->password = \Hash::make($request->password);
        $tab->remember_token=$request->_token;
        if(Auth::user()->user_type==1)
        {
            $tab->store_id=$request->store_id;
        }
        else
        {
            $tab->store_id=$this->sdc->storeID();
        }
        
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        if(Auth::user()->user_type==1)
        {
            $this->sdc->log("User","User account created for shop #".$tab->store_id.".");
        }
        else
        {
            $this->sdc->log("User","User account created.");
        }
        

        return redirect('user')->with('status', $this->moduleName.' Added Successfully !');
    }
    public function UserShow($id)
    {
        
        
        $edit = User::find($id);
        if(Auth::user()->user_type==1)
        {
            $storeList = Store::all();
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',1)->orderBy('id','DESC')->get();
            return view('apps.pages.user.index',['edit'=>$edit,'role'=>$role,'storeList'=>$storeList]);
        }
        elseif(Auth::user()->user_type==2)
        {
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',2)->orderBy('id','DESC')->get();
            return view('apps.pages.user.index',['edit'=>$edit,'role'=>$role]);
        }
        else
        {
            $role=\DB::table('roles')->select('id','name','store_id')->where('id','>',3)->get();
            return view('apps.pages.user.index',['edit'=>$edit,'role'=>$role]);
        }        
    }

    public function UserEdit(Customer $customer,$id=0)
    {
        $tab=$customer::find($id);
        $tabData=$customer::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.customer.customer',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);

    }

    public function userUpdate(Request $request, $id=0)
    {
        if(Auth::user()->user_type==1)
        {
            $this->validate($request,[
                'user_type'=>'required',
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'store_id' => 'required',
                //'password_confirmation' => 'required_with:password|same:password|min:6'
            ]);


            if(!empty($request->password))
            {
                 $this->validate($request,[
                    'password' => 'min:4',
                    'password_confirmation' => 'required_with:password|same:password|min:4'
                ]);

            }
        }
        else
        {
            $this->validate($request,[
                'user_type'=>'required',
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                //'password' => 'min:6',
                //'password_confirmation' => 'required_with:password|same:password|min:6'
            ]);


            if(!empty($request->password))
            {
                 $this->validate($request,[
                    'password' => 'min:4',
                    'password_confirmation' => 'required_with:password|same:password|min:4'
                ]);

            }
        }

        $tab=User::find($id);
        $tab->name=$request->name;
        $tab->user_type=$request->user_type;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        if(!empty($request->password))
        {
            $tab->password = \Hash::make($request->password);
        }
        $tab->remember_token=$request->_token;
        if(Auth::user()->user_type==1)
        {
            $tab->store_id=$request->store_id;
        }
        else
        {
            $tab->store_id=$this->sdc->storeID();
        }
        
        $tab->created_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("User","User account updated.");
        return redirect('user/list')->with('status', $this->moduleName.' Updated Successfully !');

    }
    public function Userdestroy($id)
    {
        $tab=User::find($id);
        $tab->delete();
        
        $this->sdc->log("User","User account deleted.");

        return redirect('user/list')->with('status', $this->moduleName.' Deleted Successfully !');
    }
    public function index()
    {
        $tab=Customer::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.customer.customer',['dataTable'=>$tab]);
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
    public function profitQuery($request)
    {
        $invoice=Customer::where('store_id',$this->sdc->storeID())->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $data=array();
        $array_column=array('ID','Invoice ID','Name','Address','Phone','Email');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->last_invoice_no,$voi->name,$voi->address,$voi->phone,$voi->email);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Customer Report";
        $report_title="Customer Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');
        $excelArray=array(
            'report_name'=>$reportName,
            'report_title'=>$report_title,
            'report_description'=>$report_description,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function invoicePDF(Request $request)
    {

        $data=array();      
        $reportName="Customer Report";
        $report_title="Customer Report";
        $report_description="Report Genarated : ".date('d-M-Y H:i:s a');

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Name</th>
                <th class="text-center" style="font-size:12px;" >Address</th>
                <th class="text-center" style="font-size:12px;" >Phone</th>
                <th class="text-center" style="font-size:12px;" >Email</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->last_invoice_no.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->address.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->phone.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->email.'</td>
                        </tr>';

                    endforeach;


                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody>
                
                </table>


                ';



                $this->sdc->PDFLayout($reportName,$html);


    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);


        $tab=new Customer;
        $tab->name=$request->name;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['customer_quantity' => \DB::raw('customer_quantity + 1')]);
        $Todaydate=date('Y-m-d');
        if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())->count()==0)
        {
            RetailPosSummaryDateWise::insert([
               'report_date'=>$Todaydate,
               'store_id'=>$this->sdc->storeID(),
               'customer_quantity' => \DB::raw('1')
            ]);
        }
        else
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())
            ->update([
               'customer_quantity' => \DB::raw('customer_quantity + 1')
            ]);
        }

        $this->sdc->log("customer","Customer account created.");

        return redirect('customer')->with('status', $this->moduleName.' Added Successfully !');
    }
    public function posCustomerAdd(Request $request)
    {

       //echo "string"; die();
        $tab=new Customer;
        $tab->name=$request->name;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        if(isset($request->customer_loyalty))
        {
            if($request->customer_loyalty==1)
            {
                $customerID = $tab->id;
                $customerInfo=Customer::find($customerID);
                $dataRequest=[
                    "store_id"  =>$this->sdc->storeID(),
                    'user_info' =>[
                        'id'=>$customerInfo->id,
                        'name'=>$customerInfo->name,
                        'email'=>$customerInfo->email,
                        'phone'=>$customerInfo->phone
                    ]
                ];

                $service = new LoyaltyService($dataRequest);
                $service->join();
            }
        }
        
        
        return $tab->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $tab=$customer::where('store_id',$this->sdc->storeID())->take(300)->orderBy('id','DESC')->get();
        return view('apps.pages.customer.list',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id=0)
    {
        $tab=$customer::find($id);
        $tabData=$customer::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.customer.customer',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer,$id=0)
    {

        $this->validate($request,[
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ]);

        $tab=$customer::find($id);
        $tab->name=$request->name;
        $tab->address=$request->address;
        $tab->phone=$request->phone;
        $tab->email=$request->email;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("customer","Customer account updated.");
        return redirect('customer')->with('status', $this->moduleName.' Updated Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id=0)
    {
        $tab=$customer::find($id);
        $invoice_date=date('Y-m-d',strtotime($tab->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)->where('store_id',$this->sdc->storeID())
            ->update([
               'customer_quantity' => \DB::raw('customer_quantity - 1')
            ]);
        }
        RetailPosSummary::where('store_id',$this->sdc->storeID())->update(['customer_quantity' => \DB::raw('customer_quantity - 1')]);
        $tab->delete();
        

        $this->sdc->log("customer","Customer account deleted.");

        return redirect('customer')->with('status', $this->moduleName.' Deleted Successfully !');
    }

    public function importCustomer(){
        return view('apps.pages.customer.import');
    }
    
    public function importCustomerSave(request $request){
        
        $filename="";
        if (!empty($request->file('importfile'))) {

            $arr_file = explode('.', $_FILES['importfile']['name']);
            $extension = end($arr_file);
        
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
    
            $spreadsheet = $reader->load($_FILES['importfile']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $count_insert=0;
            if(isset($sheetData))
            {
                foreach ($sheetData as $key => $row) 
                {
                    if($key>0)
                    {
                        $customer_name=$row[1];
                        $address=$row[2];
                        $phone=$row[3];
                        $email=$row[4];

                        $tab=new Customer;
                        $tab->name=$customer_name;
                        $tab->address=$address;
                        $tab->phone=$phone;
                        $tab->email=$email;
                        $tab->store_id=$this->sdc->storeID();
                        $tab->created_by=$this->sdc->UserID();
                        $tab->save();
                        $count_insert+=1;
                    
                        
                    }
                }
            }

            // $img = $request->file('importfile');
            // $upload = 'upload/customer_import';
            // //$filename=$img->getClientOriginalName();
            // $filename = time() . "." . $img->getClientOriginalExtension();
            // $success = $img->move($upload, $filename);
            // $rows = Excel::load($upload.'/'. $filename)->get();
            // $count_insert=0;
            // if(isset($rows))
            // {
            //     foreach ($rows as $key => $row) 
            //     {
            //         $tab=new Customer;
            //         $tab->name=$row->name;
            //         $tab->address=$row->address;
            //         $tab->phone=$row->phone;
            //         $tab->email=$row->e_mail;
            //         $tab->store_id=$this->sdc->storeID();
            //         $tab->created_by=$this->sdc->UserID();
            //         $tab->save();
            //         $count_insert+=1;
            //     }
            // }

            if($count_insert>0)
            {
                return redirect('customer/import')->with('status', $this->moduleName.' all data ('.$count_insert.') Added Successfully !');
            }
            else
            {
                return redirect('customer/import')->with('error', $this->moduleName.' no record inserted !');
            }
        }
        else
        {

         return redirect('customer/import')->with('error', $this->moduleName.' failed to upload !');
        }
    }
    public function customerReport(request $request, $id=0){
        $tab=customer::find($id);
        $tabData=invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.customer_id',$id)
                     ->get();
        return view('apps.pages.customer.report',['dataCus'=>$tab,'dataTable'=>$tabData]);
        
    }

    public function UserInfoShow(Request $request)
    {
        $id=$this->sdc->UserID();
        $edit = User::leftJoin('roles','users.user_type','=','roles.id')
                    ->leftJoin('stores','users.store_id','=','stores.store_id')
                    ->where('users.id',$id)
                    ->select('users.*','roles.name as role_name','stores.name as store_name')
                    ->first();
        return view('apps.pages.user_info.user_info',['edit'=>$edit]);        
    }


    public function change_password(Request $request)
    {
        return view('apps.pages.user_info.change_password');        
    }

    public function do_change_password(Request $request)
    {

        $this->validate($request, [
            'current_password'=>'required',
            'new_password'=>'required_with:retype_password|same:retype_password',
            'retype_password'=>'required',
        ]);
        $id=$this->sdc->UserID();
        $user_data=User::find($id);
        if(Hash::check($request->current_password,$user_data->password))
        {
            $this->sdc->log("User","User [".$user_data->name."] changed account password.");
            User::find($id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect(url('change-password'))->with('status','Password Changed Successfully.');
        }
        else
        {
            $this->sdc->log("User","User [".$user_data->name."] failed to change account password.");
            return redirect(url('change-password'))->with('error','Current Password Mismatch.');
        }
    }
}
