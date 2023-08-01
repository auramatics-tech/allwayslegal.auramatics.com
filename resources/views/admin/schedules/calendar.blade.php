@extends('admin.layouts.master')

@section('css')

<style>
    .my_p_area_list li:last-child span {

        display: none;

    }
</style>

@endsection

@section('content')

<div class="toolbar" id="kt_toolbar">

    <!--begin::Container-->

    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--begin::Page title-->

        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

            <!--begin::Title-->

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Schedule Calendar

                <!--begin::Description-->

                <!-- <small class="text-muted fs-7 fw-bold my-1 ms-1">#XRS-45670</small> -->

                <!--end::Description-->

            </h1>

            <!--end::Title-->

        </div>

        <!--end::Page title-->

    </div>

    <!--end::Container-->

</div>

<div class="post d-flex flex-column-fluid" id="kt_post">

    <!--begin::Container-->

    <div id="kt_content_container" class="container-xxl">

        <!--begin::Card-->

        <div class="card">
            <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b example example-compact">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Booking Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <div id="tblempinfo"></div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var today = new Date().toISOString();
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: [{
                    title: 'My Event',
                    start: '2010-01-01',
                    url: 'https://google.com/'
                }
                // other events here
            ],
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: '' //'timeGridDay,timeGridWeek' //,dayGridMonth
            },
            validRange : function(nowDate) {
                return {start : nowDate}
                // end: "{{date('Y-m-d', strtotime('+1 year'))}}",
            },
            initialView: 'dayGridMonth',
            slotDuration: '00:30',
            allDaySlot: false,
            eventOverlap: false,
            events: HOST_URL + "/schedule-data/" + "{{isset(request()->id) ? request()->id : ''}}",
            displayEventTime: false,
            editable: false,
            eventRender: function(event, element, view) {

                if (event.allDay === 'false') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            initialDate: "{{date('Y-m-d')}}",
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: false,
            eventClick: function(arg) {
                console.log(arg.event.id);
                var bookingid = arg.event.id;
                if (bookingid >= 0) {
                    var url = "{{ route('admin.getBookingDetails',[':bookingid']) }}";
                    url = url.replace(':bookingid', bookingid);
                    $('#tblempinfo').empty();
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {
                            $('#tblempinfo').html(response.html);
                            $('#staticBackdrop').modal('show');
                        }
                    })
                }
            },
            dayMaxEvents: true, // allow "more" link when too many events
        });
        calendar.render();
    });
</script>
@endsection