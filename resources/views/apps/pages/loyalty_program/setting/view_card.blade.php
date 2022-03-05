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
                    $membership_name = isset($data) ? $data['membership_name'] : '';
                    $status = isset($data) ? $data['status'] : '';
                    $p_from = isset($data) ? $data['point_range_from'] : '';
                    $p_to = isset($data) ? $data['point_range_to'] : '';
                    $image = isset($data) ? $data['card_pic_path'] : '';
                    $config = isset($data) ? $data['card_display_config'] : '';
                    $config = json_decode($config);
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
                                <i class="icon-user"></i> Get Information Details on: <b> {{ $membership_name }} </b>
                            </h4>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <span id="pageMSG"></span>

                                <form action="{{ route('loyalty.setting.card.update',[$id]) }}" method="POST"
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
                                                            <label for="projectinput1"> Membership Name </label>
                                                            <input disabled type="text"  onchange="changeCard(this, '')" required name="membership_name" value="{{ $membership_name }}"
                                                                class="element form-control border-info" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Status </label>
                                                            <select required name="status" disabled
                                                                class="element form-control border-info">
                                                                <option>--Select One--</option>
                                                                <option value="active" {{ ($status === "active")? "selected" : "" }}>Active</option>
                                                                <option value="draft" {{ ($status === "draft")? "selected" : "" }}>Draft</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Point Range From </label>
                                                            <input disabled name="point_range_from" type="number" value="{{ $p_from }}"
                                                                class="element form-control border-info" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Point Range To </label>
                                                            <input disabled name="point_range_to" type="number" value="{{ $p_to }}"
                                                                class="element form-control border-info" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-file-container"
                                                            data-upload-id="myUniqueUploadId">
                                                            <label>Upload Membership card Picture <a
                                                                    href="javascript:void(0)"
                                                                    class="custom-file-container__image-clear"
                                                                    title="Clear Image"></a></label>
                                                            <label id = "image_imput" class="custom-file-container__custom-file"
                                                                style="display: none;">
                                                                <input type="file" name="card_pic_path"
                                                                    class="custom-file-container__custom-file__custom-file-input"
                                                                    accept=".png, .jpg, .jpeg"
                                                                    aria-label="Choose an Image" />
                                                                <input type="hidden" name="MAX_FILE_SIZE"
                                                                    value="10485760" />
                                                                <span
                                                                    class="custom-file-container__custom-file__custom-file-control"></span>
                                                            </label>
                                                            @php
                                                                $config = json_decode($data->card_display_config);
                                                                // dd(isset($config->aname));
                                                                $style_block = "display:block";
                                                                $style_none = "display:none";

                                                                $storeDisplay = (isset($config->store_name) && $config->store_name == 1) ? $style_block : $style_none;
                                                                $customerDisplay = (isset($config->name) && $config->name == 1) ? $style_block : $style_none;
                                                                $mobileDisplay = (isset($config->mobile) && $config->mobile == 1) ? $style_block : $style_none;
                                                                $cardDisplay = (isset($config->membership_type) && $config->membership_type == 1) ? $style_block : $style_none;
                                                                $sinceDisplay = (isset($config->joined_date) && $config->joined_date == 1) ? $style_block : $style_none;
                                                            @endphp

                                                            <div id="image_preview" class="custom-file-container__image-preview"
                                                                style="overflow: hidden; position:relative; hight: 220px; width:420px; border:2px solid #CCCCCC; border-radius:3%; transition: all 0.2s; -webkit-transition: all 0.2s;">
                                                                <div class="row" style=" padding: 8px 5px;">
                                                                    <div class="col-md-12"  id="storeDisplay" style="{{ $storeDisplay }}"> <h3 id="display_store_name" style="text-align: center; text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;" class="contentBlock">{{ $store->name }}</h3></div>
                                                                    <div class="col-md-12" style="position: absolute; top:42%; left : 0px;">
                                                                        <div class="row">
                                                                            <div class="col-md-12"  id="customerDisplay"  style="{{ $customerDisplay }}"> <h5  class="contentBlock" style="text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;">Md. Customer Name</h5> </div>
                                                                            <div class="col-md-12"  id="mobileDisplay" style="{{ $mobileDisplay }}"><h5  class="contentBlock">+880 1729 129 858</h5></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6"  id="cardDisplay" style="position: absolute; bottom:0px; left : 0px; {{ $mobileDisplay }}"><h3  class="contentBlock" >{{ $membership_name }}</h3></div>
                                                                    <div class="col-md-6"  id="sinceDisplay" style="position: absolute; bottom:0px; right : 0px; text-align: right; {{ $sinceDisplay }}">
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
                                                                        <input disabled type="checkbox"  id="customerCheck"  onchange="changeCustomer(this)"  class="element"
                                                                            name="card_display_config[name]" value="1" {{ isset($config->name) ?  "checked": "" }}>
                                                                        <label for="subject_card">Customer Name</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="checkbox checkbox-primary">
                                                                        <input disabled type="checkbox"  id="mobileCheck" class="element" onchange="changeMobile(this)" class="element"
                                                                            name="card_display_config[mobile]" value="1" {{ isset($config->mobile) ?  "checked": "" }}>
                                                                        <label for="subject_card">Mobile_number</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="checkbox checkbox-primary">
                                                                        <input disabled type="checkbox" id="storeCheck" class="element"  onchange="changeStore(this)" class="element" {{ isset($config->store_name) ?  "checked": "" }}
                                                                            name="card_display_config[store_name]"
                                                                            value="1">
                                                                        <label for="subject_card">Store Name</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="checkbox checkbox-primary">
                                                                        <input disabled type="checkbox" id="cardCheck" onchange="changeCard('', this)" class="element"
                                                                            name="card_display_config[membership_type]" {{ isset($config->membership_type) ?  "checked": "" }}
                                                                            value="1">
                                                                        <label for="subject_card">Membership Type</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="checkbox checkbox-primary">
                                                                        <input disabled type="checkbox" id="sinceCheck" onchange="changeSince(this)" class="element"
                                                                            name="card_display_config[joined_date]" {{ isset($config->joined_date) ?  "checked": "" }}
                                                                            value="1">
                                                                        <label for="subject_card">Member Since</label>
                                                                    </div>
                                                                </div>
                                                            </div>
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
        <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>

        <script>
            var upload = new FileUploadWithPreview("myUniqueUploadId");
        </script>

        <script type="text/javascript">
            var id = document.getElementById("edit_card");
            if (id) {
                window.onload = function(){
                var url = '{{ asset($image) }}';
                    var image_preview = document.getElementById("image_preview");
                    if(url != "")
                        image_preview.style.backgroundImage = "url("+url+")";
                }
                id.onclick = function() {
                    var submit = document.getElementById("card_submit");
                    var image_imput = document.getElementById("image_imput");
                    submit.removeAttribute('style');
                    image_imput.removeAttribute('style');
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

<script>
    var upload = new FileUploadWithPreview("myUniqueUploadId"),
    storeDisplay = document.getElementById('storeDisplay'),
    cardDisplay = document.getElementById('cardDisplay'),
    customerDisplay = document.getElementById('customerDisplay'),
    mobileDisplay = document.getElementById('mobileDisplay'),
    sinceDisplay = document.getElementById('sinceDisplay');


    // window.onload = function(){
    //     storeDisplay.style.display = "none";
    //     cardDisplay.style.display = "none";
    //     customerDisplay.style.display = "none";
    //     mobileDisplay.style.display = "none";
    //     sinceDisplay.style.display = "none";

    // }
    function changeCard(card, visibility){
        if(card!== ""){
            var card = card.value;
            var block = cardDisplay.getElementsByClassName('contentBlock')[0];
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


</script>

    </section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
