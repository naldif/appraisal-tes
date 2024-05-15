
<!doctype html>
<html lang="en">

<head>

    
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/be/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('/be/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/be/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/be/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />


</head>


<body class="authentication-bg bg-primary">
    <div class="home-center">
        <div class="home-desc-center">

            <div class="container">

                @yield('content')
            </div>


        </div>
        <!-- End Log In page -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('/be/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/be/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/be/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('/be/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('/be/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('/be/assets/libs/parsleyjs/parsley.min.js') }}"></script>

    <script src="{{ asset('/be/assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('/be/assets/js/app.js') }}"></script>

</body>

</html>