<div id="fullscreen-search" class="fullscreen-search">
  <form  autocomplete="off" class="fullscreen-search-form" method="get" action="{{secure_url('search-nucleus')}}">
    <input type="search" name="search" autocomplete="off" id="search-nucleusv4" placeholder="Search..." class="fullscreen-search-input">
    <input type="hidden" name="search_param" autocomplete="off" placeholder="Search Param...">
    <button type="submit" class="fullscreen-search-submit">Search</button>
  </form>
  <div class="fullscreen-search-content">
    <div class="fullscreen-search-options">
      <div class="row">
        <div class="col-sm-12">
          <fieldset>
            <label class="custom-control custom-checkbox display-inline">
              <input type="checkbox" id="nuc-search-all" checked="checked" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">All</span>
            </label>
            <label class="custom-control custom-checkbox display-inline">
              <input type="checkbox" id="nuc-search-customer" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Customer</span>
            </label>
            <label class="custom-control custom-checkbox display-inline">
              <input type="checkbox" id="nuc-search-invoice" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Invoice</span>
            </label>
            <label class="custom-control custom-checkbox display-inline">
              <input type="checkbox" id="nuc-search-product" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description m-0">Product</span>
            </label>
          </fieldset>
        </div>
      </div>
    </div>
  </div><span class="fullscreen-search-close"></span>
</div>
<div class="fullscreen-search-overlay"></div>