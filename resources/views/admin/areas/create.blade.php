@extends('admin.layouts.master')
@section('css')
    <link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
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
                        <form method="post" action="{{ route('admin.store_area') }}" id="service_form"  enctype="multipart/form-data">

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ isset($area->id) ? $area->id : '' }}" name="id">

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
                                            <label for="title" class="mb-3">Image</label>
                                            <input type="file" name="image" id="image"
                                                class="form-control" placeholder="File"
                                                value="" />
                                            @if (isset($area->image) ? $area->image : '')
                                                <img src="{{ asset('practice_area_images/' . $area->image) }}"
                                                    alt="" class="img-thumbnail mt-3"
                                                    style="width:100px; height:100px">
                                            @endif
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="title" class="mb-3">Name</label>
                                            <input name="name" placeholder="Title" type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ isset($area->name) ? $area->name : old('name') }}">
                                            @error('title')
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
                                <a href="{{ route('admin.practice_area') }}" class="btn btn-secondary">Cancel</a>
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
@endsection
@section('script')
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
@endsection
