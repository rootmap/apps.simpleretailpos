@extends('apps.layout.master')
@section('title','Sales List')
@section('content')
<section id="form-action-layouts">

  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-cart4"></i> Sales Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('sales/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('sales/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
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
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th>Sold To</th>
                                <th>Invoice Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->invoice_id}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->total_amount}}</td>
                                <td>
                                    <span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{url('sales/invoice/'.$row->id)}}" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Invoice</a>
                                            <a href="javascript:putInvoiceModal('{{$row->invoice_id}}');" title="Send Invoice" class="dropdown-item"><i class="icon-email2"></i> Send Invoice</a>
                                            <a href="{{url('sales/edit/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                            <a href="{{url('sales/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
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
@include('apps.include.modal.sendSlipModal')
</section>

@endsection

@include('apps.include.datatable',['JDataTable'=>1,'invoiceSlip'=>1])