<?php
namespace App;
use App\Product;
class Cart {
    public $items = null;
    public $Warrantyinvoice_ID = null;
    public $Warrantyinvoice_Date = null;
    public $totalQty = 0;
    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->Warrantyinvoice_ID = $oldCart->Warrantyinvoice_ID;
            $this->Warrantyinvoice_Date = $oldCart->Warrantyinvoice_Date;
            $this->totalQty = $oldCart->totalQty;
        }
    }

    public function add($new_product_id=0,$old_product_id, $key_id) {
        $storeditem = ['new_product_id' =>0];
        if($this->Warrantyinvoice_ID!=$key_id)
        {
            $this->items=[];
            $this->totalQty=0;    
        }
        
        if ($this->items) {
            if (array_key_exists($old_product_id, $this->items)) {
                $storeditem = $this->items[$old_product_id];
            }
        }

        $productInfoNew=Product::find($new_product_id);
        $productInfoOld=Product::find($old_product_id);

        $storeditem['invoice_id'] = $key_id;
        $storeditem['new_product_id'] = $new_product_id;
        $storeditem['new_product_html'] = $productInfoNew->name;
        $storeditem['old_product_id'] = $old_product_id;
        $storeditem['old_product_html'] = $productInfoOld->name;
        $this->items[$old_product_id] = $storeditem;
        $this->Warrantyinvoice_ID=$key_id;
        $this->Warrantyinvoice_Date=date('Y-m-d');
        $this->totalQty++;
    }

    public function del($new_product_id=0,$old_product_id, $key_id) {
        if ($this->items) {
            if (array_key_exists($old_product_id, $this->items)) {
                unset($this->items[$old_product_id]);
                $this->totalQty--;
            }
        }

        
    }
    
    public function ClearCart() {
        $this->items = null;
        $this->Warrantyinvoice_ID = null;
        $this->Warrantyinvoice_Date = null;
        $this->totalQty = 0;
    }
}