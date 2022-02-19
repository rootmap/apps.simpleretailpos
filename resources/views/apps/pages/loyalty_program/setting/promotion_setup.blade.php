@extends('apps.layout.master')
@section('title','Customer')
@section('css')
    <link rel="stylesheet" type="text/css"href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css"/>
@endsection
@section('content')
<section id="file-exporaat">
<?php
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
	$userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>


<div class="row">
    <div class="col-md-8 offset-md-2" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify new user under a store and provide this role." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center">
                    <i class="icon-user"></i> Setup Promotion
                </h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <span id="pageMSG"></span>

                    <form action="{{ route('loyalty.setting.promotion.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id = "form_data" class="form-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Title </label>
                                                <input type="text" required name="promotion_title" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Status </label>
                                                <select required  name="status" class="element form-control border-info">
                                                    <option>--Select One--</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">In-Active</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Eligible for Membership Type </label>
                                                <select name="for_membership_type" class="element form-control border-info">
                                                    <option>All Card Holder</option>
                                                    @foreach ($memberships as $item)
                                                        <option value="{{ $item['membership_name'] }}">{{ $item['membership_name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Currency to point Coversion Rate. Exp. (1 USD = .30)</label>
                                                <input  name="currency_to_loyalty_conversion_rate" type="text" class="element form-control border-info" placeholder=".03"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Start date</label>
                                                <input required  name="start_at" type="date" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Start date</label>
                                                <input required  name="end_at" type="date" class="element form-control border-info"/>
                                            </div>

                                        </div>
                                    </div>
                                    <input id="pormotion_submit"  type="submit" class="btn btn-primary" name="submit" value="submit" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>

<script>
    var upload = new FileUploadWithPreview("myUniqueUploadId");
</script>

</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
