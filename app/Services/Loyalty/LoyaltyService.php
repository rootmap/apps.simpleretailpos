<?php

namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyCardSetting;
use App\Model\Loyalty\LoyaltyUser;

class LoyaltyService{
    protected $config = [];
    protected $storeId = "";
    protected $result = [];
    public function __construct($config = [])
    {
        $this->config= $config;
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
        //}

        $this->user = new LoyaltyUserService($config);
        $this->lltStoreCard = new LoyaltyStoreCardService($config);
        $this->lltInvoice = new LoyaltyInvoiceService($config);
    }
    public function set($config)
    {
        $this->config = $config;
        return $this;
    }
    public function join()
    {
        $this->result = $this->user->join();
        return $this;
    }

    public function setInvoice()
    {
        $this->result = $this->lltInvoice->set();
        return $this;
    }

    public function QueryBalance()
    {
        $this->result = $this->user->queryBalance();
        return $this;
    }

    public function withdraw()
    {
        $this->result = $this->user->withdraw($this->config['withdraw']['amount']);
        return $this;
    }
    public function get()
    {
        return $this->result;
    }



}
