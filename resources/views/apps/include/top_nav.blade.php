<?php 
$navClass="bg-purple bg-darken-1";
$objSite=StaticDataController::navClass();
if(!empty($objSite))
{
    $navClass=$objSite;
}
?>


<style type="text/css">
    #tour-2
    {
            text-align: center;
            line-height: 51px;
            font-size: 29px;
            padding:0 18px;
    }

    .nav
    {
        border-radius:0rem !important;
    }

    .header-navbar .navbar-header
    {
        padding:0px !important;
        width: auto !important;
        background: #F3F3F3;
        overflow: hidden;

    }

    

   
    @media screen and (min-width: 1400px) {
      
        .header-left .navbar-header .navbar-brand
        {
          line-height: 59px !important;
        }
        
    }
    @media screen and (min-width: 1600px) {
       .header-left .navbar-header .navbar-brand
        {
          line-height: 59px !important;
        }
        
    }
    @media screen and (min-width: 1900px) {

      .header-left .navbar-header .navbar-brand
      {
        line-height: 59px !important;
      }
      
    }



</style>
<header id="header">

    <!-- Start header left -->
    <div class="header-left">
        <!-- Start offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
        <div class="navbar-minimize-mobile left">
            <i class="fa fa-bars"></i>
        </div>
        <!--/ End offcanvas left -->

        <!-- Start navbar header -->
        <div class="navbar-header">

            <!-- Start brand -->
            <a id="tour-1" style="padding-bottom: 5px;" class="navbar-brand bg-info border-bottom-info" href="{{url('dashboard')}}">
                <img class="logo" height="45" src="{{asset('images/logo/logo-white.png')}}" alt="brand logo"/>
                <!-- <strong>DASHBOARD</strong> -->
            </a><!-- /.navbar-brand -->
            <!--/ End brand -->

        </div><!-- /.navbar-header -->
        <!--/ End navbar header -->

        <!-- Start offcanvas right: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
        <!--/ End offcanvas right -->

        <div class="clearfix"></div>
    </div><!-- /.header-left -->
    <!--/ End header left -->

    <!-- Start header right -->
    <div class="header-right">
        <!-- Start navbar toolbar -->
        


        {{-- <div class="navbar navbar-toolbar">
            <ul class="nav navbar-nav navbar-left">
                <li id="tour-2" class="navbar-minimize">
                    <a href="javascript:void(0);" title="Minimize sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div> --}}



        <nav class="header-navbar navbar navbar-with-menu {{$navClass}} navbar-dark navbar-shadow" style="height: 4.1rem !important;">
          <div class="navbar-wrapper" style="height: 4.1rem !important;">
            <div class="navbar-header">
              <ul class="nav navbar-nav">
                <li  id="tour-2" class="nav-item navbar-minimize">
                  <a href="javascript:void(0);" class="cash_register_collapse" data-place="open" title="Minimize sidebar">
                            <i style="color: #323232; margin-right: 0px;" class="fa fa-bars"></i>
                   </a>
                </li>
              </ul>
            </div>
    
            <div class="navbar-container content container-fluid">
              <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
    
              
                <ul class="nav navbar-nav float-xs-left"> 
                  <li class="nav-item nav-search"><a href="javascript:searchInNuc();" class="nav-link nav-link-search fullscreen-search-btn" id="fullscreen-search-btn"><i class="ficon icon-search7"></i></a></li>
                  <li class="nav-item"><a href="#" class="nav-link"  id="fullscreen" data-title="Fullscreen" data-original-title="Fullscreen View"><i style="  color:#fff;" class="ficon icon-desktop"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-xs-right"> 
                    
                  <li class="dropdown dropdown-user nav-item">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                        <i class="icon-link3"></i>
                        <span data-i18n="nav.templates.main"> Quick Links </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="{{url('pos')}}" class="dropdown-item">
                        <i class="fa fa-shopping-basket"></i> Cash Register | POS
                      </a>
                      <a href="{{url('sales/return/create')}}" class="dropdown-item">
                        <i class="icon-cart32"></i> Sales Return
                      </a>
                      <a href="{{url('category')}}" class="dropdown-item">
                        <i class="icon-ios-toggle-outline"></i> New Product Category
                      </a>
                      <a href="{{url('product')}}" class="dropdown-item">
                        <i class="icon-levels"></i> New Product
                      </a>
                    </div>
                  </li>
                    
                  <li class="dropdown dropdown-user nav-item">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                        <i class="icon-bar-chart"></i>
                        <span data-i18n="nav.templates.main"> Quick Reports </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a  href="{{url('sales/report')}}" target="_blank" class="dropdown-item">
                        <i class="icon-android-list"></i> Sales Report
                      </a>
                      <a href="{{url('payment/report')}}" target="_blank" class="dropdown-item">
                        <i class="icon-cash"></i> Payment Report
                      </a>
                      <a href="{{url('profit/report')}}" target="_blank" class="dropdown-item">
                        <i class="icon-money1"></i> Profit Report
                      </a>
                      <a href="{{url('sales/return/list')}}" target="_blank" class="dropdown-item">
                        <i class="icon-money1"></i> Sales Return Report
                      </a>
                    </div>
                  </li>
                    
    
                  <li class="dropdown dropdown-user nav-item">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                        <i class="icon-life-ring"></i>
                        <span data-i18n="nav.templates.main"> Support Menu </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="javascript:void(0);" class="dropdown-item"  id="supportChatStart">
                        <i class="icon-comments-o"></i> Chat Support Team
                      </a>
                      <a href="{{url('SupportTicket')}}" target="_blank" class="dropdown-item">
                        <i class="icon-ticket2"></i> Open Support Ticket 
                      </a>
                    </div>
                  </li>
    
                  <li class="dropdown dropdown-user nav-item">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                      <span class="avatar avatar-online">
                        <img src="{{url('theme/app-assets/images/portrait/small/avatar-s-1.png')}}" alt="{{Auth::user()->name}}">
                        <i></i>
                      </span>
                      <span class="user-name">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="{{url('store-info')}}" class="dropdown-item">
                        <i class="icon-home"></i> Store Info
                      </a>
                      <a href="{{url('user-info')}}" class="dropdown-item">
                        <i class="icon-user-check"></i> Profile
                      </a>
                      <a href="{{url('change-password')}}" class="dropdown-item">
                        <i class="icon-key22"></i> Change Password
                      </a>
                      <a href="{{url('event/calendar')}}" target="_blank" class="dropdown-item">
                        <i class="icon-calendar5"></i> View Calender
                      </a>
                      <div class="dropdown-divider"></div>
                      <a  href="javascript:void(0);" onclick="logoutFRM();" class="dropdown-item">
                        <i class="icon-power3"></i> Logout 
                        <form method="post" id="logoutME" action="{{url('logout')}}" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>
                      </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>


        <!--/ End navbar toolbar -->
    </div><!-- /.header-right -->
    <!--/ End header left -->

</header> <!-- /#header -->
