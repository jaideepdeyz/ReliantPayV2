@extends('layouts.website-base')

@section('content')

<!--Banner-->
<section class="bannermain position-relative">
    {{-- <figure class="mb-0 bgshape">
        <img src="{{ asset('website/images/online-pay.jpg') }}" alt="" class="img-fluid">
    </figure> --}}
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6 col-md-5 col-sm-12 col-12">
                <div class="banner" data-aos="fade-right">
                    <h6 style="color:#f2f2f2">Simple. Transparent. Secure </h6>
                    <h1 class="text-white">Where <span>Payments</span> and Services Unite</h1>
                    <p style="color:#d6cbcb">Welcome to ReliantPay, your trusted partner in the world of secure
                        and
                        seamless online payments.</p>
                    <div class=" button"><a class="button_text" href="{{ route('register') }}">Open a Free Account</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-sm-12">
                <div class="banner-wrapper">
                    <figure class="mb-0 d-none d-md-block">
                        <img src="{{ asset('website/images/6134224.png') }}" class="img-fluid" width="450">
                    </figure>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!--What-we-do-->
<section class="what-we-do position-relative">
    <div class="container">
        <figure class="element1 mb-0">
            <img src="{{ asset('website/images/what-we-do-icon-1.png') }}" class="img-fluid" alt="">
        </figure>
        <div class="row">
            <div class="col-12">
                <div class="subheading" data-aos="fade-right">
                    <h6>What we do</h6>
                    <h2>Get Ready To Have Best Smart Payments in The World</h2>
                </div>
            </div>
        </div>
        <div class="row position-relative">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                            class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                            <path
                                d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1m-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1" />
                        </svg>
                    </figure>
                    <h3>Payment Solution</h3>
                    <p class="mb-0 text-size-18">we offer a range of payment options to cater to your unique needs.
                    </p>
                </div>
            </div>
            <figure class="arrow1 mb-0" data-aos="fade-down">
                <img src="{{ asset('website/images/what-we-do-arrow-1.png') }}" class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1 service2">
                    <figure class="img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                            class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                            <path
                                d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z" />
                        </svg>
                    </figure>
                    <h3>Growth Business</h3>
                    <p class="mb-0 text-size-18">Whether you're a startup or an established enterprise, we offer a range
                        of payment options to cater to your unique needs.
                    </p>
                </div>
            </div>
            <figure class="arrow2 mb-0" data-aos="fade-up">
                <img src="{{ asset('website/images/what-we-do-arrow-2.png') }}" class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                        </svg>
                    </figure>
                    <h3>Connected People</h3>
                    <p class="mb-0 text-size-18">Our dedicated support team is ready to assist you with any questions or
                        issues you may encounter.

                    </p>
                </div>
            </div>
            <figure class="element3 mb-0">
                <img src="{{ asset('website/images/what-we-do-element.png') }}" alt="">
            </figure>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-12">

            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="account" data-aos="fade-right">
                    <div class="accounticon">
                        <figure class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#f37368"
                                class="bi bi-person-badge" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path
                                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
                            </svg>
                        </figure>
                    </div>
                    <div class="heading">
                        <h3 class="mb-0">PERSONAL ACCOUNT</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="account" data-aos="fade-right">
                    <div class="accounticon">
                        <figure class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#5ca1ff"
                                class="bi bi-buildings" viewBox="0 0 16 16">
                                <path
                                    d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                <path
                                    d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                            </svg>
                        </figure>
                    </div>
                    <div class="heading">
                        <h3 class="mb-0">BUSINESS ACCOUNT</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12 col-12">

            </div>
            <figure class="element2 mb-0">
                <img src="{{ asset('website/images/what-we-do-icon-2.png') }}" class="img-fluid" alt="">
            </figure>
        </div>
    </div>
</section>
<!--About Repay-->
<section class="about-repay" style="background:#f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-5">
                <div class="about-wrapper">
                    <figure class="image mb-0">
                        <img src="{{ asset('website/images/6134224.png') }}" alt="" class="img-fluid"
                            style="max-height:400px">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="about-content" data-aos="fade-up">
                    <h6>ABOUT RELIANTPAY</h6>
                    <h2>Revolutionizing the way businesses handle payments</h2>
                    <p class="text-size-18">Welcome to ReliantPay, your trusted partner in the world of secure and
                        seamless online payments. At ReliantPay, we've made it our mission to empower businesses of all
                        sizes by providing a cutting-edge payment gateway aggregation service.
                    </p>
                    <div class="right-lower">
                        <figure class="mb-0 icon">
                            <img src="{{ asset('website/images/happy-customer-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <span>55k+</span>
                            <h4 class="mb-0">Happy Customers</h4>
                        </div>
                        <figure class="mb-0 icon">
                            <img src="{{ asset('website/images/total-customers-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content content1">
                            <span>$249M+</span>
                            <h4 class="mb-0">Total Transections</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Services section-->
<section class="service-section" id="servicesSection">
    <div class="container">
        <div class="row position-relative justify-content-center">
            <div class="service-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <figure class="mb-0 services-icon">
                        <img src="{{ asset('website/images/services-our-services-icon-1.png') }}" class="img-fluid"
                            alt="">
                    </figure>
                    <h6>OUR SERVICES</h6>
                    <h2>Smart Solution for Your Payment</h2>
                </div>
            </div>
        </div>
        <figure class="element1 mb-0">
            <img src="{{ asset('website/images/what-we-do-icon-1.png') }}" class="img-fluid" alt="">
        </figure>
        <div class="services-data">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img1">
                            <img src="{{ asset('website/images/services-payment-management-icon.png') }}" alt=""
                                class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Airline Ticketing (Current Offering)
                            </h3>
                            <p class="text-size-18">Experience the world with the ease and convenience of booking your
                                airline tickets through ReliantPay. </p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img2">
                            <img src="{{ asset('website/images/services-dashboard-icon.png') }}" alt=""
                                class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Hotel Booking (Coming Soon)
                            </h3>
                            <p class="text-size-18">Elevate your travel experience by booking your accommodations with
                                ReliantPay.</p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img3">
                            <img src="{{ asset('website/images/services-integrated-payment-icon.png') }}" alt=""
                                class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Cab Services (Coming Soon)
                            </h3>
                            <p class="text-size-18">Your travel experience wouldn't be complete without reliable
                                transportation at your destination. </p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img4">
                            <img src="{{ asset('website/images/services-friendly.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Amtrak Booking (Coming Soon)
                            </h3>
                            <p class="text-size-18">For travelers exploring the beauty of the United States, we're
                                thrilled to announce that we'll soon be offering Amtrak booking services.</p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <figure class="mb-0 mobile-image" data-aos="fade-right">
                        <img src="{{ asset('website/images/services-mobile-image.png') }}" alt="" class="img-fluid">
                    </figure>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img5">
                            <img src="{{ asset('website/images/services-credit-debit-icon.png') }}" alt=""
                                class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Credit & Debit Card</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do
                                eiusmod tempor in cididod temunt.</p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <figure class="element2 mb-0">
            <img src="{{ asset('website/images/what-we-do-icon-2.png') }} " class="img-fluid" alt="">
        </figure>
    </div>
</section>
<!-- manage -->
<section class="manage-section" style="background:#f2f2f2" id="benefitSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-content" data-aos="fade-right">
                    <h2>Why Reliantpay</h2>
                    <div class="first">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{ asset('website/images/manageyour-user-friendly-icon.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>Comprehensive Services</h4>
                                    <p class="text-size-16 text">With ReliantPay, you gain access to a comprehensive
                                        suite of services.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="secound">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{ asset('website/images/manageyour-best-support-icon.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>Simplified Booking</h4>
                                    <p class="text-size-16">Our user-friendly platform makes booking a breeze. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="third">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{ asset('website/images/manageyour-secure-icon.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>Cost Savings</h4>
                                    <p class="text-size-16">We're committed to offering competitive pricing across all
                                        our services. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-wrapper">
                    <figure class="mb-0">
                        <img src="{{ asset('img/survey.svg') }}" class="img-fluid" alt="">
                    </figure>

                </div>
            </div>
        </div>
    </div>
    <figure class="mb-0 manage-layer">
        <img src="{{ asset('website/images/mange-layer.png') }}" alt="" class="img-fluid">
    </figure>

</section>
<!-- plan and pricing -->
{{-- <section class="plan">
    <div class="container">
        <figure class="element1 mb-0">
            <img src="{{ asset('website/images/what-we-do-icon-1.png') }}" class="img-fluid" alt="">
        </figure>
        <div class="row position-relative">
            <div class="col-12">
                <div class="content" data-aos="fade-right">
                    <h6>PLAN AND PRICING</h6>
                    <h2>Helping You Make Smart Financial Choices</h2>
                    <figure class="element3 mb-0">
                        <img src="{{ asset('website/images/what-we-do-element.png') }}" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="pricing">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h3>Bank Transfer</h3>
                            <p class="mb-0 text1 text">*Fees (excl VAT)</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="online-payment">Online Payment</h4>
                            <p class="mb-0 text1 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="payout">Payout</h4>
                            <p class="mb-0 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <figure class="mb-0 icon">
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt=""
                                    class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pricing">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h3>e-Wallet</h3>
                            <p class="mb-0 text1 text">*Need Verification </p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="online-payment">Online Payment</h4>
                            <p class="mb-0 text1 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="payout">Payout</h4>
                            <p class="mb-0 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <figure class="mb-0 icon">
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt=""
                                    class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pricing">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h3>Credit Card</h3>
                            <p class="mb-0 text1 text">*Fees (excl VAT)</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="online-payment">Online Payment</h4>
                            <p class="mb-0 text1 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="payout">Payout</h4>
                            <p class="mb-0 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <figure class="mb-0 icon">
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt=""
                                    class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="pricing box">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h3>Cardless Credit</h3>
                            <p class="mb-0 text1 text">*Account Must be registered</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="online-payment">Online Payment</h4>
                            <p class="mb-0 text1 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <h4 class="payout">Payout</h4>
                            <p class="mb-0 text">3.5% plus USD 1.00</p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <figure class="mb-0 icon">
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt=""
                                    class="img-fluid">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row position-relative">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="facility" data-aos="fade-up">
                    <ul class="mb-0 list-unstyled">
                        <li class="text1">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">Free Account</p>
                        </li>
                        <li class="text2">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">No Monthly Cost</p>
                        </li>
                        <li class="text3">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">No Fee Setup</p>
                        </li>
                        <li class="text4">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">Easy to Setup</p>
                        </li>
                        <li class="text5">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">Integration</p>
                        </li>
                        <li class="text6">
                            <i class="fa-regular fa-circle-check font1"></i>
                            <p class="mb-0 text-size-16">Custom price</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <figure class="element2 mb-0">
            <img src="{{ asset('website/images/what-we-do-icon-2.png') }}" class="img-fluid" alt="">
        </figure>
    </div>
</section> --}}
<!-- need more help? -->
{{-- <section class="need-section" style="background:#f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content" data-aos="fade-right">
                    <h6>NEED MORE HELP?</h6>
                    <h2>Leading, Trusted. Enabling growth.</h2>
                    <p class="text-size-18">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididuntabore et dolore aliquaQuis ipsum suspe.</p>
                </div>
            </div>
        </div>
        <div class="row position-relative">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img img1">
                        <img src="{{ asset('website/images/need-sales-icon.png') }}" alt="" class="img-fluid">
                    </figure>
                    <h3>Sales</h3>
                    <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed</p>
                    <a href="./contact.html" class="btn">Contact Sales</a>
                </div>
            </div>
            <figure class="arrow1 mb-0" data-aos="fade-down">
                <img src="{{ asset('website/images/need-arrow1.png') }}" class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1 service2">
                    <figure class="img img2">
                        <img src="{{ asset('website/images/need-more-icon2.png') }}" alt="" class="img-fluid">
                    </figure>
                    <h3>Help & Support</h3>
                    <p class="text-size-18">Labore et dolore magna aliqua quis ipsum suspendisse ultrices</p>
                    <a href="./contact.html" class="btn">Get Support</a>
                </div>
            </div>
            <figure class="arrow2 mb-0" data-aos="fade-up">
                <img src="{{ asset('website/images/need-arrow-2.png') }}" class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img img3">
                        <img src="{{ asset('website/images/need-more-icon-3.png') }}" alt="" class="img-fluid">
                    </figure>
                    <h3>Article & News</h3>
                    <p class="text-size-18">viverra maecenas accumsan lacus vel facili sis consectetur adipiscing</p>
                    <a href="./contact.html" class="btn">Read Article</a>
                </div>
            </div>
        </div>
    </div>
    <figure class="mb-0 need-layer">
        <img src="{{ asset('website/images/need-layer.png') }}" alt="" class="img-fluid">
    </figure>
</section> --}}
<!-- Partner -->


@stop