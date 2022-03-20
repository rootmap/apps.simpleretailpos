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
                                                <input type="text" onchange="changeCard(this, '')" required name="membership_name" class="element form-control border-info"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Status </label>
                                                <select required  name="status" class="element form-control border-info">
                                                    <option>--Select One--</option>
                                                    <option value="active">Active</option>
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
                                                    style=" position : relative; overflow: hidden; hight: 220px; width:420px; border:2px solid #CCCCCC; border-radius:3%; transition: all 0.2s; -webkit-transition: all 0.2s;">

                                                    <div class="row" style=" padding: 8px 5px;">
                                                        <div class="col-md-12"  id="storeDisplay">
                                                            <h3 id="display_store_name" style="text-align: center; text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;" class="contentBlock">{{ $store->name }}</h3>
                                                            <h3 id="cardDisplay" style="text-align: center; text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;" >Membership Name</h3>
                                                        </div>

                                                        <div class="col-md-12" style="position: absolute; top:42%; left : 0px;">
                                                            <div class="row">
                                                                <div class="col-md-12"  id="customerDisplay"> <h5  class="contentBlock" style="text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;">Customer Name</h5> </div>
                                                                <div class="col-md-12"  id="mobileDisplay"><h5  class="contentBlock">+880 1729 129 858</h5></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6"  id="pointDisplay" style="position: absolute; bottom:0px; left : 0px;"><h3  class="contentBlock" >Total Point</h3></div>
                                                        <div class="col-md-6"  id="sinceDisplay" style="position: absolute; bottom:0px; right : 0px; text-align: right;">
                                                            Member Since
                                                            <h6 class="contentBlock">June, 2022</h6>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="background-color: #eff4ff">
                                            <div class="row">
                                                <h3 style="padding: 1.2em .8em;"> Card Display Setting </h3>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="customerCheck"  onchange="changeCustomer(this)" class="element" name="card_display_config[name]" value="1">
                                                            <label for="subject_card">Customer Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox"  id="mobileCheck" class="element" onchange="changeMobile(this)"  name="card_display_config[mobile]" value="1">
                                                            <label for="subject_card">Mobile_number</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="storeCheck" class="element"  onchange="changeStore(this)"  name="card_display_config[store_name]" value="1">
                                                            <label for="subject_card">Store Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="cardCheck" onchange="changeCard('', this)" class="element"  name="card_display_config[membership_type]" value="1">
                                                            <label for="subject_card">Membership Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="sinceCheck" onchange="changeSince(this)"  class="element" name="card_display_config[joined_date]" value="1">
                                                            <label for="subject_card">Member Since</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" id="sinceCheck" onchange="changePoint(this)"  class="element" name="card_display_config[total_point]" value="1">
                                                            <label for="subject_card">Total Point</label>
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
    var upload = new FileUploadWithPreview("myUniqueUploadId"),
    storeDisplay = document.getElementById('display_store_name'),
    cardDisplay = document.getElementById('cardDisplay'),
    customerDisplay = document.getElementById('customerDisplay'),
    mobileDisplay = document.getElementById('mobileDisplay'),
    sinceDisplay = document.getElementById('sinceDisplay');
    pointDisplay = document.getElementById('pointDisplay');


    window.onload = function(){
        storeDisplay.style.display = "none";
        cardDisplay.style.display = "none";
        customerDisplay.style.display = "none";
        mobileDisplay.style.display = "none";
        sinceDisplay.style.display = "none";
        pointDisplay.style.display = "none";

    }
    function changeCard(card, visibility){
        if(card!== ""){
            var card = card.value;

            // var block = cardDisplay.getElementsByClassName('contentBlock');
            var block = cardDisplay;
            block.innerHTML = card;
        }
        if(visibility !== ""){

            if(visibility.checked){
                cardDisplay.style.display = "block";
            }
            else{
                cardDisplay.style.display = "none";
            }
        }
    }

    function changeStore(visibility){
        if(visibility !== ""){

            if(visibility.checked){
                storeDisplay.style.display = "block";
            }
            else{
                storeDisplay.style.display = "none";
            }
        }
    }
    function changeCustomer(visibility){
        if(visibility !== ""){

            if(visibility.checked){
                customerDisplay.style.display = "block";
            }
            else{
                customerDisplay.style.display = "none";
            }
        }
    }
    function changeMobile(visibility){
        if(visibility !== ""){

            if(visibility.checked){
                mobileDisplay.style.display = "block";
            }
            else{
                mobileDisplay.style.display = "none";
            }
        }
    }
    function changeSince(visibility){
        if(visibility !== ""){

            if(visibility.checked){
                sinceDisplay.style.display = "block";
            }
            else{
                sinceDisplay.style.display = "none";
            }
        }
    }
    function changePoint(visibility){
        if(visibility !== ""){

            if(visibility.checked){
                pointDisplay.style.display = "block";
            }
            else{
                pointDisplay.style.display = "none";
            }
        }
    }


</script>

</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
