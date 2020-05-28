<?php

namespace App\Http\Controllers;
use App\category;
use App\ProductItem;
use App\PizzaSize;
use App\PizzaFlabour;
use App\ProductOneSubLevel;
use App\ProductTwoSubLevel;
use App\Product;
use App\Discount;
use App\Tax;
use App\SubCategory;
use Session;
use App\Cart;
use App\Customer;
use App\DeliveryAddress;
use App\OrderInfo;
use Auth;
use App\Orders;
use App\OrdersItem;
use Illuminate\Http\Request;

class ProductItemController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $category=$this->categoryProduct();
        //$product=Product::all();
        $defultReturn=['category'=>$category];

        if($this->checkCommonDiscount())
        {
            $defultReturn=array_merge($defultReturn,['common'=>$this->checkCommonDiscount()]);
        }

        if($this->checkColNDelDiscount())
        {
            $defultReturn=array_merge($defultReturn,['colndel'=>$this->checkColNDelDiscount()]);
        }        

        if($this->checkTax())
        {
            $defultReturn=array_merge($defultReturn,['tax'=>$this->checkTax()]);
        }

        $orderINfo=OrderInfo::orderBy('id','DESC')->first();
        $defultReturn=array_merge($defultReturn,['orderINfoText'=>$orderINfo]);
        //dd($defultReturn);

        return view('frontend.pages.product.index',$defultReturn);
    }

    public function makePayment(Request $request)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $defultReturn=['cart'=>$cart];
        if($this->checkCommonDiscount())
        {
            $defultReturn=array_merge($defultReturn,['common'=>$this->checkCommonDiscount()]);
        }

        if($this->checkColNDelDiscount())
        {
            $defultReturn=array_merge($defultReturn,['colndel'=>$this->checkColNDelDiscount()]);
        }        

        if($this->checkTax())
        {
            $defultReturn=array_merge($defultReturn,['tax'=>$this->checkTax()]);
        }

        //dd(csrf_token());

         

        
       // dd($defultReturn['cart']->items);
        $delivery = new DeliveryAddress;
        $delivery->customer_id = Auth::user()->id;
        $delivery->token = csrf_token();
        $delivery->first_name = $defultReturn['cart']->deliveryDetail["name"];
        $delivery->address = $defultReturn['cart']->deliveryDetail["address"];
        $delivery->mobile_phone =$defultReturn['cart']->deliveryDetail["phone"];
        $delivery->email =$defultReturn['cart']->deliveryDetail["email"];
        $delivery->save();

        $pro = new Orders;
        $pro->tracking = csrf_token();
        $pro->cid = Auth::user()->id;
        $pro->invoice_date = date('Y-m-d');
        $pro->due_date = date('Y-m-d');
        $pro->order_status = "Pending";
        $pro->save();

        $order_id = $pro->id;


        if(count($defultReturn['cart']->items)>0)
        {
            foreach($defultReturn['cart']->items as $itm):
                //dd($itm);

                $protag = new OrdersItem();
                $protag->pid = $itm['item']->id;
                $protag->order_id = $order_id;
                $protag->tracking = csrf_token();
                $protag->quantity = $itm["qty"];
                $protag->unit_price =$itm['item']->id;
                $protag->tax_rate = 0;
                $protag->tax_amount = 0;
                $protag->row_total = $itm["price"];
                $protag->save();

            endforeach;
        }

        echo "Delivery ID = ".$delivery->id;
        echo "Order ID = ".$order_id;
        echo "And product detail saved";

         

        dd($defultReturn);

    }

    private function checkCommonDiscount()
    {
        $chk=Discount::where('discount_status','Active')
                     ->where('discount_option','Common')
                     ->count();
        if($chk>0)
        {
            $data=Discount::select(
                            'id',
                            'minimum_amount',
                            'discount_option',
                            'discount_type',
                            \DB::Raw("CASE WHEN discount_type='Fixed' THEN discount_amount 
                            ELSE CONCAT(discount_amount,'%') END as discount_amount"),
                            'message',
                            'discount_status',
                            'created_at'
                            )
                          ->where('discount_status','Active')
                          ->where('discount_option','Common')
                          ->first();
            //dd($data);
            return $data;
        }
    }

    private function checkColNDelDiscount()
    {
        $chk=Discount::where('discount_status','Active')
                     ->whereIn('discount_option', ['Delivery','Collection'])
                     ->count();
        //dd($chk);
        if($chk>0)
        {
            $data=Discount::select(
                            'id',
                            'minimum_amount',
                            'discount_option',
                            'discount_type',
                            \DB::Raw("CASE WHEN discount_type='Fixed' THEN discount_amount 
                            ELSE CONCAT(discount_amount,'%') END as discount_amount"),
                            'message',
                            'discount_status',
                            'created_at'
                            )
                          ->where('discount_status','Active')
                          ->whereIn('discount_option', ['Delivery','Collection'])
                          ->first();
            //dd($data);
            return $data;
        }
    }
    
    private function checkTax()
    {
        $chk=Tax::where('tax_status','Active')
                ->orderBy('id','DESC')
                ->count();
        //dd($chk);



        if($chk>0)
        {
            $data=Tax::where('tax_status','Active')
                     ->orderBy('id','DESC')
                     ->first();
            return $data;
        }
    }
    

    public function addtocart(Request $request)
    {
        if(isset($request->rec))
        {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addRec($request->rec);
        }
        elseif(isset($request->snd_item_id))
        {
            $product = Product::find($request->item_id);
            $sndItm = ProductOneSubLevel::find($request->snd_item_id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addSnd($product, $product->id,$sndItm,$sndItm->id);
        }
        elseif(isset($request->exec_menu))
        {
            parse_str($request->execArrayData, $searcharray);
            $execArrayData=$searcharray;
            $product = Product::find($request->item_id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addexecMenu($product, $product->id,$execArrayData);
        }
        elseif(isset($request->pizza_menu))
        {
            $postcount=0;
            $nExtra=[];
            $searcharray=json_decode(json_encode(json_decode($request->cartData,true)),true);
            if(isset($searcharray))
            {
                if(count($searcharray)>0)
                {
                    $size=$searcharray['size_info'];;
                    $flabour=$searcharray['flabour'];
                    $extra=$searcharray['extra'];
                    if(count($extra)>0)
                    {
                        
                        foreach($extra as $ex):
                            if(!empty($ex))
                            {
                                $nExtra[]=array(
                                    'extra_name'=>$ex['extra_name'],
                                    'extra_id'=>$ex['extra_id'],
                                    'extra_price'=>$ex['extra_price'],
                                    'extra_quantity'=>$ex['extra_quantity']
                                );
                            }
                            
                        endforeach;
                    }
                }
            }
            //dd($nExtra);
            //$execArrayData=$searcharray;
            $product = Product::find($request->item_id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->addPizzaMenu($product, $product->id,$size,$flabour,$nExtra);
        }
        else
        {
            $product = Product::find($request->item_id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id);
        }

        $request->session()->put('cart', $cart);
        return response()->json($cart);  
    }

    public function deltocart(Request $request)
    {
        //dd($request->lid);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->delProductFullRemove($request->lid);

        $request->session()->put('cart', $cart);
        return response()->json($cart); 
    }

    public function typeofdelivery(Request $request)
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        return response()->json($cart->rec); 
    }

    public function cartJson()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        return response()->json($cart);  
    }

    public function ClearCart(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->ClearCart();

        $request->session()->put('cart', $cart);
        return response()->json($cart);  
    }

    public function categoryProduct($filter='')
    {
        $row=[];
        $category=category::where('product','!=',0)
                            ->get();
        foreach($category as $index=>$cat)
        {
            $row[$index]['id']=$cat->id;
            $row[$index]['name']=$cat->name;
            $row[$index]['layout']=$cat->layout;
            $row[$index]['product']=$cat->product;
            if($cat->layout==2)
            {
                $subCatData=[];
                $checkSubcid=SubCategory::where('category_id',$cat->id)->count();
                if($checkSubcid > 0)
                {
                    
                    $SubcidData=SubCategory::where('category_id',$cat->id)->get();
                    foreach($SubcidData as $inx=>$sc)
                    {
                        $subCatData[$inx]['id']=$sc->id;
                        $subCatData[$inx]['name']=$sc->name;

                        $product_row=[];
                        $product=Product::where('scid',$sc->id)->get();
                        //dd($product);
                        foreach($product as $key=>$pro)
                        {
                            if($pro->product_level_type==1)
                            {
                                $product_row[$key]['id']=$pro->id;
                                $product_row[$key]['name']=$pro->name;
                                $product_row[$key]['price']=$pro->price;
                                $product_row[$key]['interface']=$pro->product_level_type;
                                $product_row[$key]['description']=$pro->description;
                            }
                            elseif($pro->product_level_type==2)
                            {

                                $suboneData=[];
                                $product_row[$key]['id']=$pro->id;
                                $product_row[$key]['name']=$pro->name;
                                $product_row[$key]['price']=$pro->price;
                                $product_row[$key]['interface']=$pro->product_level_type;
                                $product_row[$key]['description']=$pro->description;
                                $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                                foreach($subOne as $soIndex=>$so)
                                {
                                    $suboneData[$soIndex]['id']=$so->id;
                                    $suboneData[$soIndex]['name']=$so->name;
                                    $suboneData[$soIndex]['price']=$so->price;
                                }
                                $product_row[$key]['ProductOneSubLevel']=$suboneData;
                            }
                            elseif($pro->product_level_type==3)
                            {

                                $suboneDatamodal=[];
                                $product_row[$key]['id']=$pro->id;
                                $product_row[$key]['name']=$pro->name;
                                $product_row[$key]['price']=$pro->price;
                                $product_row[$key]['interface']=$pro->product_level_type;
                                $product_row[$key]['description']=$pro->description;
                                $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();

                                foreach($subOne as $soIndex=>$so)
                                {
                                    $suboneDatamodal[$soIndex]['id']=$so->id;
                                    $suboneDatamodal[$soIndex]['name']=$so->name;
                                    $suboneDatamodal[$soIndex]['price']=$so->price;
                                }

                                $product_row[$key]['modal']=$suboneDatamodal;
                            }
                            elseif($pro->product_level_type==4)
                            {
                                $suboneData=[];
                                $product_row[$key]['id']=$pro->id;
                                $product_row[$key]['name']=$pro->name;
                                $product_row[$key]['price']=$pro->price;
                                $product_row[$key]['interface']=$pro->product_level_type;
                                $product_row[$key]['description']=$pro->description;
                                $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                                foreach($subOne as $soIndex=>$so)
                                {
                                    $suboneData[$soIndex]['id']=$so->id;
                                    $suboneData[$soIndex]['name']=$so->name;
                                    $dpsOP=explode(',', $so->description);
                                    $suboneData[$soIndex]['dropdown']=$dpsOP;


                                }

                                $product_row[$key]['ProductOneSubLevel']=$suboneData;
                            }
                            elseif($pro->product_level_type==5)
                            {
                                $suboneData=[];
                                $product_row[$key]['id']=$pro->id;
                                $product_row[$key]['name']=$pro->name;
                                $product_row[$key]['price']=$pro->price;
                                $product_row[$key]['interface']=$pro->product_level_type;
                                $product_row[$key]['description']=$pro->description;
                                
                                $pizzaSize=[];
                                $pizzaSql=PizzaSize::where('pid',$pro->id)->get();
                                foreach($pizzaSql as $SizeIndex=>$sz)
                                {
                                    $pizzaSize[$SizeIndex]['id']=$sz->id;
                                    $pizzaSize[$SizeIndex]['name']=$sz->name;
                                    $pizzaSize[$SizeIndex]['price']=$sz->price;
                                }
                                $product_row[$key]['PizzaSize']=$pizzaSize;

                                $PiFlabour=[];
                                $pizzaSql=PizzaFlabour::where('pid',$pro->id)->get();
                                foreach($pizzaSql as $plIndex=>$sl)
                                {
                                    $PiFlabour[$plIndex]['id']=$sl->id;
                                    $PiFlabour[$plIndex]['name']=$sl->name;
                                    $PiFlabour[$plIndex]['price']=$sl->price;
                                }
                                $product_row[$key]['PizzaFlabour']=$PiFlabour;


                                $suboneData=[];
                                $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                                foreach($subOne as $soIndex=>$so)
                                {
                                    $suboneData[$soIndex]['id']=$so->id;
                                    $suboneData[$soIndex]['name']=$so->name;
                                    $suboneData[$soIndex]['price']=$so->price;
                                }

                                $product_row[$key]['pizzaExtra']=$suboneData;
                            }
                        }

                        //dd($product_row);

                        $subCatData[$inx]['sub_product_row']=$product_row;
                    }
                       
                }

                $row[$index]['product_row']=$subCatData; 
                
            }
            else
            {
                $product_row=[];
                $product=Product::where('cid',$cat->id)->get();

                foreach($product as $key=>$pro)
                {
                   

                    if($pro->product_level_type==1)
                    {
                        $product_row[$key]['id']=$pro->id;
                        $product_row[$key]['name']=$pro->name;
                        $product_row[$key]['price']=$pro->price;
                        $product_row[$key]['interface']=$pro->product_level_type;
                        $product_row[$key]['description']=$pro->description;
                    }
                    elseif($pro->product_level_type==2)
                    {

                        $suboneData=[];
                        $product_row[$key]['id']=$pro->id;
                        $product_row[$key]['name']=$pro->name;
                        $product_row[$key]['price']=$pro->price;
                        $product_row[$key]['interface']=$pro->product_level_type;
                        $product_row[$key]['description']=$pro->description;
                        $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                        foreach($subOne as $soIndex=>$so)
                        {
                            $suboneData[$soIndex]['id']=$so->id;
                            $suboneData[$soIndex]['name']=$so->name;
                            $suboneData[$soIndex]['price']=$so->price;
                        }
                        $product_row[$key]['ProductOneSubLevel']=$suboneData;
                    }
                    elseif($pro->product_level_type==3)
                    {

                        $suboneDatamodal=[];
                        $product_row[$key]['id']=$pro->id;
                        $product_row[$key]['name']=$pro->name;
                        $product_row[$key]['price']=$pro->price;
                        $product_row[$key]['interface']=$pro->product_level_type;
                        $product_row[$key]['description']=$pro->description;
                        $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();

                        foreach($subOne as $soIndex=>$so)
                        {
                            $suboneDatamodal[$soIndex]['id']=$so->id;
                            $suboneDatamodal[$soIndex]['name']=$so->name;
                            $suboneDatamodal[$soIndex]['price']=$so->price;
                        }

                        $product_row[$key]['modal']=$suboneDatamodal;
                    }
                    elseif($pro->product_level_type==4)
                    {
                        $suboneData=[];
                        $product_row[$key]['id']=$pro->id;
                        $product_row[$key]['name']=$pro->name;
                        $product_row[$key]['price']=$pro->price;
                        $product_row[$key]['interface']=$pro->product_level_type;
                        $product_row[$key]['description']=$pro->description;
                        $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                        foreach($subOne as $soIndex=>$so)
                        {
                            $suboneData[$soIndex]['id']=$so->id;
                            $suboneData[$soIndex]['name']=$so->name;
                            $dpsOP=explode(',', $so->description);
                            $suboneData[$soIndex]['dropdown']=$dpsOP;


                        }

                        $product_row[$key]['ProductOneSubLevel']=$suboneData;
                    }
                    elseif($pro->product_level_type==5)
                    {
                        $suboneData=[];
                        $product_row[$key]['id']=$pro->id;
                        $product_row[$key]['name']=$pro->name;
                        $product_row[$key]['price']=$pro->price;
                        $product_row[$key]['interface']=$pro->product_level_type;
                        $product_row[$key]['description']=$pro->description;
                        
                        $pizzaSize=[];
                        $pizzaSql=PizzaSize::where('pid',$pro->id)->get();
                        foreach($pizzaSql as $SizeIndex=>$sz)
                        {
                            $pizzaSize[$SizeIndex]['id']=$sz->id;
                            $pizzaSize[$SizeIndex]['name']=$sz->name;
                            $pizzaSize[$SizeIndex]['price']=$sz->price;
                        }
                        $product_row[$key]['PizzaSize']=$pizzaSize;

                        $PiFlabour=[];
                        $pizzaSql=PizzaFlabour::where('pid',$pro->id)->get();
                        foreach($pizzaSql as $plIndex=>$sl)
                        {
                            $PiFlabour[$plIndex]['id']=$sl->id;
                            $PiFlabour[$plIndex]['name']=$sl->name;
                            $PiFlabour[$plIndex]['price']=$sl->price;
                        }
                        $product_row[$key]['PizzaFlabour']=$PiFlabour;


                        $suboneData=[];
                        $subOne=ProductOneSubLevel::where('pid',$pro->id)->get();
                        foreach($subOne as $soIndex=>$so)
                        {
                            $suboneData[$soIndex]['id']=$so->id;
                            $suboneData[$soIndex]['name']=$so->name;
                            $suboneData[$soIndex]['price']=$so->price;
                        }

                        $product_row[$key]['pizzaExtra']=$suboneData;


                    }
                }

                $row[$index]['product_row']=$product_row;
            }

        }

        return $row;
    }

    public function product()
    {
        $product=$this->categoryProduct(
        );
        return response()->json($product);
    }

    public function getPayment()
    {
        return view('frontend.pages.checkout.select-payment');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProductItem $productItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductItem $productItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductItem $productItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductItem $productItem)
    {
        //
    }
}
