@extends('apps.layout.master')
@section('title','Help Desk Video')
@section('content')
<section id="file-exporaat">
<!-- Both borders end-->
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>
<style type="text/css">
    .bg-info strong{color: #fff;}
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-file-movie-o
"></i> Help Desk Video - <span>{{$data->title}}</span></h4>
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
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group">
                           <div class="input-group mb-15">
                              <video id="my-video" class="video-js" controls preload="auto" width="500" height="264"
                              poster="{{url('upload/TutorialVideo/thumb/'.$data->thumb)}}" data-setup="{}">
                                <source src="{{url('upload/TutorialVideo/Video/'.$data->name)}}" type='video/mp4'>
                                <source src="{{url('upload/TutorialVideo/Video/'.$data->name)}}" type='video/webm'>
                                <p class="vjs-no-js">
                                  To view this video please enable JavaScript, and consider upgrading to a web browser that
                                  <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                             </video>
                           </div>
                       </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-comments"></i> Some question & answer regarding - <span>{{$data->title}} | You can place your question or answer too.</span></h4>
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
                    <p class="bg-success" style="padding: 10px; color: #fff;">View all </p>
                    <div class="col-md-12">
                      <div class="form-group" id="comments">
                        
                      </div>
                      
                    </div>
                    <div class="col-md-12">
                      <div class="controls">
                        <div class="input-group">
                          <input type="text" onkeydown="Javascript: if (event.keyCode == 13)
SendTicketComment('vid', this.value);" id="Invalue" class="form-control" placeholder="Reply Message" required>
                          <input type="hidden" id="videoid" name="ticketid" value="{{$data->id}}">
                          <span class="input-group-btn" id="button-addon2">
                            <button class="btn btn-warning reply" type="button">
                              <i class="icon-bubbles2"></i> Send 
                            </button>
                          </span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

{{-- @include('apps.include.datatable',['JDataTable'=>1]) --}}
@section('js')
<script>
    $(document).ready(function() {
      $(".reply").click(function () {
        var msg = $('#Invalue').val();
        var msgID = $('#videoid').val();
        // alert(msgID);
        var AddHowMowKhaoUrl="{{url('helpdesk/Ajax')}}";
            $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': AddHowMowKhaoUrl,
              'data': {'msgID':msgID,'msg':msg,'_token':"{{csrf_token()}}"},
              'success': function (data) {
                console.log(data);
                $("#Invalue").val("");
               var strHTML='<div class="mt-1 mb-1"><i class="icon-user4"></i> <a href="#" class="h4">'+data.user_name+' | '+data.role_name+'</a><p class="block text-muted">'+msg+' </p><em class="text-xs text-muted"><i class="icon-calendar4"></i> Posted on <span class="text-danger">'+data.created_at+'</span></em><hr></div>';
              $("#comments").append(strHTML);
              }
          });
      });

      loadPreviousComment({{$vid}});

    });

    function SendTicketComment(sid,commentMSG)
    {
      var msg = commentMSG;
        var msgID = sid;
        // alert(msgID);
        var AddHowMowKhaoUrl="{{url('helpdesk/Ajax')}}";
            $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': AddHowMowKhaoUrl,
              'data': {'msgID':msgID,'msg':msg,'_token':"{{csrf_token()}}"},
              'success': function (data) {
                console.log(data);
                $("#Invalue").val("");
               var strHTML='<div class="mt-1 mb-1"><i class="icon-user4"></i> <a href="#" class="h4">'+data.user_name+' | '+data.role_name+'</a><p class="block text-muted">'+msg+' </p><em class="text-xs text-muted"><i class="icon-calendar4"></i> Posted on <span class="text-danger">'+data.created_at+'</span></em><hr></div>';
              $("#comments").append(strHTML);
              }
          });
    }

    function loadPreviousComment(sid)
    {
        var msgID = sid;
        // alert(msgID);
        var AddHowMowKhaoUrl="{{url('helpdesk/load/comment')}}/"+msgID;
            $.ajax({
              'async': true,
              'type': "GET",
              'global': false,
              'dataType': 'json',
              'url': AddHowMowKhaoUrl,
              'success': function (data) {
                console.log(data);
               var total=data.total;
               if(total>0)
               {
                  var strHTML='';
                  var totalData=data.datas;
                  $.each(totalData,function(key,row){
                      strHTML+='<div class="mt-1 mb-1"><i class="icon-user4"></i> <a href="#" class="h4">'+row.user_name+' | '+row.role_name+'</a><p class="block text-muted">'+row.comment+' </p><em class="text-xs text-muted"><i class="icon-calendar4"></i> Posted on <span class="text-danger"> '+row.created_at+'</span></em><hr></div>';
                  });

                  $("#comments").html(strHTML);
               }
               
              }
          });
    }
</script>
@endsection