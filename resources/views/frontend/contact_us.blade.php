@extends('frontend.layouts.master')

@section('content')
    <div class="section-contact">
        <div class="container main_section">
            <div class="c_txt">
                <h2>Contact </h2>
                <ul class="ps-0">
                    <li><a href="#">Home</a></li>
                    <li><span class="textActive">Contact</span></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="contacts-page bg-white">
        <div class="container">
            <div class="row flexRevrse">
                <div class="col-lg-5 col-md-12">
                    <div class="contacts-page-items">
                        <h2>Contact Details</h2>
                    </div>
                    <div class="text_page mt-lg-4 mt-3">
                        <h3>Address</h3>
                        <p class="d-flex align-items-start mb-0"><span><i
                                    class="fas fa-location-arrow me-2 text-primary"></i></span><span
                                class="width_ct text-dark">2599
                                Honsberger Ave,
                                Jordan Station, Ontario.
                                L0R 1S0 Canada</span>
                        </p>
                    </div>
                    <div class="text_page">
                        <h3>Phone</h3>
                        <a href="tel:+1 587 5992959"><span><i class="fa fa-phone fa-lg me-2"
                                    style="transform: rotate(100deg);font-size: 15px;"></i></span><span class="text-dark">+1
                                587
                                5992959</span></a>
                    </div>
                    <div class="text_page">
                        <h3>Link</h3>
                        <a href="https://allwayslegal.com/"><span><i class="fas fa-globe me-2"></i></span><span
                                class="text-dark">https://allwayslegal.com/</span></a>
                    </div>
                    <div class="text_page">
                        <h3>Email</h3>
                        <a href="mailto:info@allwayslegal.com"><span><i class="fas fa-envelope me-2"></i></span><span
                                class="text-dark">info@allwayslegal.com</span></a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="contacts-form-heading">
                        <h2>Get in touch!</h2>
                        <p>We'd love to hear from you</p>
                    </div>
                    @if (session()->has('error'))
                        <p class="alert alert-danger">{{ session('error') }}</p>
                    @endif
                    @if (session()->has('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    <div class="contacts-form">
                        <form class="form-group row" action="{{ route('save_contact_us') }}" method="post">
                            @csrf
                            <div class="items-col col-md-6">
                                <input type="text" name="first_name" id="first_name" class="form-control-item"
                                    placeholder="Your first name" required>
                            </div>
                            <div class="items-col col-md-6">
                                <input type="text" name="last_name" id="last_name" class="form-control-item"
                                    placeholder="Your last name" required>
                            </div>
                            <div class="items-col col-md-6">
                                <input type="tel" name="phone" id="phone" class="form-control-item"
                                    placeholder="Your Phone" required>
                            </div>
                            <div class="items-col col-md-6">
                                <input type="email" name="email" id="email" class="form-control-item"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="textarea-item">
                                <textarea class="form-control-textarea" name="message" id="message" placeholder="Write message..." required></textarea>
                            </div>
                            <div class="contact-btn-item">
                                <button type="submit" class="contact-btn">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
