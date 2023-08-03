<div class="lawyer_card detail_card">
    <div class="d-flex gap-3">
        <div>
            <figure class="card_rw_img mb-0">
                @if (!empty($lawyer->user->profile_photo_path))
                    <img src="{{ asset('user_profile/' . (isset($lawyer->user->profile_photo_path) ? $lawyer->user->profile_photo_path : '')) }}"
                        alt="Tax law">
                @else
                    <img src="{{ asset('assets/backend/media/avatars/blank.png') }}" alt="Tax law">
                @endif
            </figure>
        </div>
        <div>
            <h6 id="lawyer_id" data-id="{{ isset($lawyer->id) ? $lawyer->id : '' }}">
                {{ isset($lawyer->first_name) ? $lawyer->first_name : '' }}{{ isset($lawyer->last_name) ? $lawyer->last_name : '' }}
            </h6>
            <span class="review"><i class="fas fa-star"></i> <span class="text-dark">5(2)</span>
                <a href="#" class="text-primary">read reviews</a></span>
            <div class="mb-0 location">
                @if (isset($lawyer->city) || isset($lawyer->province))
                    <span class="mb-0"><i class="fa fa-2x fa-map-marker me-2"
                            style="font-size:18px"></i>{{ isset($lawyer->get_city->name) ? $lawyer->get_city->name : '' }},
                        {{ isset($lawyer->get_province->name) ? $lawyer->get_province->name : '' }}</span>
                @endif
            </div>
            <div class="mb-0 location">
                <div><i class="fas fa-language me-2"></i></div>
                {{ isset($lawyer->languages) ? $lawyer->languages : '' }}
            </div>
        </div>
    </div>
</div>
