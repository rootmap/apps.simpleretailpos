@extends('apps.layout.master')
@section('title','Event Calender')
@section('content')
<section id="form-action-layouts">
	<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-calendar-o"></i> Event List</h4>
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
                                <th>Event Name</th>
                                <th>Event Start Date</th>
                                <th>Event Start Time</th>
                                
                                <th>Event End Date</th>
                                <th>Event End Time</th>
                               
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->event_name}}</td>
                                <td>{{$row->event_start_date}}</td>
                                <td>{{$row->event_start_time}}</td>
                                
                                <td>{{($row->event_end_date)}}</td>
                                <td>{{($row->event_end_time)}}</td>
                             
                                <td>
                                        <a href="{{url('event/calendar/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-info"><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('event/calendar/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                </div>
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

</section>
@endsection


@include('apps.include.datatable',['JDataTable'=>1])