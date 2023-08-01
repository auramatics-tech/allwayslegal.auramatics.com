@extends('admin.layouts.master')



@section('content')

<div class="toolbar" id="kt_toolbar">

    <!--begin::Container-->

    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

        <!--begin::Page title-->

        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

            <!--begin::Title-->

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> User Detail

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
                            @if(isset($lawyer->id))

                            <tbody class="text-gray-600 fw-bold">

                                <input type="hidden" name="lawyer_id" value="{{isset($lawyer->id) ? $lawyer->id: ''}}">

                                <tr class="odd">

                                    <th class="min-w-125px sorting" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Name</th>

                                    <td class="d-flex align-items-center">{{ isset($lawyer->first_name) ? $lawyer->first_name : '' }}
                                        {{ isset($lawyer->last_name) ? $lawyer->last_name : '' }}
                                    </td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Email</th>

                                    <td>{{ isset($users->email) ? $users->email : '' }}</td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Phone</th>

                                    <td> {{ isset($lawyer->phone) ? $lawyer->phone : '' }}</td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Gender</th>

                                    <td>{{ isset($lawyer->gender) ? $lawyer->gender : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Country</th>

                                    <td>{{ isset($lawyer->country) ? $lawyer->country : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Address</th>

                                    <td>{{ isset($lawyer->address) ? $lawyer->address : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        City</th>

                                    <td>{{ isset($lawyer->city) ? $lawyer->city : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Province</th>

                                    <td>{{ isset($lawyer->province) ? $lawyer->province : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Postal</th>

                                    <td>{{ isset($lawyer->postal) ? $lawyer->postal : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Languages</th>

                                    <td>{{ isset($lawyer->languages) ? $lawyer->languages : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Law Firm Name</th>

                                    <td>{{ isset($lawyer->law_firm_name) ? $lawyer->law_firm_name : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Law Firm Reg No</th>

                                    <td>{{ isset($lawyer->law_firm_reg_no) ? $lawyer->law_firm_reg_no : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Enrolment Year </th>

                                    <td>{{ isset($lawyer->enrolment_year) ? $lawyer->enrolment_year : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Position</th>

                                    <td>{{ isset($lawyer->position) ? $lawyer->position : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Lawyer Fee</th>

                                    <td>{{ isset($lawyer->lawyer_fee) ? $lawyer->lawyer_fee : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Lawyer Fee Tax</th>

                                    <td>{{ isset($lawyer->lawyer_fee_tax) ? $lawyer->lawyer_fee_tax : '' }}</td>

                                </tr>

                            </tbody>

                            @else
                            <tbody class="text-gray-600 fw-bold">

                                <tr class="odd">

                                    <th class="min-w-125px sorting" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Name</th>

                                    <td class="d-flex align-items-center">{{ isset($users->name) ? $users->name : '' }}
                                     
                                    </td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Email</th>

                                    <td>{{ isset($users->email) ? $users->email : '' }}</td>

                                </tr>
                            </tbody>
                            @endif
                            <!--end::Table body-->

                        </table>

                    </div>

                </div>

                <!--end::Table-->

            </div>

            <!--end::Card body-->

            <div class="card-footer">

                <a href="{{ route('admin.user') }}" class="btn btn-primary">Back</a>

            </div>

        </div>

        <!--end::Card-->

    </div>

    <!--end::Container-->

</div>

@endsection