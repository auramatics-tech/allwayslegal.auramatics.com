@extends('admin.layouts.master')

@section('content')
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-contain bgi-position-bottom bgi-no-repeat"
            style="background-image: url('{{ asset('assets/backend/media/illustrations/sketchy-1/14.png') }}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-4">
                    <a href="{{ route('home') }}">
                        <figure class="mb-0 al-brand">
                            <img src="{{ asset('assets/frontend/media/logo.png') }}" alt="logo" style="width:150px">
                        </figure>
                    </a>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-10">
                        <h3>Sign In To Admin</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li class="mb-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="text"
                                placeholder="Email" name="email" autocomplete="off" required />
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                                placeholder="Password" name="password" required />
                        </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                                <label class="checkbox m-0 text-muted">
                                    <input type="checkbox" name="remember" />
                                    <span></span>Remember me</label>
                            </div>
                            <a href="{{ url('forgot-password') }}" id="kt_login_forgot"
                                class="text-muted text-hover-primary">Forget
                                Password ?</a>
                        </div>
                        <button type="submit" id="kt_login_signin_submit"
                            class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                    </form>
                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
    <!--end::Login-->
@endsection
