@extends('layouts.dashboard')
@section('content')
    <div class="py-4 right_width">
        @include('lawyer.profile.partial.info_card')
        <div class="default_card shadow-sm mt-lg-4 mt-3">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 col-12 lp_card_1" style="font-size:17px; line-height:21.5px">
                            <p><i class="fa fa-briefcase me-2"></i>
                                <span> Position:</span>
                                {{ isset(Auth::user()->lawyer->position) ? Auth::user()->lawyer->position : '' }}
                            </p>
                            <p><i class="fa fa-building me-2"></i>
                                <span>Law Firm:</span>
                                {{ isset(Auth::user()->lawyer->law_firm_name) ? Auth::user()->lawyer->law_firm_name : '' }}
                            </p>
                            <p><i class="fa fa-map-marker me-2"></i>
                                <span>Location:</span>
                                {{ isset(Auth::user()->lawyer->get_city->name) ? Auth::user()->lawyer->get_city->name : '' }}
                                {{ isset(Auth::user()->lawyer->province) ? Auth::user()->lawyer->province : '' }}
                            </p>
                            <p><i class="fa fa-phone me-2" style="transform: rotate(90deg)"></i>
                                <span>Phone:</span>
                                {{ isset(Auth::user()->lawyer->phone) ? Auth::user()->lawyer->phone : '' }}
                            </p>
                            <p><i class="fa fa-envelope me-2"></i>
                                <span> Email:</span> {{ isset(Auth::user()->email) ? Auth::user()->email : '' }}
                            </p>
                        </div>
                        <div class="col-md-6 col-12 lp_card_2">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Specialized at</h5>
                                    <p>{{ isset(Auth::user()->lawyer->specialized_at) ? Auth::user()->lawyer->specialized_at : '' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Enrolment year</h5>
                                    <p>{{ isset(Auth::user()->lawyer->enrolment_year) ? Auth::user()->lawyer->enrolment_year : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 pb-3 lp_card_3" style="color:#337ab7">
                    <legend>Practice Areas</legend>
                    @if (isset(Auth::user()->lawyer->areas))
                        @foreach (Auth::user()->lawyer->areas as $area)
                            <span
                                class="btn py-2 px-3 border me-md-3 me-1 mb-lg-3 mb-2">{{ isset($area->name) ? $area->name : '' }}</span>
                        @endforeach
                    @endif

                </div>


                <div class="col-12 lp_card_4">
                    <legend>Experience/Professional Summary</legend>
                    <div class="p-3 form-control">
                        <p class="mb-0">{{ isset(Auth::user()->lawyer->story) ? Auth::user()->lawyer->story : '' }}</p>
                    </div>
                </div>

                <div class="col-12 pt-3 lp_card_5">
                    <legend>My Services</legend>
                    @if (isset(Auth::user()->lawyer->services))
                        @foreach (Auth::user()->lawyer->services as $service)
                            <span class="btn btn-sm mt-1 p-2 border" style="background:#F0F8FF; color:#337ab7" disabled>
                                <b>{{ isset($service->title) ? $service->title : '' }}</b>
                            </span>
                        @endforeach
                    @endif
                </div>
                <div class="btn-style py-2"><a href="{{ route('lawyer.dashboard') }}" class="btn-sm ms-auto"><i
                            class="fa fa-chevron-left me-2"></i> Back</a></div>
            </div>
        </div>
    @endsection
