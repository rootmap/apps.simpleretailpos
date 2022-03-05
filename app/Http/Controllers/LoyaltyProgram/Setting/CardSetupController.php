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
        $data = $this->model
                ->where('store_id',$this->sdc->storeID())
                ->get();
        return view('apps.pages.loyalty_program.setting.card_list',["dataTable" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = StaticDataController::StoreInfo();
        return view('apps.pages.loyalty_program.setting.card_setup', ['store'=>$store]);
    }

    private function storeImage($request, $fieldName)
    {
        if (!empty($request->file($fieldName))) {
            $img = $request->file($fieldName);
            $upload = 'upload/card_templates/';
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);
            return $upload."/".$filename;
        }
        return "";
    }

    public function store(CardSetupRequest $request)
    {

        $data = $request->only([
            'membership_name', 'point_range_from', 'point_range_to',
            'min_purchase_amount',
            'card_display_config', 'status'
        ]);

        //dd($request->all());
        $data['card_display_config'] = (isset($data['card_display_config']) && is_array($data['card_display_config'])) ? json_encode($data['card_display_config']) : "";

        $result =new LoyaltyCardSetting();

        $result->store_id = $this->sdc->storeID();
        $result->membership_name = $data['membership_name'];
        $result->card_display_config = $data['card_display_config'];
        $result->card_pic_path = $this->storeImage($request, 'card_pic_path' );
        $result->point_range_from = $data['point_range_from'];
        $result->point_range_to = $data['point_range_to'];
        $result->status = $data['status'];

        $result->created_by = Auth::id();

        $result->save();
        //return $result;
        return redirect()->route('loyalty.setting.card.index');
    }

    public function show($id)
    {
        $data = $this->model
                ->where('store_id',$this->sdc->storeID())
                ->where('id',$id)
                ->first();
        $store = StaticDataController::StoreInfo();
        return view('apps.pages.loyalty_program.setting.view_card', ["data" =>$data, "store" => $store]);
    }

    public function edit($id)
    {
        //
    }

    public function checkUpdatedMembershipCard($inputName, $membershipCard)
    {
        if(trim($inputName) !== trim($membershipCard)){
            $result = $this->model
                        //->where('store_id',$this->sdc->storeID())
                        ->where('membership_name',$inputName)
                        ->first();
            return (!isset($result['membership_name']))? $inputName : $membershipCard;
        }
        return $inputName;

    }
    public function update(CardSetupRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->model
                    ->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->first();

        $result->membership_name = isset($data['membership_name']) ? $this->checkUpdatedMembershipCard($data['membership_name'], $result->membership_name) : $result->membership_name;
        $result->card_display_config = isset($data['card_display_config']) ? $data['card_display_config'] : $result->card_display_config;
        $result->card_pic_path = isset($data['card_pic_path']) ? $this->storeImage($request, 'card_pic_path' ) : $result->card_pic_path;

        $result->point_range_from = isset($data['point_range_from']) ? $data['point_range_from'] : $result->point_range_from;
        $result->point_range_to = isset($data['point_range_to']) ? $data['point_range_to'] : $result->point_range_to;
        $result->status = isset($data['status']) ? $data['status'] : $result->status;

        $result->save();
        return redirect()->route('loyalty.setting.card.show', [$result['id']]);
    }

    public function destroy($id)
    {
        $data = $this->model
                    //->where('store_id',$this->sdc->storeID())
                    ->where('id',$id)
                    ->delete();
    }
}
