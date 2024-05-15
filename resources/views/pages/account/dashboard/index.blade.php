@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Droid</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- end ol -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">

                                        <h3 class="mb-3"><span class="counter_value" data-target="519545">0</span>
                                        </h3>
                                    </div>
                                    <div class="">
                                        <p class="badge bg-soft-primary text-primary fw-bold font-size-12 mb-0">
                                            Daily</p>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14 mb-0">New Visitors</h5>
                            </div>
                            <div>
                                <div id="visitors_charts" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                        <!-- end cardbody -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h3 class="mb-3">$<span class="counter_value" data-target="97450">0</span></h3>
                                    </div>
                                    <div class="">
                                        <p class="badge bg-primary font-size-12 mb-0">Monthly</p>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14">Revenue</h5>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-progress" role="progressbar" style="width: 70%"
                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <p class="mt-3 text-muted fw-bold font-size-14 mb-0">Since last month
                                        </p>
                                    </div>
                                    <div class="">
                                        <p class="text-success font-size-13 mb-0 mt-3"><i
                                                class="mdi mdi-debug-step-out "></i>87.4
                                            %</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end cardbody -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="p-4">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h3 class="mb-3">+<span class="counter_value" data-target="213545">0</span>
                                        </h3>
                                    </div>
                                    <div class="">
                                        <p class="badge bg-soft-primary text-primary fw-bold font-size-12">
                                            Yearly</p>
                                    </div>
                                </div>
                                <h5 class="text-muted font-size-14 mb-0">Total Order</h5>
                            </div>
                            <div>
                                <div id="order_charts" class="chart-spark" dir="ltr"></div>
                            </div>
                        </div>
                        <!-- end cardbody -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            
        </div>
        <!-- end col -->
       
    </div>
    <!-- end row -->

</div>
<!-- end container-fluid -->

@endsection