@extends('apps.layout.master')
@section('title','Product')
@section('content')
<section id="form-action-layouts">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

		<div class="row">
		<div class="col-md-6 offset-md-1" @if($userguideInit==1) data-step="1" data-intro="In this section, you can add a new product." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
                        
                        @if(isset($edit))
                        <i class="icon-clipboard2"></i> Edit Product
                        @else
                        <i class="icon-clipboard2"></i> Add Product
                        @endif
                    </h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<form class="form" method="post"  enctype="multipart/form-data" 
                        @if(isset($edit))
                            action="{{url('product/modify/'.$dataRow->id)}}"
                        @else
                            action="{{url('product/save')}}"
                        @endif
                        >

							<div class="form-body">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="eventRegInput1">Select Category 
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="select2 form-control" style="width: 90%;" name="category_id">
                                            <option 
                                                @if(!isset($dataRow->category_id))
                                                    @if(empty($dataRow->category_id))
                                                    selected="selected" 
                                                    @endif
                                                @endif

                                            value="">Select a Category</option>
                                            @if(isset($existing_cat))
                                                @foreach($existing_cat as $cus)
                                                <option 
                                                    @if(isset($dataRow->category_id))
                                                        @if($dataRow->category_id==$cus->id)
                                                        selected="selected" 
                                                        @endif
                                                    @endif 
                                                value="{{$cus->id}}">{{$cus->name}}</option>
                                                @endforeach
                                            @endif                          
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="eventRegInput1">Product Barcode <span class="text-danger">*</span></label>
                                        <input type="text" 
                                        @if(isset($edit))
                                            value="{{$dataRow->barcode}}" 
                                        @endif 
                                        id="eventRegInput1" class="form-control border-info" placeholder="Barcode" name="barcode">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group 
                                    @if(isset($chkPS))
                                        @if($chkPS->product_image_status==1)
                                             col-md-6 
                                        @else 
                                             col-md-12 
                                        @endif
                                    @endif
                                     mb-2 proNameArea">
                                        <label for="eventRegInput1">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                        @if(isset($edit))
                                            value="{{$dataRow->name}}" 
                                        @endif 
                                        id="eventRegInput1" class="form-control border-info tpname" placeholder="Product Name" name="name">
                                    </div>

                                    <div class="form-group col-md-6 mb-2 proImageArea">
                                        <label for="eventRegInput1">Product Image <span class="text-danger">*</span></label>
                                        <label class="custom-file center-block block">
                                          <input type="file" id="file_product" name="product_image" class="custom-file-input">
                                          <span class="custom-file-control"></span>
                                        </label>
                                    </div>

                                </div>

                                @if(isset($edit))
                                <input type="hidden" name="ex_product_image" value="{{$dataRow->image}}" >
                                @endif 
								
								<div class="row">
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput2">Quantity In Stock <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->quantity}}" 
                                        @endif 
                                        type="number" id="number" class="form-control border-info" placeholder="Quantity In Stock" value="0" name="quantity">
									</div>	

									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Price Per Item <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->price}}" 
                                        @endif 
                                        type="text"  class="form-control border-info tpprice" placeholder="Price Per Item" value="0" name="price">
									</div>
								
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Cost Per Item <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->cost}}" 
                                        @endif 
                                        type="text"  class="form-control border-info" placeholder="Cost Per Item" value="0" name="cost">
									</div>
								</div>

							
							</div>

							<div class="form-actions center">
								<button type="button" class="btn btn-info btn-darken-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the clear button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
                                <button type="submit" class="btn btn-info btn-accent-2">
                                    <i class="icon-check2"></i> Update
                                </button>
                                @else
                                <button type="submit" class="btn btn-info btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
                                    <i class="icon-check2"></i> Save
                                </button>
                                @endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center">
                        <i class="icon-cogs"></i> Product Image Settings
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form" method="post" action="">

                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-5 offset-md-3 mb-2">
                                        <div class="input-group">
                                            
                                            <span class="input-group-addon" id="radio-addon3">
                                                <input type="checkbox" 
                                                @if(isset($chkPS))
                                                    @if($chkPS->product_image_status==1)
                                                        checked="checked" 
                                                    @endif
                                                @endif
                                                 id="switchery" class="switchery" data-size="xs"/>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="chkPS" value="{{isset($chkPS)?$chkPS->product_image_status:'0'}}" id="chkPS">
                               
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-5 offset-md-3 product_with_image">
                                        <a  href="#" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">

                                            <div class="card-body" style="border-top-right-radius:3px; border-bottom: 2px green solid; border-top-left-radius: 3px;">
                                            <img class="card-img-top img-fluid" style="height:100px; width: 100%; border-top-right-radius:3px; border-top-left-radius: 3px;" 
                                            @if(isset($edit))
                                                @if(!empty($dataRow->image))
                                                    src="{{ url('upload/product/'.$dataRow->image) }}" 
                                                @else
                                                    src="{{ url('images/product-avater-2.jpg') }}" 
                                                @endif
                                            
                                            @else 
                                                src="{{ url('images/product-avater-2.jpg') }}" 
                                            @endif 
                                            
                                            alt="">
                                            </div>

                                            <div class="card-body collapse in">
                                                        
                                                <div class="p-1 card-header" style="padding: 0.7rem !important;">
                                                    <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left info product_name_place" style="color: #fff;">
                                                        @if(isset($edit))
                                                            @if(!empty($dataRow->name))
                                                                {{ $dataRow->name }}
                                                            @else
                                                                Product Name
                                                            @endif
                                                        
                                                        @else 
                                                            Product Name
                                                        @endif 
                                                    </p>          
                                                </div>
                                            <div class="text-xs-right info" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">$<span class="product_price_place">
                                                @if(isset($edit))
                                                    @if(!empty($dataRow->price))
                                                        {{ $dataRow->price }}
                                                    @else
                                                        Price 
                                                    @endif
                                                
                                                @else 
                                                    price
                                                @endif
                                            </span></div>
                                            </div>    
                                        </a>
                                    </div>



                                    <div class="col-md-5  offset-md-3 product_without_image">
                                        <a href="#" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">
                                            <div class="card-body collapse in">
                                                        
                                                <div class="p-1 bg-info" style="padding: 0.7rem !important; border-top-right-radius:3px; border-top-left-radius: 3px;">
                                                    <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left product_name_place" style="color: #fff;">Test Name</p>          
                                                </div>
                                            <div class="text-xs-right" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">$<span class="product_price_place">555</span></div>
                                            </div>    
                                        </a>
                                    </div>





                                </div>

                            
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card-header">
                    <hr>
                    <h4 class="card-title" style="text-align: center;" id="basic-layout-card-center">
                        <i class="icon-monitor"></i> Review Panel : Image <code class="imgStatusProduct">Disabled</code>
                    </h4>
                </div>
            </div>
        </div>
	</div>
	<!-- Both borders end-->


    <!-- Both borders end-->

<!-- Both borders end -->


</section>
<script type="text/javascript">
    var productSettings="{{url('product/settings')}}";
</script>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'switchery'=>1,'addproduct'=>1])
