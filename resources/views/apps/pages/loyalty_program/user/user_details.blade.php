@extends('apps.layout.master')
@section('title','Loyalty Users')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
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
    <div class="col-md-6" @if($userguideInit==1) data-step="1" data-intro="In this section, you can added/modify new user under a store and provide this role." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center">
                    <i class="icon-user"></i> User Information
                </h4>
            </div>
            {{-- {{ dd($edit) }} --}}
            <div class="card-body collapse in">
                <div class="card-block">
                    <span id="pageMSG"></span>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Name </label>
                                    <input type="text"
                                        @if(isset($edit))
                                            value="{{$edit->name}}"
                                        @endif
                                        id="eventRegInput1"  readonly="" class="form-control border-info" placeholder="Full name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="projectinput1">Email </label>

                                        @if(isset($edit))
                                        <input type="text"  readonly="" id="eventRegInput2" class="form-control border-info" placeholder="Email Address" name="email" readonly="" value="{{$edit->email}}">
                                        @endif

                                </div>
                                <div class="form-group">
                                    <label for="projectinput1">Phone </label>
                                        <input type="text"
                                        @if(isset($edit))
                                            value="{{$edit->phone}}"
                                        @endif
                                        id="eventRegInput4"  readonly="" class="form-control border-info" placeholder="Phone Number" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="projectinput1">Total Invoices </label>
                                        <input type="text"
                                        @if(isset($edit))
                                            value="{{$edit->total_invoices}}"
                                        @endif
                                        id="eventRegInput4"  readonly="" class="form-control border-info" placeholder="Phone Number" name="phone">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Store Name </label>
                                        <input type="text" @if(isset($edit))
                                            value="{{$edit->store_name}}"
                                        @endif  readonly="" class="form-control border-info" placeholder="Store Name">
                                </div>
                                <div class="form-group">
                                    <label for="projectinput1">Total Loyalty Point </label>
                                        <input type="text" @if(isset($edit))
                                            value="{{$edit->total_point}}"
                                        @endif  readonly="" class="form-control border-info" placeholder="Store Name">
                                </div>
                                <div class="form-group">
                                    <label for="projectinput1">Total Purchase </label>
                                        <input type="text"
                                        @if(isset($edit))
                                            value="{{$edit->total_purchase_amount}}"
                                        @endif
                                        id="eventRegInput4"  readonly="" class="form-control border-info" placeholder="Phone Number" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        @php
            // dd($data);
            $image = isset($data) ? $data['card_pic_path'] : '';
            // dd($image);
            $config = isset($data->card_display_config)? json_decode($data->card_display_config) : [];
            // dd(isset($config->aname));
            $style_block = "display:block";
            $style_none = "display:none";
            $storeDisplay = (isset($config->store_name) && $config->store_name == 1) ? $style_block : $style_none;
            $customerDisplay = (isset($config->name) && $config->name == 1) ? $style_block : $style_none;
            $mobileDisplay = (isset($config->mobile) && $config->mobile == 1) ? $style_block : $style_none;
            $cardDisplay = (isset($config->membership_type) && $config->membership_type == 1) ? $style_block : $style_none;
            $sinceDisplay = (isset($config->joined_date) && $config->joined_date == 1) ? $style_block : $style_none;
            $pointDisplay = (isset($config->total_point) && $config->total_point == 1) ? $style_block : $style_none;
        @endphp
        <div id="image_preview" class="custom-file-container__image-preview"
            style="overflow: hidden; position:relative; hight: 220px; width:420px; border:2px solid #CCCCCC; border-radius:3%; transition: all 0.2s; -webkit-transition: all 0.2s;">
            <div class="row" style=" padding: 8px 5px;">
                <div class="col-md-12">
                    <div class="col-md-12"  id="storeDisplay" style="{{ $storeDisplay }}"> <h3 id="display_store_name" style="text-align: center; text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;" class="contentBlock">{{ $edit->store_name }}</h3></div>
                    <div class="col-md-12"  id="cardDisplay" style="{{ $storeDisplay }}"> <h3 id="display_store_name" style="text-align: center; text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;" class="contentBlock">{{ $edit->membership_card_type }}</h3></div>

                </div>
                <div class="col-md-12" style="position: absolute; top:42%; left : 0px;">
                    <div class="row">
                        <div class="col-md-12"  id="customerDisplay"  style="{{ $customerDisplay }}"> <h5  class="contentBlock" style="text-shadow: 2px 2px 2px #B4ACA6; font-weight: bold;"> {{ $edit->name }} </h5> </div>
                        <div class="col-md-12"  id="mobileDisplay" style="{{ $mobileDisplay }}"><h5  class="contentBlock">{{ $edit->phone }} </h5></div>
                    </div>
                </div>
                <div class="col-md-6"  id="pointDisplay" style="position: absolute; bottom:0px; left : 0px; text-shadow: 2px 2px 2px #5c5a5a; font-weight: bold; {{ $pointDisplay }}"><h3  class="contentBlock" >{{$edit->total_point}}</h3></div>
                <div class="col-md-6"  id="sinceDisplay" style="position: absolute; bottom:0px; right : 0px; text-align: right; {{ $sinceDisplay }}">
                    <span style="text-shadow: 2px 2px 2px #5c5a5a; font-weight: bold;">Member Since</span>
                    <h6 class="contentBlock">{{ formatDate($edit->created_at) }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all customer in this table and see customer report." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> User's Loyalty Invoices</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a href="{{url('customer/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('customer/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-striped table-bordered zero-configuration">
						<thead>
							<tr>
								<th>Invoice ID</th>
								<th>User ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Purchase Amount</th>
								<th>Promotion ID</th>
								<th>Earned Point</th>
								<th>Membership Type</th>
								<th> Tender ID </th>
								<th>Tender Name</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->invoice_id}}</td>
								<td>{{$row->user_id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->purchase_amount}}</td>
								<td>{{$row->promotion_id}}</td>
								<td>{{$row->earned_point}}</td>
								<td>{{$row->membership_card_type}}</td>
								<td>{{$row->tender_id}}</td>
								<td>{{$row->tender_name}}</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="6">No Record Found</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Both borders end -->

<script type="text/javascript">
    window.onload = function(){
        var url = '{{ asset($image) }}';
        var image_preview = document.getElementById("image_preview");
        if(url != "")
            image_preview.style.backgroundImage = "url("+url+")";
            console.log(url);
    }
</script>
</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])
