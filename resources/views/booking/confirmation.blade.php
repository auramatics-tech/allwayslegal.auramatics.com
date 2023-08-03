@extends('layouts.dashboard')

@section('content')
    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        .paypal-powered-by {
            opacity: 0 !important;
        }
    </style>

    <div class="py-4 right_width">
        <div class="row">
            <div class="col-12">
                <p class="mb-0"><em> We've sorted lawyers based on their areas of experience in your area of
                        need.</em></p>
            </div>
            <div class="col-lg-6 mt-3">
                @include('booking.includes.info_card')
                <div class="lawyer_card detail_card p-3 confirm_right_card mt-lg-4 mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box_info h-100">
                                <small><i
                                        class="fas fa-clock me-2"></i>{{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
                                    {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}</small>
                                <small><i class="fa fa-phone me-2 mt-3" style="transform: rotate(90deg)"></i>
                                    {{ isset($lawyer->phone) ? $lawyer->phone : '' }}</small>
                            </div>
                        </div>
                        <div class="pt-2 col-md-12"" style="list-style:none; font-size:13px; color:gray">
                            <li>This is the day and time your lawyer will call you. We suggest a quiet place
                                for max benefit.</li>
                            <li class="pb-2 pt-2">You can reschedule or cancel your call by speaking with
                                out Legal Concierge service team.</li>
                            <li>Calls can be cancelled up to 2 hours before. Contract reviews require 24hrs
                                notice.</li>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 mt-3">
                <div class="border" style="background:ghostwhite; border-radius:5px">
                    <div class="card p-3">
                        <table class="table table-borderless align-middle">
                            <tbody class="p-5">
                                <tr>
                                    <td colspan="2"><strong>Item</strong></td>
                                    <td style="float:right"><strong>Total</strong></td>
                                </tr>
                                <tr style="border-bottom:1px solid #ddd">
                                    <td colspan="2">{{ isset($service->title) ? $service->title : '' }}</td>
                                    <td style="float:right">${{ isset($service->price) ? $service->price : '' }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                            <td colspan="2">Service Fee</td>
                                            <td style="float:right">
                                                ${{ isset($service->service_fee) ? $service->service_fee : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Service Fee Tax</td>
                                            <td style="float:right">
                                                ${{ isset($service->service_fee_tax) ? $service->service_fee_tax : '' }}
                                            </td>
                                        </tr> --}}
                                {{-- <tr>
                                            <td colspan="2">Legal Fee</td>
                                            <td style="float:right">
                                                ${{ isset($service->legal_fee) ? $service->legal_fee : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Legal Fee Tax</td>
                                            <td style="float:right">
                                                ${{ isset($service->legal_fee_tax) ? $service->legal_fee_tax : '' }}</td>
                                        </tr> --}}
                                <tr>
                                    <td colspan="2">Lawyer Fee</td>
                                    <td style="float:right">
                                        ${{ isset($lawyer->lawyer_fee) ? $lawyer->lawyer_fee : 0 }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Lawyer Fee Tax</td>
                                    <td style="float:right">
                                        ${{ isset($lawyer->lawyer_fee_tax) ? $lawyer->lawyer_fee_tax : 0 }}</td>
                                </tr>
                                <tr style="border-top:1px solid #ddd; padding-bottom:20px">
                                    <td colspan="2" style="padding-bottom:10px">
                                        <i class="fa fa-exclamation-circle" style="color:#337ab7"></i>
                                        <strong>Estimated Total</strong>
                                    </td>

                                    @php
                                        if (!empty($service)) {
                                            $estimated_total = $service->price + $lawyer->lawyer_fee + $lawyer->lawyer_fee_tax;
                                        } else {
                                            $estimated_total = 0;
                                        }
                                    @endphp
                                    <td style="float:right" data-price="{{ $estimated_total }}"
                                        data-id="{{ isset($appointment->id) ? $appointment->id : '' }}"
                                        data-lawyer-id="{{ isset($appointment->lawyer_id) ? $appointment->lawyer_id : '' }}"
                                        data-client-id="{{ isset($appointment->client_id) ? $appointment->client_id : '' }}"
                                        id="estimated_total"><strong>${{ $estimated_total }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <h5 class="mt-lg-4 mt-3">Add a payment method</h5>
                <div class="mt-2 text-center">
                    <div class="row">
                        <div class="col-12">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-grid gap-1 d-flex justify-content-md-end">
                    <div class="btn-style py-2"><a
                            href="{{ route('schedule_time', ['id' => isset($appointment->id) ? $appointment->id : null, 'step' => 4]) }}"
                            class="btn-sm ms-auto"><i class="fa fa-chevron-left me-2"></i> Back</a></div>
                </div>
            </div>
        </div>
    </div>

    <div id="loading-message" style="display: none;">
        Loading... Please wait.
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.case_anchor').addClass('disable-click');
            $('.step_complete').removeClass('d-none');
            $('.schedule_anchor .step_complete').show();
        });
    </script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AYSPNrvDxESPQ4mZB-n43cWO4kFXU6KQGGyeaoLAifLCCUGxRtBwGVcybcIpQaclpPTPMmJ04kkQKJJ1">
    </script>
    <script>
        $(document).ready(function() {
            var price = $('#estimated_total').attr('data-price');
            var appointment_id = $('#estimated_total').attr('data-id');
            var lawyer_id = $('#estimated_total').attr('data-lawyer-id');
            var client_id = $('#estimated_total').attr('data-client-id');

            // Render the PayPal button
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'gold',
                    shape: 'pill',
                    label: 'paypal',
                    height: 40,
                    width: 50
                },

                createOrder: function(data, actions) {
                    // Set up the transaction details
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                currency_code: "USD",
                                value: price // Replace with the actual amount from your cart
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // Capture the payment and send the details to the server
                    return actions.order.capture().then(function(details) {
                        // Send the payment details to your server using AJAX
                        $('#loading-message').show();
                        $.ajax({
                            url: '{{ route('payment') }}',
                            type: 'POST',
                            data: {
                                paymentID: data.orderID,
                                payerID: data.payerID,
                                amount: details.purchase_units[0].amount.value,
                                appointment_id: appointment_id,
                                lawyer_id: lawyer_id,
                                client_id: client_id,
                                _token: '{{ csrf_token() }}' // Include the CSRF token-
                            },
                            success: function(response) {
                                // Handle the response from the server
                                console.log(response);
                                window.location.href =
                                    "{{ url('/booking-summary') }}/" +
                                    appointment_id;
                            },
                            error: function(xhr, status, error) {
                                // Handle the error
                                console.log(xhr.responseText);
                            },
                        });
                    });
                }

            }).render('#paypal-button-container');
        })
    </script>
@endsection
