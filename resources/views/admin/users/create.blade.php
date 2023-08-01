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
                    @if (Route::is('admin.create_user'))
                        Create User
                    @elseif (Route::is('admin.edit_user'))
                        Edit User
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
                        <form method="post" action="{{ route('admin.store_user') }}" id="user_form">

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ isset($user->id) ? $user->id : '' }}" name="id">
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
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="" class="mb-3">Name</label>
                                            <input value="{{ isset($user->name) ? $user->name : '' }}" type="text"
                                                class="form-control" name="name" id="name" placeholder="Name">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="" class="mb-3">User Type</label>
                                            <div class="d-flex">
                                                @foreach ($roles as $role)
                                                    <div class="text-center">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="radio" name="roles[]"
                                                                    value="{{ $role->id }}"
                                                                    @isset($user) 
                                                            @if (in_array($role->id, $user->roles->pluck('id')->toArray())) 
                                                            checked @endif @endisset">
                                                                <span class="btn ps-2">{{ $role->name }}</span>
                                                                @error('role')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('role') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 row_dim mb-3">
                                            <label for="" class="mb-3">Email</label>
                                            <input value="{{ isset($user->name) ? $user->email : old('email') }}"
                                                type="text" class="form-control" name="email" id="email"
                                                placeholder="Email" autocomplete="off">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('email') }}</strong>
                                            </span>
                                        </div>
                                        @if(Route::is('admin.create_user'))
                                        <div class="form-group col-md-6 row_dim mb-3">
                                            <label for="" class="mb-3">Password</label>
                                            <input value="{{ old('password') }}" type="password" class="form-control"
                                                name="password" id="password" placeholder="Password" autocomplete="off">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('password') }}</strong>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
                                <a href="{{ route('admin.user') }}" class="btn btn-secondary">Cancel</a>
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
