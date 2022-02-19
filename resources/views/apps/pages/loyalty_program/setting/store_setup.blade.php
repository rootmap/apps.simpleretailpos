@extends('apps.layout.master')
@section('title','Customer')
@section('content')
<section id="file-exporaat">
<?php
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
	$userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>


<div class="row">
    <div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify new user under a store and provide this role." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center">
                    <i class="icon-user"></i> {{ (isset($edit) ? "My Store Information" : "Set up Store") }}
                </h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <span id="pageMSG"></span>
                    <form action="{{ route('loyalty.setting.store.store') }}" method="POST">
                        @csrf

                        <div id = "form_data" class="form-body">
                            @if (isset($edit))
                                <button type="button" id="edit_store" class="btn btn-outline-secondary btn-sm" style="float: right;" name="edit"> Edit </button>
                            @endif
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="projectinput1"> Joined in Loyalty Program </label>
                                        <select {{ isset($edit)? "disabled" : "" }} name="is_in_loyalty_program" class="element form-control border-info">
                                            <option value="1"  {{ isset($edit) && $edit['is_in_loyalty_program'] === 1 ? "selected":"" }}>Yes</option>
                                            <option value="0" {{ isset($edit) && $edit['is_in_loyalty_program'] === 0 ? "selected":"" }}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="projectinput1"> Allow Cash Withdrawal With Loyalty Program </label>

                                        <select {{ isset($edit)? "disabled" : "" }} name="allow_cash_withdrawal_by_loyanty_point" class="element form-control border-info">
                                            <option value="1" {{ isset($edit) && $edit['allow_cash_withdrawal_by_loyanty_point'] === 1 ? "selected":"" }}>Yes</option>
                                            <option value="0"  {{ isset($edit) && $edit['allow_cash_withdrawal_by_loyanty_point'] === 0 ? "selected":"" }}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="projectinput1"> Currency To Loyaly Point Conversion Rate (Exp: 1  USD Purchase = .01 point)</label>
                                            <input {{ isset($edit)? "disabled" : "" }} type="text" @if(isset($edit))
                                                value="{{ $edit->currency_to_loyalty_conversion_rate }}"
                                            @endif name="currency_to_loyalty_conversion_rate" class="element form-control border-info" placeholder=".01">
                                    </div>
                                    <div class="form-group">
                                        <label for="projectinput1"> Minimum Purchase amount to Enroll in Loyalty Program </label>
                                            <input {{ isset($edit)? "disabled" : "" }} type="text" @if(isset($edit))
                                                value="{{ $edit->min_purchase_amount }}"
                                            @endif name="min_purchase_amount" class="element form-control border-info" placeholder="Minimum Purchase Amount">
                                    </div>
                                    <input id="edit_store_submit" {!! isset($edit) ? ' style="display:none"' : "" !!} type="submit" class="btn btn-primary" name="submit" value="submit" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var id = document.getElementById("edit_store");
    if(id){
        id.onclick = function(){
            var submit = document.getElementById("edit_store_submit");
            submit.removeAttribute('style');
            enableElements();
        }

        function enableElements(){
            var parent =document.getElementById('form_data');
            var dom =parent.getElementsByClassName('element');

            for(var i =0; i<dom.length; i++){
                dom[i].removeAttribute('disabled');
            }
        }
    }
</script>



</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
