@extends('apps.layout.master')
@section('title','Sales List')
@section('content')
<section id="form-action-layouts">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Sales Report Filter</h4>
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
                    <form id="salesSu" method="post" action="{{url('sales/report')}}">
                        {{csrf_field()}}
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-md-2">
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
                                <div class="col-md-2">
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
                                    <h4>Invoice ID</h4>
                                    <div class="input-group">
                                    <input 
                                     @if(!empty($invoice_id))
                                            value="{{$invoice_id}}"  
                                     @endif 
                                     type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="invoice_id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h4>Customer</h4>
                                    <div class="input-group">
                                        <select name="customer_id" class="select2 form-control">
                                            <option value="">Select a customer</option>
                                            @if(isset($customer))
                                                @foreach($customer as $cus)
                                                <option 
                                                 @if(!empty($customer_id) && $customer_id==$cus->id)
                                                    selected="selected"  
                                                 @endif 
                                                value="{{$cus->id}}">{{$cus->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <h4>Status</h4>
                                    <div class="input-group">
                                        <select name="invoice_status" class="form-control">
                                            <option value="">Select a Status</option>
                                            <option 
                                                @if(!empty($invoice_status) && $invoice_status=='Due')
                                                    selected="selected"  
                                                 @endif 
                                             value="Due">Due</option>
                                            <option 
                                                @if(!empty($invoice_status) && $invoice_status=='Partial')
                                                    selected="selected"  
                                                 @endif
                                            value="Partial">Partial</option>
                                            <option 
                                                @if(!empty($invoice_status) && $invoice_status=='Paid')
                                                    selected="selected"  
                                                 @endif
                                            value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    
                                    <div class="input-group" style="margin-top:32px;">
                                        <button type="submit" id="salesSUSub" class="btn btn-primary mr-1">
                                            <i class="icon-check2"></i> Generate Report
                                        </button>
                                        <a href="javascript:void(0);" data-url="{{url('sales/excel/report')}}" class="btn btn-info mr-1 change-action-export-sales">
                                            <i class="icon-file-excel-o"></i> Generate Excel
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{url('sales/pdf/report')}}" class="btn btn-success mr-1 change-action-export-sales">
                                            <i class="icon-file-pdf-o"></i> Generate PDF
                                        </a>
                                        <a href="{{url('sales/report')}}" style="margin-left: 5px;" class="btn btn-danger">
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
                <h4 class="card-title"><i class="icon-cart4"></i> Sales Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        {{-- <li><a href="{{url('sales/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('sales/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li> --}}
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
                                <th>Tender</th>
                                <th>Status</th>
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
                                <td>{{date('Y-m-d',strtotime($row->created_at))}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->tender_name}}</td>
                                <td>
                                    @if($row->Invoice_status=="Due")
                                        <span class="btn btn-danger">{{$row->Invoice_status}}</span>
                                    @elseif($row->Invoice_status=="Partial")
                                        <span class="btn btn-warning">{{$row->Invoice_status}}</span>
                                    @elseif($row->Invoice_status=="Paid")
                                        <span class="btn btn-success">{{$row->Invoice_status}}</span>
                                    @else
                                        <span class="btn btn-danger">{{$row->Invoice_status}}</span>
                                    @endif
                                </td>
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

@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1,'invoiceSlip'=>1])