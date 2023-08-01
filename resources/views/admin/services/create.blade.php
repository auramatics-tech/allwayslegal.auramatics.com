@extends('admin.layouts.master')
@section('css')
@endsection
@section('content')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                @if (Route::is('admin.create_service'))
                Create Service
                @elseif (Route::is('admin.edit_service'))
                Edit Service
                @endif
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
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <form method="post" action="{{ route('admin.store_service') }}" id="service_form">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <input type="hidden" value="{{ isset($service->id) ? $service->id : '' }}" name="id">

                        <div class="col-md-12 p-9">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <div class="row">
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="mb-3">Title</label>
                                        <input name="title" placeholder="Title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ isset($service->title) ? $service->title : old('title') }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="mb-3">Price $</label>
                                        <input name="price" placeholder="Price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ isset($service->price) ? $service->price : old('price') }}">
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="service fee" class="mb-3">Service fee $</label>
                                        <input name="service_fee" placeholder="Service fee" type="number" class="form-control @error('service_fee') is-invalid @enderror" value="{{ isset($service->service_fee) ? $service->service_fee : old('service_fee') }}">
                                        @error('service_fee')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="service fee tax" class="mb-3">Service fee tax $</label>
                                        <input name="service_fee_tax" placeholder="Service fee tax" type="number" class="form-control @error('service_fee_tax') is-invalid @enderror" value="{{ isset($service->service_fee_tax) ? $service->service_fee_tax : old('service_fee_tax') }}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        @error('service_fee_tax')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="legal fee" class="mb-3">Legal fee $</label>
                                        <input name="legal_fee" placeholder="Legal fee" type="number" class="form-control @error('legal_fee') is-invalid @enderror" value="{{ isset($service->legal_fee) ? $service->legal_fee : old('legal_fee') }}">
                                        @error('legal_fee')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="legal fee tax" class="mb-3">Legal fee tax $</label>
                                        <input name="legal_fee_tax" placeholder="Legal fee tax" type="number" class="form-control @error('legal_fee_tax') is-invalid @enderror" value="{{ isset($service->legal_fee_tax) ? $service->legal_fee_tax : old('legal_fee_tax') }}">
                                        @error('legal_fee_tax')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="practice areas" class="mb-3">Practice Areas(Default All)</label>
                                        <select name="practice_areas[]" multiple class="multiple-selection form-control" data-placeholder="Select Practice Areas">
                                            @if(count($practice_areas))
                                            @foreach ($practice_areas as $area)
                                            <option @if(isset($service->practice_area_id) && in_array($area->id,json_decode($service->practice_area_id,true))) 
                                                selected @endif value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>

                                        @error('practice_areas')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="legal fee tax" class="mb-3">Description</label>
                                        <textarea name="description" type="text" placeholder="Service description" class="form-control @error('legal_fee_tax') is-invalid @enderror">{{ isset($service->description) ? $service->description : old('description') }}</textarea>
                                        @error('legal_fee_tax')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="service_submit" class="btn btn-primary me-3">Submit</button>
                            <a href="{{ route('admin.service') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>

<!--end::Content-->
@endsection
@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<!--end::Page Scripts-->
<script>
    $(document).ready(function() {
        $('#role').on('change', function() {
            var demovalue = $(this).val();
            console.log(demovalue);
            $(".row_dim").hide();
            $("#show" + demovalue).show();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".multiple-selection").select2();

    });
</script>
@endsection