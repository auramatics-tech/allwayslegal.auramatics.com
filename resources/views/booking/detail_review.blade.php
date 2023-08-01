<div class="modal" id="viewDetailModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="card">
                <div class="row lawyer">
                    <div class="col-12">
                        <div class="lawyer_card detail_card border-0">
                            <div class="d-flex gap-3">
                                <div>
                                    <figure class="card_rw_img mb-0">
                                        @if (isset($lawyerDetail->user->profile_photo_path) && $lawyerDetail->user->profile_photo_path)
                                            <img src="{{ asset('/user_profile/' . $lawyerDetail->user->profile_photo_path) }}"
                                                alt="" class="profile_avatar">
                                        @else
                                            <img src="{{ asset('assets/backend/media/avatars/blank.png') }}"
                                                alt="" class="profile_avatar">
                                        @endif
                                    </figure>
                                </div>
                                <div>
                                    <h6>{{ isset($lawyerDetail->first_name) ? $lawyerDetail->first_name : '' }}
                                        {{ isset($lawyerDetail->last_name) ? $lawyerDetail->last_name : '' }}</h6>
                                    <span class="review"><i class="fas fa-star"></i> <span class="text-dark">5(2)</span>
                                        <a href="#" class="text-primary">read reviews</a></span>
                                    @if (isset($lawyerDetail->city) || isset($lawyerDetail->province))
                                        <div class="mb-0 location">
                                            <div><i class="fa fa-map-marker me-2"></i></div>
                                            {{ isset($lawyerDetail->get_city->name) ? $lawyerDetail->get_city->name : '' }},
                                            {{ isset($lawyerDetail->get_province->name) ? $lawyerDetail->get_province->name : '' }}
                                        </div>
                                    @endif
                                    @if (isset($lawyerDetail->languages) && $lawyerDetail->languages)
                                        <div class="mb-0 location">
                                            <div><i class="fas fa-language me-2"></i></div>
                                            {{ isset($lawyerDetail->languages) ? $lawyerDetail->languages : '' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="footer">
                                <p><strong>Practice Areas</strong></p>
                                <ul class="d-flex gap-3">
                                    @if (count($lawyerDetail->areas))
                                        @foreach ($lawyerDetail->areas as $area)
                                            <li>{{ $area->name }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="footer mt-lg-4 mt-3">
                                <p><strong>Services</strong></p>
                                <ul class="d-flex gap-3 flex-wrap">
                                    @if (count($lawyerDetail->services))
                                        @foreach ($lawyerDetail->services as $service)
                                            <li>{{ $service->title }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            {{-- <div class="bottom_btn mt-3">
                                <a href="#" class="text-decoration-underline"> Read More</a>
                            </div> --}}
                            <div class="col-12 text-end modal-footer mt-3 pb-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="btn-style py-2"><a href="{{ route('schedule_time') }}"
                                class="btn-sm ms-auto">Continue<i class="fa fa-chevron-right ms-2"></i></a></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

