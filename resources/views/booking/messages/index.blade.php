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
            <h4 class="mb-3" style="color:#337ab7">Messages</h4>
        </div>
        <div style="width:100%; overflow-x: auto">
            <table class="table table-striped table-bordered text-center appointment_table">
                <thead style="background:#337ab7; color:#fff">
                    <tr>
                        <th scope="col" class="mw-150px"> Booking ID</th>
                        @if (Auth::user()->client)
                            <th scope="col" class="mw-150px"> Lawyer name</th>
                        @else
                            <th scope="col" class="mw-150px"> Client name</th>
                        @endif
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($appointments))
                        @foreach ($appointments as $key => $appointment)
                            {{-- @if (!$appointment->isCancelled()) --}}
                            <tr>
                                <th scope="row">
                                    #{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}
                                </th>
                                @if (Auth::user()->client)
                                    <td>{{ isset($appointment->lawyer_name) ? $appointment->lawyer_name : '' }}</td>
                                @else
                                    <td>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</td>
                                @endif
                                <td>
                                    <div style="display: flex;gap:12px; align-items:center; justify-content:center">

                                        <a href="{{ route('chat', $appointment->id) }}" class="btn"
                                            style="background:#337ab7;color:#fff"><b><i class="fa fa-reply"></i></b></a>
                                        @php$messageCount = getMessageCount($appointment->id);
                                            
                                        @endphp
                                        @if (!empty($messageCount))
                                            <span class="badge rounded-pill bg-warning ms-1">
                                                {{ $messageCount }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $appointments->links() }}</div>
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
@endsection
