<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Simple-pos">
  <meta name="keywords" content="POS,Simple-pos">
  <meta name="author" content="Md Mahamudur Zaman Bhuyian-Fahad">
  <title>
    @yield('title')
    | Simple Retail POS
  </title>
  @include('apps.include.headercss')
  @yield('css')
  @yield('counter-display-css')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
  <style type="text/css">
    html body.fixed-navbar {
        padding-top: 0rem;
    }
  </style>
  <!-- navbar-fixed-top-->
  {{-- @include('apps.include.top_nav') --}}
  {{-- @include('apps.include.full-screen-search') --}}
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- main menu-->
  {{-- @include('apps.include.mainmenu') --}}
  <!-- /main menu content-->
  {{-- @include('apps.include.fotter-logout-menu') --}}
</div>
<!-- / main menu-->

<div class="app-content content container-fluid" style="margin-left: 0px;">
  <div class="content-wrapper">

    <div class="content-body">
      <!-- Form actions layout section start -->
      @include('apps.include.msg')
      @yield('content')
      <!-- // Form actions layout section end -->
    </div>
</div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('apps.include.footer')


@include('apps.include.footerjs')
@yield('js')
@yield('counter-display-js')
</body>
</html>
