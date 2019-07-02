@extends('apps.layout.master')
@section('title','Support Ticket')
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
                <h4 class="card-title"><i class="icon-ticket"></i> Support Ticket - <span>{{$ticket->id}}</span></h4>
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
                    <div class="col-md-6">
                        <div class="form-group">
                           <div class="input-group mb-15">
                              <span class="input-group-addon bg-info"  style="width:78px;"><strong>Name</strong></span>
                              <div class="form-control no-border-left" style="width: 300px;" id="prependedInput">{{$ticket->name}}</div>
                           </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           <div class="input-group mb-15">
                              <span class="input-group-addon bg-info"  style="width:78px;"><strong>Email</strong></span>
                              <div class="form-control no-border-left" style="width: 300px;"  id="prependedInput">{{$ticket->email}}</div>
                           </div>
                       </div>
                    </div>
                   <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group mb-15">
                             <span class="input-group-addon bg-info"  style="width:78px;"><strong>Subject</strong></span>
                             <div class="form-control no-border-left" style="width:825px;" id="prependedInput" type="text">{{$ticket->subject}}</div>
                          </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                        <div class="form-group">
                          <div class="input-group mb-15">
                             <span class="input-group-addon bg-info"  style="width:78px;"><strong>Service</strong></span>
                             <div class="form-control no-border-left" style="width: 200px;" id="prependedInput">{{$ticket->related_service_name}}</div>
                          </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                        <div class="form-group">
                          <div class="input-group mb-15">
                             <span class="input-group-addon bg-info"  style="width:78px;"><strong>Department</strong></span>
                             <div class="form-control no-border-left" style="width: 180px;"  id="prependedInput">{{$ticket->department_name}}</div>
                          </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                        <div class="form-group">
                          <div class="input-group mb-15">
                             <span class="input-group-addon bg-info"  style="width:78px;"><strong>Priority</strong></span>
                             <div class="form-control no-border-left" style="width: 130px;"  id="prependedInput">{{$ticket->priority}}</div>
                          </div>
                      </div>
                   </div>
                       <div class="col-md-12">
                            <div class="form-group">
                              <div class="input-group">
                                 <span class="input-group-addon bg-info"  style="width:78px;"><strong>Message</strong></span>
                                 <div class="form-control no-border-left" style="width:825px; min-height: 200px;">{{$ticket->message}}</div>
                              </div>
                          </div>
                       </div>
                       @if(!empty($ticket->attachment))
                       <div class="col-md-5">
                            <div class="form-group">
                              <div class="input-group mb-15">
                                 <span class="input-group-addon bg-info"  style="width:78px;"><strong> Attachment </strong></span>
                                 <div class="form-control no-border-left" style="width: 400px;" id="prependedInput"><a target="_blank" href="{{url('upload/SupportTicket/'.$ticket->attachment)}}" class="btn btn-warning">Download</a></div>
                              </div>
                          </div>
                       </div>
                       @endif
                       <div class="col-md-12">
                            <div class="form-group">
                              <div class="input-group mb-15">
                                 <span class="input-group-addon bg-info"  style="width:78px;"><strong> Complete </strong></span>
                                 <div class="form-control no-border-left" style="width: 400px;" id="prependedInput"><input type="checkbox" id="scp" onclick="SupportComplete(24)"> Check if you want to make it complete.</div>
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
                <h4 class="card-title"><i class="icon-comments"></i> Some question & answer regarding - <span>{{$ticket->id}} | You can place your question or answer too.</span></h4>
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
SendTicketComment('{{$sid}}', this.value);" id="Invalue" class="form-control" placeholder="Reply Message" required>
                          <input type="hidden" id="ticketid" name="ticketid" value="{{$ticket->id}}">
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
        var msgID = $('#ticketid').val();
        // alert(msgID);
        var AddHowMowKhaoUrl="{{url('SupportTicket/Ajax')}}";
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

      loadPreviousComment({{$sid}});

    });

    function SendTicketComment(sid,commentMSG)
    {
      var msg = commentMSG;
        var msgID = sid;
        // alert(msgID);
        var AddHowMowKhaoUrl="{{url('SupportTicket/Ajax')}}";
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
        var AddHowMowKhaoUrl="{{url('SupportTicket/load/comment')}}/"+msgID;
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
