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
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h6 class="pf_name dark-blue-color">
                {{ isset(Auth::user()->client->first_name) ? Auth::user()->client->first_name : '' }}
                {{ isset(Auth::user()->client->last_name) ? Auth::user()->client->last_name : '' }}
            </h6>
            @if (isset(Auth::user()->client->city) || isset(Auth::user()->client->province))
               <div class="mb-3"><span class="ms-0"><i class="fa fa-2x fa-map-marker me-2"
                        style="font-size:18px"></i>{{ isset(Auth::user()->client->get_city->name) ? Auth::user()->client->get_city->name : '' }},
                    {{ isset(Auth::user()->client->get_province->name) ? Auth::user()->client->get_province->name : '' }}</span></div>
            @endif
            <a class="btn col-md-5 col-lg-5" style="background:#337ab7; color:#fff"
                href="{{ route('client.profile.edit', Auth::user()->id) }}">View
                Profile</a>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-3 text-right">
            <div class="btn-style py-2"><a href="{{ route('booking') }}" class="btn-sm ms-auto">Booking<i
                        class="fa fa-chevron-right ms-2"></i></a></div>
        </div>
    </div>
</div>
