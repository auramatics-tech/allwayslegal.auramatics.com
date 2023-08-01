@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col py-lg-5 py-4 right_width right_width">
                <div class="row">
                    <div class="col-12 left-section">
                        <div class="row text-center">
                            <div class="col-12">
                                <div class="card default_card">
                                    <div class="card-body">
                                        <h2 class="fs-36px dark-blue-color">Let's get to know you!</h2>
                                        <p style="color:#333; font-size:20px">
                                            <b><small>Why do we need this information?</small></b>
                                        </p>

                                        <p class="mb-0">In order for a client to work with a client, this
                                            information is
                                            legally required in Canada.
                                        </p>

                                        <p class="mb-0">We can also use this information to serve you better and
                                            recommend more suitable
                                            clients. AllwaysLegal does not sell you personal information for
                                            any reason.
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 right-section mt-3">
                        <form method="POST" action="{{ route('lawyer.profile.store') }}" class="profile_form default_card">
                            @csrf
                            <div class="card-body pt-2">
                                <h5 class="dark-blue-color">Personal info</h5>
                                <p style="color:#333">You are currently signing up as a Lawyer.
                                    If you want to sign up to be a lawyer on the platform,
                                    <a href="#">click here</a>. This information will show who the
                                    account belongs to.
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <div class="col-md-6 mb-3">
                                        <label for="first-name">First name <span class="text-danger">*</span></label>
                                        <input name="first_name" placeholder="First name" type="text"
                                        class="form-control form-control-item @error('first_name') is-invalid @enderror"
                                            value="{{ old('first_name') }} @isset($lawyer) {{ $lawyer->first_name }} @endisset" >
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last-name">Last name <span class="text-danger">*</span></label>
                                        <input name="last_name" placeholder="Last name" type="text"
                                        class="form-control form-control-item @error('last_name') is-invalid @enderror"
                                            value="{{ old('last_name') }} @isset($lawyer) {{ $lawyer->last_name }} @endisset" >
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone">Phone number <span class="text-danger">*</span></label>
                                        <input name="phone" placeholder="Phone number" type="number"
                                            class="form-control form-control-item @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }} @isset($lawyer) {{ $lawyer->phone }} @endisset">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label class="fieldlabels">Gender/Sex: <span class="text-danger">*</span></label>
                                        <select name="gender"  class="form-select form-control form-control-item @error('gender') is-invalid @enderror mb-0">
                                            <option value="">--Select Gender--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="female">Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="country">Country <span class="text-danger">*</span></label>
                                        <select name="country"
                                            class="form-select form-control form-control-item @error('country')  is-invalid @enderror mb-0">
                                            <option value="">--Select Country--</option>
                                            <option value="Canada">Canada</option>
                                            <option value="United-States">United States</option>
                                            <option value="United-kingdom">United Kingdom</option>
                                            <option value="Nigeria">Nigeria</option>
                                        </select>
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="last-name">Address </label>
                                        <input name="address" placeholder="Address" type="text"
                                            class="form-control form-control-item @error('address') is-invalid @enderror"
                                            value="{{ old('address') }} @isset($lawyer) {{ $lawyer->last_name }} @endisset">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="last-name">City </label>
                                        <input name="city" placeholder="City" type="text"
                                            class="form-control form-control-item @error('city') is-invalid @enderror"
                                            value="{{ old('city') }} @isset($lawyer) {{ $lawyer->last_name }} @endisset">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="province">Province</label>
                                        <input name="province" placeholder="Province" type="text"
                                           class="form-control form-control-item @error('province') is-invalid @enderror"
                                            value="{{ old('province') }} @isset($lawyer) {{ $lawyer->province }} @endisset">
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="postal">Postal code</label>
                                        <input name="postal" placeholder="Postal code" type="text"
                                        class="form-control form-control-item  @error('postal') is-invalid @enderror"
                                            value="{{ old('postal') }} @isset($lawyer) {{ $lawyer->postal }} @endisset">
                                        @error('postal')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="languages">Alternate language</label>
                                        <input name="languages" placeholder="Spoken language asides from english"
                                            type="text" class="form-control form-control-item @error('languages') is-invalid @enderror"
                                            value="{{ old('languages') }} @isset($lawyer) {{ $lawyer->language }} @endisset">
                                        @error('spoken_language')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="law-firm-name">Law firm name <span
                                                class="text-danger">*</span></label>
                                        <input name="law_firm_name" placeholder="Law firm name" type="text"
                                        class="form-control form-control-item @error('law_firm_name') is-invalid @enderror"
                                            value="{{ old('law_firm_name') }} @isset($lawyer) {{ $lawyer->law_firm_name }} @endisset">
                                        @error('law_firm_name')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="law-firm-reg-no">Law firm reg. no. <span
                                                class="text-danger">*</span></label>
                                        <input name="law_firm_reg_no" placeholder="Law firm reg. number" type="text"
                                        class="form-control form-control-item  @error('last_name') is-invalid @enderror"
                                            value="{{ old('law_firm_reg_no') }} @isset($lawyer) {{ $lawyer->law_firm_reg_no }} @endisset">
                                        @error('law_firm_reg_no')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <legend><small>Select your areas of practice:</small></legend>
                                    <div class="row">
                                        @foreach ($areas as $area)
                                            <div class="col-sm-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="areas[]"
                                                            value="{{ $area->id }}">
                                                        {{ $area->name }}
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12">
                                            <legend><small>Experience/Professional Summary: <span
                                                        class="text-danger">*</span></small>
                                            </legend>
                                            <textarea name="story" class="form-control form-control-item @error('story') is-invalid @enderror mb-0 pt-3" rows="5"
                                                id="Experience" title="Experience" style="border-radius:0px!important"
                                                placeholder="Share a brief story about your work life and experience... (250 words max)"></textarea>
                                            @error('story')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-start mt-5 pt-3">
                                    <p>
                                         By continuing, you accept the AllwaysLegal <a href="http://"> Terms of Use</a> and <a href="http://">Privacy Policy.</a>
                                    </p>
                                    <div class="text-center d-flex justify-content-center gap-3 mt-4">
                                        <div class="btn-style"><a href="{{ route('lawyer.profile.create') }}" class="btn-sm  bg-secondary">Reset</a>
                                        </div>
                                        <button type="submit" class="save_btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
