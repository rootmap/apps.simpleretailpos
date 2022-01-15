<div class="modal fade text-xs-left" id="loginApprovalForManagerAndAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel35"> Manager / Admin Confirmation Required</h3>
            </div>
            <form action="javascript:void(0);" method="post">
                <div class="col-md-12 ma_verify_msg" style="margin-top: 10px;"></div>
                <div class="modal-body">
                    <input type="hidden" name="ma_product_id" id="ma_product_id" value="0">
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="projectinput1">
                            Email Address
                        </label>
                        <div class="col-md-8">
                            <input type="text" autocomplete="off"  id="ma_email_address" class="form-control" placeholder="Email Address" name="ma_email_address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="projectinput1">
                            Password
                        </label>
                        <div class="col-md-8">
                            <input type="password" autocomplete="off"  id="ma_password" class="form-control" placeholder="Password" name="ma_password">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-green verify_ma">
                                <i class="icon-check2"></i> Verify Credentials
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>