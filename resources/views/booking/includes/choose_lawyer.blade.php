<div class="card">
    <div class="row lawyer">
        @if (count($lawyerDetails))
            @foreach ($lawyerDetails as $lawyerDetail)
                <div class="col-lg-6 mb-lg-4 mb-3">
                    <div class="lawyer_card">
                        {{-- <a href="{{ route('detail_review' , $lawyerDetail->id)}}"> --}}
                        <div class="d-flex gap-3">
                            <div>
                                @if (isset($lawyerDetail->user->profile_photo_path))
                                    <img src="{{ asset('/user_profile/' . $lawyerDetail->user->profile_photo_path) }}"
                                        alt="lawyer pic" style="width:80px; height:80px">
                                @else
                                    <img src="{{ asset('assets/backend/media/avatars/blank.png') }}" alt="lawyer pic"
                                        style="width:80px; height:80px">
                                @endif
                            </div>
                            <div>
                                <h6>{{ isset($lawyerDetail->first_name) ? $lawyerDetail->first_name : '' }} {{ isset($lawyerDetail->last_name) ? $lawyerDetail->last_name : '' }}
                                </h6>
                                <span class="review"><i class="fas fa-star"></i> <span
                                        class="text-dark">5(2)</span></span>
                                @if (isset($lawyerDetail->city) || isset($lawyerDetail->province))
                                    <p class="mb-0 location"><i class="fa fa-map-marker me-2"></i>
                                        {{ isset($lawyerDetail->get_city->name) ? $lawyerDetail->get_city->name : '' }},
                                        {{ isset($lawyerDetail->get_province->name) ? $lawyerDetail->get_province->name : '' }}
                                    </p>
                                @endif
                            </div>
                            <div class="ms-auto">
                                <input type="checkbox" class="check_btn_enable" name="lawyer_id[]"  value="{{ isset($lawyerDetail->id) ? $lawyerDetail->id : '' }}">
                                <input type="hidden" name="lawyer_name[]"  value="{{ isset($lawyerDetail->first_name) ? $lawyerDetail->first_name : '' }} {{ isset($lawyerDetail->last_name) ? $lawyerDetail->last_name : '' }}">
                            </div>
                        </div>
                        <div class="footer">
                            Next available : {{ \Carbon\Carbon::parse($lawyerDetail->available_slot)->format('l F j') }}
                        </div>
                        <div class="btns-2 mt-3">
                            <div class="btn-style"> <a href="javascript:" data-id="{{ $lawyerDetail->id }}"
                                    class="view_detail btn-sm text-center w-100 justify-content-center">View Detail</a></div>
                        </div>

                        {{-- </a> --}}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
