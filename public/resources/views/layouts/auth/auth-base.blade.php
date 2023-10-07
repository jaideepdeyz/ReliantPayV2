<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard : Reliant Pay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Agent Login" name="description" />
     

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('auth/images/favicon.ico') }} ">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
          <!-- Plugins css-->
        <link href="{{ asset ('auth/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/quill/quill.core.css" rel="stylesheet') }}" type="text/css" />
        <link href="{{ asset ('auth/libs/quill/quill.snow.css" rel="stylesheet') }}" type="text/css" />

        <!-- Plugins css -->
        <link href="{{ asset ('auth/libs/flatpickr/flatpickr.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset ('auth/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Theme Config Js -->
        <script src="{{ asset ('auth/js/head.js') }}"></script>

        <!-- Bootstrap css -->
        <link href="{{ asset ('auth/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- App css -->
        <link href="{{ asset ('auth/css/app.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Icons css -->
        <link href="{{ asset ('auth/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @livewireStyles

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            @if(Auth::user()->role == 1)
                @include('partials.admin.admin-sidebar')
            @elseif (Auth::user()->role == 2)
                @include('partials.dealer.dealer-sidebar')
            @elseif (Auth::user()->role == 3)
                @include('partials.agent.agent-sidebar')
            @endif

           <!-- ============================================================== -->
            <!-- Start Page Content here -->
            
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- ========== Topbar Start ========== -->
                <div class="navbar-custom">
                    <div class="topbar">
                        <div class="topbar-menu d-flex align-items-center gap-1">

                            <!-- Topbar Brand Logo -->
                            <div class="logo-box">
                                <!-- Brand Logo Light -->
                                <a href="#" class="logo-light">
                                    <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}" alt="logo" class="logo-lg">
                                    <img src="{{ asset('auth/images/adminlogo/admin-logo-sm-light.png') }}" alt="small logo" class="logo-sm">
                                </a>

                                <!-- Brand Logo Dark -->
                                <a href="index.html" class="logo-dark">
                                    <img src="{{ asset('auth/images/adminlogo/admin-logo-dark.png') }}" alt="dark logo" class="logo-lg">
                                    <img src="{{ asset('auth/images/adminlogo/admin-logo-sm-dark.png') }}" alt="small logo" class="logo-sm">
                                </a>
                            </div>

                            <!-- Sidebar Menu Toggle Button -->
                            <button class="button-toggle-menu">
                                <i class="mdi mdi-menu"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="dropdown d-none d-xl-block">
                                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    Create New
                                    <i class="mdi mdi-chevron-down ms-1"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="fe-briefcase me-1"></i>
                                        <span>New Projects</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="fe-user me-1"></i>
                                        <span>Create Users</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="fe-bar-chart-line- me-1"></i>
                                        <span>Revenue Report</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>Settings</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="fe-headphones me-1"></i>
                                        <span>Help & Support</span>
                                    </a>

                                </div>
                            </div>

                            <!-- Mega Menu Dropdown -->
                            {{-- <div class="dropdown dropdown-mega d-none d-xl-block">
                                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    Mega Menu
                                    <i class="mdi mdi-chevron-down  ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-megamenu">
                                    <div class="row">
                                        <div class="col-sm-8">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h5 class="text-dark mt-0">UI Components</h5>
                                                    <ul class="list-unstyled megamenu-list">
                                                        <li>
                                                            <a href="widgets.html">Widgets</a>
                                                        </li>
                                                        <li>
                                                            <a href="extended-nestable.html">Nestable List</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Range Sliders</a>
                                                        </li>
                                                        <li>
                                                            <a href="pages-gallery.html">Masonry Items</a>
                                                        </li>
                                                        <li>
                                                            <a href="extended-sweet-alert.html">Sweet Alerts</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Treeview Page</a>
                                                        </li>
                                                        <li>
                                                            <a href="extended-tour.html">Tour Page</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-4">
                                                    <h5 class="text-dark mt-0">Applications</h5>
                                                    <ul class="list-unstyled megamenu-list">
                                                        <li>
                                                            <a href="ecommerce-products.html">eCommerce Pages</a>
                                                        </li>
                                                        <li>
                                                            <a href="crm-dashboard.html">CRM Pages</a>
                                                        </li>
                                                        <li>
                                                            <a href="email-inbox.html">Email</a>
                                                        </li>
                                                        <li>
                                                            <a href="apps-calendar.html">Calendar</a>
                                                        </li>
                                                        <li>
                                                            <a href="contacts-list.html">Team Contacts</a>
                                                        </li>
                                                        <li>
                                                            <a href="task-kanban-board.html">Task Board</a>
                                                        </li>
                                                        <li>
                                                            <a href="email-templates.html">Email Templates</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-4">
                                                    <h5 class="text-dark mt-0">Extra Pages</h5>
                                                    <ul class="list-unstyled megamenu-list">
                                                        <li>
                                                            <a href="javascript:void(0);">Left Sidebar with User</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Menu Collapsed</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">Small Left Sidebar</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);">New Header Style</a>
                                                        </li>
                                                        <li>
                                                            <a href="pages-search-results.html">Search Result</a>
                                                        </li>
                                                        <li>
                                                            <a href="pages-gallery.html">Gallery Pages</a>
                                                        </li>
                                                        <li>
                                                            <a href="pages-coming-soon.html">Maintenance & Coming Soon</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="text-center mt-3">
                                                <h3 class="text-dark">Special Discount Sale!</h3>
                                                <h4>Save up to 70% off.</h4>
                                                <a href="https://1.envato.market/uboldadmin" target="_blank" class="btn btn-primary rounded-pill mt-3">Download Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <ul class="topbar-menu d-flex align-items-center">
                            <!-- Topbar Search Form -->
                            <li class="app-search dropdown me-6 d-none d-lg-block">
                                <form>
                                    <input type="search" class="form-control rounded-pill" placeholder="Search..." id="top-search">
                                    <span class="fe-search search-icon font-22"></span>
                                </form>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found 22 results</h5>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-home me-1"></i>
                                        <span>Analytics Report</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-aperture me-1"></i>
                                        <span>How can I help you?</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>User profile settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                    <span class="font-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Jacob Deo</h5>
                                                    <span class="font-12 mb-0">Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Fullscreen Button -->
                            <li class="d-none d-md-inline-block">
                                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                                    <i class="fe-maximize font-22"></i>
                                </a>
                            </li>

                            <!-- Search Dropdown (for Mobile/Tablet) -->
                            <li class="dropdown d-lg-none">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="ri-search-line font-22"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>

                            <!-- App Dropdown -->
                            <li class="dropdown d-none d-md-inline-block">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fe-grid font-22"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                                    <div class="p-2">
                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/slack.png" alt="slack">
                                                    <span>Slack</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/github.png" alt="Github">
                                                    <span>GitHub</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                                    <span>Dribbble</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row g-0">
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                                    <span>Bitbucket</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                                    <span>Dropbox</span>
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="dropdown-icon-item" href="#">
                                                    <img src="assets/images/brands/g-suite.png" alt="G Suite">
                                                    <span>G Suite</span>
                                                </a>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div>
                            </li>

                            <img src="{{ asset('auth/images/flags/flag-icons/IN.png') }}" class="me-0 me-sm-1" height="18">

                            <!-- Language flag dropdown  -->
                            {{-- <li class="dropdown d-none d-md-inline-block">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="18">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                    </a>

                                </div>
                            </li> --}}

                            <!-- Notofication dropdown -->
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="fe-bell font-22"></i>
                                    <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0 font-16 fw-semibold"> Notification</h6>
                                            </div>
                                            <div class="col-auto">
                                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                    <small>Clear All</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-1" style="max-height: 300px;" data-simplebar>

                                        <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                                        <!-- item-->

                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">New user registered</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">Yesterday</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <h5 class="text-muted font-13 fw-normal mt-0">30 Dec 2021</h5>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Datacorp</h5>
                                                        <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                            <div class="card-body">
                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon">
                                                            <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <h5 class="noti-item-title fw-semibold font-14">Karen Robinson</h5>
                                                        <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <div class="text-center">
                                            <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                        </div>
                                    </div>

                                    <!-- All-->
                                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                        View All
                                    </a>

                                </div>
                            </li>

                            <!-- Light/Darj Mode Toggle Button -->
                            <li class="d-none d-sm-inline-block">
                                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                                    <i class="ri-moon-line font-22"></i>
                                </div>
                            </li>

                            <!-- User Dropdown -->
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    
                                    @if(isset(Auth::user()->image)  && !empty(Auth::user()->image))
                                        <img src="{{env('PROFILE_IMAGE_PATH')}}{{Auth::user()->image}}" alt="user-image" class="rounded-circle">
                                    @else
                                        <img src="{{env('PROFILE_IMAGE_PATH_EMPTY')}}{{Auth::user()->name}}" alt="user-image" class="rounded-circle">
                                    @endif
                                    
                                    
                                   <span class="ms-1 d-none d-md-inline-block">
                                        {{ Auth::user()->name}} <i class="mdi mdi-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                    

                                    <!-- item-->
                                    <a href="#" class="dropdown-item notify-item">
                                        <i class="fe-user"></i>
                                        <span>My Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings"></i>
                                        <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-lock"></i>
                                        <span>Lock Screen</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </a> --}}

                                    <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fe-log-out"></i>
                                        <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                    </form>

                                </div>
                            </li>

                            <!-- Right Bar offcanvas button (Theme Customization Panel) -->
                            <li>
                                <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                                    <i class="fe-settings font-22"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ========== Topbar End ========== -->

                <div class="content">

               @yield('content')

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div><script>document.write(new Date().getFullYear())</script> © Ubold - <a href="https://coderthemes.com/" target="_blank">Coderthemes.com</a></div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end footer-links">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

             <!-- Theme Settings -->
        <div class="offcanvas offcanvas-end right-bar" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex align-items-center w-100 p-0 offcanvas-header">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified w-100" role="tablist">
                    {{-- <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2" data-bs-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="offcanvas-body p-3 h-100" data-simplebar>
                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    {{-- <div class="tab-pane" id="chat-tab" role="tabpanel">

                        <form class="search-bar">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                        <h6 class="fw-medium mt-2 text-uppercase">Group Chats</h6>

                        <div>
                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-success"></i>
                                <span class="mb-0 mt-1">App Development</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-warning"></i>
                                <span class="mb-0 mt-1">Office Work</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1 text-danger"></i>
                                <span class="mb-0 mt-1">Personal Group</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item ps-3 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline me-1"></i>
                                <span class="mb-0 mt-1">Freelance</span>
                            </a>
                        </div>

                        <h6 class="fw-medium mt-3 text-uppercase">Favourites <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-end mdi mdi-plus-circle"></i></a></h6>

                        <div>
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <h6 class="fw-medium mt-3 text-uppercase">Other Chats <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-end mdi mdi-plus-circle"></i></a></h6>

                        <div class="pb-4">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-4.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-5.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="d-flex align-items-start noti-user-item">
                                    <div class="position-relative me-2">
                                        <img src="assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                        <div class="font-13 text-muted">
                                            <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center mt-3">
                                <a href="javascript:void(0);" class="btn btn-sm btn-white">
                                    <i class="mdi mdi-spin mdi-loading me-2"></i>
                                    Load more
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="fw-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                        <div class="px-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">App Development<span class="float-end">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Database Repair<span class="float-end">37%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Backup Create<span class="float-end">52%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <h6 class="fw-medium mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                        <div>
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Sales Reporting<span class="float-end">12%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">Redesign Website<span class="float-end">67%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                                <p class="text-muted mb-0">New Admin Design<span class="float-end">84%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <div class="p-3 mt-2 d-grid">
                            <a href="javascript: void(0);" class="btn btn-success waves-effect waves-light">Create Task</a>
                        </div>

                    </div> --}}

                    <div class="tab-pane active" id="settings-tab" role="tabpanel">

                        <div class="mt-n3">
                            <h6 class="fw-medium py-2 px-3 font-13 text-uppercase bg-light mx-n3 mt-n3 mb-3">
                                <span class="d-block py-1">Theme Settings</span>
                            </h6>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                        </div>

                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h5>

                        <div class="colorscheme-cardradio">
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                                    <label class="form-check-label" for="layout-color-light">Light</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                                    <label class="form-check-label" for="layout-color-dark">Dark</label>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Content Width</h5>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-width" id="layout-width-default" value="default">
                                <label class="form-check-label" for="layout-width-default">Fluid (Default)</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-width" id="layout-width-boxed" value="boxed">
                                <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                            </div>
                        </div>

                        <div id="layout-mode">
                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Layout Mode</h5>

                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-default" value="default">
                                    <label class="form-check-label" for="layout-mode-default">Default</label>
                                </div>


                                <div id="layout-detached">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-detached" value="detached">
                                        <label class="form-check-label" for="layout-mode-detached">Detached</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                                <label class="form-check-label" for="topbar-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                                <label class="form-check-label" for="topbar-color-dark">Dark</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-brand" value="brand">
                                <label class="form-check-label" for="topbar-color-brand">Brand</label>
                            </div>
                        </div>

                        <div>
                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Color</h5>

                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                                    <label class="form-check-label" for="leftbar-color-light">Light</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-brand" value="brand">
                                    <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-gradient" value="gradient">
                                    <label class="form-check-label" for="leftbar-color-gradient">Gradient</label>
                                </div>
                            </div>
                        </div>

                        <div id="menu-icon-color">
                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Menu Icon Color</h5>

                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-light" value="light">
                                    <label class="form-check-label" for="twocolumn-menu-color-light">Light</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-dark" value="dark">
                                    <label class="form-check-label" for="twocolumn-menu-color-dark">Dark</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-brand" value="brand">
                                    <label class="form-check-label" for="twocolumn-menu-color-brand">Brand</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-two-column-color" id="twocolumn-menu-color-gradient" value="gradient">
                                    <label class="form-check-label" for="twocolumn-menu-color-gradient">Gradient</label>
                                </div>
                            </div>
                        </div>

                        <div id="sidebar-size">
                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar Size</h5>

                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                    <label class="form-check-label" for="leftbar-size-default">Default</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                    <label class="form-check-label" for="leftbar-size-compact">Compact (Medium Width)</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label" for="leftbar-size-small">Condensed (Icon View)</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                    <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-fullscreen" value="fullscreen">
                                    <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                                </div>
                            </div>
                        </div>

                        <div id="sidebar-user">
                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h5>

                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="data-sidebar-user" id="sidebaruser-check">
                                <label class="form-check-label" for="sidebaruser-check">Enable</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

           
        </div>

        </div>
        <!-- END wrapper -->



        <!-- scripts js -->
        @livewireScripts

        @stack('scripts')

         <!-- Vendor js -->
        <script src="{{ asset ('auth/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset ('auth/js/app.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset ('auth/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/selectize/js/standalone/selectize.min.js') }}"></script>

         <!-- third party js -->
        <script src="{{ asset ('auth/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        
        <script src="{{ asset ('auth/libs/mohithg-switchery/switchery.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/multiselect/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset ('auth/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset ('auth/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
     
        <!-- third party js ends --> 
        
        
        <!-- Init js-->
        <script src="{{ asset ('auth/js/pages/form-advanced.init.js') }}"></script>

        <!-- Datatables init -->
        <script src="{{ asset('auth/js/pages/customers.init.js') }}"></script>

        
        <!-- Dropzone file uploads-->
        <script src="{{ asset('auth/libs/dropzone/min/dropzone.min.js') }}"></script>

        <!-- Quill js -->
        <script src="{{ asset('auth/libs/quill/quill.min.js') }}"></script>

        <!-- Init js-->
        <script src="{{ asset('auth/js/pages/form-fileuploads.init.js') }}"></script>

        <!-- Init js -->
        <script src="{{ asset('auth/js/pages/add-product.init.js') }}"></script>
       
        <!-- Dashboar 1 init js-->
        <script src="{{ asset ('auth/js/pages/dashboard-1.init.js') }}"></script>

        

    </body>

</html>

