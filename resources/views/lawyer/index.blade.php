@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('lawyer.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width right_width">
                @if(empty($lawyerFee))
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-info-circle me-2" style="font-size:18px"></i>Your profile will not be published until you set your hourly rate!
                  </div>
                @endif
                @include('lawyer.profile.partial.info_card')
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/user-group-man-woman.png')}}"
                                    alt="clients" style="width:50px">
                                <h3>{{(isset($client_count) ? $client_count: '0')}}</h3>
                                <p>Clients</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/briefcase.png')}}" alt="reviews"
                                    style="width:50px">
                                <h3>{{(isset($service_count) ? $service_count: '0')}}</h3>
                                <p>Services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/parallel-tasks.png')}}"
                                    alt="practice-areas" style="width:50px">
                                <h3>{{(isset($area_count) ? $area_count: '0')}}</h3>
                                <p>Practice Areas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/overtime.png')}}" alt="appointments"
                                    style="width:50px">
                                <h3>{{(isset($client_count) ? $client_count: '0')}}</h3>
                                <p>Appointments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/card-in-use.png')}}" alt="payments"
                                    style="width:50px">
                                <h3>${{(isset($total_payment) ? $total_payment: '0')}}</h3>
                                <p>Payments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/handshake.png')}}" alt="reviews"
                                    style="width:50px">
                                <h3>1,200</h3>
                                <p>Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/filled-message.png')}}" alt="messages"
                                    style="width:50px">
                                <h3>47</h3>
                                <p>Messages</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="ld_card">
                            <div class="card-body">
                                <img src="{{asset('assets/frontend/media/lawyer/opened-folder.png')}}" alt="files"
                                    style="width:50px">
                                <h3>154</h3>
                                <p>Files</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endsection
