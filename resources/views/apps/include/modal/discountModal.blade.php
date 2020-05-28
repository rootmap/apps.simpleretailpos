<div class="modal fade text-xs-left" id="Discount" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h3 class="modal-title" id="myModalLabel35"> Discount For Sale</h3>
  </div>
      <form>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Discount Amount</label>
                <div class="col-md-8">
                    <input type="number" id="discount_amount" class="form-control" 
                    @if(isset($ps))
                    value="{{$ps->sales_discount}}" 
                    @else
                    value="0" 
                    @endif 
                    placeholder="%" name="Percentage">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Discount Type</label>
                <div class="col-md-8">
                    <select name="discount_type" class="form-control border-primary">
                        <option 
                        @if(isset($ps))
                        @if($ps->discount_type==1)
                        selected="selected"  
                        @endif
                        @endif 
                        value="1">Amount</option>
                        <option 
                        @if(isset($ps))
                        @if($ps->discount_type==2)
                        selected="selected"  
                        @endif
                        @endif 
                        value="2">Percent %</option>
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                <div class="col-md-8">
                    <button type="button" class="btn btn-info apply-discount">
                        <i class="icon-check2"></i> Apply Discount
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>