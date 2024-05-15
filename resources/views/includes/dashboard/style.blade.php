<meta charset="utf-8" />
<title>{{ $title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('/be/assets/images/favicon.ico')}}">

<!-- jquery.vectormap css -->
<link href="{{asset('/be/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
    type="text/css" />
<!-- Sweet Alert-->
<link href="{{ asset('/be/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('/be/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('/be/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('/be/assets/libs/spectrum-colorpicker2/spectrum.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('/be/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
<!-- DataTables -->
<link href="{{asset('/be/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('/be/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('/be/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('/be/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
    rel="stylesheet" type="text/css" />

{{-- Preloader --}}
<link rel="stylesheet" href="{{ asset('/be/assets/preloader/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('/be/assets/preloader/css/main.css') }}">

<!-- Bootstrap Css -->
<link href="{{asset('/be/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('/be/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('/be/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />