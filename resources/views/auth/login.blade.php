@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="side_bar_img">
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="card">
                    <div class="card-header bg-white">
                        <h1 class="dark-blue-color fs-36px">Login to your account to continue.</h1>
                        <p>Book a lawyer anytime, from anywhere with your free Allways-Legal account, and start getting answers to your legal questions today.</p>
                    </div>
                    <div class="card-body">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="row mb-3">
                                {{-- <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control-item @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control-item @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label font_mobile" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-7 text-end">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link p-0 font_mobile" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit"  class="contact-btn">
                                        {{ __('Login') }}
                                    </button>

                                   
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <p>Don't have an account? <span><a href="{{route('register')}}" class="login_here">Sign-up here</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
