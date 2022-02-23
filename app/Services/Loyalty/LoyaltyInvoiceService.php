<?php

namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyInvoice;
use App\Model\Loyalty\LoyaltyUser;
use App\Services\Loyalty\LoyaltyUserService;
use App\Services\Loyalty\LoyaltyPromotionService;


class LoyaltyInvoiceService{

    private $config = [];
    private $user = null;
    private $promotion_details = [];
    private $loyalty_usage_details = [];

    public function __construct($config)
    {
        $this->config= $config;
        $this->store_id = $config['store_id'];
        // {
        //     "store_id"  :"241",
        //     "user_info" :{
        //         "name":"Md. Mohiuddin khan",
        //         "email":"mohiuddin@mail.com",
        //         "phone":"017283848494",
        //         "id":"36"
        //     },
        //     "invoice_info" : {
        //         "invoice_id":"12",
        //         "purchase_amount":"100",
        //         "tender_id":"1",
        //         "tender_name":"Debit Card"
        //     },
        //     "withdeaw" : {
        //         "amount" : "10",
        //             "ref_id"   : "1"
        //         }
        // }

    }

    public function set()
    {
        // Is user Joined in loyalty Program.
        // Find Is there any Promotion going on;
        // Find If this invoice is purchased through Loyalty Point.
        //Insert into Invoice table
        // Update User's Purchase related information, Also try to update user membership type by total Loyalty Point.
        // Update Promotion related information(if promotion ongoing).
        // Update Loyalty_point_usages table (If Purchased throught loyalty Point)

        $this->user = new LoyaltyUserService($this->config);
        $result = $this->user->getLoyaltyUser();
        if(! isset($result->id)){
            $this->user->join();
            $result = $this->user->getLoyaltyUser();
        }

        $invoice = new LoyaltyInvoice();

        $invoice->store_id = $this->store_id;
        $invoice->user_id = $this->config['user_info']['id'];
        $invoice->name = $this->config['user_info']['name'];
        $invoice->email = $this->config['user_info']['email'];
        $invoice->phone = $this->config['user_info']['phone'];
        $invoice->invoice_id = $this->config['invoice_info']['invoice_id'];
        $invoice->purchase_amount = $this->config['invoice_info']['purchase_amount'];
        $invoice->membership_card_type = $result['membership_card_type'];
        $invoice->tender_id = $this->config['invoice_info']['tender_id'];
        $invoice->tender_name = $this->config['invoice_info']['tender_name'];

        $invoice->promotion_id = "";
        $invoice->earned_point = 0;
        $invoice->save();
        $data = $this->update( $invoice['id'], $result['membership_card_type'], $this->config['invoice_info']['purchase_amount'] );

        if(isset($data)  && $data === "promo"){

            return $invoice;
        }
        return $data;

    }

    private function update($invoiceId, $cardType, $amount)
    {
        /* Check If Tender name is "Loyalty Point"
            if loyalty point then check if purchase amout is >= loyalty equavalent point
                if yes then  update invoice, user, loyalty usage
                if no then return false message
        If not loyalty point then, check -
            has promotion- if yes
                then, get promotional loyalty point, update, invoice, promotion, user
            If No, then update invoice, user
        */
        $tanderName = $this->config['invoice_info']['tender_name'];
        $user = new LoyaltyUserService($this->config);
        if($tanderName === "Loyalty Point"){
            $data = $user->purchase();
            $usage = new LoyaltyUsageService($this->config);
            $usage->setUsage( $data['withdrawn']['loyalty_points'], "Purchase");
            return "promo";
        }
        $promo= new LoyaltyPromotionService($this->config);
        $promotion = $promo->getLatestPromotionDetails ( $amount, $cardType);

        $point = "";
        $promotionId = "";
        if($promotion){
            $point = $promotion['point'];
            $data = $promotion['data'];
            $promotionId = $data['id'];
            $invoiceId = $this->config['invoice_info']['invoice_id'];
            $purchaseAmount = $this->config['invoice_info']['purchase_amount'];

            $promo->updatePromotionProgram($promotionId, $invoiceId, $purchaseAmount,$point);
        }
        else{
            $promo = new LoyaltyStoreCardService($this->config);
            $convert = $promo->convert($amount,"");
            $point = $convert['total_point'];
            $purchaseAmount = $amount;
        }
        $invoice = LoyaltyInvoice::where('invoice_id', $invoiceId)->first();

        $invoice->promotion_id = $promotionId;
        $invoice->earned_point = $point;
        $invoice->save();

        $user = new LoyaltyUserService($this->config);
        return $user->updateUserInvoice($invoiceId, $amount, $point);

    }


}
