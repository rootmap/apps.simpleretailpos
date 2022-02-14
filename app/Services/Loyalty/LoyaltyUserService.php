<?php

namespace App\Services\Loyalty;

use App\Model\Loyalty\LoyaltyUser;

class LoyaltyUserService{
    protected $config = [];
    protected $storeId = "";

    public function __construct($config)
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
            // }

    }

    public function join()
    {
        $user_info = $this->config['user_info'];
        if( $result = $this->is_esists($user_info['id'])){
            return $result;
        }
        $result = new LoyaltyUser();
        $card = new LoyaltyStoreCardService($this->config);
        $card_type = $card->getMembershipByPoint(0);
        $result->store_id = $this->config['store_id'];
        $result->user_id = $user_info['user_id'];
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
                    ->where('user_id', $this->config['user_id'])
                    ->first();
        if($hasData->user_id){
            return $hasData;
        }
        return false;
    }

    public function updateUserInvoice($invoiceId,$purchaseAmount,$LoyaltyPoint)
    {
        $result = LoyaltyUser::
                    where('store_id',$this->store_id)
                    ->where('user_id',$this->config['user_info']['id'])
                    ->first();
        $lPoint = $result->total_point + $LoyaltyPoint;
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
        if($data['id']){
            $card = new LoyaltyStoreCardService($this->config);
            return [
                "loyalty_points"=> $data['total_points'],
                "balance"=> $card->convert($data['total_points'], "withdraw")
            ];
        }
        return [
            'status' =>400,
            "message" => "User yet not in Loyalty Program."
        ];
    }
    public function withdraw($balance)
    {
        $data = $this->queryBalance();
        if(isset($data['loyalty_points'])){
            if($balance <= $data['balance'] ){
                $data = $this->calcWithdrawBalance($balance);
                if(isset($data['withdrawn'])){
                    $usage = new LoyaltyUsageService($this->config);
                    $usage->setUsage("Cash Withdrawal", $data['withdrawn']['loyalty_points']);
                    return $data;
                }
                return [
                    'status' =>200,
                    "message" => "Invalid Balance Query."
                ];
            }
            return [
                'status' =>200,
                "message" => "Insufficient balance."
            ];
        }
        return [
            'status' =>400,
            "message" => "User yet not in Loyalty Program."
        ];
    }
    private function calcWithdrawBalance($balance)
    {
        $result = LoyaltyUser::
                    where('store_id',$this->store_id)
                    ->where('user_id',$this->config['user_info']['id'])
                    ->first();
        $card = new LoyaltyStoreCardService($this->config);

        $withdrawd = $card->convert($balance,"Withdraw");
        $lPoint = $result->total_point - $withdrawd;
        $card = new LoyaltyStoreCardService($this->config);
        $card_type = $card->getMembershipByPoint($lPoint);

        $updatedBalance = $result->total_purchase_amount - $balance;
        $result->total_purchase_amount = $updatedBalance;
        $result->total_point = $lPoint;
        $result->membership_card_type = $card_type['membership_name'];
        $result->save();
        return [
            "current" =>[
                "loyalty_points"=> $lPoint,
                "balance"=> $updatedBalance
            ],
            "withdrawn" =>[
                "loyalty_points"=> $withdrawd,
                "balance"=> $balance
            ]
        ];
    }
}
