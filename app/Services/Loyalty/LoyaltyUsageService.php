<?php
namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyPointUsage;

class LoyaltyUsageService{
    private $config = [];
    private $store_id ="";

    public function __construct($config)
    {
        $this->config =$config;
        $this->store_id =$config['store_id'];
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

    public function setUsage( $loyalty_point, $usued_for = "Cash Withdrawal")
    {
        // dd($this->config);
        $result = new LoyaltyPointUsage();

        $result->store_id = $this->store_id;
        $result->user_id = $this->config['user_info']['id'];
        $result->name = $this->config['user_info']['name'];
        $result->email = $this->config['user_info']['email'];
        $result->phone = $this->config['user_info']['phone'];
        $result->used_loyalty_point = $loyalty_point;
        $result->used_for = ($usued_for === "Cash Withdrawal")? "Cash Withdrawal" : "Purchase" ;
        $result->invoice_id = ($usued_for === "Cash Withdrawal")? $this->config['withdraw']['ref_id']??"" : $this->config['invoice_info']['invoice_id'];
        $result->amount = ($usued_for === "Cash Withdrawal")?$this->config['withdraw']['amount'] : $this->config['invoice_info']['purchase_amount'];

        $result->save();
        //dd($result);
        return $result;
    }
}
