@extends('layouts.app')

@section('content')
<style>
    .form-control-item{
        border-radius: 0.3rem;
        border:1px solid;
        border-color:#ebebeb;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="side_bar_img">
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div class="card">
                    <div class="card-header bg-white">
                        <h1 class="dark-blue-color fs-36px">Register your account to continue.</h1>
                        <p>Book a lawyer anytime, from anywhere with your free Allways Legal account, and start getting
                            answers to your legal questions today.</p>
                    </div>

                    <div class="card-body">
                        {{-- <span id="error_msg" class="text-danger"></span> --}}
                        <form method="POST" action="{{ route('register') }}" id="register_form">
                            @csrf

                            <div class="row mb-3">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-12">
                                    <select name="role"
                                        class="required form-control-item form-control-lg @error('role') is-invalid @enderror mb-0"
                                        id="role_select" required>
                                        <option value="">Choose a role</option>
                                        <option value="3">I am a Client</option>
                                        <option value="2">I am a Lawyer</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                        class="required form-control-item @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="required form-control-item @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Email Address">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select name="country"
                                        class="required form-control-item form-control-lg @error('country') is-invalid @enderror mb-0"
                                        id="country" required>
                                        <option value="">Choose Country</option>
                                        @if (count($countries))
                                            @foreach ($countries as $key => $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select id="province" name="province"
                                        class="required form-control-item form-control-lg @error('province') is-invalid @enderror mb-0" required>
                                        <option value="">Choose Province/State</option>
                                    </select>
                                    @error('province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select id="city" name="city"
                                        class="required form-control-item form-control-lg @error('city') is-invalid @enderror mb-0" required>
                                        <option value="">Choose city</option>
                                    </select>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="address" type="text"
                                        class="required form-control-item @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="name" autofocus
                                        placeholder="Address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input id="postal" type="text"
                                        class="required form-control-item @error('postal') is-invalid @enderror" name="postal"
                                        value="{{ old('postal') }}" required autocomplete="name" autofocus
                                        placeholder="Postal code">

                                    @error('postal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 lawyer_div" style="display: none;">
                                <div class="col-md-12 mb-3">
                                    <input id="law_firm_reg_no" type="text"
                                        class="form-control-item role_req @error('law_firm_reg_no') is-invalid @enderror"
                                        name="law_firm_reg_no" value="{{ old('law_firm_reg_no') }}" autofocus
                                        placeholder="License Number">

                                    @error('license_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <input id="enrolment_year" type="number"
                                        class="form-control-item role_req @error('enrolment_year') is-invalid @enderror"
                                        name="enrolment_year" value="{{ old('enrolment_year') }}"  autofocus
                                        placeholder="Year of qualification/enrolment">

                                    @error('enrolment_year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3 ">
                                    <select name="area_id"
                                        class="form-control-item role_req form-control-lg @error('area_id') is-invalid @enderror mb-0">
                                        <option value="">Choose Area</option>
                                        @if (count($areas))
                                            @foreach ($areas as $key => $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('area_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control-item" name="story" id="" rows="4" placeholder="Achievement"></textarea>
                                    @error('story')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="required form-control-item @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> --}}

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="required form-control-item"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="button" class="contact-btn submit_btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-white">
                        <p>Already have an account? <span><a href="{{ route('login') }}" class="login_here">Login
                                    here</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.submit_btn', function(e) {
           
        e.preventDefault();
        var isFormValid = true;
        $('.required').each(function() {
        if ($.trim($(this).val()) == '') {
            isFormValid = false;
            $(this).css('border-color', 'red');
        }
        else {
            $(this).css('border-color', '');
            $("#error_msg").append('');
        }

        });

        // $("#error_msg").append('Please fill out all required fields.');
        // Submit form if all required fields are filled
        console.log(isFormValid);
        if (isFormValid) {
            console.log("here");
            $(this).prop('disabled', true)
            $('#register_form').submit();
        }
    });
        $(document).ready(function() {
            $('#role_select').on('change', function() {
                if (this.value == '2') {
                    $(".lawyer_div").show();
                    $(".role_req").attr("required", true);
                    $(".role_req").addClass("required");
                } else {
                    $(".lawyer_div").hide();
                    $(".role_req").attr("required", false);
                    $(".role_req").removeClass("required");
                }
            });
        });
        $(document).on('change', '#country', function() {

            var country_id = $(this).val();
            console.log(country_id);

            $.ajax({
                url: "{{ route('get_register_data') }}",
                method: "get",
                data: {
                    country_id: country_id
                },
                success: function(data) {
                    $('#province').html('');

                    var html = '<option  value="">Select State/Province</option>';

                    $.each(data, function(k, v) {

                        html += '<option  value="' + v.id + '">' + v.name + '</option>';

                    })

                    html += '</select>'

                    $('#province').html(html);
                }
            })
        })
        $(document).on('change', '#province', function() {

            var state_id = $(this).val();
            console.log(state_id);

            $.ajax({
                url: "{{ route('get_register_data') }}",
                method: "get",
                data: {
                    state_id: state_id
                },
                success: function(data) {
                    $('#city').html('');

                    var html = '<option  value="">Select City</option>';

                    $.each(data, function(k, v) {

                        html += '<option  value="' + v.id + '">' + v.name + '</option>';

                    })

                    html += '</select>'

                    $('#city').html(html);
                }
            })
        })
    </script>
@endsection
