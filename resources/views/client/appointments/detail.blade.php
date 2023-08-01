@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('client.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width">
                <div class="mb-3">
                    <h4 class="mb-3" style="color:#337ab7">Appointment Detail</h4>
                </div>
                <div style="width:100%; height:100%; overflow-x: auto">
                    <table class="table table-striped table-bordered text-left">
                        <thead style="background:#337ab7; color:#fff">
                            <tr>
                                <th width="10%" class="text-center">Sn.</th>
                                <th width="30%">Title</th>
                                <th width="60%">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                                <th class="text-center">1</th>
                                <th scope="col">Booking ID</th>
                                <td>{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <th scope="col"> Client name</th>
                                <td>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <th scope="col"> Practice Area</th>
                                <td>{{ isset($appointment->area_name) ? $appointment->area_name : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">4</th>
                                <th scope="col"> Service</th>
                                <td>{{ isset($appointment->service_title) ? $appointment->service_title : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">5</th>
                                <th scope="col"> Date</th>
                                <td>{{ isset($appointment->date) ? date_format($appointment->date, 'd/m/Y') : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">6</th>
                                <th scope="col"> Start time</th>
                                <td>{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i:s') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">7</th>
                                <th scope="col"> End time</th>
                                <td>{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i:s') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">8</th>
                                <th scope="col"> Case Title</th>
                                <td>{{ isset($appointment->case_title) ? $appointment->case_title : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">9</th>
                                <th scope="col"> Case Note</th>
                                <td>{{ isset($appointment->case_note) ? $appointment->case_note : '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">10</th>
                                <th scope="col"> Case File</th>
                                <td>
                                    <div>
                                        <a href="{{ asset(isset($appointment->case_file) ? $appointment->case_file : '') }}" target="_blank" rel="noopener noreferrer">view</a>
                                  
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">11</th>
                                <th scope="col"> Created On</th>
                                <td>{{ isset($appointment->created_at) ? date_format($appointment->created_at, 'd/m/Y H:i:s') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center">12</th>
                                <th scope="col"> Status</th>
                                <td>
                                    @if (isset($appointment->status) && $appointment->status == 1)
                                        <span class="pl_badge pl_bg_warning">Requested</span>
                                    @elseif(isset($appointment->status) && $appointment->status == 2)
                                        <span class="pl_badge pl_bg_primary">Request Accepted</span>
                                    @else
                                        <span class="pl_badge pl_bg_success">Confirmed</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if (isset($appointment->status) && $appointment->status == 3)
                    <div class="mb-3 mt-4">
                        <h4 class="mb-3" style="color:#337ab7">Payment Detail</h4>
                    </div>
          
                    <table class="table table-striped table-bordered text-left">
                        <tbody>
                            <tr>
                                <th class="text-center" width="10%">1</th>
                                <th scope="col" width="30%">Service amount</th>
                                <td width="60%">${{ isset($appointment->service_price) ? $appointment->service_price : '0' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <th scope="col">Lawyer fee</th>
                                <td>${{ isset($appointment->lawyer_fee) ? $appointment->lawyer_fee : '0' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <th scope="col">Lawyer fee tax</th>
                                <td>${{ isset($appointment->lawyer_fee_tax) ? $appointment->lawyer_fee_tax : '0' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center"></th>
                                <th scope="col">Total</th>
                                @php
                                if(!empty($appointment))
                                    $total = $appointment->service_price + $appointment->lawyer_fee + $appointment->lawyer_fee_tax ;
                                else 
                                $total = 0;
                                
                                @endphp
                                <td>${{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <div class="mt-3 d-grid gap-1 d-flex justify-content-md-end">
                        <div class="btn-style py-2"><a href="{{route('client.appointment.index')}}" class="btn-sm ms-auto py-1 px-3" id="next_legal"><i class="fa fa-chevron-left me-2"></i>Back</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
