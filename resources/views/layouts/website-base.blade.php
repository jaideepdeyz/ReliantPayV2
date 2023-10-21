<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Home | Repay</title>
    <!-- /SEO Ultimate -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('website/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('website/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('website/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('website/images/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('website/images/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('website/images/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('website/images/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('website/images/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('website/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('website/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('website/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('website/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('website/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('website/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('website/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/js/bootstrap.min.js') }}">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('website/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/custom-style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('website/css/special-classes.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 sol-sm-12">
                    <div class="email">
                        <figure class="mb-0 emailicon">
                            <img src="{{ asset('website/images/header-emailicon.png') }}" alt=""
                                class="img-fluid">
                        </figure>
                        <a href="mailto:support@repay.com" class="mb-0 text-size-14 text-white">support@reliantpay.com</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 sol-sm-12 d-md-block d-none">
                    <div class="mb-0 social-icons">
                        <ul class="mb-0 list-unstyled">
                            <li>Follow us on:</li>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Header-->
    <header class="header">
        <div class="container">
            <nav class="navbar position-relative navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/">
                    <figure class="mb-0"><img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                            alt="" class="img-fluid" style="max-height:100px"></figure>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="./index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./service.html">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pricing.html">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contact.html">Contact Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#"
                                id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> Pages </a>
                            <div class="dropdown-menu drop-down-content">
                                <ul class="list-unstyled drop-down-pages">
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="./team.html">Teams</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="./about.html">About us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="./faq.html">FAQ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="./comingsoon.html">Coming Soon</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#"
                                id="navbarDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> Blog </a>
                            <div class="dropdown-menu drop-down-content">
                                <ul class="list-unstyled drop-down-pages">
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="single-post.html">Single Post</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="infinite-scroll.html">Infinite Scroll</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link" href="load-more.html">Load
                                            More</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link" href="one-column.html">One
                                            Column</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link" href="two-column.html">Two
                                            Column</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="three-column.html">Three Column</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="three-colum-sidbar.html">Three Column Sidebar</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="four-column.html">Four Column</a></li>
                                    <li class="nav-item"><a class="dropdown-item nav-link"
                                            href="six-colum-full-wide.html">Six Column</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link login" href="{{ route('login') }}"><i
                                    class="fa-solid fa-user-lock"></i>Sign in</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')


    <!-- Footer -->
    <section class="footer-section">
        <div class="partner-section">
            <div class="container">
                <div class="partner">
                    <ul class="mb-0 list-unstyled">
                        <li>
                            <figure class="mb-0 partner1">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-1.png') }}"
                                    alt="">
                            </figure>
                        </li>
                        <li>
                            <figure class="mb-0 partner1 partner2">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-2.png') }}"
                                    alt="">
                            </figure>
                        </li>
                        <li class="img-mb">
                            <figure class="mb-0 partner1 partner3">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-3.png') }}"
                                    alt="">
                            </figure>
                        </li>
                        <li>
                            <figure class="mb-0 partner1 partner4">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-4.png') }}"
                                    alt="">
                            </figure>
                        </li>
                        <li>
                            <figure class="mb-0 partner1 partner5">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-5.png') }}"
                                    alt="">
                            </figure>
                        </li>
                        <li>
                            <figure class="mb-0 partner1 partner5">
                                <img class="img-fluid" src="{{ asset('website/images/partner-logo-6.png') }}"
                                    alt="">
                            </figure>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="middle-portion">
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-6 col-12">
                        <a href="./index.html">
                            <figure class="footer-logo">
                                <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}" class="img-fluid"
                                    alt="">
                            </figure>
                        </a>
                        <p class="text-size-16 footer-text">Lorem ipsum dolor sit amet, consectetur adipisc ing elitsed
                            do eiusmod tempororem ipsum dolor sit am econsect ametconsectetetur.</p>
                        <figure class="mb-0 payment-icon">
                            <img src="{{ asset('website/images/payment-card.png') }}" class="img-fluid"
                                alt="">
                        </figure>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-12 col-12 d-lg-block d-none">

                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12 col-12 d-md-block d-none">
                        <div class="links">
                            <h4 class="heading">Important Link</h4>
                            <hr class="line">
                            <ul class="list-unstyled mb-0">
                                <li><a href="./index.html" class=" text-size-16 text text-decoration-none">Home</a>
                                </li>
                                <li><a href="./about.html" class=" text-size-16 text text-decoration-none">About
                                        Us</a></li>
                                <li><a href="./service.html"
                                        class=" text-size-16 text text-decoration-none">Services</a></li>
                                <li><a href="./contact.html"
                                        class=" text-size-16 text text-decoration-none">Contact</a></li>
                                <li><a href="./pricing.html"
                                        class=" text-size-16 text text-decoration-none">Pricing</a></li>
                                <li><a href="./faq.html" class=" text-size-16 text text-decoration-none">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-12 d-lg-block d-none">
                        <div class="links">
                            <h4 class="heading">Support</h4>
                            <hr class="line">
                            <ul class="list-unstyled mb-0">
                                <li><a href="./contact.html"
                                        class=" text-size-16 text text-decoration-none">Support</a></li>
                                <li><a href="./pricing.html" class=" text-size-16 text text-decoration-none">Plan</a>
                                </li>
                                <li><a href="./service.html"
                                        class=" text-size-16 text text-decoration-none">Benefits</a></li>
                                <li><a href="./team.html"
                                        class=" text-size-16 text text-decoration-none">Testimonial</a></li>
                                <li><a href="./comingsoon.html" class=" text-size-16 text text-decoration-none">Coming
                                        Soon</a></li>
                                <li><a href="./team.html" class=" text-size-16 text text-decoration-none">Members</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-sm-block">
                        <div class="icon">
                            <h4 class="heading">Get in Touch</h4>
                            <hr class="line">
                            <ul class="list-unstyled mb-0">
                                <li class="text-size-16 text">Email: <a href="mailto:info@repay.com"
                                        class="mb-0 text text-decoration-none text-size-16">info@repay.com</a></li>
                                <li class="text-size-16 text">Phone: <a href="tel:+4733378901"
                                        class="mb-0 text text-decoration-none text-size-16">+1 234 567 89 0 0</a></li>
                                <li class="text-size-16 text1">Fax: <a href="tel:+198765432199"
                                        class="mb-0 text text-decoration-none text-size-16">+1 (987) 654 321 9 9</a>
                                </li>
                                <li class="social-icons">
                                    <div class="circle"><a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </div>
                                    <div class="circle"><a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                    <div class="circle"><a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                    </div>
                                    <div class="circle"><a href="#"><i class="fa-brands fa-pinterest"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--footer area-->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-white" style="font-size:14px;">Copyright @2023 ReliantPay. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('website/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/video_link.js') }}"></script>
    <script src="{{ asset('website/js/video.js') }}"></script>
    <script src="{{ asset('website/js/counter.js') }}"></script>
    <script src="{{ asset('website/js/custom.js') }}"></script>
    <script src="{{ asset('website/js/animation_links.js') }}"></script>
    <script src="{{ asset('website/js/animation.js') }}"></script>
    @stack('scripts')
    <script>
        window.addEventListener('swal', function(e) {
            Swal.fire(e.detail);
        });
    </script>
    @livewireScripts
</body>

</html>
