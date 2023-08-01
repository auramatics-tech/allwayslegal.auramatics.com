@extends('layouts.dashboard')
@section('css')
<style>
    .client_service_card {
        min-height: 158px;
    }
</style>
@endsection
@section('content')
<div class="container py-lg-5 py-4 dashboard">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
            @include('client.includes.sidebar')
        </div>
        <div class="col col-xl-9 pb-lg-5 pb-4 right_width">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    @include('client.profile.partial.info_card')
                </div>
                <div class="col-lg-12 mt-lg-0 mt-4">
                    <div class="client_card shadow-sm mb-3">
                        <div class="text">
                            <p class="mb-1">
                                <b>Talk to a lawyer</b>
                            </p>
                            <p class="mb-0">Book an advice session</p>
                        </div>
                        <div class="ms-auto">
                            <div class="btn-style py-2"><a href="{{ route('messages.index') }}" class="btn-sm ms-auto">Chat<i class="fa fa-chevron-right ms-2"></i></a></div>
                        </div>
                    </div>
                    <div class="client_card shadow-sm mb-0">
                        <div class="currency">
                            <b>$100</b>
                        </div>
                        <div class="mx-3 text">
                            <p class="mb-1"><b>Unable to fetch your credits</b></p>
                            <p class="mb-0"> Please check back later</p>
                        </div>
                        <div class="ms-auto">
                            <div class="btn-style py-2"><a href="" class="btn-sm ms-auto">Refer</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4">
                        <h3 class="dark-blue-color heading_after fs-25px">Upcoming </h3>
                        <p class="mb-0">These are your active and upcoming Appointment</p>
                        <div class="card-body px-0 pb-0">
                            @if(count($ongoing_appointments))
                            @foreach($ongoing_appointments as $ongoing_appointment)
                            <div class="d-flex align-items-center law_grow_div border-0">
                                <span class="bullet-vertical me-3"></span>
                                <div class="flex-grow-1">
                                    <a href="{{ route('client.appointment.detail', ['id' => isset($ongoing_appointment->id) ? $ongoing_appointment->id : '']) }}" class="fs-5 lh-sm">#{{ isset($ongoing_appointment->booking_code) ? $ongoing_appointment->booking_code : '' }}</a>
                                    <span class="d-block fs-14px">In {{ isset($ongoing_appointment->days_until_appointment) ? $ongoing_appointment->days_until_appointment : '' }}
                                        @if(isset($ongoing_appointment->days_until_appointment) && $ongoing_appointment->days_until_appointment > 1) Days @else Day @endif</span>
                                </div>

                                <span class="badge badge-light-success fs-8 fw-bolder">
                                    @if (isset($ongoing_appointment->status) && $ongoing_appointment->status == 2)
                                    Request Accepted
                                    @elseif(isset($ongoing_appointment->status) && $ongoing_appointment->status == 3)
                                    Confirmed
                                    @endif
                                </span>
                            </div>
                            @endforeach
                            @else
                            <p class="alert alert-warning mt-4">No upcoming Appointment!</p>
                            @endif

                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4">
                        <div class="d-md-flex">
                            <div>
                                <h3 class="dark-blue-color heading_after fs-25px">Your Lawyers</h3>
                                <p class="mb-0">See your previous lawyers or hire a preious one</p>
                            </div>

                            {{-- <div class="btn-style py-2 ms-auto">
                                    <a href="#" class="btn_outline ms-auto"> <i class="fa fa-plus-circle me-2"></i>Hire a new
                                        lawyer</a>
                                </div>--}}
                        </div>
                        <div class="card-body px-0 pb-0">
                            @if(count($lawyers))
                            @foreach($lawyers as $lawyer)
                            <div class="d-flex align-items-center law_grow_div">
                                <div class="me-3">
                                    <img src="{{ asset('assets/backend/media/avatars/blank.png') }}" class="img-thumbnail" alt="" style="width:60px; height:60px">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="#" class="fs-5 lh-sm">{{isset($lawyer->first_name)? $lawyer->first_name :''}} {{isset($lawyer->last_name)? $lawyer->last_name :''}}</a>
                                    <span class="d-block fs-14px">
                                        @if (isset($lawyer->city) || isset($lawyer->province))
                                        <div class="mb-3"><span class="ms-0"><i class="fa fa-2x fa-map-marker me-2" style="font-size:18px"></i>{{ isset($lawyer->get_city->name) ? $lawyer->get_city->name : '' }},
                                                {{ isset($lawyer->get_province->name) ? $lawyer->get_province->name : '' }}</span></div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        {{-- <p class="alert alert-warning mt-4">You have no previous lawyers available yet</p> --}}

                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="dark-blue-color heading_after fs-25px">More</h3>
                    <p>AllwaysLegal offers upfront fixed prices on popular legal services for businesses.</p>
                </div>
                @if(count($services))
                @foreach($services as $key=>$service)
                <div class="col-md-4 col-12">
                    <div class="client_service_card mb-3">
                        <h6 class="mb-1">{{isset($service->title) ? $service->title : ''}}</h6>
                        <p><b>Price:</b> ${{isset($service->price) ? $service->price : ''}}</p>
                        <p class="mb-0"><a href="#" data-bs-toggle="modal" data-bs-target="#serviceModal_{{$key}}">View
                                Details</a>
                        </p>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="serviceModal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{isset($service->title) ? $service->title : ''}}</h5>
                                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close" style="background:#fff;">
                                    <span aria-hidden="true" style="background:#fff; font-size:25px">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{isset($service->description) ? $service->description : ''}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection