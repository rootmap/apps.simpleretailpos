<div class="modal fade text-xs-left" id="Discount" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Set Sales Email Send Time </h3>
  </div>
      <form method="post" action="{{url('settings/invoice/email/time')}}" name="emailSendTime">
        {{csrf_field()}}
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Select Send Time</label>
                <div class="col-md-8">
                    <select name="email_time" class="form-control border-primary">
                        <option 
                        @if(isset($editData))
                        @if($editData->email_time==1)
                        selected="selected"  
                        @endif
                        @endif 
                        value="1">Instant Send</option>
                        <option 
                        @if(isset($editData))
                        @if($editData->email_time==2)
                        selected="selected"  
                        @endif
                        @endif 
                        value="2">Send Day-End Time</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-info">
                        <i class="icon-check2"></i> Apply Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>