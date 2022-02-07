<?php

namespace App\Http\Controllers\LoyaltyProgram\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoyaltyProgram\MainController;
use App\Http\Requests\Loyalty\Setup\CardSetupRequest;
use App\Model\Loyalty\LoyaltyCardSetting;
use Illuminate\Http\Request;

class CardSetupController extends MainController
{

    public function __construct(LoyaltyCardSetting $card)
    {
        $this->model = $card;
    }


    public function index()
    {
        return $this->model->all();
        //return $this->model->paginate(request()->get('per_page',10));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardSetupRequest $request)
    {
        $data = $request->only([
            'membership_name', 'point_range_from', 'point_range_to',
            'min_purchase_amount', 'purchase_amount_to_point_conversion_rate',
            'card_display_config', 'created_by'
        ]);

        $data['card_display_config'] = (is_array($data['card_display_config'])) ? json_encode($data['card_display_config']) : "";

        $result =new LoyaltyCardSetting();

        $result->membership_name = $data['membership_name'];
        $result->point_range_from = $data['point_range_from'];
        $result->point_range_to = $data['point_range_to'];
        $result->min_purchase_amount = $data['min_purchase_amount'];
        $result->purchase_amount_to_point_conversion_rate = $data['purchase_amount_to_point_conversion_rate'];
        $result->card_display_config = $data['card_display_config'];
        $result->card_display_config = $data['card_display_config'];
        $result->created_by = $data['created_by'];

        $result->save();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CardSetupRequest $request, $id)
    {
        return $request->all();
        $data = $this->model->find($id);
        $data->membership_name = $data['membership_name'];
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
