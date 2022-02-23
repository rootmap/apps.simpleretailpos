<?php

namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyUser;

class LoyaltyUserService{
    protected $config = [];
    protected $storeId = "";

    public function __construct($config)
    {
        // dd($config['store_id']);
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

    public function join()
    {
        //dd($this->config['user_info']);
        $user_info = $this->config['user_info'];
        if( $result = $this->is_esists($user_info['id'])){
            return $result;
        }
        $result = new LoyaltyUser();
        $card = new LoyaltyStoreCardService($this->config);
        $card_type = $card->getMembershipByPoint(0);
        //dd($card_type);
        $result->store_id = $this->config['store_id'];
        $result->user_id = $user_info['id'];
        $result->email = $user_info['email'];
        $result->name = $user_info['name'];
        $result->name = $user_info['phone'];
        $result->total_invoices = 0;
        $result->total_purchase_amount = 0;
        $result->total_point = 0;
        $result->membership_card_type = $card_type['membership_name'];
        $result->save();
        return $result;
    }

    private function is_esists($id=null){
        $user_info = $this->config['user_info'];

        $result = new LoyaltyUser();
        $hasData = $result
                    ->where('store_id', $this->config['store_id'])
                    ->where('user_id', $this->config['user_info']['id'])
                    ->first();
        if(isset($hasData->user_id)){
            return $hasData;
        }
        return false;
    }

    public function updateUserInvoice($invoiceId,$purchaseAmount,$loyaltyPoint = "")
    {
        $loyaltyPoint = "";
        $result = LoyaltyUser::
                    where('store_id',$this->store_id)
                    ->where('user_id',$this->config['user_info']['id'])
                    ->first();
        if($loyaltyPoint=== "" || $loyaltyPoint <=0){
            $card = new LoyaltyStoreCardService($this->config);
            $data = $card->convert($purchaseAmount, "point");
            //dd("Inside Update User------", $data);
            $loyaltyPoint = $data['total_point'];
        }
        $lPoint = $result->total_point + $loyaltyPoint;

        $card = new LoyaltyStoreCardService($this->config);
        $card_type = $card->getMembershipByPoint($lPoint);

        $result->total_invoices = $result->total_invoices + 1;
        $result->total_purchase_amount = $result->total_purchase_amount + $purchaseAmount;
        $result->total_point = $lPoint;
        $result->membership_card_type = $card_type['membership_name'];
        $result->save();
        return $result;
    }
    public function getLoyaltyUser()
    {
        return LoyaltyUser::
                    where('store_id',$this->store_id)
                    ->where('user_id',$this->config['user_info']['id'])
                    ->first();
    }
    public function queryBalance()
    {
        $data = $this->getLoyaltyUser();
        // dd($data);
        if($data['id']){
            $card = new LoyaltyStoreCardService($this->config);
            return $card->convert($data['total_point'], "withdraw");
        }
        return [
            'status' =>400,
            "message" => "User yet not in Loyalty Program."
        ];
    }
    public function withdraw($balance)
    {
        $data = $this->queryBalance();
        // dd($data);
        if(isset($data['total_point'])){
            if($balance <= $data['balance'] ){
                // dd($data, $balance);
                $data = $this->calcWithdrawBalance($balance);
                if(isset($data['withdrawn'])){
                    $usage = new LoyaltyUsageService($this->config);
                    $usage->setUsage( $data['withdrawn']['loyalty_points'], "Cash Withdrawal");
                    return $data;
                }
                return false;
            }
            return false;
        }
        return false;
    }
    public function purchase()
    {
        $balance = $this->config['invoice_info']['purchase_amount'];
        $data = $this->queryBalance();
        if(isset($data['total_point'])){
            if($balance <= $data['balance'] ){

                return $this->calcWithdrawBalance($balance, true);
            }
            return false;
        }
        return false;
    }
    private function calcWithdrawBalance($balance, $isPurchase = false)
    {
        $result = LoyaltyUser::
                    where('store_id',$this->store_id)
                    ->where('user_id',$this->config['user_info']['id'])
                    ->first();
        $card = new LoyaltyStoreCardService($this->config);

        $withdrawd = $card->convert($balance,"point");
        $lPoint = $result->total_point - $withdrawd['total_point'];
        $card_type = $card->getMembershipByPoint($lPoint);
        $updatedBalance = $result->total_purchase_amount - $balance;
        if($isPurchase){
            $updatedBalance = $result->total_purchase_amount + $balance;
            $result->total_invoices = $result->total_invoices +1;
            $result->total_purchase_amount = $updatedBalance;
        }
        $result->total_point = $lPoint;
        $result->membership_card_type = $card_type['membership_name'];
        $result->save();
        return [
            "current" =>[
                "loyalty_points"=> $lPoint,
                "balance"=> $updatedBalance
            ],
            "withdrawn" =>[
                "loyalty_points"=> $withdrawd['total_point'],
                "balance"=> $balance
            ]
        ];
    }

}
