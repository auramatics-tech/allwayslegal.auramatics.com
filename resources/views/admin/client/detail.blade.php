@extends('admin.layouts.master')



@section('content')

<div class="toolbar" id="kt_toolbar">

    <!--begin::Container-->

    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">

        <!--begin::Page title-->

        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">

            <!--begin::Title-->

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Client Detail

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

                            <tbody class="text-gray-600 fw-bold">
                                <input type="hidden" name="id" value="{{ isset($client->id) ? $client->id : '' }}">
                                <tr class="odd">

                                    <th class="min-w-125px sorting" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Name</th>

                                    <td class="d-flex align-items-center">{{ isset($client->first_name) ? $client->first_name : '' }}
                                        {{ isset($client->last_name) ? $client->last_name : '' }}
                                    </td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Email</th>

                                    <td>{{ isset($client->email) ? $client->email : '' }}</td>

                                </tr>

                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Phone</th>

                                    <td> {{ isset($client->phone) ? $client->phone : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Country</th>

                                    <td>{{ isset($client->get_country->name) ? $client->get_country->name : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Address</th>

                                    <td>{{ isset($client->address) ? $client->address : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        City</th>

                                    <td>{{ isset($client->get_city->name) ? $client->get_city->name : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Province</th>

                                    <td>{{ isset($client->get_province) ? $client->get_province->name : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                        Postal</th>

                                    <td>{{ isset($client->postal) ? $client->postal : '' }}</td>

                                </tr>

                                <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Position</th>

                                <td>{{ isset($client->position) ? $client->position : '' }}</td>

                                </tr>
                                <tr>

                                    <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                    Business</th>

                                    <td>{{ isset($client->business) ? $client->business : '' }}</td>

                                </tr>

                            </tbody>
                          
                            <!--end::Table body-->

                        </table>

                    </div>

                </div>

                <!--end::Table-->

            </div>

            <!--end::Card body-->

            <div class="card-footer">

                <a href="{{ route('admin.clients') }}" class="btn btn-primary">Back</a>

            </div>

        </div>

        <!--end::Card-->

    </div>

    <!--end::Container-->

</div>

@endsection