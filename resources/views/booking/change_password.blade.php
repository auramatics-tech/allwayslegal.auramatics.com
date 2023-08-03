@extends('layouts.dashboard')

@section('content')
    <div class="right_width">
        <div class="card card-custom">
            @if (session()->has('error'))
                <p class="alert alert-danger mx-3">{{ session('error') }}</p>
            @endif

            @if (session()->has('success'))
                <p class="alert alert-success mx-3">{{ session('success') }}</p>
            @endif

            <div class="card-header flex-wrap border-0 pt-6 pb-0 bg-white">

                <div class="card-title mt-3">

                    <h3 class="card-label mb-0" style="color:#337ab7"> Change Password </h3>

                </div>

            </div>

            <div class="card-body pt-3">

                <form action="{{ route('dashboard.change_password_save') }}" method="post">

                    @csrf

                    <div class="form-group  mb-3 ms-1">

                        <label class="mb-3">Current Password

                            <span class="text-danger">*</span></label>

                        <input type="password" name="current_password" id="current_password" class="form-control"
                            placeholder="Current Password" required />

                    </div>

                    <div class="form-group mb-3 ms-1">

                        <label class="mb-3">New Password

                            <span class="text-danger">*</span></label>

                        <input type="password" name="new_password" id="new_password" class="form-control"
                            placeholder="New Password" required />

                    </div>

                    <div class="form-group mb-4 ms-1">

                        <label class="mb-3">Confirm Password

                            <span class="text-danger">*</span></label>

                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                            placeholder="Confirm Password" required />

                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save</button>

                </form>

            </div>

        </div>
    </div>
@endsection
