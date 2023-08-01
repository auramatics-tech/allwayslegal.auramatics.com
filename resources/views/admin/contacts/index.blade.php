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

                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Contacts

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

                <!--begin::Card header-->

                <div class="card-header border-0 pt-6">

                    <!--begin::Card title-->

                    <div class="card-title w-100">

                        <!--begin::Search-->

                        <form class="d-flex align-items-center position-relative my-1" method="get">

                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->

                            <span class="svg-icon svg-icon-1 position-absolute ms-6">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"

                                    fill="none">

                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"

                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>

                                    <path

                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"

                                        fill="black"></path>

                                </svg>

                            </span>

                            <!--end::Svg Icon-->

                            <input type="text" class="form-control w-250px ps-14"

                                placeholder="Search Email" value="{{ isset(request()->q) ? request()->q : '' }}"

                                name="q">

                        </form>

                        <!--end::Search-->

                        <div>

                            <a href="{{route('admin.contact_us_listing')}}" class="btn btn-primary ms-3 px-2 py-3"><i class="fas fa-retweet" style="font-size:18px; margin-left:3px"></i></a>

                        </div>

                    </div>

                    <!--begin::Card title-->

                </div>

                <!--end::Card header-->

                <!--begin::Card body-->

                <div class="card-body pt-3">

                    <!--begin::Table-->

                    @if (Session::has('success'))

                        <div class="alert alert-success text-center">

                            {{ Session::get('success') }}

                        </div>

                    @endif

                    <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                        <div class="table-responsive">

                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"

                                id="kt_table_users">

                                <!--begin::Table head-->

                                <thead>

                                    <!--begin::Table row-->

                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"

                                            rowspan="1" colspan="1"

                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                            Name</th>

                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"

                                            rowspan="1" colspan="1"

                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                            Email</th>

                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"

                                            rowspan="1" colspan="1"

                                            aria-label="User: activate to sort column ascending" style="width: 224.953px;">

                                            Phone no.</th>



                                        <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users"

                                            rowspan="1" colspan="1"

                                            aria-label="Two-step: activate to sort column ascending" style="width: 125px;">

                                            Created At</th>

                                        <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"

                                            aria-label="Actions" style="width: 100px;">Actions</th>

                                    </tr>

                                    <!--end::Table row-->

                                </thead>

                                <!--end::Table head-->

                                <!--begin::Table body-->

                                <tbody class="text-gray-600 fw-bold">

                                    <!--begin::Table row-->

                                    @if (count($contacts))

                                        @foreach ($contacts as $key => $contact)

                                            <tr class="odd">

                                                <!--begin::User=-->

                                                <td>

                                                    <!--begin::User details-->

                                                    <div class="d-flex flex-column">

                                                        <a href="{{ route('admin.contact_detail', $contact->id) }}"

                                                            class="text-gray-800 text-hover-primary mb-1">{{ $contact->first_name }} {{ $contact->last_name }}</a>

                                                    </div>

                                                    <!--begin::User details-->

                                                </td>

                                                <!--end::User=-->

                                                <!--begin::Role=-->

                                                <td>{{ isset($contact->email) ? $contact->email : '' }}</td>

                                                <td>{{ isset($contact->phone) ? $contact->phone : '' }}</td>

                                                <!--end::Role=-->

                                                <!--begin::Last login=-->

                                                <td data-order="2023-01-08T12:00:52+05:30">

                                                        {{ date('F d, Y', strtotime($contact->created_at)) }}

                                                </td>

                                                <!--begin::Action=-->

                                                <td class="text-end">

                                                    <a href="#" class="btn btn-light btn-active-light-primary"

                                                        data-kt-menu-trigger="click"

                                                        data-kt-menu-placement="bottom-end">Actions

                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->

                                                        <span class="svg-icon svg-icon-5 m-0">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"

                                                                height="24" viewBox="0 0 24 24" fill="none">

                                                                <path

                                                                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"

                                                                    fill="black"></path>

                                                            </svg>

                                                        </span>

                                                        <!--end::Svg Icon-->

                                                    </a>

                                                    <!--begin::Menu-->

                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"

                                                        data-kt-menu="true">

                                                        <!--begin::Menu item-->

                                                        <div class="menu-item px-3">

                                                            <a href="{{ route('admin.contact_detail', $contact->id) }}"

                                                                class="menu-link px-3">Detail</a>

                                                        </div>

                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->

                                                        {{-- <div class="menu-item px-3">

                                                            <a href="javascript:" rel="{{ $contact->id }}"

                                                                rel1="delete-user"

                                                                class="deleteRecord menu-link px-3">Delete</a>

                                                        </div> --}}

                                                        <!--end::Menu item-->

                                                    </div>

                                                    <!--end::Menu-->

                                                </td>

                                                <!--end::Action=-->

                                            </tr>

                                        @endforeach

                                    @endif

                                </tbody>

                                <!--end::Table body-->

                            </table>

                        </div>

                        <div class="row text-end">

                            {{ $contacts->withQueryString()->onEachSide(0)->links('pagination::bootstrap-4') }}

                        </div>

                    </div>

                    <!--end::Table-->

                </div>

                <!--end::Card body-->

            </div>

            <!--end::Card-->

        </div>

        <!--end::Container-->

    </div>



@endsection

