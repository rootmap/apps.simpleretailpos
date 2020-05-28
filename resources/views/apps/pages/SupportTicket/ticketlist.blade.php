@extends('apps.layout.master')
@section('title','Support Ticket')
@section('content')
<section id="file-exporaat">
<!-- Both borders end-->
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all Support Ticket list in this table  ." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-users"></i> Support Ticket List</h4>
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
                                <th>Full Name</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Priority</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th style="width: 180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($ticket))
                            @foreach($ticket as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->subject}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->priority}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->last_ticket_action}}</td>
                                
                                <td>
                                         
                                        <a href="{{url('SupportTicket/view/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="5" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i> Support Detail</a>
                                        
                                        
                                        <a  href="{{url('SupportTicket/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-danger" @if($userguideInit==1) data-step="6" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i> Delete</a>
                                        
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