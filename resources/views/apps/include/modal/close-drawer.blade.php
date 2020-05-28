<div class="modal fade text-xs-left" id="close-drawer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> <i class="icon-filing"></i> Close Drawer</h3>
  </div>
  <form>
    <div class="modal-body" style="padding-top: 0px;">
        <div class="form-group row">
            <div class="col-md-8 offset-md-2" style="text-align: center;">
                

              <table class="table table-striped">
                <tbody>
                  <tr>
                      <td colspan="2"><strong>Drawer Closing Detail | (<span id="storeCloseDate">{{date('d/m/Y')}}</span>)</strong>
                      </td>
                  </tr>
                  <tr>
                      <td align="left" width="80%">Total Collection :  </td>
                      <td align="left" id="storeCloseTotalCollection">$0.00</td>
                  </tr>
                  <tr>
                      <td colspan="2"><div style="background:rgba(51,51,51,1); display:block; height:1px;"></div> </td>
                  </tr>
                </tbody>
                <tbody id="storeCloseTableTenderList">
                  <tr>
                      <td align="left">Cash Collected (+) :  </td>
                      <td align="left">$0.00</td>
                  </tr>
                  <tr>
                      <td align="left">Credit Card Collected (+) :  </td>
                      <td align="left">$0.00</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                      <td align="left">Opening Amount (+) :  </td>
                      <td align="left">$<span id="storeCloseOpeningAmount">10.00</span></td>
                  </tr>
                  <tr>
                      <td align="left">Payout (+)(-) :  </td>
                      <td align="left">$<span id="totalPayout">0.00</span></td>
                  </tr>
                  {{-- <tr>
                      <td align="left">BuyBack ( - )  :  </td>
                      <td align="left">$0.00</td>
                  </tr> --}}
                  <tr>
                      <td align="left">Tax (-)  :  </td>
                      <td align="left">$<span id="storeCloseTaxAmount">0.00</span></td>
                  </tr>
                  <tr>
                      <td colspan="2"><div style="background:rgba(51,51,51,1); display:block; height:1px;"></div> </td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                      <td align="left">Net Total :  </td>
                      <td align="left">$<span id="currectStoreTotal">0.00</span></td>
                  </tr>
              </tbody>
            </table>


            </div>
        </div>

        <div class="form-group row">
          <div class="col-md-12" style="text-align: center;">
            <button type="button" class="btn btn-info btn-accent-3 btn-large closeStore">
              <i class="icon-check2"></i> Close Drawer 
            </button>
            <button type="button" class="btn btn-info btn-darken-3 btn-large closePrintStore">
              <i class="icon-ios-printer-outline"></i> Print & Close Drawer
            </button>
            <br /><br />
          <span id="closeStoreMsg"></span>
        </div>
    </div>
   
</div>
</form>
</div>
</div>
</div>