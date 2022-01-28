<?php

namespace App\Http\Controllers;
use App\Pos;
use App\Product;
//use Session;
use App\InvoiceProduct;
use App\InvoicePayment;
use App\Invoice;
use App\Tender;
use App\Customer;
use App\PosSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvoiceProductController extends Controller
{
    
    private $sdc;
    public function __construct(){ 
        $this->sdc = new StaticDataController(); 
    }

    public function getDBCart(Request $request)
    {
        $datas=\DB::table('sessions')->where('user_id',\Auth::user()->id)->first();
        // /$data = Session::where('user_id',\Auth::user()->id)->first();
        dd(unserialize(base64_decode($datas->payload)));
    }

    private function genarateDefaultCustomer()
    {
        $chkCus=Customer::where('store_id',$this->sdc->storeID())->where('name','No Customer')->count();
        if($chkCus==0)
        {
            $tab_customer=new Customer;
            $tab_customer->name="No Customer";
            $tab_customer->store_id=$this->sdc->storeID();
            $tab_customer->phone="00000000000";
            $tab_customer->email="nocustomer".$this->sdc->storeID()."@simpleretailpos.com";
            $tab_customer->created_by=\Auth::user()->id;
            $tab_customer->save();
        }

        $cus=Customer::where('store_id',$this->sdc->storeID())->where('name','No Customer')->first();

        return $cus->id;
    }

    public function getAddToCart(Request $request, $pid) {

        $defualtCustomer=$this->genarateDefaultCustomer();

        if(isset($request->price))
        {
            $product = Product::find($pid);
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->addCustomPrice($product, $product->id,$request->price);
        }
        else
        {
            $product = Product::find($pid);
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->add($product, $product->id);
        }

        if(empty($cart->customerID))
        {
            $cart = new Pos($cart);
            $cart->addCustomerID($defualtCustomer);
        }

        
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function getAddVTToCart(Request $request, $pid) {

        $defualtCustomer=$this->genarateDefaultCustomer();

        if(isset($request->price))
        {
            $product=[
                'id'=>$pid,
                'name'=>$request->product_name,
                'barcode'=>$pid,
                'detail'=>$request->product_name,
                'price'=>$request->price,
                'cost'=>$request->price,
                'image'=>'VT001'
            ];
            
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->addCustomVTPrice($product, $pid,$request->price);
        }
        else
        {
            $product=[
                'id'=>$pid,
                'name'=>$request->product_name,
                'barcode'=>$pid,
                'detail'=>$request->product_name,
                'price'=>$request->price,
                'cost'=>$request->price,
                'image'=>'VT001'
            ];
            
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->addVT($product,$pid);
        }

        if(empty($cart->customerID))
        {
            $cart = new Pos($cart);
            $cart->addCustomerID($defualtCustomer);
        }

        
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function getCustomQuantityToCart(Request $request,$pid=0,$quantity=0,$price=0) {

        $product = Product::find($pid);
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->addCustomQuantityPrice($product, $product->id,$quantity,$price);
        //$cart->addCustomQuantity($product, $product->id,$quantity);
        $request->session()->put('Pos', $cart);
        return response()->json(1);

    }

    public function getAssignDiscountToCart(Request $request)
    {
        $discountType=$request->discount_type?$request->discount_type:0;
        $discount_amount=$request->discount_amount?$request->discount_amount:0;
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->getAssignDiscountToCart($discountType,$discount_amount);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

   public function getCusAssignToCart(Request $request,$cusid)
   {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->addCustomerID($cusid);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
   }

    public function getPaidCart(Request $request) {
        $paidAmount=$request->paidAmount;
        $paymentID=$request->paymentID;
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->addPayment($paidAmount, $paymentID);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function getPaidCartPublic(Request $request) {

        $paidAmount=$request->paidAmount;
        $paymentID=$request->paymentID;
        $invoice_id=$request->invoice_id;


        $Tender=Tender::find($paymentID);

        $invoice=Invoice::where('invoice_id',$invoice_id)->first();
        $invoice->tender_id=$paymentID;
        $invoice->save();

        $Customer=Customer::find($invoice->customer_id);

        $ChkInvoicePayment=InvoicePayment::where('invoice_id',$invoice_id)->count();
        if($ChkInvoicePayment>0)
        {
            $InvoicePayment=InvoicePayment::where('invoice_id',$invoice_id)->first();
            $InvoicePayment->invoice_id=$invoice_id;

            $InvoicePayment->tender_id=$Tender->id;
            $InvoicePayment->tender_name=$Tender->name;

            $InvoicePayment->customer_id=$Customer->id;
            $InvoicePayment->customer_name=$Customer->name;

            $InvoicePayment->total_amount=$invoice->total_amount;
            $InvoicePayment->paid_amount=$paidAmount;


            $InvoicePayment->store_id=$invoice->store_id;
            $InvoicePayment->created_by=$invoice->created_by;
            $InvoicePayment->save();
        }
        else
        {
            $InvoicePayment=new InvoicePayment;
            $InvoicePayment->invoice_id=$invoice_id;

            $InvoicePayment->tender_id=$Tender->id;
            $InvoicePayment->tender_name=$Tender->name;

            $InvoicePayment->customer_id=$Customer->id;
            $InvoicePayment->customer_name=$Customer->name;

            $InvoicePayment->total_amount=$invoice->total_amount;
            $InvoicePayment->paid_amount=$paidAmount;


            $InvoicePayment->store_id=$invoice->store_id;
            $InvoicePayment->created_by=$invoice->created_by;
            $InvoicePayment->save();
        }
        


        return response()->json(1);
    }

    public function getDelRowFRMCart(Request $request,$pid)
    {
        $product = Product::find($pid);
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->delProductRow($product, $product->id);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function changeCounterPayStatus(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->AllowCustomerPayBill($request->counterPayStatus);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function getCart(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        
        echo "<pre>";
        print_r($oldCart); die();
    }

    public function getClearCart(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->ClearCart();
        Session::put('Pos', $cart);
    }

}
