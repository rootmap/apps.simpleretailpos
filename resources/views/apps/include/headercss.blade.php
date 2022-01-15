<link rel="apple-touch-icon" sizes="57x57" href="{{url('icon/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{url('icon/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{url('icon/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{url('icon/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{url('icon/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{url('icon/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{url('icon/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{url('icon/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{url('icon/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{url('icon/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('icon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{url('icon/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('icon/favicon-16x16.png')}}">
<link rel="manifest" href="{{url('icon/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{url('icon/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">




<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/bootstrap.min.css')}}">
<!-- font icons-->
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/fonts/icomoon.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/pace.css')}}">
<!-- END VENDOR CSS-->
<!-- BEGIN ROBUST CSS-->
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/bootstrap-extended.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/app.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/colors.min.css')}}">
<!-- END ROBUST CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/menu/menu-types/vertical-overlay-menu.min.css')}}">
<!-- END Page Level CSS-->

<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{url('theme/assets/css/style.css')}}">
<!-- END Custom CSS-->



  <!-- START GLOBAL MANDATORY STYLES -->
        {{-- <link href="{{url('theme/nucleusv3/assets/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
        <!--/ END GLOBAL MANDATORY STYLES -->

        <!-- START PAGE LEVEL STYLES -->
<link href="{{url('theme/sidebar/assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css')}}" rel="stylesheet">
        {{-- <link href="{{url('theme/sidebar/assets/css/animate.min.css')}}" rel="stylesheet"> --}}
        <!--/ END PAGE LEVEL STYLES -->
<!-- END Custom CSS-->


<!-- BEGIN Custom CSS-->
{{-- <link href="{{url('theme/nucleusv3/assets/css/reset.css')}}" rel="stylesheet"> --}}
<link href="{{url('theme/sidebar/assets/css/layout.css')}}" rel="stylesheet">
<link href="{{url('theme/sidebar/assets/css/default.theme.css')}}" rel="stylesheet" id="theme">

<style type="text/css">
	.nav>li {
	    position: relative;
	    display: block;
	}
</style>

<?php 
$userguideInit=StaticDataController::userguideInit();
if($userguideInit==1)
{
?>
    <link href="{{url('introjs/example/assets/css/demo.css')}}" rel="stylesheet">
    <link href="{{url('introjs/introjs.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/animate/animate.min.css')}}">
<?php
}
?>
<link href="{{url('chat/style.css')}}" rel="stylesheet">