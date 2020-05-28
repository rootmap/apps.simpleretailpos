@extends('apps.layout.master')
@section('title','Help Desk')
@section('content')
<section id="file-exporaat">
<!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-info-circle"></i> Help Desk</h4>
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
                    <div class="row">
                        <div class="card-body">
                        @if(isset($data))
                        @foreach($data as $vdo)
                            <div class="col-lg-4 col-md-12">
                                <a href="{{url('helpdesk/detail/'.$vdo->id)}}">
                                    <div style="border:1px solid #ededed; padding: 5px;">
                                        <div class="card-content">
                                            <h4 style="text-align: center">{{$vdo->title}}</h4> <hr> 
                                            <img class="card-img-top img-fluid" src="{{url('upload/TutorialVideo/thumb/'.$vdo->thumb)}}" style="height: 350px;" alt="Card image cap">
                                            <img width="90%" class="plclass" src="{{url('images/pl.png')}}" style="opacity:1; left:8%; top: 30%;  z-index: 1; position: absolute;">
                                        </div>
                                    </div>
                                </a>
                                <br>
                                <br>
                            </div>
                        @endforeach
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->
</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])