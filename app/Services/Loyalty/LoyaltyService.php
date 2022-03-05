<?php

namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyCardSetting;
use App\Model\Loyalty\LoyaltyUser;
use Symfony\Component\VarDumper\Cloner\Data;

class LoyaltyService{
    protected $config = [];
    protected $storeId = "";
    protected $result = [];
    public function __construct($config = [])
    {
        //dd($config);
        $this->config= $config;
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
        return $this->user->join();
    }

    public function setInvoice()
    {
        return $this->lltInvoice->set();
    }

    public function queryBalance()
    {
        return $this->user->queryBalance();
        
    }

    public function withdraw()
    {
        return $this->user->withdraw($this->config['withdraw']['amount']);

    }
    public function get()
    {
        return $this->result;
    }



}
