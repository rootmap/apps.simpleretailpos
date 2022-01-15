@extends('apps.layout.master')
@section('title','User Menu')
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
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all user list in this table. You can edit/delete." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-users"></i> Users List</h4>
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
                                <th>User Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                @if(Auth::user()->user_type==1)
                                    <th>Store</th>
                                @endif
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->user_type_name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                @if(Auth::user()->user_type==1)
                                    <td>{{$row->store_id}}</td>
                                @endif
                                <td>
                                        @if(in_array('User_List_Edit', $dataMenuAssigned)) 
                                        <a href="{{url('user/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info" @if($userguideInit==1) data-step="2" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        @endif
                                        @if(in_array('User_List_Delete', $dataMenuAssigned)) 
                                        <a  href="{{url('user/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-info btn-darken-1" @if($userguideInit==1) data-step="3" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
                                        @endif
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