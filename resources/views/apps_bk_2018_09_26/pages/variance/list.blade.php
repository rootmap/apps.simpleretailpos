@extends('apps.layout.master')
@section('title','Variance List')
@section('content')
<section id="form-action-layouts">

<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>  
  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-tab"></i> Variance List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('variance/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('variance/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
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
                                <th>ID</th>
                                <th>Variance ID</th>
                                <th>Variance Date</th>
                                <th>Variance Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->variance_id}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->total_variance_quantity}}</td>
                                <td>
                                    <span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            
                                            @if(in_array('Variance_List_View_Detail', $dataMenuAssigned)) 
                                            <a href="{{url('variance/products/report/'.$row->id)}}" title="View Report" class="dropdown-item"><i class="icon-clipboard2"></i> View Report</a> 
                                            @endif 
                                            
                                            @if(in_array('Variance_List_View_Edit', $dataMenuAssigned))
                                            <a href="{{url('variance/edit/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                            @endif

                                            @if(in_array('Variance_List_View_Delete', $dataMenuAssigned))
                                            <a href="{{url('variance/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                            @endif

                                        </span>
                                    </span>
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