<!doctype html>
<html lang="en">

<head>
    @include('includes.dashboard.style')
</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <div id="loader-wrapper">
        <div id="loader">
        </div>
        <img src="{{ asset('/be/assets/images/logo-corner.png') }}" alt="Loading...">
    </div>

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            @include('includes.dashboard.topbar')
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">
                <!--- Sidemenu -->
                @include('includes.dashboard.sidebar')
                <!-- Sidebar -->
            </div>
        </div>
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

    @include('includes.dashboard.script')
</body>

</html>