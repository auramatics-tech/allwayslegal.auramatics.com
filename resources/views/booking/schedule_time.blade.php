@extends('layouts.dashboard')
@section('css')
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
    <link rel='stylesheet' href='{{ asset('assets/frontend/css/calender.css') }}' />
    <style>
        .a_active {
            color: #ffffff !important;
            background: #a94442 !important;
            border-radius: 4px !important;
            padding: 5px 10px !important;
        }

        .v_active {
            color: #ffffff !important;
            background: #0EBB33 !important;
            border-radius: 4px !important;
            padding: 5px 10px !important;
        }

        .disabled-date {
            pointer-events: none;
        }

        .disabled-date a {
            color: #ddd !important;

        }

        .disabled-date.now {
            color: #fff !important;

        }

        .disabled-date.now a {
            pointer-events: all;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('booking.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width">
                <div class="col-12">
                    <p><em>Select a convinient date and time to communicate with your lawyer</em></p>
                </div>
                <div class="card">
                    <div class="row lawyer">
                        <div class="col-12 mb-3">
                            @include('booking.includes.info_card')
                        </div>
                        <div class="pt-4 mb-3" style="line-height:1px">
                            <p class="mb-0">Schedule your call</p>
                        </div>
                        <div class="col-12">
                            <div class="md_data">
                                <div id="calendar-container"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sd_card">
                                <div class="card-header p-3" style="background:ghostwhite">
                                    <small>{{ date('Y') }}</small><br>
                                    <p><b class="date_of_day">{{ date('d M Y') }}</b></p>
                                </div>
                                <div class="slot_data">
                                    <div class="p-4 morning" style="cursor:pointer">
                                       
                                            <div class="pb-2" style="color:#337ab7 ">Select Slot :</div>
                                            <div class="label_radio row row-cols-2 row-cols-lg-5 g-2 g-lg-3 text-center">
                                                @if (count($slots))
                                                @foreach ($slots as $key => $slot)
                                                    <div class="col-sm-3 col-4">
                                                        <label for="time_slot"
                                                            class="time_slots {{ isset($slot['active']) && $slot['active'] == 1 ? 'active' : '' }}"
                                                            data-date="{{ isset($slot['date']) ? $slot['date'] : '' }}"
                                                            data-start_time="{{ isset($slot['start_time']) ? $slot['start_time'] : '' }}"
                                                            data-end_time="{{ isset($slot['end_time']) ? $slot['end_time'] : '' }}"
                                                            style="border: 1px solid #ddd; background: ghostwhite; color: #666;">
                                                            {{ isset($slot['start_time']) ? $slot['start_time'] : '' }} -
                                                            {{ isset($slot['end_time']) ? $slot['end_time'] : '' }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                @else
                                                <div class="col-12">No slots available</div>
                                            @endif
                                            </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-grid gap-1 d-flex justify-content-md-end">
                    <div class="btn-style py-2"><a href="{{ route('client.appointment.index') }}" class="btn-sm ms-auto"><i
                                class="fa fa-chevron-left me-2"></i> Back</a></div>
                </div>
            </div>
        </div>
    </div>
    <form action="@if(isset($appointment->status) && $appointment->status == 3){{ route('reschedule_slots') }} @else {{route('save_slots')}} @endif" method="post" id="save_slots">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ request()->get('id') }}">
        <input type="hidden" name="date" id="ap_date">
        <input type="hidden" name="start_time" id="ap_start_time">
        <input type="hidden" name="end_time" id="ap_end_time">
    </form>

@endsection
@section('script')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='{{ asset('assets/frontend/js/calendar.js') }}'></script>
    <script>
        $(document).ready(function() {
            $('.step_complete').removeClass('d-none');
            $("#calendar-container").calendarJs({
                lang: "en",
                withArrows: true
            });
        });

        $(document).ready(function() {
            // Iterate through each date cell and disable past dates
            setTimeout(() => {
                DisableBeforeDates();
            }, 1000);

            var availableDates = @json($availableDates);
            // console.log(availableDates);
            availableDates.forEach(function(date) {

                var dateString = date;
                var dateObj = new Date(dateString);

                var day = String(dateObj.getDate()).padStart(2, '0');
                var monthIndex = dateObj.getMonth();
                var year = dateObj.getFullYear();

                var monthNames = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ];
                var formattedDate = day + ' ' + monthNames[monthIndex] + ' ' + year;
                setTimeout(() => {
                    // console.log($("table tbody tr td a[title='" + formattedDate + "']").html())
                    $("table tbody tr td a[title='" + formattedDate + "']").addClass('a_active')
                }, 1000);
            });
        });
        $(document).on('click', '.prev-month,.next-month', function() {
            DisableBeforeDates();
        });

        function DisableBeforeDates() {
            var currentDate = new Date();
            $('.date_td').each(function() {

                var dateText = $(this).find('a').attr('title');
                var date = new Date(dateText);

                // Compare the dates and disable past dates
                if (date < currentDate) {
                    $(this).addClass('disabled-date');
                    $(this).find('a').removeAttr(
                        'href'); // Optionally remove the link if present
                }
            });
        }

        $(document).on('click', '.date_td', function() {
            $('.date_td').children().removeClass('v_active');
            $(this).children().addClass('v_active');
            var date_d = $(this).children().attr('title');
            var lawyer_id = $('#lawyer_id').attr('data-id');
            $(".date_of_day").html(date_d);

            var urlParams = new URLSearchParams(window.location.search);

            var step = urlParams.get('step');

            $.ajax({
                type: 'POST',
                url: "{{ route('get_slots') }}",
                data: {
                    "date_d": date_d,
                    'lawyer_id': lawyer_id,
                    "_token": "{{ csrf_token() }}",
                    "step": step
                },
                success: function(data) {
                    $('.label_radio').html('');
                    var html = '';
                    if (data.length > 0) {
                        console.log(data);
                        $.each(data, function(k, v) {
                            if (v.active == 1) {
                                var activeCls = "active";
                            }

                            html +=
                                '<div class="col-sm-3 col-4">\n\
                                <label for="time_slot" class="time_slots' + ' ' +
                                activeCls +
                                '" data-date="' + v.datet +
                                '" data-start_time="' + v.start_timet +
                                '" data-end_time="' + v.end_timet +
                                '"style=" border:1px solid #ddd; background:ghostwhite;color:#666;">' +
                                v.start_timet + ' - ' + v.end_timet + '</label>\n\
                                </div>';
                        })
                    } else {
                        html = '<div class="col-12">No slots available</div>';
                    }
                    $('.label_radio').html(html);
                }
            });
        })
        $(document).on('click', '.time_slots', function() {
            $('.time_slots').removeClass('active');
            $(this).addClass('active');
            $('#ap_date').val($(this).attr('data-date'));
            $('#ap_start_time').val($(this).attr('data-start_time'));
            $('#ap_end_time').val($(this).attr('data-end_time'));

            // Submit the form
            $('#save_slots').submit();

        })
    </script>
@endsection
