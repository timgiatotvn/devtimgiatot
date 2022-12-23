<!DOCTYPE html>
<html lang="vi">
<head>
        <meta charset="utf-8" />
        <title>Tìm Giá Tốt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('static/client/images/favicon.jpeg')}}">

        <!-- third party css -->
        <link href="{{asset('sellers/assets/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

       <!-- App css -->
       <link href="{{asset('sellers/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
       <link href="{{asset('sellers/assets/css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
        
    </head>

    <body class="loading" data-layout-color="light" data-layout="detached" data-rightbar-onstart="true">
        @include('clients::sellers.layouts.top_bar')
            <!-- Start Content-->
        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                <!-- ========== Left Sidebar Start ========== -->
                @include('clients::sellers.layouts.left_sidebar')
                <!-- Left Sidebar End -->
                @yield('content')
            </div>
        </div>
        @include('clients::sellers.layouts.right_sidebar')

        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->


        <!-- bundle -->
        <script src="{{asset('sellers/assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('sellers/assets/js/app.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('sellers/assets/js/vendor/apexcharts.min.js')}}"></script>
        <script src="{{asset('sellers/assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('sellers/assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="{{asset('sellers/assets/js/pages/demo.dashboard.js')}}"></script>
        <!-- end demo js-->
        @yield('js')
        
    </body>

<!-- Mirrored from coderthemes.com/hyper/modern/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 May 2022 06:14:17 GMT -->
</html>
