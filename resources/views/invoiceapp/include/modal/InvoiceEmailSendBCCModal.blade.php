<div class="modal fade text-xs-left" id="BCC" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Set Sales Auto Email Notifier - BCC </h3>
  </div>
      <form method="post" action="{{url('settings/invoice/email/bcc')}}" name="emailSendbcc">
        {{csrf_field()}}
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Add your e-Mail</label>
                <div class="col-md-8">
                    <input type="text" id="projectinput1" class="form-control" placeholder="Email Address" value="{{$editData->bcc}}" name="bcc">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-check2"></i> Apply Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>