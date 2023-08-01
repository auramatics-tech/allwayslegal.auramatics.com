<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <div class="widget">
                    <a href="{{route('home')}}" class="navbar-brand"><img alt="" class="img-fluid"
                            src="{{asset('assets/frontend/media/logo.png')}}" style="width:75px; height: 70px;">
                        <span>Allways
                            Legal</span></a>
                    <address class="s1 d-flex flex-column mt-4">
                        <span><i class="id-color fa fa-map-marker fa-lg"></i>08 W 36th St, New York, NY
                            10001</span>
                        <span><i class="id-color fa fa-phone fa-lg"
                                style="transform: rotate(100deg); font-size: 18px;"></i>+1 333 9296</span>
                        <span><i class="id-color fas fa-envelope"></i><a
                                href="mailto:contact@Faq.com">contact@Faq.com</a></span>
                        <span><i class="id-color fas fa-file"></i><a href="#">Download Brochure</a></span>
                    </address>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <h4 class="id-color mb20">Menu</h4>
                <ul class="ul-style-2">
                    <li><a href="{{route('home')}}" class="text-white"><i class="fas fa-check me-3"></i>Home </a></li>
                    <li><a href="{{route('services')}}" class="text-white"><i class="fas fa-check me-3"></i>Services</a></li>
                    <li><a href="{{route('agency')}}" class="text-white"><i class="fas fa-check me-3"></i>Agency</a></li>
                    <li><a href="{{route('term_of_use')}}" class="text-white"><i class="fas fa-check me-3"></i>Terms of use</a></li>
                    <li><a href="{{route('privacy_policy')}}" class="text-white"><i class="fas fa-check me-3"></i>Privacy policy</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4 class="id-color">Newsletter</h4>
                <p>Signup for our newsletter to get the latest news, updates and special offers in your inbox.
                </p>
                <form action="{{ route('admin.subscribe_us') }}" class="row" id="form_subscribe" method="post" name="form_subscribe">
                    <div class="col text-center">
                        @csrf
                        <input class="form-control" id="subscribers" name="subscribers" placeholder="enter your email" type="text" required> <a href="javascript:" onclick="$('#form_subscribe').submit();" id="btn-submit"><i class="fas fa-arrow-right"></i></a>
                        <div class="clearfix"></div>
                    </div>
                </form>
                <div class="spacer-10"></div>
                <span class="invalid-feedback" role="alert" style="display:block;">
                    <strong id="error_first_name">{{ $errors->first('subscribers') }}</strong>
                </span>
                <small>Your email is safe with us. We don't spam.</small>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="de-flex row">
                <div class="de-flex-col-XS col-md-6 text-sm-center text-md-start text-lg-start mb-md-0 mb-3">
                    © Copyright 2023 - Allways Legal Services
                </div>
                <div class="de-flex-col col-md-6">
                    <span class="social-icons d-flex gap-4 justify-content-md-end justify-content-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>