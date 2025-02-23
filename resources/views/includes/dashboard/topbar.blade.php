<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('/be/assets/images/logo-sm-dark.png')}}" alt="logo-sm-dark" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('/be/assets/images/logo-dark.png')}}" alt="logo-dark" height="22">
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('/be/assets/images/logo-sm-light.png')}}" alt="logo-sm-light" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('/be/assets/images/logo-light.png')}}" alt="logo-light" height="22">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
            <i class="ri-menu-2-line align-middle"></i>
        </button>

        {{-- <div class="dropdown dropdown-mega d-none d-xl-block ms-2">
            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false"
                aria-expanded="false">
                Mega Menu
                <i class="mdi mdi-chevron-down"></i>
            </button>
            <div class="dropdown-menu dropdown-megamenu">
                <div class="row">
                    <div class="col-sm-8">

                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="font-size-14 mt-0">UI Components</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Lightbox</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Rating</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Forms</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tables</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Charts</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <h5 class="font-size-14 mt-0">Applications</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Ecommerce</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Calendar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Email</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Projects</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tasks</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Contacts</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4">
                                <h5 class="font-size-14 mt-0">Extra Pages</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Light Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Compact Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Horizontal layout</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Maintenance</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Coming Soon</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Timeline</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">FAQs</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="font-size-14 mt-0">UI Components</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Lightbox</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Rating</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Forms</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tables</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Charts</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-5">
                                <div>
                                    <img src="{{ asset('/be/assets/images/megamenu-img.png') }}" alt="megamenu-img"
                                        class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div>

            </div>
        </div> --}}
    </div>

    <div class="d-flex">
        <div class="dropdown d-inline-block d-lg-none">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="top-icon">
                    <i class="ri-search-line"></i>
                </div>

            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">
                <form class="p-3">
                    <div class="m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ...">
                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end -->

        <div class="dropdown d-none d-lg-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                <div class="top-icon">
                    <i class="mdi mdi-fullscreen"></i>
                </div>
            </button>
        </div>
        <!-- end  -->

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <div class="top-icon">
                    <i class="mdi mdi-bell"></i>
                </div>
                <span class="badge bg-danger rounded-pill">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0"> Notifications </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small"> View All</a>
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 230px;">
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                    <i class="ri-shopping-cart-line"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1">Your order is placed</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <img src="{{ asset('/be/assets/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-xs"
                                alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1">James Lemire</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">It will seem like simplified English.</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="ri-checkbox-circle-line"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <img src="{{ asset('/be/assets/images/users/avatar-4.jpg') }}" class="me-3 rounded-circle avatar-xs"
                                alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="p-2 border-top">
                    <div class="d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end notification -->

        <div class="dropdown d-inline-block user-dropdown">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ !empty(auth()->user()->detail_user->photo) ? url(Storage::url(auth()->user()->detail_user->photo)) : auth()->user()->avatar }}"
                    alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1">{{ auth()->user()->name }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My
                    Wallet</a>
                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i
                        class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                    screen</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Logout
                <form action="{{ route('logout')}}" id="logout-form" method="POST" style="display: none">
                    @csrf
                </form>
            </a>
            </div>
        </div>
        <!-- end user -->
    </div>
</div>