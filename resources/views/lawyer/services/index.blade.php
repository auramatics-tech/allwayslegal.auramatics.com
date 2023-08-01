@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('lawyer.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width right_width">
                <div class="row">
                    <div class="col-md-12" style="text-decoration:none">
                    @if(Session::has('success'))
                    <div class="alert alert-success text-center">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <h4 style="color:#337ab7">Services</h4>
                        <div class="btn-style mb-3">
                            <a href="{{ route('lawyer.services.edit', Auth::user()->id) }}"
                                class="btn-sm ms-auto">Update Service <i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                        <div class="row">
                            @if(count(Auth::user()->lawyer->services))
                            @foreach (Auth::user()->lawyer->services as $service)
                                <div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                    <div class="lb_service_card">
                                        <p class="service_title">{{ $service->title }}</p>
                                        <p class="mb-0 price"><small>${{ $service->price }}+tax</small></p>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
