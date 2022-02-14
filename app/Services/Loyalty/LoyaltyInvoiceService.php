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
            //     "store_id"  :"",
            //     'user_info' :{
            //         'name':"",
            //         'email':"",
            //         'phone':"",
            //         'id':"",
            //     },
            //     "invoice_info" : {
            //         "invoice_id":"",
            //         "purchase_amount":"",
            //         "tender_id":"",
            //         "tender_name":"",
            //     },
            //     "withdeaw" : {
            //         "amount" : "",
            //          "ref_id"   : ""
            //     }
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
    }

    private function update($invoiceId, $cardType, $amount)
    {
        $tanderName = $this->config['invoice_info']['tender_name'];
        $invoice = LoyaltyInvoice::find($invoiceId);

        $promo = new LoyaltyStoreCardService($this->config);
        $promotion = $promo->convert($cardType);
        $total_point = 0;
        if(! $tanderName === "Loyalty Point"){
            $invoice->promotion_id = "";
            $invoice->earned_point = $total_point;
            $invoice->save();
            $llt_usage = new LoyaltyUsageService($this->config);
            $llt_usage->setUsage($usued_for = "Cash Withdrawal", $promotion );

            return ;
        }

        $promo = new LoyaltyPromotionService($this->config);
        $promotion = $promo->getLatestPromotionDetails ( $amount, $cardType);

        if($promotion['total_point'] > 0 ){
            $p_data = $promo['data'];
            $invoice->promotion_id = $p_data['id'];
            $total_point = $promotion['total_point'];
            $invoice->earned_point = $total_point;
            $invoice->save();

            // Update Promotional Program table
            $promo->updatePromotionProgram($p_data['id'], $invoiceId, $amount,$total_point);
        }

        $promo = new LoyaltyStoreCardService($this->config);
        $total_point = $promo->convert($cardType);

        $user = new LoyaltyUserService($this->config);
        $user->updateUserInvoice($invoiceId,$amount,$total_point);

        return;
    }


}
