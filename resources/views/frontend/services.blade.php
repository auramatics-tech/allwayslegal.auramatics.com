@extends('frontend.layouts.master')

@section('content')
    <div class="section-contact">
        <div class="container main_section">
            <div class="c_txt">
                <h2>Services</h2>
                <ul class="ps-0">
                    <li><a href="#">Home</a></li>
                    <li><span class="textActive">Services</span></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="services_Section padding_50px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-0 pb-5 fs-36px dark-blue-color">
                        Why Choose Allways Legal Services?</h1>
                </div>
                <div class="col-12 mb-4">
                    <div class="text-center d-flex gap-3">
                        <div>
                            <div class="service_icon1">
                                <img src="{{ asset ('assets/frontend/media/legal_service.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="text text-start">
                            <h4 class="mb-0"><a href="#" class="dark-blue-color">Direct Legal Help</a></h4>
                            <p class="mb-0">Lawyers are waiting. Register, Book Service, Select a Lawyer & Book
                                Appointment.</p>
                        </div>
                    </div>
                    <hr class="line_hr w-100 full mx-auto">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/businessman.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Register</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/customer-service.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Book Service</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-lg-5 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/law.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Select a Lawyer & Book
                                Appointment</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="text-center d-flex gap-3">
                        <div>
                            <div class="service_icon1">
                                <img src="{{ asset ('assets/frontend/media/woman.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="text text-start">
                            <h4 class="mb-0"><a href="#" class="dark-blue-color">Our Admin Services</a></h4>
                            <p class="mb-0">Easily and efficiently organise your inquiries with our Allways Legal Admin
                                Services.</p>
                        </div>
                    </div>
                    <hr class="line_hr w-100 full mx-auto">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/lawyer.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Register</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/request.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Submit Request</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="text-center services_card mx-auto">
                        <div class="service_icon mx-auto">
                            <img src="{{ asset ('assets/frontend/media/reply.png')}}" alt="">
                        </div>
                        <hr class="line_hr mx-auto">
                        <div class="text">
                            <h4><a href="#" class="text-primary">Instant Reply</a></h4>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
