@extends('apps.layout.master')
@section('title','Stockin Order Report')
@section('content')
<section id="form-action-layouts">

  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-stack"></i> Stock In Order eport</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
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
        <div class="col-lg-3 col-sm-12 border-right-pink bg-pink border-right-lighten-3">
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

@include('apps.include.datatable',['JDataTable'=>1])