@extends('layouts.website-base')

@section('content')

<!--Banner-->
<section class="bannermain position-relative">
    <figure class="mb-0 bgshape">
        <img src="{{ asset('website/images/homebanner-bgshape.png') }}" alt="" class="img-fluid">
    </figure>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="banner" data-aos="fade-right">
                    <h6>Simple. Transparent. Secure </h6>
                    <h1>The Smart Way for<span>Online Payment</span> Solution.</h1>
                    <p class="banner-text">Lorem ipsum dolor sit amet, consectetur adipisc ing elit sed do eiusmod tempor.</p>
                    <div class="button"><a  class="button_text" href="{{route('dealer-registration')}}">Open a Free Account</a></div>
                </div>
            </div>
            <div class=" col-lg-7 col-md-7 col-sm-12">
                <div class="banner-wrapper">
                    <figure class="mb-0 homeelement1">
                        <img src="{{ asset('website/images/homeelement1.png') }}" class="img-fluid" alt="">
                    </figure>
                    <figure class="mb-0 banner-image">
                        <img src="{{ asset('website/images/homebanner-image.png') }}" class="img-fluid" alt="banner-image">
                    </figure>
                    <figure class="mb-0 content img-bg">
                        <img src="{{ asset('website/images/homebanner-img-bg.png') }}" alt="banner-image-bg">
                    </figure>
                    <figure class="mb-0 homeelement">
                        <img src="{{ asset('website/images/homeelement.png') }}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
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
                        <img src="{{ asset('website/images/what-we-do-credit-debit-icon.png') }}" alt="" class="img-fluid">
                    </figure>
                    <h3>Payment Solution</h3>
                    <p class="mb-0 text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
                </div>
            </div>
            <figure class="arrow1 mb-0" data-aos="fade-down">
                <img src="{{ asset('website/images/what-we-do-arrow-1.png')}}"  class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1 service2">
                    <figure class="img">
                        <img src="{{ asset('website/images/what-we-do-growth--icon.png')}}" alt="" class="img-fluid">
                    </figure>
                    <h3>Growth Business</h3>
                    <p class="mb-0 text-size-18">Labore et dolore magna aliqua quis ipsum suspendisse ultrices gravida risus commo ddolore magnao.</p>
                </div>
            </div>
            <figure class="arrow2 mb-0" data-aos="fade-up">
                <img src="{{ asset('website/images/what-we-do-arrow-2.png')}}"  class="img-fluid" alt="">
            </figure>
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="service1">
                    <figure class="img">
                        <img src="{{ asset('website/images/what-we-do-connected-people-icon.png') }}" alt="" class="img-fluid">
                    </figure>
                    <h3>Connected People</h3>
                    <p class="mb-0 text-size-18">viverra maecenas accumsan lacus vel facili sis consectetur adipiscing mae-cenelit seiscingsd.</p>
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
                            <img src="{{ asset('website/images/what-we-do-personal-account-icon.png') }} " class="img-fluid" alt="">
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
                            <img src="{{ asset('website/images/what-we-do-business-account-icon-2.png')}}" class="img-fluid" alt="">
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
<section class="about-repay">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="about-wrapper">
                    <figure class="circle mb-0">
                        <img src="{{ asset('website/images/image-2-bg.png') }}" alt="">
                    </figure>
                    <div class="position-relative">
                        <a class="popup-vimeo" href="https://video-previews.elements.envatousercontent.com/h264-video-previews/d1c81f1e-849f-4d45-ae57-b61c2f5db34a/25628048.mp4">
                            <figure class="mb-0 videobutton">
                                <img class="thumb img-fluid" style="cursor: pointer" src="{{ asset('website/images/play-button.png') }}" alt="">
                            </figure>
                        </a>
                    </div>
                    <figure class="image mb-0">
                        <img src="{{ asset('website/images/image-2.png') }}" alt="" class="img-fluid">
                    </figure>
                    <figure class="homeelement mb-0">
                        <img src="{{ asset('website/images/homeelement.png') }}" alt="" class="img-fluid">
                    </figure>
                    <figure class="homeelement1 mb-0">
                        <img src="{{ asset('website/images/homeelement.png') }}" alt="" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="about-content"  data-aos="fade-up">
                    <h6>ABOUT REPAY</h6>
                    <h2>We Have The Most Users All Over The World</h2>
                    <p class="text-size-18">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
                    <p class="text-size-18 text">magna aliquaQuis ipsum suspendisse ultrices gravida. Risus com- modo viverra maecenas.</p>
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
<section class="service-section">
    <div class="container">
        <div class="row position-relative">
            <div class="service-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <figure class="mb-0 services-icon">
                        <img src="{{ asset('website/images/services-our-services-icon-1.png') }}" class="img-fluid" alt="">
                    </figure>
                    <h6>OUR SERVICES</h6>
                    <h2>Smart Solution for Your Payment</h2>
                    <figure class="service-image" data-aos="fade-up">
                        <img src="{{ asset('website/images/services-our-services-image.png') }}" class="img-fluid" alt="">
                    </figure>
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
                            <img src="{{ asset('website/images/services-payment-management-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Payment Management</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img2">
                            <img src="{{ asset('website/images/services-dashboard-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Personal Dashboard</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
                            <a href="./pricing.html" class="more">More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="service-box">
                        <figure class="img img3">
                            <img src="{{ asset('website/images/services-integrated-payment-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Integrated Payments</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
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
                            <h3>Business Tracking</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
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
                            <img src="{{ asset('website/images/services-credit-debit-icon.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <h3>Credit & Debit Card</h3>
                            <p class="text-size-18">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
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
<section class="manage-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-content"  data-aos="fade-right">
                    <h2>Manage Everything in Your Hand</h2>
                    <div class="first">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <figure class="mb-0 icon">
                                    <img src="{{ asset('website/images/manageyour-user-friendly-icon.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <div class="content">
                                    <h4>User Friendly</h4>
                                    <p class="text-size-16 text">Lorem ipsum dolor sit ametcon sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt.</p>
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
                                    <h4>Best Support</h4>
                                    <p class="text-size-16">Sec tetur adipiscing elit sed do eiusmod tempor in cididod temunt Lorem ipsum dolor sit ametcon.</p>
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
                                    <h4>Secure</h4>
                                    <p class="text-size-16">Adipiscing elit sed do eiusmod tempor in cididod temunt. Lorem ipsum dolor sit ametcon sec tetur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="manage-wrapper">
                    <figure class="mb-0 homeelement1">
                        <img src="{{ asset('website/images/homeelement1.png') }}" class="img-fluid" alt="">
                    </figure>
                    <figure class="mb-0 manage-image">
                        <img src="{{ asset('website/images/manage-your-everything-image.png') }}" class="img-fluid" alt="">
                    </figure>
                    <figure class="mb-0 content img-bg">
                        <img src="{{ asset('website/images/manageyour-mange-your-bg.png') }}" alt="" class="">
                    </figure>
                    <figure class="mb-0 homeelement">
                        <img src="{{ asset('website/images/homeelement.png" class="img-fluid') }}" alt="">
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
<section class="plan">
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
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt="" class="img-fluid">
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
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt="" class="img-fluid">
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
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt="" class="img-fluid">
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
                                <img src="{{ asset('website/images/price-payment-icon.png') }}" alt="" class="img-fluid">
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
</section>
<!-- need more help? -->
<section class="need-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content" data-aos="fade-right">
                    <h6>NEED MORE HELP?</h6>
                    <h2>Leading, Trusted. Enabling growth.</h2>
                    <p class="text-size-18">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntabore et dolore aliquaQuis ipsum suspe.</p>
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
</section>
<!-- Partner -->


@stop
