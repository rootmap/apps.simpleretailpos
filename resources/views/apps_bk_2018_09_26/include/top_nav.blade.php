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
      <div class="navbar-wrapper" style="height: 4.1rem !important; overflow: hidden;">
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
          
            <ul class="nav navbar-nav float-xs-right">
              

                <li class="dropdown dropdown-user nav-item  border-left-grey  border-right-grey border-lighten-2" title="Full Screen View" data-toggle="tooltip" data-placement="top" data-title="Fullscreen" style="padding-left:8px;">
                  <a id="fullscreen" title="" style="font-size: 20px" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen" data-original-title="Fullscreen View" class="nav-link" style=" padding-top: 20px;">
                      <i style="font-size: 25px;  color:#fff;" class="icon-desktop"></i>
                  </a>
                </li>

                <li class="dropdown dropdown-user nav-item border-right-grey border-lighten-2">
                    <a href="#" data-toggle="dropdown" title="Profile" class="nav-link dropdown-user-link">
                    <span class="avatar avatar-online">
                        <img src="{{url('theme/app-assets/images/portrait/small/avatar-s-1.png')}}" alt="avatar">
                        <i></i>
                    </span>
                    <span class="user-name">{{Auth::user()->name}}</span>
                    </a>
              </li>
{{-- 
              <a href="#" class="nav-link dropdown-user-link">
                <span class="user-name" style="line-height: 40px; font-size: 25px; margin-left: 15px;"> <i class="icon-unlock-alt danger"></i></span></a> --}}
              <li class="dropdown-user nav-item">

                <a href="javascript:void(0);" onclick="logoutFRM();" data-toggle="dropdown" title="Profile" class="nav-link dropdown-user-link">
                    <span class="">
                        <i style="
    line-height: 31px;
    font-size: 22px;
    margin-left: 18px;
" class="icon-power3"></i>
                    </span>
                    </a>
                <div class="dropdown-menu dropdown-menu-right" style="z-index: 9999 !important;">
                  <!-- <a href="#" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a>
                  <a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a>
                  <a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a>
                  <a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a> -->
                  <div class="dropdown-divider"></div>
                  <form method="post" id="logoutME" action="{{url('logout')}}" >
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <button class="link-login btn dropdown-item" href="{{url('logout')}}" title="logout" rel="nofollow"><i class="icon-power3"></i> Logout</button>
                  </form>
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
