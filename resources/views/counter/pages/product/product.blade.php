@extends('apps.layout.master')
@section('title','Product')
@section('content')
<section id="form-action-layouts">


		<div class="row">
		<div class="col-md-6 offset-md-3">
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
						<form class="form" method="post" 
                        @if(isset($edit))
                            action="{{url('product/modify/'.$dataRow->id)}}"
                        @else
                            action="{{url('product/save')}}"
                        @endif
                        >
							<div class="form-body">
                                {{ csrf_field() }}
								<div class="form-group">
									<label for="eventRegInput1">Product Name <span class="text-danger">*</span></label>
									<input type="text" 
                                    @if(isset($edit))
                                        value="{{$dataRow->name}}" 
                                    @endif 
                                    id="eventRegInput1" class="form-control border-primary" placeholder="Product Name" name="name">
								</div>

								<div class="row">
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput2">Quantity In Stock <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->quantity}}" 
                                        @endif 
                                        type="number" id="number" class="form-control border-primary" placeholder="Quantity In Stock" value="0" name="quantity">
									</div>	

									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Price Per Item <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->price}}" 
                                        @endif 
                                        type="text"  class="form-control border-primary" placeholder="Price Per Item" value="0" name="price">
									</div>
								
									<div class="form-group col-md-4 mb-2">
										<label for="eventRegInput3">Cost Per Item <span class="text-danger">*</span></label>
										<input 
                                        @if(isset($edit))
                                        value="{{$dataRow->cost}}" 
                                        @endif 
                                        type="text"  class="form-control border-primary" placeholder="Cost Per Item" value="0" name="cost">
									</div>
								</div>

							
							</div>

							<div class="form-actions center">
								<button type="button" class="btn btn-warning mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> Update
                                </button>
                                @else
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> Save
                                </button>
                                @endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Both borders end-->


    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i> Product List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
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
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 50px;">Quantity IN Stock</th>
                                <th>Price</th>
                                <th>Cost</th>
                                
                                <th>Total Price</th>
                                <th>Total Cost</th>
                                <th>Product Added</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->price}}</td>
                                <td>{{$row->cost}}</td>
                                
                                <td>{{($row->price*$row->quantity)}}</td>
                                <td>{{($row->cost*$row->quantity)}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>
                                        <a href="{{url('product/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info"><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('product/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                </div>
                                </td>
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


</section>

@endsection

@include('apps.include.datatable',['JDataTable'=>1])