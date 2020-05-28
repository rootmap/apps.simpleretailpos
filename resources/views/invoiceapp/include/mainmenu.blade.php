<aside id="sidebar-left" class="sidebar-circle">
        <style type="text/css">
            .avatarside img {
                width: 100%;
                max-width: 100%;
                height: auto;
                border: 0;
                border-radius: 1000px;
            }

            .sidebar-content img {
                width: 49px !important;
                height: 49px !important;
                margin-right: 3px;
                padding: 5px;
            }
        </style>
        <!-- Start left navigation - profile shortcut -->
        <div id="tour-8" class="sidebar-content" style="padding-top: 20px;">
            <div class="media">
                <a class="pull-left avatarside" href="http://localhost/nucleusv3/">
                    <img src="{{asset('images/logo/icons.png')}}" alt="admin">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"> Simple Retail POS</h4>
                    <small>Total POS &amp; Sales Solutions</small>
                </div>
            </div>
        </div><!-- /.sidebar-content -->
        <!--/ End left navigation -  profile shortcut -->

        <!-- Start left navigation - menu -->
        <ul id="tour-9" class="sidebar-menu">
            <li class="sidebar-category">
                <span>System Quick Links</span>
                <span class="pull-right"><i class="fa fa-link"></i></span>
            </li>
            <!-- Start navigation - dashboard -->
            <li class="">
                <a href="{{url('dashboard')}}">
                    <span class="icon"><i class="fa fa-home"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <!--/ End navigation - dashboard -->
            <li class="{{ Request::path() == 'pos' ? 'active' : '' }}">
                <a href="{{url('pos')}}">
                    <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="text">Cash Register</span>
                </a>
            </li>
            <!-- Start navigation - frontend themes -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <span class="text">Customer</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'customer' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer')}}" class="menu-item">Add New Customer</a></li>
                    <li class="{{ Request::path() == 'customer/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/list')}}" class="menu-item">Customer List</a></li>
                    <li class="{{ Request::path() == 'customer/import' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/import')}}" class="menu-item">Import Customer</a></li>
                </ul>
            </li>

            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-database"></i></span>
                    <span class="text">Inventory</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'product' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product')}}" class="menu-item">Add New Product</a></li>
                    <li class="{{ Request::path() == 'product/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/list')}}" class="menu-item">Product List</a></li>
                    <li class="{{ Request::path() == 'product/stock/in' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in')}}" class="menu-item">Add New Stock</a></li>
                    <li class="{{ Request::path() == 'product/stock/in/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in/list')}}" class="menu-item">Stock Order List</a></li>
                    <li class="{{ Request::path() == 'product/import' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/import')}}" class="menu-item">Import Inventory</a></li>
                    <li  class="{{ Request::path() == 'vendor/create' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/vendor/create')}}" class="menu-item">
                            Add New Vendor
                        </a>
                    </li>
                    <li  class="{{ Request::path() == 'vendor/list' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/vendor/list')}}" class="menu-item">
                            Vendor List
                        </a>
                    </li>
                </ul>
            </li>


            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-times-circle"></i></span>
                    <span class="text">Warranty</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li  class="{{ Request::path() == 'warranty' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/warranty')}}" class="menu-item">Add New Warranty</a></li>
                    <li class="{{ Request::path() == 'warranty/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/report')}}" class="menu-item">Warranty Report</a></li>
                    <li class="{{ Request::path() == 'warranty/batch-out' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/batch-out')}}" class="menu-item">Warranty Batch Out</a></li>
                    
                </ul>
            </li>



            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    <span class="text">Variance</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li  class="{{ Request::path() == 'variance/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/create')}}" class="menu-item">Add New Variance</a></li>
                    <li  class="{{ Request::path() == 'variance/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/report')}}" class="menu-item">Variance Report</a></li>
                </ul>
            </li>

            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="text">Sales Return</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li  class="{{ Request::path() == 'sales/return/create' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/sales/return/create')}}" class="menu-item">
                            Add New Sales Return
                        </a>
                    </li>
                    <li  class="{{ Request::path() == 'sales/return/list' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/sales/return/list')}}" class="menu-item">
                            Sales Return List
                        </a>
                    </li>
                </ul>
            </li>
     
            <!--/ End navigation - frontend themes -->

            <!-- Start category apps -->
            <li class="sidebar-category">
                <span> Reports & Settings</span>
                <span class="pull-right"><i class="fa fa-pie-chart"></i> <i class="fa fa-cog"></i></span>
            </li>
            <!--/ End category apps -->

            <!-- Start navigation - blog -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-area-chart"></i></span>
                    <span class="text">Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'profit/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/profit/report')}}" class="menu-item">Profit Report</a></li>
                    <li class="{{ Request::path() == 'payment/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/payment/report')}}" class="menu-item">Payment Report</a></li>
                    <li class="{{ Request::path() == 'product/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/product/report')}}" class="menu-item">product Status Report</a></li>
                    <li class="{{ Request::path() == 'product/stock/in/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('product/stock/in/report')}}" class="menu-item">Stock Received Report</a></li>
                    <li class="{{ Request::path() == 'tender/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender/report')}}" class="menu-item">Tender List</a></li>
                    <li class="{{ Request::path() == 'sales/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('sales/report')}}" class="menu-item">Sales Report</a></li>
                    <li class="{{ Request::path() == '/card/list' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/card/list')}}" class="menu-item">Card List</a></li>
                    <li class="{{ Request::path() == '/authorize/net/payment/history' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/authorize/net/payment/history')}}" class="menu-item">Authorize Payment Card History</a></li>
                </ul>
            </li>

            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-connectdevelop"></i></span>
                    <span class="text">System Setting</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'tender' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender')}}" class="menu-item">Add New Tender</a></li>
                    <li class="{{ Request::path() == '/pos/settings' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/pos/settings')}}" class="menu-item">POS Setting</a></li>
                    <li class="{{ Request::path() == '/setting/printer/print-paper/size' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/setting/printer/print-paper/size')}}" class="menu-item">Printer Paper Size</a></li>
                    <li class="{{ Request::path() == 'site/navigation' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/navigation')}}" class="menu-item">Navigation Setting</a></li>
                    <li class="{{ Request::path() == 'counter/display/add' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter/display/add')}}" class="menu-item">Counter Display Add/Remove</a></li>
                    <li class="{{ Request::path() == 'site/color' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/color')}}" class="menu-item">Color Plate</a></li>
                    <li class="{{ Request::path() == '/settings/invoice/email' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/settings/invoice/email')}}" class="menu-item">Invoice email template</a></li>
                    <li class="{{ Request::path() == 'authorize/net/payment/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/authorize/net/payment/setting')}}" class="menu-item">AuthorizeNet Account </a></li>
                </ul>
            </li>
            <!--/ End navigation - blog -->
            <li class="sidebar-category">
                <span> Help Desk</span>
                <span class="pull-right"><i class="fa fa-desktop"></i></span>
            </li>
            <!-- Start navigation - mail -->
            <li>
                <a href="helpdesk.php">
                    <span class="icon"><i class="fa fa-video-camera"></i></span>
                    <span class="text">Tutorial Videos</span>
                </a>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-calendar"></i></span>
                    <span class="text">Event Calendar</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li><a href="{{url('event/calendar')}}" title="">Event/Schedule Calendar</a></li>
                    <li><a href="{{url('event/calendar/create')}}" title="">Create Event/Schedule</a></li>
                    <li><a href="{{url('event/calendar/list')}}" title="">Events & Schedule List</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-support"></i></span>
                    <span class="text">Support Ticket</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li><a href="submit_ticket.php" title="">Submit Ticket</a></li>
                    <li><a href="support_ticket.php" title="">Support Ticket List</a></li>
                </ul>
                
            </li>

          


            <li>
                <a target="_blank" href="http://localhost/nucleusv3/NucleusV3UserGuideShopAdmin.pdf">
                    <span class="icon"><i class="fa fa-video-camera"></i></span>
                    <span class="text">User Guide</span>
                </a>
            </li>
            <li>
                <button style="width:80%;" data-text="how to" class="btn btn-block btn-info ml-1 copyButton">Counter Display Link</button>
                <span style="opacity: 0; height: 0px !important;" id="cdlDt">http://counter-display.spxce.co/public/login</span>
            </li>

            <!--/ End documentation - api documentation -->

        </ul><!-- /.sidebar-menu -->
        <!--/ End left navigation - menu -->

        <div id="tour-10" class="sidebar-footer hidden-xs hidden-sm hidden-md">
        </div>
    </aside><!-- /#sidebar-left -->


<?php /*
{{-- 
<div data-scroll-to-active="true" class="main-menu menu-flipped menu-fixed menu-dark menu-bordereded menu-accordion menu-shadow">
      <!-- main menu header-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="nav-item {{ Request::path() == 'dashboard' ? 'active' : '' }} border-bottom-purple"><a href="{{url('dashboard')}}"><i class="icon-dashboard"></i><span data-i18n="nav.dash.main" class="menu-title">Dashboard</span>
          </a>
          </li>

          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-cart"></i>
              <span class="menu-title">Sales</span>
            </a>
            <ul class="menu-content">
              <li class="{{ Request::path() == 'pos' ? 'active' : '' }} border-bottom-purple"><a href="{{url('pos')}}" class="menu-item">Point of Sales (POS)</a></li>
              <li class="{{ Request::path() == 'counter-display' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter-display')}}" class="menu-item">Counter Display</a></li>
              <li class="{{ Request::path() == 'sales' ? 'active' : '' }} border-bottom-purple"><a href="{{url('sales')}}" class="menu-item">Add New Sales</a></li>
              <li class="{{ Request::path() == 'sales/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('sales/report')}}" class="menu-item">Sales Report</a></li>

            </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-user"></i>
              <span class="menu-title">Customer</span>
            </a>
            <ul class="menu-content">
              <li class="{{ Request::path() == 'customer' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer')}}" class="menu-item">Add New Customer</a></li>
              <li class="{{ Request::path() == 'customer/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/report')}}" class="menu-item">Customer Report</a></li>
            </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-mobile"></i>
              <span class="menu-title">Product</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'product' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product')}}" class="menu-item">Add New Product</a></li>
                <li class="{{ Request::path() == 'product/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/list')}}" class="menu-item">Product List</a></li>
              </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-stack"></i>
              <span class="menu-title">Product Stock In</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'product/stock/in' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in')}}" class="menu-item">New Stock In</a></li>
                <li class="{{ Request::path() == 'product/stock/in/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in/list')}}" class="menu-item">Stock In Order List</a></li>
              </ul>
          </li>
           <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-credit-card"></i>
              <span class="menu-title">Tender</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'tender' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender')}}" class="menu-item">Add New Tender</a></li>
                <li class="{{ Request::path() == 'tender/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender/report')}}" class="menu-item">Tender Report</a></li>
              </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-archive2"></i>
              <span class="menu-title">Warranty</span>
            </a>
              <ul class="menu-content">
                <li  class="{{ Request::path() == 'warranty' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/warranty')}}" class="menu-item">Create Warranty</a></li>
                <li class="{{ Request::path() == 'warranty/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/report')}}" class="menu-item">Warranty Report</a></li>
                <li class="{{ Request::path() == 'warranty/batch-out' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/batch-out')}}" class="menu-item">Warranty Batch Out</a></li>
              </ul>
          </li>

          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-gg"></i>
              <span class="menu-title">Variance</span>
            </a>
              <ul class="menu-content">
                <li  class="{{ Request::path() == 'variance/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/create')}}" class="menu-item">Create Variance</a></li>
                <li  class="{{ Request::path() == 'variance/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/report')}}" class="menu-item">Variance Report</a></li>
              </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-television"></i>
              <span class="menu-title">Report</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'profit/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/profit/report')}}" class="menu-item">Profit Report</a></li>
                <li class="{{ Request::path() == 'payment/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/payment/report')}}" class="menu-item">Payment Report</a></li>
                <li class="{{ Request::path() == 'product/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/product/report')}}" class="menu-item">product Status Report</a></li>
                <li class="{{ Request::path() == 'product/stock/in/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('product/stock/in/report')}}" class="menu-item">product Stockin  Report</a></li>
              </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-stack-2"></i>
              <span class="menu-title">Setting</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == '/pos/settings' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/pos/settings')}}" class="menu-item">POS Setting</a></li>
                {{-- <li class="{{ Request::path() == '/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/setting')}}" class="menu-item">Setting</a></li> --}}
                <li class="{{ Request::path() == 'site/navigation' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/navigation')}}" class="menu-item">Navigation Setting</a></li>
                <li class="{{ Request::path() == 'counter/display/add' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter/display/add')}}" class="menu-item">Counter Display Add/Remove</a></li>
                <li class="{{ Request::path() == 'site/color' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/color')}}" class="menu-item">Color Plate</a></li>
              </ul>
          </li>
          <li class="nav-item border-bottom-purple"><a href="javascript:void(0);"><i class="icon-android-globe"></i><span data-i18n="nav.dash.main" class="menu-title">{{$_SERVER['REMOTE_ADDR']}}</span>
          </a>
          </li>
        </ul>
      </div>

 --}} */ ?>
 @section('js')
 <script type="text/javascript">
     document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});

function copyToClipboard(elem) {
      // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
 </script>
 @endsection