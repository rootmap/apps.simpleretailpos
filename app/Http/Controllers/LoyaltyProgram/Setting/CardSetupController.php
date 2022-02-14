<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoyaltyProgram\MainController;
use App\Http\Controllers\StaticDataController;
use App\Http\Requests\Loyalty\Setup\CardSetupRequest;
use App\Model\Loyalty\LoyaltyCardSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardSetupController extends MainController
{

    public function __construct(LoyaltyCardSetting $card, StaticDataController $sdc)
    {
        $this->model = $card;
        $this->sdc = $sdc;
    }


    public function index()
    {
        return $this->model
                //->where('store_id',$this->sdc->storeID())
                ->get();
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

    public function storeImage($request, $fieldName)
    {
        if (!empty($request->file($fieldName))) {
            $img = $request->file($fieldName);
            $upload = 'upload/card_templates/';
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
            return $$upload."/".$filename;
        }
        return "";
    }

    public function store(CardSetupRequest $request)
    {
        $data = $request->only([
            'membership_name', 'point_range_from', 'point_range_to',
            'min_purchase_amount', 'purchase_amount_to_point_conversion_rate',
            'card_display_config', 'created_by','status'
        ]);

        $data['card_display_config'] = (is_array($data['card_display_config'])) ? json_encode($data['card_display_config']) : "";

        $result =new LoyaltyCardSetting();

        //$result->store_id = $this->sdc->storeID();
        $result->membership_name = $data['membership_name'];
        $result->card_display_config = $data['card_display_config'];
        $result->card_image_path = $this->storeImage($request, 'card_image_path' );
        $result->point_range_from = $data['point_range_from'];
        $result->point_range_to = $data['point_range_to'];
        $result->status = $data['status'];

        //$result->created_by = Auth::id();
        $result->created_by = 1;

        $result->save();
        return $result;
    }

    public function show($id)
    {
        return $this->model
                //->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
    }

    public function edit($id)
    {
        //
    }

    public function update(CardSetupRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();

        $result->membership_name = $data['membership_name'];
        $result->card_display_config = $data['card_display_config'];
        $result->card_image_path = $this->storeImage($request, 'card_image_path' );

        $result->point_range_from = $data['point_range_from'];
        $result->point_range_to = $data['point_range_to'];
        $result->status = $data['status'];

        $result->save();
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->delete();
    }
}
