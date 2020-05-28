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
    |  
    Simplepos.com
  </title>
  @include('apps.include.headercss')
  @yield('css')
  <style type="text/css">
    html body.fixed-navbar
    {
        padding-top: 0px !important;
    }
  </style>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  fixed-navbar">
<!-- / main menu-->
<div class="content app-content container-fluid">
  <div class="content-wrapper bg-info">
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
<script type="text/javascript">
  $(document).ready(function(){
      $(".counter-display").attr("style",'min-height:'+($(window).height()-85)+'px;');
      $(".testerPickup").attr("style",'min-height:'+($(window).height()-35)+'px; min-width:500px;');
      console.log($(window).height());
  });
    
</script>
</body>
</html>
