@extends('layouts.dashboard')
@section('content')
    <div class="py-4 right_width">
        <div class="row">
            <div class="col-12 right-section mt-3">
                <form method="POST" action="{{ route('lawyer.save_hourly_rate') }}" class="profile_form default_card">
                    @csrf
                    <div class="card-body pt-2">
                        <h5 class="dark-blue-color">Set hourly rate</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="lawyer_id" value="{{ Auth::user()->lawyer->id }}">
                            <div class="col-md-12 mb-3">
                                <label for="lawyer_fee">Your fee ($)<span class="text-danger">*</span></label>
                                <input name="lawyer_fee" type="text"
                                    class="form-control form-control-item @error('lawyer_fee') is-invalid @enderror"
                                    value="{{ isset($lawyer->lawyer_fee) ? $lawyer->lawyer_fee : old('lawyer_fee', '') }}">
                                @error('lawyer_fee')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="lawyer_fee_tax">fee tax ($)<span class="text-danger">*</span></label>
                                <input name="lawyer_fee_tax" type="text"
                                    class="form-control form-control-item @error('lawyer_fee_tax') is-invalid @enderror"
                                    value="{{ isset($lawyer->lawyer_fee_tax) ? $lawyer->lawyer_fee_tax : old('lawyer_fee_tax', '') }}">
                                @error('lawyer_fee_tax')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="paypal_email_id">Paypal Email<span class="text-danger">*</span></label>
                                <input name="paypal_email_id" type="email"
                                    class="form-control form-control-item @error('paypal_email_id') is-invalid @enderror"
                                    value="{{ isset($lawyer->paypal_email_id) ? $lawyer->paypal_email_id : old('paypal_email_id', '') }}">
                                @error('paypal_email_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 text-start pt-3">
                            <div class="btn-style float-start me-3"><a href="{{ route('lawyer.dashboard') }}"
                                    class="btn-sm  bg-secondary"><i class="fa fa-chevron-left me-2"></i>Back</a>
                            </div>
                            <button type="submit" class="save_btn float-start">Save <i
                                    class="fa fa-chevron-right ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
