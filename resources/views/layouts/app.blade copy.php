
<!doctype html>
<html lang="en">

<head>
    @include('includes.dashboard.style')
</head>


<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('includes.dashboard.topbar')

        <!-- ========== Left Sidebar Start ========== -->
        @include('includes.dashboard.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page-content -->
            @include('includes.dashboard.footer')
            
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @include('includes.dashboard.script')

</body>

</html>