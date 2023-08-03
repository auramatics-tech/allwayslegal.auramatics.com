@extends('layouts.dashboard')
@section('content')
    <div class="py-4 right_width">
        <h4 class="mb-3" style="color:#337ab7">Edit Profile</h4>
        <div class="mb-5" style="background:#fff">

            <form method="POST"
                action="@if (isset($lawyer->id) && !empty($lawyer->id)) {{ route('lawyer.profile.update', isset($lawyer->id) ? $lawyer->id : '') }} @else {{ route('lawyer.profile.store') }} @endif"
                class="profile_form">
                @if (isset($lawyer->id) && !empty($lawyer->id))
                    @method('PATCH')
                @endif
                @csrf
                @if (empty($lawyer->id))
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @endif
                <div class="card-body p-4 default_card">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first-name">First name <span class="text-danger">*<span></label>
                            <input name="first_name" placeholder="First name" type="text"
                                class="form-control form-control-item @error('first_name') is-invalid @enderror"
                                value="{{ isset($lawyer->first_name) ? $lawyer->first_name : old('first_name') }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last-name">Last name <span class="text-danger">*<span></label>
                            <input name="last_name" placeholder="Last name" type="text"
                                class="form-control form-control-item @error('last_name') is-invalid @enderror"
                                value="{{ isset($lawyer->last_name) ? $lawyer->last_name : old('last_name') }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone number <span class="text-danger">*<span></label>
                            <input name="phone" placeholder="Phone number" type="text"
                                class="form-control form-control-item @error('phone') is-invalid @enderror"
                                value="{{ isset($lawyer->phone) ? $lawyer->phone : old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="fieldlabels">Gender/Sex: <span class="text-danger">*<span></label>
                            <select name="gender"
                                class="form-select form-control form-control-item @error('gender')is-invalid @enderror mb-0"
                                style="padding:11px">
                                <option value="">-- Select Gender/Sex--</option>
                                <option value="Male"
                                    {{ isset($lawyer->gender) && $lawyer->gender == 'Male' ? 'selected' : (old('gender') == 'Male' ? 'selected' : '') }}>
                                    Male</option>
                                <option value="Female"
                                    {{ isset($lawyer->gender) && $lawyer->gender == 'Female' ? 'selected' : (old('gender') == 'Female' ? 'selected' : '') }}>
                                    Female</option>
                                <option value="Other"
                                    {{ isset($lawyer->gender) && $lawyer->gender == 'Other' ? 'selected' : (old('gender') == 'Other' ? 'selected' : '') }}>
                                    Other</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="country">Country <span class="text-danger">*<span></label>
                            <select name="country"
                                class="form-select form-control-item form-control @error('country') is-invalid @enderror mb-0"
                                style="padding:11px">
                                <option value="">-- Select Country--</option>
                                @if (count($countries))
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ isset($lawyer->country) && $lawyer->country == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="province">Province <span class="text-danger">*<span></label>
                            <select name="province"
                                class="form-select form-control-item form-control @error('province') is-invalid @enderror mb-0"
                                style="padding:11px">
                                <option value="">-- Select City--</option>
                                @if (count($provinces))
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}"
                                            {{ isset($lawyer->province) && $lawyer->province == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last-name">City <span class="text-danger">*<span></label>
                            <select name="city"
                                class="form-select form-control-item form-control @error('city') is-invalid @enderror mb-0"
                                style="padding:11px">
                                <option value="">-- Select City--</option>
                                @if (count($cities))
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ isset($lawyer->city) && $lawyer->city == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last-name">Address</label>
                            <input name="address" placeholder="Address" type="text"
                                class="form-control form-control-item @error('address') is-invalid @enderror"
                                value="{{ isset($lawyer->address) ? $lawyer->address : old('address') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postal">Postal Code</label>
                            <input name="postal" placeholder="Postal code" type="text"
                                class="form-control form-control-item @error('postal') is-invalid @enderror"
                                value="{{ isset($lawyer->postal) ? $lawyer->postal : old('postal') }}">
                            @error('postal')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="languages">Alternate language</label>
                            <input name="languages" placeholder="Spoken language asides from english" type="text"
                                class="form-control form-control-item @error('languages') is-invalid @enderror"
                                value="{{ isset($lawyer->languages) ? $lawyer->languages : old('languages') }}">
                            @error('languages')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="law-firm-name">Law firm name <span class="text-danger">*<span></label>
                            <input name="law_firm_name" placeholder="Law firm name" type="text"
                                class="form-control form-control-item @error('law_firm_name') is-invalid @enderror"
                                value="{{ isset($lawyer->law_firm_name) ? $lawyer->law_firm_name : old('law_firm_name') }}">
                            @error('law_firm_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="law-firm-reg-no">Law firm reg. no. <span class="text-danger">*<span></label>
                            <input name="law_firm_reg_no" placeholder="Law firm reg. number" type="text"
                                class="form-control form-control-item @error('law_firm_reg_no') is-invalid @enderror"
                                value="{{ isset($lawyer->law_firm_reg_no) ? $lawyer->law_firm_reg_no : old('law_firm_reg_no') }}">
                            @error('law_firm_reg_no')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="law-firm-reg-no">Position</label>
                            <input name="position" placeholder="Position" type="text"
                                class="form-control form-control-item @error('position') is-invalid @enderror"
                                value="{{ isset($lawyer->position) ? $lawyer->position : old('position') }}">
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="law-firm-reg-no">Enrolment year</label>
                            <input name="enrolment_year" placeholder="Year of qualification/enrolment" type="text"
                                class="form-control form-control-item @error('enrolment_year') is-invalid @enderror"
                                value="{{ isset($lawyer->enrolment_year) ? $lawyer->enrolment_year : old('enrolment_year') }}">
                            @error('enrolment_year')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="law-firm-reg-no">Specialized at</label>
                            <input name="specialized_at" placeholder="Ex:Legal, Political" type="text"
                                class="form-control form-control-item @error('specialized_at') is-invalid @enderror"
                                value="{{ isset($lawyer->specialized_at) ? $lawyer->specialized_at : old('specialized_at') }}">
                            @error('specialized_at')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label>Experience/Professional Summary:</label>
                            <textarea name="story" class="form-control form-control-item @error('story') is-invalid @enderror mb-0 pt-2"
                                rows="5" id="experience" title="Experience" style="border-radius:0px!important"
                                placeholder="Share a brief story about your work life and experience... (255 words max)">{{ isset($lawyer->story) ? $lawyer->story : old('story') }}</textarea>
                            @error('experience')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center d-flex justify-content-center gap-3 mt-4">
                        <div class="btn-style"><a href="{{ route('lawyer.profile.index') }}"
                                class="btn-sm  bg-secondary"><i class="fa fa-chevron-left me-2"></i>Back</a>
                        </div>
                        <button type="submit" class="save_btn">Save Changes<i
                                class="fa fa-chevron-right ms-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
