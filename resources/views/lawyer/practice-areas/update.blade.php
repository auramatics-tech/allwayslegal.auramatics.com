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
                <h4 class="mb-3" style="color:#337ab7">Practice Area</h4>
                <form method="POST" action="{{ route('lawyer.update_practice_areas') }}">
                    @csrf
                    <div class="row px-3">
                        <input type="hidden" name="id" value="{{ isset($lawyer->id) ? $lawyer->id : '' }}">
                        @foreach ($areas as $area)
                            <div class="col-lg-4 col-md-6 col-sm-1 text-center" style="border:1px dashed #ddd">
                                <div class="checkbox p-3 d-flex flex-column align-items-start p_area">
                                    <label class="text-start">
                                        @if (isset($area->image))
                                            <img src="{{ asset('practice_area_images/' . $area->image) }}"
                                                alt="{{ $area->name }}" class="img-thumbnail"
                                                style="width:50px; height:50px; cursor:pointer">
                                        @else
                                            <img src="{{ asset('assets/frontend/media/blank-image.svg') }}"
                                                alt="{{ $area->name }}" class="img-thumbnail"
                                                style="width:50px; height:50px; cursor:pointer">
                                        @endif
                                        <div class="d-flex align-items-center gap-3 mt-3">
                                            <input type="checkbox" name="areas[]" value="{{ $area->id }}"
                                                @isset($lawyer) 
                                                    @if (in_array($area->id, $lawyer->areas->pluck('id')->toArray())) 
                                                    checked @endif @endisset">
                                            <h6 class="mb-0" style=" cursor:pointer">
                                                {{ $area->name }}</h6>
                                        </div>
                                        @error('area')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center d-flex justify-content-md-end justify-content-center gap-3 mt-4">
                        <div class="btn-style"><a href="{{ route('lawyer.practice_areas', Auth::user()->id) }}"
                                class="btn-sm  bg-secondary"><i class="fa fa-chevron-left me-2"></i>Go Back</a>
                        </div>
                        <button type="submit" class="save_btn">Save Changes<i
                                class="fa fa-chevron-right ms-2"></i></button>
                    </div>
                </form>
            </div>
            <style type="text/css">
                input[type="checkbox"] {
                    zoom: 1.4;
                }
            </style>
        </div>
    </div>
@endsection
