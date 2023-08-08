@extends('layouts.dashboard')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .appointment_table tbody tr:nth-of-type(even) th,
        .appointment_table tbody tr:nth-of-type(even) td {
            background: rgba(255, 255, 255, 0.5) !important;
            box-shadow: inset 0 0 0 9999px rgba(241, 241, 241, 0.5);
        }

        .relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none;
        }

        hr {
            margin: 5px auto;
            width: 60%;
        }

        .chat-bubble {
            padding: 10px 14px;
            background: #a94442;
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

        .receive .chat-bubble p {
            color: #fff !important;
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
            background: #337ab7;
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
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-3" style="color: #337ab7;">Reply Ticket Enquiry</h4>
        </div>
        <div class="row g-9 mb-8 residential">
            <div class="chat-panel">
                <div class="card-header d-flex align-items-center justify-content-between"
                    id="kt_drawer_chat_messenger_header">
                    <!--begin::Title-->
                    <div class="card-title">
                        <!--begin::User-->
                        <div class="d-flex justify-content-center flex-column me-3">
                            <a href="#"
                                class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{ isset($enquiry->title) ? $enquiry->title : '' }}</a>
                        </div>
                        <!--end::User-->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                            <a href="{{ route('client.ticket_enquiry') }}" type="button" class="btn btn-secondary"><span
                                    class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span></a>

                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <div class="message_section mb-5" id="chat" style="height:500px;overflow-y: auto;">
                    @if (count($messages))
                        @foreach ($messages as $message)
                            <div class="row no-gutters mb-2" style="margin: 10px;">
                                <div
                                    class="col-xl-5 col-lg-5 col-md-8 col-11 @if ($message->user_id == Auth::user()->id) ms-auto send @else me-auto receive @endif">
                                    <div
                                        class="chat-bubble @if ($message->user_id == Auth::user()->id) ) chat-bubble--right @else chat-bubble--left @endif">
                                        <p class="user_name">{{ ucfirst($message->user_name) }}</p>
                                        <p>
                                            @if ($message->type == 'text')
                                                {{ $message->message }}
                                            @else
                                                <a href="{{ asset('query_image/' . $message->message) }}" target="_blank"
                                                    class="card p-1"><i class="o mr-1"
                                                        aria-hidden="true"></i>{{ $message->message }}</a>
                                            @endif
                                            <br><br>
                                            <span
                                                class="text-grey">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at, 'UTC')->setTimezone('Asia/Kolkata')->format('H:i') }}</span>
                                        </p>
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
                            <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $enquiry->id }}">
                            <input type="hidden" name="last_msg" id="last_msg"
                                value="{{ isset($messages->last()->id) ? $messages->last()->id : '' }}">
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
                url: "{{ route('client.send_msg_client') }}",
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
                    url: "{{ route('client.fetch_msg_client') }}",
                    data: {
                        ticket_id: $('#ticket_id').val(),
                        last_msg: $('#last_msg').val()
                    },
                    success: function(data) {
                        if (data.msg.length) {
                            $('#last_msg').val(data.last_msg_id)
                            $('#chat').append(data.msg);
                            $('#msg_box').val('');
                            $('#file-input').val('');
                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            setInterval(fetch_msg, 3000);
        });


        $(document).ready(function() {
            fetch_msg();
        });
    </script>
@endsection
