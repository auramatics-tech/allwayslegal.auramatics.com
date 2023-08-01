@extends('layouts.dashboard')
@section('content')
<style>
    .pl_action_drop li a.text-dark:hover {
        text-decoration-thickness: 1px;
    }

    .pl_action_drop li a.text-dark:active {
        color: #337ab7 !important;
    }

    .pl_action_drop li button:hover,
    .pl_action_drop li button:active,
    .pl_action_drop li button {
        border: 0;
        background: transparent;
        padding-right: 1rem !important;
        padding-left: 1rem !important;
        padding-top: 0rem !important;
        padding-bottom: 0rem !important;

    }

    .pl_action_drop li button:hover {
        text-decoration: underline;
        text-decoration-thickness: 1px;
    }
    .appointment_table tbody tr th,
    .appointment_table tbody tr td{
        vertical-align: middle;
    }
</style>
<div class="container">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
            @include('client.includes.sidebar')
        </div>
        <div class="col col-xl-9 py-lg-5 py-4 right_width">
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                {{ Session::get('error') }}
            </div>
            @endif
            <div class="mb-3">
                <h4 class="mb-3" style="color:#337ab7">Appointments</h4>
            </div>
            <div style="width:100%; overflow-x: auto">
                <table class="table table-striped table-bordered text-center appointment_table">
                    <thead style="background:#337ab7; color:#fff">
                        <tr>
                            <th scope="col"> Action</th>
                            <th scope="col" class="mw-150px">Booking ID</th>
                            <th scope="col" class="mw-200px"> Status</th>
                            <th scope="col" class="mw-150px"> Lawyer name</th>
                            <th scope="col" class="mw-150px"> Practice Area</th>
                            <th scope="col" class="mw-150px"> Service</th>
                            <th scope="col" class="mw-150px"> Case Title</th>
                            <th scope="col" class="mw-150px"> Date</th>
                            <th scope="col" class="mw-100px"> Start time</th>
                            <th scope="col" class="mw-100px"> End time</th>
                            <!-- <th scope="col" class="mw-150px"> Created On</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($appointments))
                        @foreach ($appointments as $key => $appointment)
                        {{-- @if (!$appointment->isCancelled()) --}}
                        <tr>
                            <td>
                                <div class="dropdown pl_action_drop">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width:168px">
                                        <li><a href="{{ route('client.appointment.detail', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">View Detail</a></li>

                                        <?php
                                        $DateTime = substr($appointment->date, 0, 10) . ' ' . substr($appointment->start_time, 11);
                                        $appointmentDateTime = strtotime($DateTime);
                                        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
                                        ?>
                                        @if ((isset($appointment->date) || !empty($appointment->date)) && !isset($appointment->refund_id))
                                        @if ($appointmentDateTime > $currentDateTime)
                                        {{--<button type="button" class="btn warningBg whiteColor reschedule"
                                                            data-bs-toggle="modal" data-bs-target="#rescheduleModal"
                                                            data-id="{{ isset($appointment->id) ? $appointment->id : '' }}"
                                        data-lawyer-id="{{ isset($appointment->lawyer_id) ? $appointment->lawyer_id : '' }}"
                                        data-date="{{ isset($appointment->date) ? $appointment->date : '' }}"
                                        data-start="{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i') : '' }}"
                                        data-end="{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i') : '' }}">Reschedule</button>--}}



                                        <li><a href="{{ route('reschedule_time', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">Reschedule</a></li>

                                        @endif
                                        @endif
                                        @if (isset($appointment->status) && ($appointment->status == 2 || (empty($appointment->status) && $appointment->status == 5 )|| (empty($appointment->status) && $appointment->status == 6)))

                                        @if (isset($appointment->date) && !empty($appointment->date) &&  ($appointment->status == 2 || $appointment->status == 5 ))
                                        <li> <a id="hire" href="{{ route('confirmation', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">Continue</a></li>
                                        @else
                                        <li><a id="hire" href="{{ route('schedule_time', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">Hire</a></li>
                                        @endif
                                        @endif
                                        @if ($appointment->isCancelled() && $appointment->status == 5 )
                                        <li><a href="{{ route('confirmation', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">Continue</a></li>
                                        @endif
                                        @if (isset($appointment->status) && ($appointment->status == 3 || $appointment->status == 6) && !empty($appointment->date))
                                        @if (!isset($appointment->refund_id))
                                        <li>
                                            <form action="{{ route('appointment_cancel') }}" method="POST" id="appointment_cancel_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                                <button type="button" class="text-dark px-3 py-2" id="appointment_cancel">
                                                  Cancel
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        @else
                                        <li><a href="{{ route('client.appointment.cancel_request', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="text-dark px-3 py-2">Delete</a></li>
                                        @endif
                                        @if (isset($appointment->status) && $appointment->status == 3)
                                        <li><a href="{{ isset($appointment->join_url) ? $appointment->join_url : '' }}" class="text-dark px-3 py-2" target="_blank">Join</a></li>
                                        @endif
                                    </ul>
                                    {{-- <div style="display: flex;gap:12px; align-items:center;">
                                        <a href="{{ route('client.appointment.detail', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn" style="background:#337ab7;color:#fff"><b><i class="fa fa-eye"></i></b></a>

                                    <?php
                                    $DateTime = substr($appointment->date, 0, 10) . ' ' . substr($appointment->start_time, 11);
                                    $appointmentDateTime = strtotime($DateTime);
                                    $currentDateTime = strtotime(date('Y-m-d H:i:s'));
                                    ?>
                                    @if ((isset($appointment->date) || !empty($appointment->date)) && !isset($appointment->refund_id))
                                    @if ($appointmentDateTime > $currentDateTime)
                                   <button type="button" class="btn warningBg whiteColor reschedule"
                                                                data-bs-toggle="modal" data-bs-target="#rescheduleModal"
                                                                data-id="{{ isset($appointment->id) ? $appointment->id : '' }}"
                                    data-lawyer-id="{{ isset($appointment->lawyer_id) ? $appointment->lawyer_id : '' }}"
                                    data-date="{{ isset($appointment->date) ? $appointment->date : '' }}"
                                    data-start="{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i') : '' }}"
                                    data-end="{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i') : '' }}"><b><i class="fa fa-calendar" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reschedule"></i></b></button>



                                    <a href="{{ route('reschedule_time', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn warningBg" style="color:#fff"><b><i class="fa fa-calendar" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reschedule"></i></b></a>

                                    @endif
                                    @endif
                                    @if (isset($appointment->status) && ($appointment->status == 2 || (empty($appointment->status) && $appointment->status == 5 )|| (empty($appointment->status) && $appointment->status == 6)))

                                    @if (isset($appointment->date) && !empty($appointment->date) && $appointment->status == 5 )
                                    <a id="hire" href="{{ route('confirmation', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn successBg" style="color:#fff"><b>Continue</b></a>
                                    @else
                                    <a id="hire" href="{{ route('schedule_time', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn successBg" style="color:#fff"><b>Hire</b></a>
                                    @endif
                                    @endif
                                    @if ($appointment->isCancelled() && $appointment->status == 5 )
                                    <a href="{{ route('confirmation', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn successBg" style="color:#fff"><b>Continue</b></a>
                                    @endif
                                    @if (isset($appointment->status) && $appointment->status == 3 && !empty($appointment->date))
                                    @if (!isset($appointment->refund_id))
                                    <form action="{{ route('appointment_cancel') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                        <button type="submit" class="btn dangerBg whiteColor">
                                           Cancel
                                        </button>
                                    </form>
                                    @endif
                                    @else
                                    <a href="{{ route('client.appointment.cancel_request', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn dangerBg whiteColor" style="color:#fff;"><b><i class="fa fa-times"></i></b></a>
                                    @endif
                                    @if (isset($appointment->status) && $appointment->status == 3)
                                    <a href="{{ isset($appointment->join_url) ? $appointment->join_url : '' }}" class="btn" style="background:#337ab7;color:#fff" target="_blank"><b>Join</b></a>
                                    @endif
                                </div>--}}
                            </td>
                            <th scope="row">
                                #{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}
                            </th>
                            <td>
                                @if (!$appointment->isCancelled())
                                @if (isset($appointment->status) && $appointment->status == 1)
                                <span class="pl_badge pl_bg_warning">Requested</span>
                                @elseif(isset($appointment->status) && $appointment->status == 2)
                                <span class="pl_badge pl_bg_primary">Request Accepted</span>
                                @elseif(isset($appointment->status) && $appointment->status == 3)
                                <span class="pl_badge pl_bg_success">Confirmed</span>
                                @elseif(isset($appointment->status) && $appointment->status == 4)
                                <span class="pl_badge pl_bg_danger">Cancelled and Refund</span>
                                @elseif(isset($appointment->status) && $appointment->status == 5)
                                <span class="pl_badge @if(!empty($appointment->payment_id)) pl_bg_success @else pl_bg_primary_dark @endif">@if(!empty($appointment->payment_id))Confirmed and @endif Reschedule Requested</span>
                                @else
                                <span class="pl_badge @if(!empty($appointment->payment_id)) pl_bg_success @else pl_bg_primary_dark @endif">@if(!empty($appointment->payment_id))Confirmed and @endif Resheduled</span>
                                @endif
                                @else
                                <span class="pl_badge pl_bg_primary_dark">Reshedule Disapproved</span>
                                @endif
                            </td>
                            <td>{{ isset($appointment->lawyer_id) ? $appointment->lawyer->first_name : '' }}&nbsp;{{ isset($appointment->lawyer_id) ? $appointment->lawyer->last_name : '' }}
                            </td>
                            <td>{{ isset($appointment->area_name) ? $appointment->area_name : '' }}</td>
                            <td>{{ isset($appointment->service_title) ? $appointment->service_title : '' }}
                            </td>
                            <td>{{ isset($appointment->case_title) ? $appointment->case_title : '' }}</td>
                            <td>{{ isset($appointment->date) ? date_format($appointment->date, 'd/m/Y') : '' }}
                            </td>
                            <td>{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i:A') : '' }}
                            </td>
                            <td>{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i:A') : '' }}
                            </td>
                            {{--<td>{{ isset($appointment->created_at) ? date_format($appointment->created_at, 'd/m/Y H:i:s') : '' }}
                            </td> --}}


                        </tr>
                        {{-- @endif --}}
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $appointments->links() }}</div>
        </div>
    </div>
</div>
@include('client.appointments.reschedule_modal')
@endsection
@section('script')
<script>
    $(document).on('click', '.reschedule', function() {

        console.log($(this).data('date'));
        $("#reschedule_form input[name='id']").val($(this).data('id'));
        $("#reschedule_form input[name='lawyer_id']").val($(this).data('lawyer-id'));

        var date = $(this).data('date');
        var formattedDate = date.slice(0, 10);
        $("#reschedule_form input[name='date']").val(formattedDate);

        var StartTime = $(this).data('start');
        var EndTime = $(this).data('end');
        $("#reschedule_form input[name='start_time']").val(StartTime);
        $("#reschedule_form input[name='end_time']").val(EndTime);
    });
    $(document).on('change', '#reschedule_date', function() {
        $("#reschedule_form input[name='start_time']").val('');
        $("#reschedule_form input[name='end_time']").val('');
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

     $(document).on('click', "#appointment_cancel", function() {

        Swal.fire({

            title: 'Are you sure?',

            text: "You won't be able to revert this!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, cancel it!'

        }).then((result) => {

            if (result.isConfirmed) {

                $('#appointment_cancel_form').submit();
                Swal.fire(

                    'Canceled!',

                    'Your Appointment has been canceled.',

                    'success',

                )

            }

        })

    });

    </script>
@endsection