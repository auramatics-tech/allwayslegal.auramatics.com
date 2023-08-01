@extends('admin.layouts.master')

@section('content')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Contact Detail
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
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                id="kt_table_users">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-bold">
                                    <tr class="odd">
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                            rowspan="1" colspan="1"
                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">
                                            Name</th>
                                        <td class="d-flex align-items-center">
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href="{{ route('admin.contact_detail', $contact->id) }}"
                                                    class="text-gray-800 text-hover-primary mb-1">{{ $contact->first_name }}
                                                    {{ $contact->last_name }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                            rowspan="1" colspan="1"
                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">
                                            Email</th>
                                        <td>{{ isset($contact->email) ? $contact->email : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                            rowspan="1" colspan="1"
                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">
                                            Phone no.</th>
                                        <td>{{ isset($contact->phone) ? $contact->phone : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"
                                            rowspan="1" colspan="1"
                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">
                                            Message</th>
                                        <td>{{ isset($contact->message) ? $contact->message : '' }}</td>
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
                    <a href="{{ route('admin.contact_us_listing') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection