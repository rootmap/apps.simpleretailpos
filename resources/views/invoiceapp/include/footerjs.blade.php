
    
<!-- BEGIN VENDOR JS-->
    <!-- build:js app-assets/js/vendors.min.js-->
    <script src="{{url('theme/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/jquery-sliding-menu.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/sliders/slick/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
    <!-- /build-->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <!-- build:js app-assets/js/app.min.js-->
    <script src="{{url('theme/app-assets/js/core/app-menu.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/core/app.min.js')}}" type="text/javascript"></script>
    <!-- /build-->

    <!-- START CORE PLUGINS -->
<script type="text/javascript">
        function logoutFRM()
        {
                $("#logoutME").submit();
        }

        function copyToClipboard(element) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val($(element).text()).select();
          document.execCommand("copy");
          $temp.remove();
          alert("Counter display link copied successfully.");
        }

        

        $(document).ready(function(){
            $("#fullscreen").click(function(){
                $(document).toggleFullScreen()
                $(this).children("i").toggleClass("danger");
            });

            $(".copyButton").click(function(){
                copyToClipboard('#cdlDt');
            });
            
        });
    </script>

<!-- BEGIN Custom CSS-->
<script src="{{url('theme/sidebar/assets/js/jquery.cookie.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/handlebars.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/typeahead.bundle.min.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/jquery.nicescroll.min.js')}}"></script>


<!-- END Custom CSS-->
    <!--/ END CORE PLUGINS -->


    <!-- START PAGE LEVEL SCRIPTS -->
    <script src="{{url('theme/sidebar/assets/js/apps.js')}}"></script>
    
    <script src="{{url('theme/sidebar/assets/js/demo.js')}}"></script>
    <!--/ END PAGE LEVEL SCRIPTS -->


    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
