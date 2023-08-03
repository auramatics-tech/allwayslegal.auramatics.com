@extends('admin.layouts.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .my_p_area_list li:last-child span {

        display: none;
    }

    hr {
        margin: 5px auto;
        width: 60%;
    }

    .chat-bubble {
        padding: 10px 14px;
        background: #ECECF9;
        margin: 10px 0px;
        border-radius: 9px;
        position: relative;
        animation: fadeIn 1s ease-in;
        justify-content: space-between;
        padding-right: 50px;
    }

    .chat-bubble span {
        position: absolute;
        right: 10px;
        bottom: 10px;
    }

    .send .chat-bubble p {
        color: #fff !important;
        font: normal normal normal 18px/24px Poppins;
    }

    .send .chat-bubble .user_name {
        font: normal normal normal 12px/24px Poppins;
    }

    .receive .chat-bubble .user_name {
        font: normal normal normal 12px/24px Poppins;
    }

    .receive .chat-bubble p {
        font: normal normal normal 18px/24px Poppins;
    }

    .send .chat-bubble span {
        color: #fff !important;
        font: normal normal normal 12px/24px Poppins;
    }


    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .send .chat-bubble {
        background: #00876F;
        color: #fff;
    }

    .custom-file-input {
        position: absolute;
        left: -9999px;
    }


    .custom-file-label {
        cursor: pointer;
    }


    .file-icon {
        font-size: 2rem;

    }

    .message_section {
        height: 545px;
        overflow-y: auto;
        overflow-x: hidden;
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

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Reply

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
            <div class="card-body pt-0" style="min-height: calc(100vh - 230px);">

                <!--begin::Table-->

                @if (Session::has('success'))
                <div class="alert alert-success text-center">

                    {{ Session::get('success') }}

                </div>
                @endif

                <div id="kt_table_services_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div>
                        @if (Session::has('error'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('error') }}
                        </div>
                        @endif
                        <div class="d-flex g-9 mb-0 residential flex-column justify-content-between">
                            <div class="card-header px-0" id="kt_drawer_chat_messenger_header">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::User-->
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{isset($data->case_title) ? $data->case_title : ''}}</a>
                                        <!--begin::Info-->
                                        <div class="mb-0 lh-1">
                                            <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                                            <span class="fs-7 fw-bold text-muted">Active</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Close-->
                                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                        <a href="{{ route('admin.appointments') }}" type="button" class="btn btn-secondary"><span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                </svg>
                                            </span></a>

                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <div class="chat-panel">
                                <div class="message_section mb-5" id="chat" style="height: calc(100vh - 382px);overflow-y: auto;">
                                    @if(count($messages))
                                    @foreach($messages as $message)
                                    <div class="row no-gutters">
                                        <div class="col-xl-5 col-lg-5  col-md-8 col-11 @if($message->sender_id == Auth::id()) ms-auto send @else me-auto receive @endif">
                                            <div class="chat-bubble @if($message->sender_id == Auth::id()) chat-bubble--right @else chat-bubble--left @endif">
                                                <p class="user_name">{{ucfirst($message->user_name)}}</p>
                                                @if($message->type == 'text')
                                                {{$message->body}}
                                                @else
                                                <a href="{{asset('query_image/' . $message->body)}}" target="_blank" class="card p-1"><i class="o mr-1" aria-hidden="true"></i>{{$message->body}}</a>
                                                @endif
                                                <br><br>
                                                <span>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$message->created_at,'UTC')->setTimezone('Asia/Kolkata')->format('H:i')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                <form action="" method="post" id="chat_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex align-items-center chat-box-tray mx-auto w-100 gap-3">
                                        <div class="d-flex gap-3 align-items-center w-100">
                                            <input type="hidden" name="appointment_id" id="appointment_id" value="{{$data->id}}">
                                            <input type="hidden" name="last_msg" id="last_msg" value="{{isset($messages->last()->id) ? $messages->last()->id : ''}}">
                                            <textarea autofocus name="msg_box" id="msg_box" rows="1" class="w-100 form-control" placeholder="Type here..."></textarea>
                                            <div class="d-flex">
                                                <label for="file-input" class="custom-file-label">
                                                    <i class="fa fa-picture-o file-icon" aria-hidden="true"></i>
                                                </label>
                                                <input id="file-input" name="image" type="file" class="custom-file-input" />
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="button" id="send_msg_btn" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('change', '#file-input', function() {
        var file_name = $('#file-input')[0].files[0].name
        console.log(file_name)
        $('#msg_box').val(file_name);
    })
    $(document).on('click', '#send_msg_btn', function() {
        var formData = new FormData($('#chat_form')[0]);
        $.ajax({
            method: "post",
            url: "{{ route('admin.send_message') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#last_msg').val(data.last_msg_id);
                $('#chat').append(data.msg);
                $('#msg_box').val('');
                $('#file-input').val('');
            }
        });

    });

    function fetch_msg() {
        if ($('#last_msg').val() && $('#last_msg').val() !== '') {
            console.log($('#last_msg').val())
            $.ajax({
                method: "get",
                url: "{{ route('admin.fetch_message') }}",
                data: {
                    appointment_id: $('#appointment_id').val(),
                    last_msg: $('#last_msg').val()
                },
                success: function(data) {
                    if (data.msg.length) {
                        $('#last_msg').val(data.last_msg_id)
                        $('#chat').append(data.msg);
                        $('#msg_box').val('');
                        s
                        $('#file-input').val('');
                    }
                }
            });
        }
    }
    $(document).ready(function() {
        setInterval(fetch_msg, 1000);
    });


    $(document).ready(function() {
        fetch_msg();
    });
</script>
@endsection