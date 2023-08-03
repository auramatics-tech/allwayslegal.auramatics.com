@extends('layouts.app')

@section('content')
    <style>
        .dar_text_span{
            color: #337ab7;
            font-weight: 400;
        }
        table tr td{
            text-align: left
        }
    </style>

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 430px">
        <div class="w-75 py-4" style="border:1px solid #337ab7">
            <div class="row">
                <div class="col-md-12">
                    <div class="box_info h-100 text-center align-items-center">
                     <h2 class="text-center fs-36px dark-blue-color"> Appointment Confirmed</h2>
                        <p><span class="dar_text_span">{{isset($appointment->client_name)?$appointment->client_name :''}}</span> thanks for your booking!!<br>
                            You are currently booked with <span class="dar_text_span">{{isset($appointment->lawyer_name)?$appointment->lawyer_name :''}} </span><br>
                            Service: <span class="dar_text_span">{{isset($appointment->service_title)?$appointment->service_title :''}}</span><br>
                            An email confirmation has been sent to the email address below:<br>
                            <span class="dar_text_span">{{isset($appointment->client_email)?$appointment->client_email :''}}</span><br>
                        </p>
                        <table class="mx-auto">
                            <tr>
                                <td> <p class="mb-0">Your booking date and time : </p></td>
                                <td>
                                    <span class="dar_text_span">{{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }} {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }} </span>
                                </td>
                            </tr>
                            <tr>
                                <td> <p class="mb-0">Appointment URL : </p></td>
                                <td>
                                    <span class="dar_text_span"><a href="{{ route('client.appointment.detail', ['id' => isset(request()->id) ? request()->id : '']) }}" style="text-decoration:underline;">Show</a></span>
                                </td>
                            </tr>
                            <tr>
                                <td> <p class="mb-0">Massage URL  : </p></td>
                                <td>
                                    <span class="dar_text_span"><a href="{{ route('dashboard.messages.index')}}" style="text-decoration:underline;">Link</a></span>
                                </td>
                            </tr>
                            <tr>
                                <td> <p class="mb-0">Meeting zoom URL  : </p></td>
                                <td>
                                    <span class="dar_text_span"><a href="{{isset($appointment->join_url)?$appointment->join_url :''}}"  target="_blank" style="text-decoration:underline;">Link</a></span>
                                </td>
                            </tr>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

