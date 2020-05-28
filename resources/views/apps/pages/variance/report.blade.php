@extends('apps.layout.master')
@section('title','Variance Report Detail')
@section('content')
<section id="form-action-layouts">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the variance report in this table." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-tab"></i> Variance Report Detail</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="overflow:visible;">
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Variance ID</th>
                                <th>Variance DATE</th>
                                <th>Product Name</th>
                                <th>Quantity In System</th>
                                <th>Quantity In Hand</th>
                                <th>Quantity Variance</th>
                                <th>Cost Variance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataVariance))
                            @foreach($dataVariance as $row)
                            <tr>
                                <td>{{$row->variance_id}}</td>
                                <td>{{date('d/m/y',strtotime($row->created_at))}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->quantity_in_system}}</td>
                                <td>{{$row->quantity_in_hand}}</td>
                                <td>{{$row->variance_quanity}}</td>
                                <td>{{$row->variance_cost}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No Record Found</td>
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