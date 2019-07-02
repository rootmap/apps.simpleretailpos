@extends('apps.layout.master')
@section('title','Product')
@section('content')
<section id="form-action-layouts">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Product Report Filter</h4>
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
                    <form method="post" action="{{url('product/report')}}">
                        {{csrf_field()}}
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Start Date</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        <input 
                                        @if(!empty($start_date))
                                            value="{{$start_date}}"  
                                        @endif
                                        name="start_date" type="text" class="form-control DropDateWithformat" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4>End Date</h4>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        <input 
                                        @if(!empty($end_date))
                                            value="{{$end_date}}"  
                                        @endif 
                                         name="end_date" type="text" class="form-control DropDateWithformat" />
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    
                                    <div class="input-group" style="margin-top:32px;">
                                        <button type="submit" class="btn btn-primary mr-1">
                                            <i class="icon-check2"></i> Generate Report
                                        </button>
                                        <a href="javascript:void(0);" data-url="{{url('product/excel/report')}}" class="btn btn-info mr-1 change-action">
                                            <i class="icon-file-excel-o"></i> Generate Excel
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{url('product/pdf/report')}}" class="btn btn-success mr-1 change-action">
                                            <i class="icon-file-pdf-o"></i> Generate PDF
                                        </a>
                                        <a href="{{url('product/report')}}" style="margin-left: 5px;" class="btn btn-danger">
                                            <i class="icon-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i> Product List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('product/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('product/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
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
                                <th style="width: 50px;">Quantity in Stock</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>Product Added</th>
                                <th>Total price</th>
                                <th>Total cost</th>
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
                                <td>{{$row->created_at}}</td>
                                <td>{{($row->price*$row->quantity)}}</td>
                                <td>{{($row->cost*$row->quantity)}}</td>
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

@include('apps.include.datatable',['JDataTable'=>1,'dateDrop'=>1])