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
                        <h4 class="mb-3" style="color:#337ab7">Services</h4>
                        <form method="POST" action="{{ route('lawyer.services.update', isset($lawyer->id)?$lawyer->id:'') }}">
                             @method('PATCH')
                            @csrf
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-sm-6 col-md-6 col-lg-4 text-center">
                                        <div class="lb_service_card">
                                            <label>
                                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                                    @isset($lawyer) 
                            @if (in_array($service->id, $lawyer->services->pluck('id')->toArray())) 
                            checked @endif @endisset">
                                                <p class="service_title" style="cursor:pointer">{{ $service->title }}
                                                </p>
                                                <p class="mb-0 price"><small>${{ $service->price }}+tax</small></p>
                                                @error('service')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center d-flex justify-content-sm-end justify-content-center gap-3">
                                <div class="btn-style"><a href="{{ route('lawyer.services.index', Auth::user()->id) }}"
                                        class="btn-sm  bg-secondary"><i class="fa fa-chevron-left me-2"></i>Go Back</a>
                                </div>
                                <button type="submit" class="save_btn">Save Changes<i class="fa fa-chevron-right ms-2"></i></button>
                            </div>
                        </form>

                        <style type="text/css">
                            input[type="checkbox"] {
                                zoom: 1.4;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
