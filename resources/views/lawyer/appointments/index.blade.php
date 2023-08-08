@extends('layouts.dashboard')
@section('content')
    <style>
        .appointment_table tbody tr:nth-of-type(even) th,
        .appointment_table tbody tr:nth-of-type(even) td {
            background: rgba(255, 255, 255, 0.5) !important;
            box-shadow: inset 0 0 0 9999px rgba(241, 241, 241, 0.5);
        }

        .relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none;
        }

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
        .appointment_table tbody tr td {
            vertical-align: middle;
        }
    </style>

    <div class="py-4 right_width">
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
        <div style="width:100%; overflow-x: auto;height:80vh">
            <table class="table table-striped table-bordered text-center appointment_table">
                <thead style="background:#337ab7; color:#fff">
                    <tr>
                        <th scope="col"> Action</th>
                        <th scope="col" class="mw-150px"> Booking ID</th>
                        <th scope="col" class="mw-200px"> Status</th>
                        <th scope="col" class="mw-150px"> Client name</th>
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
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width:168px">
                                            <li><a href="{{ route('lawyer.appointment.detail', ['id' => isset($appointment->id) ? $appointment->id : '']) }}"
                                                    class="text-dark px-3 py-2">View Detail</a> </li>
                                            <?php
                                            $DateTime = substr($appointment->date, 0, 10) . ' ' . substr($appointment->start_time, 11);
                                            $appointmentDateTime = strtotime($DateTime);
                                            $currentDateTime = strtotime(date('Y-m-d H:i:s'));
                                            ?>
                                            @if ((isset($appointment->date) || !empty($appointment->date)) && !isset($appointment->refund_id))
                                                @if ($appointmentDateTime > $currentDateTime)
                                                    <li><button type="button" class="text-dark px-3 py-2 reschedule"
                                                            data-bs-toggle="modal" data-bs-target="#rescheduleModal"
                                                            data-id="{{ isset($appointment->id) ? $appointment->id : '' }}"
                                                            data-date="{{ isset($appointment->date) ? $appointment->date : '' }}"
                                                            data-start="{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i') : '' }}"
                                                            data-end="{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i') : '' }}">Reschedule</button>
                                                    </li>
                                                @endif
                                            @endif
                                            @if (isset($appointment->status) && $appointment->status == 3)
                                                <li><a href="{{ isset($appointment->start_url) ? $appointment->start_url : '' }}"
                                                        class="text-dark px-3 py-2" target="_blank">Start</a> </li>
                                            @endif
                                            @if (isset($appointment->status) && $appointment->status == 1)
                                                <li>
                                                    @if (!empty($appointment->lawyer->lawyer_fee))
                                                        <form action="{{ route('lawyer.appointment.update_status') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                                            <button type="submit" name="status" value="2"
                                                                class="text-dark px-3 py-2">
                                                                Accept
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('lawyer.get_hourly_rate') }}"
                                                            class="text-dark px-3 py-2" id="set_rate_accept">Accept</a>
                                                    @endif
                                                </li>
                                            @endif
                                            @if (isset($appointment->reshedule_status) && $appointment->reshedule_status == 1 && !$appointment->isCancelled())
                                                <li><button type="button" class="text-dark px-3 py-2 rescheduleBtn"
                                                        data-id="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                                        Reschedule Accept
                                                    </button> </li>
                                            @endif
                                            @if (isset($appointment->status) &&
                                                    ($appointment->status == 3 || $appointment->status == 6) &&
                                                    !empty($appointment->date) &&
                                                    !isset($appointment->refund_id))
                                                <li>
                                                    <form action="{{ route('appointment_cancel') }}" method="POST"
                                                        id="appointment_cancel_form">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                                        <button type="button" class="text-dark px-3 py-2"
                                                            id="appointment_cancel">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                </li>
                                            @else
                                                <li> <a href="{{ route('lawyer.appointment.cancel_request', ['id' => isset($appointment->id) ? $appointment->id : '']) }}"
                                                        class="text-dark px-3 py-2">Delete</a> </li>
                                            @endif
                                            {{--@php
                                                $currentTime = now('UTC');
                                                $slotTime = $appointment->date . ' ' . date('H:i:s', strtotime($appointment->end_time));
                                            @endphp
                                            @if ( $currentTime >= $slotTime && isset($appointment->status) && $appointment->status == 3 && $appointment->client_join ==  1)--}}
                                                <li> <a href="{{ route('lawyer.appointment.send_invoice', ['id' => isset($appointment->id) ? $appointment->id : '']) }}"
                                                        class="text-dark px-3 py-2">Invoice</a> </li>
                                          {{-- @endif--}}
                                        </ul>
                                    </div>
                                    {{-- <div style="display: flex;gap:12px; align-items:center;">
                                    <a href="{{ route('lawyer.appointment.detail', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn" style="background:#337ab7;color:#fff"><b><i class="fa fa-eye"></i></b></a>
                                <?php
                                $DateTime = substr($appointment->date, 0, 10) . ' ' . substr($appointment->start_time, 11);
                                $appointmentDateTime = strtotime($DateTime);
                                $currentDateTime = strtotime(date('Y-m-d H:i:s'));
                                ?>
                                @if ((isset($appointment->date) || !empty($appointment->date)) && !isset($appointment->refund_id))
                                @if ($appointmentDateTime > $currentDateTime)
                                <button type="button" class="btn warningBg whiteColor reschedule" data-bs-toggle="modal" data-bs-target="#rescheduleModal" data-id="{{ isset($appointment->id) ? $appointment->id : '' }}" data-date="{{ isset($appointment->date) ? $appointment->date : '' }}" data-start="{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i') : '' }}" data-end="{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i') : '' }}"><b><i class="fa fa-calendar" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reschedule"></i></b></button>
                                @endif
                                @endif
                                @if (isset($appointment->status) && $appointment->status == 3)
                                <a href="{{ isset($appointment->start_url) ? $appointment->start_url : '' }}" class="btn" style="background:#337ab7;color:#fff" target="_blank"><b>Start</b></a>
                                @endif
                                @if (isset($appointment->status) && $appointment->status == 1)
                                <form action="{{ route('lawyer.appointment.update_status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                    <button type="submit" name="status" value="2" class="btn successBg whiteColor" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reschedule Request Approve">
                                        <b><i class="fa fa-check"></i></b>
                                    </button>
                                </form>
                                @endif
                                @if (isset($appointment->reshedule_status) && $appointment->reshedule_status == 1 && !$appointment->isCancelled())
                                <button type="button" class="btn successBg whiteColor rescheduleBtn" data-id="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                    <b><i class="fa fa-check"></i></b>
                                </button>
                                @endif
                                @if (isset($appointment->status) && $appointment->status == 3 && !empty($appointment->date) && !isset($appointment->refund_id))
                                <form action="{{ route('appointment_cancel') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ isset($appointment->id) ? $appointment->id : '' }}">
                                    <button type="submit" class="btn dangerBg whiteColor">
                                        <b>Cancel</b>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('lawyer.appointment.cancel_request', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn dangerBg whiteColor" style="color:#fff"><b><i class="fa fa-times"></i></b></a>
                                @endif
                                @php
                                $currentTime = now('UTC');
                                $slotTime = $appointment->date . ' ' . date('H:i:s', strtotime($appointment->end_time));
                                @endphp
                                @if ($slotTime && $currentTime >= $slotTime && isset($appointment->status) && $appointment->status == 3)
                                <a href="{{ route('lawyer.appointment.send_invoice', ['id' => isset($appointment->id) ? $appointment->id : '']) }}" class="btn" style="background:#337ab7;color:#fff"><b>Invoice</b></a>
                                @endif
            </div> --}}
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
                                            <span
                                                class="pl_badge @if (!empty($appointment->payment_id)) pl_bg_success @else pl_bg_primary_dark @endif">
                                                @if (!empty($appointment->payment_id))
                                                    Confirm and
                                                @endif Reschedule Requested
                                            </span>
                                        @else
                                            <span
                                                class="pl_badge @if (!empty($appointment->payment_id)) pl_bg_success @else pl_bg_primary_dark @endif">
                                                @if (!empty($appointment->payment_id))
                                                    Confirm and
                                                @endif Resheduled
                                            </span>
                                        @endif
                                    @else
                                        <span class="pl_badge pl_bg_primary_dark">Reshedule Disapproved</span>
                                    @endif
                                </td>
                                <td>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</td>
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
                                {{-- <td>{{ isset($appointment->created_at) ? date_format($appointment->created_at, 'd/m/Y H:i:s') : '' }}
            </td> --}}


                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $appointments->links() }}</div>

        @include('lawyer.appointments.reschedule_modal')
        <!-- The Modal -->
        <div class="modal" id="rescheduleModalClient">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('lawyer.appointment.check') }}" method="POST" id="reschedule_form2">
                        @csrf
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Reschedule appointment
                                request</h4>
                            <button type="button" class="close border-0 fs-4 bg-none"
                                data-bs-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body container p-0 border-0">
                            <div class="row">
                                <input type="hidden" name="date" id="reschedule_date" min="{{ date('Y-m-d') }}"
                                    value="">
                                <input type="hidden" name="start_time" value="">
                                <input type="hidden" name="end_time" value="">
                                <input type="hidden" name="lawyer_id" value="{{ Auth::user()->lawyer->id }}">
                                <input type="hidden" name="id" value="">
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-primary">Accept</button>
                            <button type="button" class="btn btn-danger rejectBtn"
                                data-bs-dismiss="modal">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.reschedule', function() {

            console.log($(this).data('date'));
            $("#reschedule_form input[name='id']").val($(this).data('id'));

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


        $(document).on('click', '.rescheduleBtn', function() {
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('lawyer/get-reschedule-data') }}/" + id,
                method: "get",
                success: function(data) {
                    console.log(data, 'resedule data');
                    $("#reschedule_form2 input[name='date']").val(data.date);
                    $("#reschedule_form2 input[name='start_time']").val(data.start_time);
                    $("#reschedule_form2 input[name='end_time']").val(data.end_time);
                    $("#reschedule_form2 input[name='id']").val(id);
                    $("#reschedule_form2 .rejectBtn").attr('data-id', id);
                    if (data.status == 5 && data.payment_id != null) {
                        $("#reschedule_form2 .rejectBtn").addClass('rejectButton');
                    } else {
                        $("#reschedule_form2 .rejectBtn").addClass('rejectNoPayment');
                    }
                    $('#rescheduleModalClient').modal("show");
                }
            })
        })

        $(document).on('click', '.rejectButton', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('appointment_cancel') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $(".reschedule").addClass('d-none');
                }
            })
        })

        $(document).on('click', '.rejectNoPayment', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('lawyer.reschedule_reject') }}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    id: id
                },
                success: function(data) {
                    $(".reschedule").addClass('d-none');
                }
            })
        })
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
