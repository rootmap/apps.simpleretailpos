@extends('apps.layout.master')
@section('title','Create Warranty From Invoice List')
@section('content')
<section id="file-exporaat">

<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the warranty inventory report in this table and see the details." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-cart4"></i> Warranty Inventory Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('warranty/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('warranty/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
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
                                <th>WARRANTY BATCH ID</th>
                                <th>WARRANTY BATCH DATE</th>
                                <th>WARRANTY PRODUCT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{date('Y-m-d',strtotime($row->created_at))}}</td>
                                <td>{{$row->warranty_batch_quantity}}</td>
                                <td>

                                    <a href="{{url('warranty/view/'.$row->id)}}" title="Detail View" class="btn btn-info" @if($userguideInit==1) data-step="2" data-intro="Please click here for see detail." @endif><i class="icon-book"></i> See Detail</a>
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