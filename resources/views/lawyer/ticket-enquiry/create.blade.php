@extends('layouts.dashboard')
@section('content')
    <style>
        .appointment_table tbody tr:nth-of-type(even) th,
        .appointment_table tbody tr:nth-of-type(even) td {
            background: rgba(255, 255, 255, 0.5) !important;
            box-shadow: inset 0 0 0 9999px rgba(241, 241, 241, 0.5);
        }

        .relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none;
        }
    </style>

    <div class="py-4 right_width">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="mb-3">
            <h4 class="mb-3" style="color:#337ab7"> Add Ticket Enquiry</h4>
        </div>
        <div style="width:100%; overflow-x: auto">
            <div class="col-md-12">
                <div class="card card-custom gutter-b example example-compact">
                    <form method="post" action="{{ route('lawyer.ticket_enquiries_save') }}" id="service_form">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                @if (count($errors) > 0)
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">Title:</label>
                                    <input name="title" placeholder="Title" type="text"
                                        class="w-100 form-control @error('title') is-invalid @enderror" value="">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea name="description" type="text" placeholder="Ticket description"
                                        class="form-control @error('description') is-invalid @enderror"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="background:none;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('lawyer.ticket_enquiries') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
