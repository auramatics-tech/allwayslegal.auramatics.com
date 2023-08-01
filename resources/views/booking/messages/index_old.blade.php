@extends('layouts.dashboard')
@section('content')
{{--<div class="container">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-3 px-sm-2 px-0 col_sidebar">
            @include('client.includes.sidebar')
        </div>
        <div class="col py-lg-5 py-4 right_width">
           <div style="background:#fff; border: solid #ddd 1px; border-radius:10px" class="container px-3">
                <div class="row" style="height:100%">
                    <div class="col-4" style="border-right:2px solid #ddd">
                        <div>
                            <div class="row p-2 align-items-center" style="border-bottom:1px solid gray; min-height:65px">
                                <div class="col-9">
                                    AllwaysLegal
                                </div>
                                <div class="img_container col-3">
                                    <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ Auth::user()->name }}" alt="" style="border-radius:50%;height:40px;width:40px;">
                                </div>
                            </div>
                            <div class="chatlist_body p-2" style="overflow-y:auto; max-height:480px; direction:rtl; cursor:pointer;overflow-x:hidden">
                                @if(count($data))
                                @foreach ($data as $lawyer)
                                @if (is_object($lawyer) && $lawyer->cancelled_at === null)
                                {{ isset($data->user_type) ? $data->user_type : '' }}
                                @if(Auth::user()->client)
                                <div style="direction:ltr; height:70px; background:ghostwhite; border-radius:10px" class="chatlist_item row mb-1 ml-2 pt-3">
                                    <div class="chatlist_img_container col-3">
                                        <img src="https://ui-avatars.com/api/?name={{ isset($lawyer->lawyer_name) ? $lawyer->lawyer_name : '' }}" alt="" style="border-radius:50%">
                                        <div class='status-circle'></div>
                                    </div>
                                    <div class="chatlist_info col-9">
                                        <div class="top_row row">
                                            <div class="list_username col-6">
                                                {{ isset($lawyer->lawyer_name) ? $lawyer->lawyer_name : '' }}<br>
                                                {{ isset($lawyer->booking_code) ? $lawyer->booking_code : '' }}
                                            </div>
                                            <div class="col-6 text-end"><small><i class="date">1 day ago</i></small></div>
                                        </div>
                                        <div class="bottom_row row">
                                            <div class="message_body text-truncate col-9">
                                                <small>text</small>
                                            </div>
                                            <div class="unread_count col-3" style="background:#ddd">
                                                <small>12</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div style="direction:ltr; height:70px; background:ghostwhite; border-radius:10px" class="chatlist_item row mb-1 ml-2 pt-3">
                                    <div class="chatlist_img_container col-3">
                                        <img src="https://ui-avatars.com/api/?name={{ isset($lawyer->client_name) ? $lawyer->client_name : '' }}" alt="" style="border-radius:50%">
                                        <div class='status-circle'></div>
                                    </div>
                                    <div class="chatlist_info col-9">
                                        <div class="top_row row">
                                            <div class="list_username col-6">
                                                {{ isset($lawyer->client_name) ? $lawyer->client_name : '' }}<br>
                                                {{ isset($lawyer->booking_code) ? $lawyer->booking_code : '' }}
                                            </div>
                                            <div class="col-6 text-end"><small><i class="date">1 day ago</i></small></div>
                                        </div>
                                        <div class="bottom_row row">
                                            <div class="message_body text-truncate col-9">
                                                <small>text</small>
                                            </div>
                                            <div class="unread_count col-3" style="background:#ddd">
                                                <small>12</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach
                                @else
                                <span>You have no conversations.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-8 px-0" tyle="max-height:500px">
                        <div class="w-100 px-0">
                            <div class="chatbox_header d-flex p-2" style="border-bottom:1px solid gray; min-height:65px">
                                <div class="">
                                    <i class="fa fa-arrow-left"></i>

                                    <img src="https://ui-avatars.com/api/?name=" alt="" style="border-radius:50%; width:45px" style="float:right; width:30px">
                                </div>

                                <div class="name" style="float:right">

                                </div>

                                <div class="info">

                                    <div class="info_item">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>

                                    <div class="info_item">
                                        <i class="bi bi-image"></i>
                                    </div>

                                    <div class="info_item">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="chatbox_body p-3" style="overflow-y:scroll; min-height:300px; max-height:300px">

                                <div wire:key="" class="msg_body" style="width:80%;max-width:80%;max-width:max-content;background:ghostwhite;margin-bottom:5px;padding:10px;border-radius:10px">

                                    text here

                                    <div class="msg_body_footer" style="line-height:1">
                                        <div class="date text-right">
                                            <small><i>08/04/2023</i></small>
                                        </div>

                                        <div class="read text-right">
                                            <small><i class="fa fa-check"></i></small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script>
                                $('.chatbox_body').on('scroll', function() {
                                    var top = $('.chatbox_body').scrollTop();
                                    if (top == 0) {
                                        window.livewire.emit('loadmore');
                                    }
                                });
                            </script>
                            <script>
                                window.addEventListener('updateHeight', event => {
                                    let oldHeight = event.detail.height;
                                    let newHeight = $('.chatbox_body')[0].scrollHeight;
                                    let height = $('.chatbox_body').scrollTop(newHeight - oldHeight);

                                    window.livewire.emit('updateHeight', {
                                        height: height,
                                    });
                                });
                            </script>
                            <div class="text-center mt-3 mb-5" style="color:#333">
                                <img src="{{ asset('storage/img/chatbox-simple.svg') }}" alt="" style="width:45%; margin:auto; opacity:0.5">
                                <h4>Pick up where you left off</h4>
                                <h5>Select a conversation to start chatting</h5>
                            </div>

                            <script>
                                window.addEventListener('rowChatToBottom', event => {

                                    $('.chatbox_body').scrollTop($('.chatbox_body')[0].scrollHeight);
                                });
                            </script>
                        </div>
                        <div class="d-flex pl-3 pr-3">
                            <textarea name="" id="" class="form-control" rows="1" placeholder="type message here....."></textarea>
                            <button class="btn btn-primary col-1 ml-2">Send</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>--}}



@endsection