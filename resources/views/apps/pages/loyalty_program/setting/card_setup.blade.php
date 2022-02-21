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
                    <i class="icon-user"></i> Setup New Membership Card
                </h4>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <span id="pageMSG"></span>

                    <form action="{{ route('loyalty.setting.card.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id = "form_data" class="form-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Membership Name </label>
                                                <input type="text" required name="membership_name" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Status </label>
                                                <select required  name="status" class="element form-control border-info">
                                                    <option>--Select One--</option>
                                                    <option value="activee">Active</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Point Range From </label>
                                                <input  name="point_range_from" type="number" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Point Range To </label>
                                                <input  name="point_range_to" type="number" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="custom-file-container" data-upload-id="myUniqueUploadId">
                                                <label>Upload Membership card Picture <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image" ></a></label>
                                                <label class="custom-file-container__custom-file">
                                                    <input
                                                        type="file"
                                                        name = "card_pic_path"
                                                        class="custom-file-container__custom-file__custom-file-input"
                                                        accept=".png, .jpg, .jpeg"
                                                        aria-label="Choose an Image"
                                                    />
                                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                    <span
                                                        class="custom-file-container__custom-file__custom-file-control"
                                                    ></span>
                                                </label>
                                                <div class="custom-file-container__image-preview"
                                                    style="overflow: hidden; hight: 220px; width:350px; border:2px solid #CCCCCC; border-radius:3%; transition: all 0.2s; -webkit-transition: all 0.2s;"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="background-color: #eff4ff">
                                            <div class="row">
                                                <h3 style="padding: 1.2em .8em;"> Card Display Setting </h3>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" class="element" name="card_display_config[name]" value="1">
                                                            <label for="subject_card">Customer Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" class="element"  name="card_display_config[mobile]" value="1">
                                                            <label for="subject_card">Mobile_number</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" class="element"  name="card_display_config[store_name]" value="1">
                                                            <label for="subject_card">Store Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" class="element"  name="card_display_config[membership_type]" value="1">
                                                            <label for="subject_card">Membership Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox"  class="element" name="card_display_config[joined_date]" value="1">
                                                            <label for="subject_card">Member Since</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="card_submit"  type="submit" class="btn btn-primary" name="submit" value="submit" />
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
