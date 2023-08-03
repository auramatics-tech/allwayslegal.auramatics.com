@extends('layouts.dashboard')
@section('content')
    <div class="py-4 right_width">
        <div class="row">
            <div class="col-md-12" style="text-decoration:none">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h4 class="mb-3" style="color:#337ab7">Practice Areas</h4>
                    <div class="d-flex align-items-center mb-3 justify-content-md-end justify-content-center">
                        <div class="btn-style">
                            <a href="{{ route('lawyer.edit_practice_areas', Auth::user()->id) }}"
                                class="btn-sm ms-auto">Update Area <i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    @foreach (Auth::user()->lawyer->areas as $area)
                        <div id="lawyer->id" class="area-box col-lg-3 col-md-4 col-sm-6 col-xs-6 p_area">
                            <div class="text-center order p-3"
                                style="text-decoration:none; min-height:150px; max-height:150px">
                                @if (isset($area->image))
                                    <img src="{{ asset('practice_area_images/' . $area->image) }}" alt="{{ $area->name }}"
                                        style="width:70px">
                                @else
                                    <img src="{{ asset('assets/frontend/media/blank-image.svg') }}"
                                        alt="{{ $area->name }}" style="width:70px">
                                @endif
                                <h6 class="mt-3">{{ $area->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="col-md-6 d-flex align-items-center mt-4 justify-content-md-start justify-content-center">
                        <div class="d-flex pagination">{{ $areas->links() }}</div>
                    </div> --}}
        </div>
    </div>
@endsection
