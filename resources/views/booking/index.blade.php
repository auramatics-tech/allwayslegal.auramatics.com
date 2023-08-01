@extends('layouts.dashboard')

@section('content')
<style>
    .submit_next_btn:disabled {
        opacity: 0.5;
}
</style>
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
                @include('booking.includes.sidebar')
            </div>
            <div class="col py-lg-5 py-4 right_width">
                <form class="col-md-12 right-section p-3" action="{{ route('save_booking_data') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="case_summary">
                        @include('booking.includes.case_summary')
                    </div>
                    <div class="d-none" id="legal_needs">
                        @include('booking.includes.legal_need')
                        <span class="text-danger errorMsg"></span>
                        <div class="mt-3 d-grid gap-1 d-flex justify-content-md-end">
                            <div class="btn-style py-2"><button type="Submit" class="btn-sm ms-auto py-1 px-3 submit_next_btn">Next<i
                                        class="fa fa-chevron-right ms-2"></i></button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="detail_modal"></div>
    </div>
@endsection
@section('script')
    <script>
        $(document).on('click', '#next_legal', function(e) {
            e.preventDefault();
            var isFormValid = true;
            $('.required').each(function() {
                if ($.trim($(this).val()) == '') {
                    isFormValid = false;
                    $(this).css('border-color', 'red');
                } else {
                    $(this).css('border-color', '');
                    $("#error_msg").append('');
                }

            });
            if (isFormValid) {
                $(this).prop('disabled', true)
                $('#case_summary').addClass('d-none');
                $('#legal_needs').removeClass('d-none');
                $('.booking_ul> li> a.active').removeClass('active');
                $('.legal_need_anchor').addClass('active');
                $('.case_anchor').addClass("disable-click");
                $('.submit_next_btn').prop('disabled', true);
                $('.case_anchor .step_complete').removeClass('d-none');
            }
        })
        $(document).on('click', 'input.check_btn_enable', function() {
            if($(this).prop('checked')){
                    $('.submit_next_btn').prop('disabled', false)
                }else{
                    $('.submit_next_btn').prop('disabled', true)
                }
        });
        $(document).on('change', '#area_select', function() {

            var area_id = $(this).val();
            var areaName =  $(this).find('option[value="' + area_id + '"]').attr('data-name');
            $.ajax({
                url: "{{ route('get_services') }}",
                method: "get",
                data: {
                    area_id: area_id
                },
                success: function(data) {
                    $('#area_name').val(areaName);
                    $('#services_select').html('');

                    var html = '<option  value="">Select Services</option>';

                    $.each(data, function(k, v) {

                        html += '<option  value="' + v.id + '"  data-title="' + v.title + '">' + v.title + '</option>';

                    })

                    html += '</select>'

                    $('#services_select').html(html);
                }
            })
        })
        $(document).on('click', '#services_select', function() {
            var selectedValue = $(this).val();
            var serviceTitle = $(this).find('option[value="' + selectedValue + '"]').attr('data-title');

            $.ajax({
                url: "{{ route('choose_lawyer') }}",
                method: "get",
                data: {
                    id: $(this).val(),
                },
                success: function(data) {
                    $('#lawyer_div').html(data);
                    $('.booking_ul> li> a.active').removeClass('active');
                    $('.choose_lawyer').addClass('active');
                    $('.legal_need_anchor').addClass("disable-click");
                    $('#service_title').val(serviceTitle);
                    $('.legal_need_anchor .step_complete').removeClass('d-none');
                }
            })
        })
        $(document).on('click', '.view_detail', function() {
            $.ajax({
                url: "{{ route('detail_review') }}",
                method: "get",
                data: {
                    id: $(this).attr('data-id'),
                },
                success: function(data) {
                    $('#detail_modal').html(data);
                    $('#viewDetailModal').modal('show');
                }
            })
        })
    </script>
@endsection
