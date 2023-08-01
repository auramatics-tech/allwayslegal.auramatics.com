@extends('frontend.layouts.master')

@section('content')
<div class="section-contact">
    <div class="container main_section">
        <div class="c_txt">
            <h2>Find Legal Help</h2>
            <ul class="ps-0">
                <li><a href="#">Home</a></li>
                <li><span class="textActive">Find Legal Help</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="practice-details-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-md-3 mb-0">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="field-section">
                            <div class="field-img">
                                <img src="{{ asset ('assets/frontend/media/2.jpg')}}" alt="" class="w-100">
                            </div>
                            <div class="field-content">
                                <h3><span>25</span>Years of Experience In This Field</h3>
                                <div class="btns">
                                    <div class="btn-style"><a href="#">Contact Us Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="practice-catagory-item">
                            <div class="widget-title">
                                <h3 class="text-left mb-0 fs-36px dark-blue-color">Category</h3>
                            </div>
                            <div class="practice-section">
                                <ul>
                                    <li class="active"><a href="">Family Law</a></li>
                                    <li><a href="">Criminal Law</a></li>
                                    <li><a href="">Business Law</a></li>
                                    <li><a href="">Personal Injury</a></li>
                                    <li><a href="">Education Law</a></li>
                                    <li><a href="">Drugs Crime</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="practice-section-img">
                    <img src="{{ asset ('assets/frontend/media/3.jpg')}}" alt="">
                </div>
                <div class="practice-section-text">
                    <h2 class="fs-36px dark-blue-color">Family Law</h2>
                    <h5>I must explain to you how all this mistaken idea of denouncing pleasure and praising
                        pain was born </h5>
                    <p>I will give you a complete account of the system, and expound the actual teachings of the
                        great explorer of the truth, the master-builder of human happiness. No one rejects,
                        dislikes, or avoids pleasure itself, because it is pleasure, but because those who do
                        not know how to pursue pleasure rationally encounter consequences that are extremely
                        painful. Nor again is there anyone who loves or pursues or desires to obtain pain of
                        itself, </p>
                    <p>because it is pain, but because occasionally circumstances occur in which toil and pain
                        can procure him some great pleasure. To take a trivial example, which of us ever
                        undertakes laborious physical exercise, except to obtain some advantage from it? </p>
                </div>
                <div class="organigation-area row mt-xl-5 mt-4">
                    <div class="col-md-4">
                        <div class="organaigation-img">
                            <img src="{{ asset ('assets/frontend/media/4.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="organigation-text col-md-8">
                        <h2 class="fs-36px dark-blue-color mt-md-0 mt-3">Family Law Organizations</h2>
                        <span class="text-dark"><i class="fas fa-check" aria-hidden="true"></i> <span>
                                master-builder of human happiness.</span></span>
                        <span><i class="fas fa-check" aria-hidden="true"></i> <span> Occasionally circumstances
                                occur in which toil and pain</span></span>
                        <span><i class="fas fa-check" aria-hidden="true"></i> <span> Avoids pleasure itself,
                                because it is pleasure</span></span>
                        <span><i class="fas fa-check" aria-hidden="true"></i> <span> who do not know how to
                                pursue pleasure</span></span>
                        <span><i class="fas fa-check" aria-hidden="true"></i> <span> To take a trivial example,
                                which of us ever undertakes</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection