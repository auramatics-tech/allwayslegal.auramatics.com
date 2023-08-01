@extends('frontend.layouts.master')

@section('content')
<div class="section-contact">
    <div class="container main_section">
        <div class="c_txt">
            <h2>Agencies</h2>
            <ul class="ps-0">
                <li><a href="#">Home</a></li>
                <li><span class="textActive">Agencies</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="section-details">
    <div class="row myRow ">
        <div class="col-md-6 text_left">
            <div class="dt_view">
                <div class="heading-txt">
                    <span>MANAGING PARTNER </span>
                    <a href="agency_detail.html" class="h2-h">
                        <h2 class="dark-blue-color fs-36px">Lorem Ipsum</h2>
                    </a>
                    <p>Consequat occaecat ullamco amet non eiusmod nostrud dolore irure incididunt est duis anim
                        sunt
                        officia. Fugiat velit proident aliquip nisi incididunt nostrud exercitation proident est
                        nisi.
                        Irure magna elit commodo anim ex veniam culpa eiusmod id nostrud sit cupidatat in veniam
                        ad.
                        Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis.
                        Occaecat
                        sit
                        eu exercitation irure Lorem incididunt nostrud. </p>
                </div>
                <div class=socials-icon>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg_agency_img" style="background: url('{{ asset("assets/frontend/media/1.jpg")}}');">
        </div>
    </div>
</div>
<div class="section-details">
    <div class="row">
        <div class="col-md-6 bg_agency_img" style="background: url('{{ asset("assets/frontend/media/1.jpg")}}');">
        </div>
        <div class="col-md-6 text_left">
            <div class="dt_view">
                <div class="heading-txt">
                    <span>SENIOR PARTNER</span>
                    <a href="agency_detail.html" class="h2-h">
                        <h2 class="dark-blue-color fs-36px">Lorem Ipsum</h2>
                    </a>
                    <p>Consequat occaecat ullamco amet non eiusmod nostrud dolore irure incididunt est duis anim
                        sunt
                        officia. Fugiat velit proident aliquip nisi incididunt nostrud exercitation proident est
                        nisi.
                        Irure magna elit commodo anim ex veniam culpa eiusmod id nostrud sit cupidatat in veniam
                        ad.
                        Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis.
                        Occaecat
                        sit
                        eu exercitation irure Lorem incididunt nostrud. </p>
                </div>
                <div class=socials-icon>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-details">
    <div class="row myRow">
        <div class="col-md-6 text_left">
            <div class="dt_view">
                <div class="heading-txt">
                    <span>ASSOCIATE</span>
                    <a href="agency_detail.html" class="h2-h">
                        <h2 class="dark-blue-color fs-36px">Lorem Ipsum</h2>
                    </a>
                    <p>Consequat occaecat ullamco amet non eiusmod nostrud dolore irure incididunt est duis anim
                        sunt
                        officia. Fugiat velit proident aliquip nisi incididunt nostrud exercitation proident est
                        nisi.
                        Irure magna elit commodo anim ex veniam culpa eiusmod id nostrud sit cupidatat in veniam
                        ad.
                        Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis.
                        Occaecat
                        sit
                        eu exercitation irure Lorem incididunt nostrud. </p>
                </div>
                <div class=socials-icon>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg_agency_img" style="background: url('{{ asset("assets/frontend/media/1.jpg")}}');">
        </div>
    </div>
</div>
@endsection