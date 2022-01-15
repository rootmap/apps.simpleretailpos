<div class="modal fade text-xs-left" id="ma_product_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel35"> Product Edit </h3>
            </div>
            <form action="javascript:void(0);" method="post">
                <div class="col-md-12 map_verify_msg" style="margin-top: 10px;"></div>
                <div class="modal-body">
                    <input type="hidden" name="map_product_id" id="map_product_id" value="0">
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="projectinput1">
                            Product Name
                        </label>
                        <div class="col-md-8">
                            <input type="text" autocomplete="off" readonly="readonly" id="map_product" class="form-control" placeholder="Product Name" name="map_product">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="projectinput1">
                            Price
                        </label>
                        <div class="col-md-8">
                            <input type="text" autocomplete="off"  id="map_price" class="form-control" placeholder="Price" name="map_price" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="projectinput1">
                            Quantity
                        </label>
                        <div class="col-md-8">
                            <input type="text" autocomplete="off"  id="map_quantity" class="form-control" placeholder="Quantity" name="map_quantity" value="0">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-green verify_map">
                                <i class="icon-check2"></i> Update 
                            </button>

                            <button type="button" class="btn btn-green verify_map_remove"  class="close" data-dismiss="modal" aria-label="Close">
                                <i class="icon-remove"></i> Cancel 
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>