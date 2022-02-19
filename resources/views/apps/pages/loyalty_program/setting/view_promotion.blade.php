@extends('apps.layout.master')
@section('title', 'Customer')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
@endsection
@section('content')
    <section id="file-exporaat">
        <?php
        $dataMenuAssigned = [];
        $dataMenuAssigned = StaticDataController::dataMenuAssigned();
        $userguideInit = StaticDataController::userguideInit();
        ?>


        <div class="row">
            <div class="col-md-8 offset-md-2"
                @if ($userguideInit == 1) data-step="1" data-intro="In this section, you can added/modify new user under a store and provide this role." @endif>
                @php
                    $id = isset($data) ? $data['id'] : '';
                    $title = isset($data) ? $data['promotion_title'] : '';
                    $status = isset($data) ? $data['status'] : '';
                    $membership = isset($data) ? $data['for_membership_type'] : '';
                    $rate = isset($data) ? $data['currency_to_loyalty_conversion_rate'] : '';
                    $start = isset($data) ? $data['start_at'] : '';
                    $end = isset($data) ? $data['end_at'] : '';

                @endphp
                @if (!isset($data))
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Sorry, No Record found.
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-card-center">
                                <i class="icon-user"></i> Promotion Details  on: <b> {{ $title }} </b>
                            </h4>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <span id="pageMSG"></span>

                                <form action="{{ route('loyalty.setting.promotion.update',[$id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div id="form_data" class="form-body">
                                            <button type="button" id="edit_card" class="btn btn-outline-secondary btn-sm"
                                                style="float: right;" name="edit"> Edit </button>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Title </label>
                                                            <input type="text" disabled required name="promotion_title" class="element form-control border-info" value="{{ $title }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Status </label>
                                                            <select disabled required  name="status" class="element form-control border-info">
                                                                <option>--Select One--</option>
                                                                <option value="active"  {{ ($status === "active")? "selected" : "" }}>Active</option>
                                                                <option value="inactive"  {{ ($status === "inactive")? "selected" : "" }}>In-Active</option>
                                                                <option value="draft"  {{ ($status === "draft")? "selected" : "" }}>Draft</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Eligible for Membership Type </label>
                                                            <select disabled name="for_membership_type" class="element form-control border-info">
                                                                <option>All Card Holder</option>
                                                                @foreach ($memberships as $item)
                                                                    <option value="{{ $item['membership_name'] }}"  {{ ($item['membership_name'] === $membership)? "selected" : "" }}>{{ $item['membership_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Currency to point Coversion Rate. Exp. (1 USD = .30)</label>
                                                            <input disabled required name="currency_to_loyalty_conversion_rate" type="text" class="element form-control border-info"  value="{{ $rate }}" placeholder=".03"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Start date</label>
                                                            <input disabled required  name="start_at" type="date" class="element form-control border-info" value="{{ $start }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Start date</label>
                                                            <input disabled required  name="end_at" type="date" class="element form-control border-info" value="{{ $end }}"/>
                                                        </div>

                                                    </div>
                                                </div>
                                                <input id="card_submit" {!! isset($data) ? ' style="display:none"' : '' !!} type="submit"
                                                    class="btn btn-primary" name="submit" value="submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <script type="text/javascript">
            var id = document.getElementById("edit_card");
            if (id) {

                id.onclick = function() {
                    var submit = document.getElementById("card_submit");
                    submit.removeAttribute('style');
                    enableElements();
                }

                function enableElements() {
                    var parent = document.getElementById('form_data');
                    var dom = parent.getElementsByClassName('element');
                    for (var i = 0; i < dom.length; i++) {
                        dom[i].removeAttribute('disabled');
                    }
                }
            }
        </script>

    </section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
