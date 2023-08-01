@extends('frontend.layouts.master')

@section('content')
<section class="hero hero-slider-wrapper hero-style-2">
    <div class="hero-slider">
        <div class="slide">
            <img src="{{asset('assets/frontend/media/home/bg3.png')}}" alt class="slider-bg">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 slide-caption">
                        <p class="text">Need Legal Help?</p>
                        <h2><span>Easy Online Access to Experienced Lawyers</span></h2>
                        <span class="subtitle">In this family, you control the costs, while lawyers handle the
                            work for you...</span>
                        <div class="btns">
                            <div class="btn-style btn-style-3"><a href="#">Get Started </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="{{asset('assets/frontend/media/home/bg4.png')}}" alt class="slider-bg">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-8 slide-caption">
                        <p>The Most Talented Law Frim</p>
                        <h2><span>We Fight For Your Justice</span> <span>As Like A Friend.</span></h2>
                        <div class="btns">
                            <div class="btn-style btn-style-3"><a href="#">Contact us now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section home-feature bg_light_secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <h1 class="text-center pt-5 pb-5 fs-36px dark-blue-color">
                        Why Choose Allways Legal Services?</h1>
                </div>
                <div class="row mb-40px" id="services-owl-mobile">
                    <div class="col-lg-4 col-md-6 col-sm-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <div class="features-small-item" tyle="background:#337ab7">
                            <div class="icon" tyle="font-size:0px">
                                <!--<i class="fa fa-gavel" style="font-size:100px; color:#337ab7"></i>-->
                                <img src="{{asset('assets/frontend/media/legal_service.svg')}}" alt="">
                            </div>

                            <h4 style="color:#002d6a">Direct Legal Help</h4>
                            <p style="font-size:16px">
                                Lawyers are waiting.
                                Register, Book Service,
                                Select a Lawyer &
                                Book Appointment.
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                        <div class="features-small-item">
                            <div class="icon">
                                <!--<i class="fa fa-user" style="font-size:100px; color:#337ab7"></i>-->
                                <img src="{{asset('assets/frontend/media/woman.svg')}}" alt="">
                            </div>
                            <h4 style="color:#002d6a">Our Admin Services</h4>
                            <p style="font-size:16px">
                                Easily and efficiently organise your inquiries with our
                                Allways Legal Admin Services.</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                        <div class="features-small-item">
                            <div class="icon">
                                <img src="{{asset('assets/frontend/media/payment_agency.svg')}}" alt="">
                                <!--<i class="fa fa-bank" style="color:#337ab7; font-size:100px"></i>-->
                            </div>
                            <h4 style="color:#002d6a">Payment Agency</h4>
                            <p style="font-size:16px">Use our payment services to pay globally
                                for purchases, services, gift and debt.</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text title">
                    <h2>Get started with just a few quick steps...</h2>
                    <ul class="list-unstyled">
                        <li>
                            <span style="color:#337ab7"><i class="fa fa-check-circle" style="font-size:18px">
                                </i>&nbsp; Select practice area</span>
                            <p style="color:grey;">
                                Conveniently choose from an array of our <b>"LEGAL PRACTICE AREAS"</b>
                                that best suits your personal interests and need.</i>
                            </p>
                        <li>
                            <span style="color:#337ab7"><i class="fa fa-check-circle"
                                    style="font-size:18px"></i>&nbsp;
                                Select a service</span>
                            <p style="color:grey;">
                                Experience the luxury of selecting a service of your choice from available
                                options
                                and
                                enjoy the flexibility of our delivery.
                            </p>
                        </li>
                        <li>
                            <span style="color:#337ab7"><i class="fa fa-check-circle"
                                    style="font-size:18px"></i>&nbsp;
                                Book a lawyer</span>
                            <p style="color:grey;">
                                Meet top-notch, verified and experienced lawyers and get the chance to select
                                lawyers
                                of your choice based on location and profile.
                            </p>
                        </li>
                    </ul>
                    <div class="btns-2">
                        <div class="btn-style"><a href="#">Get Started</a></div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6">
                <div class="about-title">
                    <div class="img-holder">
                        <img src="{{asset('assets/frontend/media/intro.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding all-sectors-wrap wow fadeInUp bg_light_secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title pb_50 text-center">
                    <h2 class="dark-blue-color fs-36px">Select an Area of Practice</h2>
                </div>
            </div>
        </div>

        <div class="row" id="area-owl-mobile">
            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/bankrupsy.png')}}" alt="Bankrupsy Law"
                            style="width:80px">
                        <h6>BANKRUPTCY</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/business.png')}}" alt="Business Law" style="width:80px">
                        <h6>BUSINESS</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/employment.png')}}" alt="Employment Law"
                            style="width:80px">
                        <h6>EMPLOYMENT LAW</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/environment (1).png')}}" alt="Environment Law"
                            style="width:80px">
                        <h6>ENVIRONMENT</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/family.png')}}" alt="Family Law" style="width:80px">
                        <h6>FAMILY</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/health.png')}}" alt="Health Law" style="width:80px">
                        <h6>HEALTH</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/immigration.png')}}" alt="Immigration Law"
                            style="width:80px">
                        <h6>IMMIGRATION</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/intellectual.png')}}" alt="Intellectual Property Law"
                            style="width:80px">
                        <h6>INTELLECTUAL PROPERTY</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/personal-injury.png')}}" alt="Personal Injury Law"
                            style="width:80px">
                        <h6>PERSONAL INJURY</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/education.png')}}" alt="Education Law"
                            style="width:80px">
                        <h6>EDUCATION</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/insurance.png')}}" alt="Insurance Law"
                            style="width:80px">
                        <h6>INSURANCE</h6>
                    </div>
                </a>
            </div>

            <div class="area-box col-md-3 col-sm-4 col-xs-6">
                <a href="#">
                    <div class="single-campaignCategories-area change">
                        <img src="{{asset('assets/frontend/media/tax.png')}}" alt="Tax law" style="width:80px">
                        <h6>TAX</h6>
                    </div>
                </a>
            </div>
        </div>
        <div class="mt-4 text-center">
            <a href="#">
                <button class="btn secondary_ct_btn btn-lg shadow-none">
                    Browse All Areas <i class="fa fa-arrow-right ms-2"></i>
                </button>
            </a>
        </div>
    </div>
</section>
<section class="section-padding team_section">
    <div class="container">
        <div class="row row_reverse">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="about-text title">
                    <h2>Experienced lawyers waiting to fight for you.</h2>
                    <p class="text-color">
                        Experienced lawyers waiting to fight for you.
                        Allways legal was designed to bridge the gap between lawyers and clients globally.
                        Regardless of your personalty or business Allways Legal connects you with lawyers ready
                        to help in each specific area.</i>
                    </p>
                    <p class="text-color">
                        We'll connect you with experience lawyers. Just tell us what you want and we'll link you
                        with the lawyer that is able to assist you.
                    </p>

                    <div class="btns-2">
                        <div class="btn-style"><a href="#">View our practice areas</a></div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6">
                <div class="about-title">
                    <div class="img-holder">
                        <img src="{{asset('assets/frontend/media/practice-area.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section-padding testimonial-wrapper fadeInUp bg_light_secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title pb_50 text-center">
                    <h2 class="dark-blue-color fs-36px">Happy Clients</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel t_carousel10">
                    <div class="single_testimonial">
                        <div class="order_extra pos_relative d-flex justify-content-start flex-column">
                            <div class="author_info text-left">
                                <p class="author_comment color_66">
                                    <i class="fa fa-quote-left me-2" aria-hidden="true"></i>
                                    The services of Allways Legal made it possible for me
                                    to access the services of a lawyer from the comfort of my home.
                                    I did not need to go to the lawyer’s office. I often feel intimidated
                                    in law offices but on this occasion I got what I needed from the lawyer
                                    just by booking appointment online, speaking to him, uploading papers
                                    and paying for the specific tasks I needed.<i class="fa fa-quote-right ms-2"
                                        aria-hidden="true"></i>
                                </p>
                            </div>
                            <div class="author_footer d-flex gap-3 align-items-center mt-3">
                                <div>
                                    <figure class="mb-0 author_img">
                                        <img src="{{asset('assets/frontend/media/home/user-solid.svg')}}" alt="">
                                    </figure>
                                </div>
                                <div>
                                    <h4 class="mb-0">Chuma Ogbo</h4>
                                    <span>Creative Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_testimonial">
                        <div class="order_extra pos_relative d-flex justify-content-start flex-column">
                            <div class="author_info text-left">
                                <p class="author_comment color_66">
                                    <i class="fa fa-quote-left me-2" aria-hidden="true"></i>
                                    Writing the facts of my case was a daunting task. I didn’t know where to
                                    begin or what questions to ask. The Admin Services was very helpful.
                                    I felt like they entered my mind and brought out exactly what I wanted
                                    to say and the questions I wanted to ask. They earned my trust.
                                    By the time I got to the lawyer it was very easy for the lawyer to
                                    understand my needs. It took little of the lawyer time to provide
                                    the services I needed. That translated into less legal fee.<i
                                        class="fa fa-quote-right ms-2" aria-hidden="true"></i>
                                </p>
                            </div>
                            <div class="author_footer d-flex gap-3 align-items-center mt-3">
                                <div>
                                    <figure class="mb-0 author_img">
                                        <img src="{{asset('assets/frontend/media/home/user-solid.svg')}}" alt="">
                                    </figure>
                                </div>
                                <div>
                                    <h4 class="mb-0">Chuma Ogbo</h4>
                                    <span>Creative Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_testimonial">
                        <div class="order_extra pos_relative d-flex justify-content-start flex-column">
                            <div class="author_info text-left">
                                <p class="author_comment color_66">
                                    <i class="fa fa-quote-left me-2" aria-hidden="true"></i>
                                    The services of Allways Legal made it possible for me
                                    to access the services of a lawyer from the comfort of my home.
                                    I did not need to go to the lawyer’s office. I often feel intimidated
                                    in law offices but on this occasion I got what I needed from the lawyer
                                    just by booking appointment online, speaking to him, uploading papers
                                    and paying for the specific tasks I needed.<i class="fa fa-quote-right ms-2"
                                        aria-hidden="true"></i>
                                </p>
                            </div>
                            <div class="author_footer d-flex gap-3 align-items-center mt-3">
                                <div>
                                    <figure class="mb-0 author_img">
                                        <img src="{{asset('assets/frontend/media/home/user-solid.svg')}}" alt="">
                                    </figure>
                                </div>
                                <div>
                                    <h4 class="mb-0">Chuma Ogbo</h4>
                                    <span>Creative Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_testimonial">
                        <div class="order_extra pos_relative d-flex justify-content-start flex-column">
                            <div class="author_info text-left">
                                <p class="author_comment color_66">
                                    <i class="fa fa-quote-left me-2" aria-hidden="true"></i>
                                    The services of Allways Legal made it possible for me
                                    to access the services of a lawyer from the comfort of my home.
                                    I did not need to go to the lawyer’s office. I often feel intimidated
                                    in law offices but on this occasion I got what I needed from the lawyer
                                    just by booking appointment online, speaking to him, uploading papers
                                    and paying for the specific tasks I needed.<i class="fa fa-quote-right ms-2"
                                        aria-hidden="true"></i>
                                </p>
                            </div>
                            <div class="author_footer d-flex gap-3 align-items-center mt-3">
                                <div>
                                    <figure class="mb-0 author_img">
                                        <img src="{{asset('assets/frontend/media/home/user-solid.svg')}}" alt="">
                                    </figure>
                                </div>
                                <div>
                                    <h4 class="mb-0">Chuma Ogbo</h4>
                                    <span>Creative Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single_testimonial">
                        <div class="order_extra pos_relative d-flex justify-content-start flex-column">
                            <div class="author_info text-left">
                                <p class="author_comment color_66">
                                    <i class="fa fa-quote-left me-2" aria-hidden="true"></i>
                                    The services of Allways Legal made it possible for me
                                    to access the services of a lawyer from the comfort of my home.
                                    I did not need to go to the lawyer’s office. I often feel intimidated
                                    in law offices but on this occasion I got what I needed from the lawyer
                                    just by booking appointment online, speaking to him, uploading papers
                                    and paying for the specific tasks I needed.<i class="fa fa-quote-right ms-2"
                                        aria-hidden="true"></i>
                                </p>
                            </div>
                            <div class="author_footer d-flex gap-3 align-items-center mt-3">
                                <div>
                                    <figure class="mb-0 author_img">
                                        <img src="{{asset('assets/frontend/media/home/user-solid.svg')}}" alt="">
                                    </figure>
                                </div>
                                <div>
                                    <h4 class="mb-0">Chuma Ogbo</h4>
                                    <span>Creative Head</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section blog_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center pb_50 ">
                    <h2 class="dark-blue-color fs-36px">Not sure what you need?</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="bloglist item">
                    <div class="post-content">
                        <div class="post-image">
                            <img alt="" src="{{asset('assets/frontend/media/booking.jpg')}}">
                        </div>
                        <div class="post-text">
                            <h4><a href="#">The Lawyer European Awards shortlist<span></span></a>
                            </h4>
                            <p> Use our free admin services. Our experienced admin team will help you.
                                Book a call now or send your questions and our admin team will provide
                                you with the assistance you need.
                            </p>
                            <p>Book a call now and take
                                advantage of our free legal consultation service.</p>
                            <div class="btn-style"><a href="#">Contact Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="bloglist item">
                    <div class="post-content">
                        <div class="post-image">
                            <img alt="" src="{{asset('assets/frontend/media/payment-agency.svg')}}">
                        </div>
                        <div class="post-text">
                            <h4><a href="#">Efficient and reliable payment system.</a>
                            </h4>
                            <p> Allways Legal payment agency enables you to pay for goods and services globally.
                                Before you engage in investment, purchase of goods and services in a country
                                outside your place of residence inform us. </p>
                            <p>We will act as escrow and
                                make payment for you according to your instructions.
                            </p>
                            <div class="btn-style"><a href="#">Contact Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="bloglist item">
                    <div class="post-content">
                        <div class="post-image">
                            <img alt="" src="{{asset('assets/frontend/media/booking.jpg')}}">
                        </div>
                        <div class="post-text">
                            <h4><a href="#">The Lawyer European Awards shortlist<span></span></a>
                            </h4>
                            <p> Use our free admin services. Our experienced admin team will help you.
                                Book a call now or send your questions and our admin team will provide
                                you with the assistance you need.
                            </p>
                            <p>Book a call now and take
                                advantage of our free legal consultation service.</p>
                            <div class="btn-style"><a href="#">Contact Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding get_wrapper">
    <div class="row_position">
        <div class="container">
            <h2 class="text-center pt-5 pb-5 fs-36px text-white mb-0">Get started today!</h2>
            <p class="text-white text-center mx-auto">
                Book your first Allways legal service today or check out our free stuff.
                From the podcast and blog to our webinars and legal concierge,
                Allways legal has got you covered and is guaranteed to change
                your perspective about lawyers — for good.
            </p>
            <div class="btn-style text-center btn-style-3"><a href="#">Get Started Now</a></div>
        </div>
    </div>
</section>
<section class="section-padding faq-wrapper" style="background:ghostwhite" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title pb_50 text-center">
                    <h2 class="dark-blue-color fs-36px">
                        Are you still confused?</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 text-center">
                <img src="{{asset('assets/frontend/media/faq.svg')}}" alt="faq">
            </div>
            <div class="container col-lg-7 col-md-12 col-sm-12 col-xs-12">
                <h5 style="color:#002d6a">
                    Feel free to explore some of our frequently asked questions...</h5>
                <div class="styled-faq">
                    <div class="panel-group" class="accordion" id="accordionFaq" role="tablist"
                        aria-multiselectable="true">
                        <div class="accordion" id="accordionFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-expanded="false" aria-controls="collapseOne">
                                        What is Allways Legal?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>It is an online service that connects people to lawyers.
                                            We do not provide legal services; legal representation;
                                            legal advice or lawyer referral services. We bridge the
                                            gap between you and lawyers so that it is easier for
                                            you to find the lawyer you need.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        How do I get started?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>Two ways to start are –
                                            Get registered or contact our free admin services.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Why should I choose this platform?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>You get the chance to choose from a list of verified and
                                            experienced lawyers based on their areas of practice and choose
                                            how and when you would like to interact with them. So it is easier
                                            to select the lawyer that best meet your needs.
                                            You are also able to purchase every aspect of legal services
                                            you need at a specified fee. No surprises with legal fee.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        How do I make payment?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>Online payment facilities are available.
                                            You are able to pay with credit cards or debit card.
                                            You can request bank account details if you prefer
                                            to pay by bank-to-bank transfer.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        Can I trust this site?
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>This site has registered lawyers regulated by the Law Society
                                            of their province, state and country. We ensure that a lawyer is
                                            registered with the relevant Law Society or professional body and
                                            of good standing before inclusion in the Allways Legal database
                                            of lawyers. We run a check and vet all lawyers you see on this site.
                                            Every communication through this site is private and confidential.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                        aria-expanded="false" aria-controls="collapseSix" style="background:#">
                                        How can Allways Legal make payment as my agent?
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="headingSix" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>It is simple. Just contact us with details of who to pay
                                            and when to pay. Allways Legal is able to receive your money
                                            on trust and disburse it according to your instructions.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button collapsed shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                        aria-expanded="false" aria-controls="collapseSeven">
                                        Can Allways Legal help me purchase personal goods
                                        online and deliver to my address in Africa?
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse"
                                    aria-labelledby="headingSeven" data-bs-parent="#accordionFaq">
                                    <div class="accordion-body">
                                        <p>Yes, Allways Legal can help. Send us details of what you want
                                            to buy online and make the payment to us and we pay for the goods
                                            for you. We can receive it and send to you if the seller does not
                                            dispatch to your country.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection