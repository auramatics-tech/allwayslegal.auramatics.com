@extends('layouts.dashboard')
@section('content')
    <div class="py-4 right_width">
        <h4 class="mb-3" style="color:#337ab7">Edit Profile</h4>
        <div class="mb-5" style="background:#fff">
            <form method="POST" action="{{ route('client.profile.update', isset($client->id) ? $client->id : '') }}"
                class="profile_form">
                @method('PATCH')
                @csrf
                <div class="card-body p-4 default_card">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first-name">First name <span class="text-danger">*<span></label>
                            <input name="first_name" placeholder="First name" type="text"
                                class="form-control form-control-item @error('first_name') is-invalid @enderror"
                                value="{{ isset($client->first_name) ? $client->first_name : old('first_name') }}">
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
                                value="{{ isset($client->last_name) ? $client->last_name : old('last_name') }}">
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
                                value="{{ isset($client->phone) ? $client->phone : old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
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
                                            {{ isset($client->country) && $client->country == $country->id ? 'selected' : '' }}>
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
                                <option value="">-- Select Province--</option>
                                @if (count($provinces))
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}"
                                            {{ isset($client->province) && $client->province == $province->id ? 'selected' : '' }}>
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
                                            {{ isset($client->city) && $client->city == $city->id ? 'selected' : '' }}>
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
                                value="{{ isset($client->address) ? $client->address : old('address') }}">
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
                                value="{{ isset($client->postal) ? $client->postal : old('postal') }}">
                            @error('postal')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="business">Business</label>
                            <input name="business" placeholder="Business" type="text"
                                class="form-control form-control-item @error('business') is-invalid @enderror"
                                value="{{ isset($client->business) ? $client->business : old('business') }}">
                            @error('business')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="position">Position</label>
                            <input name="position" placeholder="Position" type="text"
                                class="form-control form-control-item @error('position') is-invalid @enderror"
                                value="{{ isset($client->position) ? $client->position : old('position') }}">
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="text-center d-flex justify-content-center gap-3 mt-4">
                        <div class="btn-style"><a href="{{ route('client.dashboard') }}" class="btn-sm  bg-secondary"><i
                                    class="fa fa-chevron-left me-2"></i>Back</a>
                        </div>
                        <button type="submit" class="save_btn">Save Changes<i
                                class="fa fa-chevron-right ms-2"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
