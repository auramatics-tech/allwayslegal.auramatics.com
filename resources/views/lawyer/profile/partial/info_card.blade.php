<div class="card mb-4 default_card shadow-sm">
    <div class="row pt-2 pb-2">
          <form id="uploadForm" enctype="multipart/form-data" class="col-sm-12 col-md-6 col-lg-3 text-center">
            @csrf
            <label for="profile_photo_path" >
                @if( isset(Auth::user()->profile_photo_path) && Auth::user()->profile_photo_path)
                <img src="{{ asset('/user_profile/'.Auth::user()->profile_photo_path) }}" alt="" class="profile_avatar">
                @else
                <img src="{{ asset('assets/backend/media/avatars/blank.png') }}" alt="" class="profile_avatar">
                @endif
                <input type="file" name="profile_photo_path" id="profile_photo_path" class="d-none">
            </label>
        </form>
        <div class="col-sm-12 col-md-6 col-lg-9">
            <h6 class="pf_name dark-blue-color">
                @if(isset(Auth::user()->lawyer->first_name))
                {{ isset(Auth::user()->lawyer->first_name) ? Auth::user()->lawyer->first_name : '' }}
                {{ isset(Auth::user()->lawyer->last_name) ? Auth::user()->lawyer->last_name : '' }}
                @else
                 {{ isset(Auth::user()->name) ? Auth::user()->name : '' }}
                @endif
            </h6>
            @if (isset(Auth::user()->lawyer->law_firm_name))
                <span><i class="fa fa-2x fa-building me-2" style="font-size:18px"></i>
                    {{ isset(Auth::user()->lawyer->law_firm_name) ? Auth::user()->lawyer->law_firm_name : '' }}</span>
            @endif
            @if (isset(Auth::user()->lawyer->city) || isset(Auth::user()->lawyer->province))
                <span class="ms-3"><i class="fa fa-2x fa-map-marker me-2"
                        style="font-size:18px"></i>{{ isset(Auth::user()->lawyer->get_city->name) ? Auth::user()->lawyer->get_city->name : '' }},
                    {{ isset(Auth::user()->lawyer->get_province->name) ? Auth::user()->lawyer->get_province->name : '' }}</span>
            @endif
            <br>
            @if (Route::is('lawyer.profile.index'))
                <a class="btn col-md-6 col-lg-2 mt-3" style="background:#337ab7; color:#fff"
                    href="{{ route('lawyer.profile.edit', Auth::user()->id) }}">Edit
                    Profile</a>
            @else
                <a class="btn col-md-6 col-lg-2 mt-3" style="background:#337ab7; color:#fff"
                    href="{{ route('lawyer.profile.index') }}">View
                    Profile</a>

                <a class="btn col-md-6 col-lg-2 mt-3 ms-2" style="background:#337ab7; color:#fff"
                    href="{{ route('lawyer.get_hourly_rate') }}">Set
                    Rate</a>
            @endif
        </div>
    </div>
</div>
