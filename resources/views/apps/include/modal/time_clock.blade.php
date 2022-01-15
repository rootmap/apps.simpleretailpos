<div class="modal fade text-xs-left" id="TimeClockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="myModalLabel35"><i class="icon-clock3"></i> Time Clock (Punch Log)</h3>
      </div>
      <div class="modal-body">
          <div class="col-md-12" id="punchMSG"></div>
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group row">
                <div class="input-group">
                  <input type="text" class="form-control" readonly="" id="punch_time" placeholder="Current Date" aria-describedby="button-addon2" value="{{date("Y-m-d H:i:s")}}">
                  <span class="input-group-btn" id="button-addon2">
                    <button class="btn btn-info" id="punch" type="button">Punch </button>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-8">&nbsp;</div>
          </div>
          <div class="clearfix"></div>
          <div class="hideDIv" style="display: none">
            <table class="table table-striped table-bordered data-basic-initialization">
              <thead>
                <tr>
                  <th>Date IN</th>
                  <th>Time In</th>
                  <th>Date Out</th>
                  <th>Time Out</th>
                  <th>Elapsed Time (HH:MM)</th>
                </tr>
              </thead>
              <tbody id="punchLogTimes">
                {{-- <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                </tr> --}}
                
                
              </tbody>
              <tfoot>
                <tr>
                  <th>Date IN</th>
                  <th>Time In</th>
                  <th>Date Out</th>
                  <th>Time Out</th>
                  <th>Elapsed Time (HH:MM)</th>
                </tr>
              </tfoot>
            </table>
          </div>     
      </div>
    </div>
  </div>
</div>