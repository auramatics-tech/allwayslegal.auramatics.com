@extends('admin.layouts.master')

@section('css')

<style>

    .my_p_area_list li:last-child span{

        display:none;

    }

</style>

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

                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Services

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

                    <div class="card-title">

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

                            <input type="text" class="form-control w-250px ps-14" placeholder="Search Service"

                                value="{{ isset(request()->q) ? request()->q : '' }}" name="q">

                        </form>

                        <!--end::Search-->

                    </div>

                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->

                    <div class="card-toolbar">

                        <!--begin::Toolbar-->

                        <div class="d-flex justify-content-end" data-kt-service-table-toolbar="base">

                            <!--begin::Add service-->

                            <a href="{{ Route('admin.create_service') }}" type="button" class="btn btn-primary">

                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->

                                <span class="svg-icon svg-icon-2">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"

                                        viewBox="0 0 24 24" fill="none">

                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"

                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>

                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"

                                            fill="black"></rect>

                                    </svg>

                                </span>

                                <!--end::Svg Icon-->Add Service

                            </a>

                            <!--end::Add service-->

                        </div>

                        <!--end::Toolbar-->

                    </div>

                    <!--end::Card toolbar-->

                </div>

                <!--end::Card header-->

                <!--begin::Card body-->

                <div class="card-body pt-0">

                    <!--begin::Table-->

                    @if (Session::has('success'))

                        <div class="alert alert-success text-center">

                            {{ Session::get('success') }}

                        </div>

                    @endif

                    <div id="kt_table_services_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                        <div class="table-responsive">

                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"

                                id="kt_table_services">

                                <!--begin::Table head-->

                                <thead>

                                    <!--begin::Table row-->

                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                                        <th class="min-w-50px">

                                            S.no</th>

                                        <th class="min-w-100px">

                                            Title</th>

                                        <th class="min-w-100px">

                                            Price</th>

                                        <th class="min-w-100px">

                                            Service fee</th>

                                        <th class="min-w-100px">

                                            Service fee tax</th>

                                        <th class="min-w-100px">

                                            Legal fee</th>

                                        <th class="min-w-100px">

                                            Legal fee tax</th>

                                           <!--   <th class="min-w-100px">-->

                                           <!--Practice Area</th>-->

                                        <th class="min-w-100px">

                                            Description</th>

                                        <th class="min-w-125px " tabindex="0" aria-controls="kt_table_services"

                                            rowspan="1" colspan="1"

                                            aria-label="Two-step: activate to sort column ascending" style="width: 125px;">

                                            Created At</th>

                                        <th class="text-end min-w-125px sorting_disabled" rowspan="1" colspan="1"

                                            aria-label="Actions" style="width: 100px;">Actions</th>

                                    </tr>

                                    <!--end::Table row-->

                                </thead>

                                <!--end::Table head-->

                                <!--begin::Table body-->

                                <tbody class="text-gray-600 fw-bold">

                                    <!--begin::Table row-->

                                    @if (count($services))

                                        @foreach ($services as $key => $service)

                                            <tr class="odd">

                                                <td>{{$key+1}}</td>

                                                <td class="d-flex align-items-center">

                                                    <!--begin::service details-->

                                                    <div class="d-flex flex-column">

                                                        <a href="#"

                                                            class="text-gray-800 text-hover-primary mb-1">{{ $service->title }}

                                                        </a>

                                                    </div>

                                                    <!--begin::service details-->

                                                </td>

                                                <td>${{ isset($service->price) ? $service->price : '' }}</td>

                                                <td>${{ isset($service->service_fee) ? $service->service_fee : '' }}</td>

                                                <td>${{ isset($service->service_fee_tax) ? $service->service_fee_tax : '' }}</td>

                                                <td>${{ isset($service->legal_fee) ? $service->legal_fee : '' }}</td>

                                                <td>${{ isset($service->legal_fee_tax) ? $service->legal_fee_tax : '' }}</td>

                                                {{--<td>

                                                    <ul class="list-unstyled my_p_area_list">

                                                    @if(isset($service->practice_area_id) && ($service->is_all == 0))

                                                    @foreach(json_decode($service->practice_area_id) as $practice_area)

                                                    <li>{{$practice_area->get_area_name->name}} <span>,</span></li>

                                                    @endforeach

                                                    @else

                                                     <li>All</li>

                                                    @endif

                                                    </ul>

                                                </td>--}}

                                                <td>{{ isset($service->description) ? $service->description : '' }}</td>



                                                <td data-order="2023-01-08T12:00:52+05:30">

                                                        {{ date('F d, Y', strtotime($service->created_at)) }}

                                                </td>

                                                <!--begin::Action=-->

                                                <td class="text-end">

                                                    <a href="#"

                                                        class="btn btn-light btn-active-light-primary"

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

                                                            <a href="{{ route('admin.edit_service', $service->id) }}"

                                                                class="menu-link px-3">Edit</a>

                                                        </div>

                                                        <!--end::Menu item-->

                                                        <!--begin::Menu item-->

                                                        <div class="menu-item px-3">

                                                            <a href="javascript:" rel="{{ $service->id }}"

                                                                rel1="delete-service"

                                                                class="deleteRecord menu-link px-3">Delete</a>

                                                        </div>

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

                        <!-- <div class="row">

                                        <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"></div>

                                        <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">

                                            <div class="dataTables_paginate paging_simple_numbers" id="kt_table_services_paginate">

                                                <ul class="pagination">

                                                    <li class="paginate_button page-item previous disabled" id="kt_table_services_previous"><a href="#" aria-controls="kt_table_services" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li>

                                                    <li class="paginate_button page-item active"><a href="#" aria-controls="kt_table_services" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>

                                                    <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_services" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>

                                                    <li class="paginate_button page-item "><a href="#" aria-controls="kt_table_services" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>

                                                    <li class="paginate_button page-item next" id="kt_table_services_next"><a href="#" aria-controls="kt_table_services" data-dt-idx="4" tabindex="0" class="page-link"><i class="next"></i></a></li>

                                                </ul>

                                            </div>

                                        </div>

                                    </div> -->

                        <div class="row text-end">

                            {{ $services->withQueryString()->onEachSide(0)->links('pagination::bootstrap-4') }}

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



@section('script')

    <!--begin::Page Scripts(used by this page)-->

    <script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>

    <!--end::Page Scripts-->

@endsection

