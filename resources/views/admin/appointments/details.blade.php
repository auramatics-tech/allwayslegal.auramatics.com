@extends('admin.layouts.master')



@section('content')

<div class="toolbar" id="kt_toolbar">

    <!--begin::Container-->

    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

        <!--begin::Page title-->

        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

            <!--begin::Title-->

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Appointment Detail

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

<div class="post d-flex flex-column-fluid" id="kt_post">

    <!--begin::Container-->

    <div id="kt_content_container" class="container-xxl">

        <!--begin::Card-->

        <div class="card">

            <!--begin::Card body-->

            <div class="card-body pt-0">

                <!--begin::Table-->

                <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="table-responsive">

                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">

                            <!--begin::Table body-->

                            <tbody class="text-gray-600 fw-bold">


                                <tr class="odd">

                                    <th class="min-w-125px sorting" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Booking ID</th>

                                    <td class="d-flex align-items-center">{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Client name</th>

                                    <td>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Practice Area</th>

                                    <td> {{ isset($appointment->area_name) ? $appointment->area_name : '' }}</td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Date</th>

                                    <td>{{ isset($appointment->date) ? date_format($appointment->date, 'd/m/Y') : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Start time</th>

                                    <td>{{ isset($appointment->start_time) ? date_format($appointment->start_time, 'H:i:s') : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        End time</th>

                                    <td>{{ isset($appointment->end_time) ? date_format($appointment->end_time, 'H:i:s') : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Case Title</th>

                                    <td>{{ isset($appointment->case_title) ? $appointment->case_title : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Case Note</th>

                                    <td>{{ isset($appointment->case_note) ? $appointment->case_note : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Case File</th>

                                    <td> <a href="{{ asset('public/'.isset($appointment->case_file) ? $appointment->case_file : '')}}" target="_blank" rel="noopener noreferrer">view</a></td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Created On</th>

                                    <td> {{ isset($appointment->created_at) ? date_format($appointment->created_at, 'd/m/Y H:i:s') : '' }} </td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Status</th>

                                    <td> @if (isset($appointment->status) && $appointment->status == 1)
                                        <span class="pl_badge pl_bg_warning">Requested</span>
                                        @elseif(isset($appointment->status) && $appointment->status == 2)
                                        <span class="pl_badge pl_bg_primary">Request Accepted</span>
                                        @else
                                        <span class="pl_badge pl_bg_success">Confirmed</span>
                                        @endif
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    @if (isset($appointment->status) && $appointment->status == 3)
                        <div class="mb-3 mt-4">
                            <h4 class="mb-3" style="color:#337ab7">Payment Detail</h4>
                        </div>
                    </div>

                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">

                        <!--begin::Table body-->

                        <tbody class="text-gray-600 fw-bold">
                            <tr>

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Service amount</th>

                                <td> {{ isset($appointment->service_price) ? $appointment->service_price : '0' }} </td>

                            </tr>
                            <tr>

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Lawyer fee</th>

                                <td> {{ isset($appointment->lawyer_fee) ? $appointment->lawyer_fee : '0' }} </td>

                            </tr>
                            <tr>

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Lawyer fee tax</th>

                                <td>{{ isset($appointment->lawyer_fee_tax) ? $appointment->lawyer_fee_tax : '0' }} </td>

                            </tr>
                            <tr>

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Total</th>
                                @php
                                if(!empty($appointment))
                                $total = $appointment->service_price + $appointment->lawyer_fee + $appointment->lawyer_fee_tax ;
                                else
                                $total = 0;

                                @endphp
                                <td>${{ $total }}</td>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    @endif
                </div>
               
                <!--end::Table-->

            </div>

            <!--end::Card body-->

            <div class="card-footer">

                <a href="{{ route('admin.appointments') }}" class="btn btn-primary">Back</a>

            </div>

        </div>

        <!--end::Card-->

    </div>

    <!--end::Container-->

</div>

@endsection