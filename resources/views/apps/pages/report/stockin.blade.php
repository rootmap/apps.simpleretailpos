@extends('apps.layout.master')
@section('title','Stockin Order Report')
@section('content')
<section id="form-action-layouts">
<?php 
        $userguideInit=StaticDataController::userguideInit();
        //dd($dataMenuAssigned);
    ?>
<div class="row">
        <div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see stock in order report by date wise or order id or vendor and generate excel or PDF." @endif>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Stock In Order Report Filter</h4>
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
                        <form method="post" action="{{url('product/stock/in/report')}}">
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
                                    <div class="col-md-2">
                                        <h4>Order ID</h4>
                                        <div class="input-group">
                                        <input 
                                         @if(!empty($order_no))
                                                value="{{$order_no}}"  
                                         @endif 
                                         type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Order ID" name="order_no">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h4>Vendor</h4>
                                        <div class="input-group">
                                            <select name="vendor_id" class="select2 form-control">
                                                <option value="">Select a Vendor</option>
                                                @if(isset($vendor))
                                                    @foreach($vendor as $ven)
                                                    <option 
                                                     @if(!empty($vendor_id) && $vendor_id==$ven->id)
                                                        selected="selected"  
                                                     @endif 
                                                    value="{{$ven->id}}">{{$ven->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <div class="input-group" style="margin-top:32px;">
                                            <button type="submit" class="btn btn-info btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
                                                <i class="icon-check2"></i> Generate Report
                                            </button>
                                            <a href="javascript:void(0);" data-url="{{url('product/stock/in/excel/report')}}" class="btn btn-info btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
                                                <i class="icon-file-excel-o"></i> Generate Excel
                                            </a>
                                            <a href="javascript:void(0);" data-url="{{url('product/stock/in/pdf/report')}}" class="btn btn-info btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
                                                <i class="icon-file-pdf-o"></i> Generate PDF
                                            </a>
                                            <a href="{{url('product/stock/in/report')}}" style="margin-left: 5px;" class="btn btn-info btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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
    <div class="col-xs-12" @if($userguideInit==1) data-step="6" data-intro="You are seeing your stock in order report by search and total stockin quantity." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-stack"></i> Stock In Order Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('product/stock/in/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('product/stock/in/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="min-height: 360px;">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Invoice Total Quantity</th>
                                <th>Created At</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_quantity=0;
                            ?>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->order_no}}</td>
                                <td>{{$row->order_date}}</td>
                                <td>{{$row->total_quantity}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->created_by}}</td>
                            </tr>
                            <?php $total_quantity+=$row->total_quantity; ?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 border-right-pink bg-info border-right-lighten-3">
            <div class="card-block text-xs-center">
                <h1 class="display-3 white"><i class="icon-stack font-large-2"></i> {{$total_quantity}}</h1>
                <span class="white">Total Stockin Quantity</span>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->

</section>

@endsection

@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])