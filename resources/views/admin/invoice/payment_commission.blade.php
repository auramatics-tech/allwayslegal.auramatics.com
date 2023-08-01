{{--<!DOCTYPE html>
<html>

<head>
    <title>Appointment Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .appointment-table,
        .payment-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .invoice-header p {
            margin: 0;
        }

        .invoice-footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h1>Appointment Detail</h1>
        <p>Here is your Appointment Details!</p>
    </div>

    <table class="appointment-table">
        <tr>
            <th>Client Name:</th>
            <td>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</td>
</tr>
<tr>
    <th>Booking ID:</th>
    <td>{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}</td>
</tr>
<tr>
    <th>Practice Area:</th>
    <td>{{ isset($appointment->area_name) ? $appointment->area_name : '' }}</td>
</tr>
<tr>
    <th>Service:</th>
    <td>{{ isset($appointment->service_title) ? $appointment->service_title : '' }}</td>
</tr>
<tr>
    <th>Date and Time:</th>
    <td>
        {{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
        {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}
    </td>
</tr>
<tr>
    <th>Case Title:</th>
    <td>{{ isset($appointment->case_title) ? $appointment->case_title : '' }}</td>
</tr>
<tr>
    <th>Case Note:</th>
    <td>{{ isset($appointment->case_note) ? $appointment->case_note : '' }}</td>
</tr>
<tr>
    <th>Status:</th>
    <td>
        @if (isset($appointment->status) && $appointment->status == 1)
        <span>Requested</span>
        @elseif(isset($appointment->status) && $appointment->status == 2)
        <span>Request Accepted</span>
        @else
        <span>Confirmed</span>
        @endif
    </td>
</tr>
</table>

<div class="invoice-header">
    <h2>Payment Detail</h2>
</div>

<table class="payment-table">
    <tr>
        <th>Service amount</th>
        <td>${{ isset( $service->price) ?  $service->price : '' }}</td>
    </tr>
    <tr>
        <th>Service fee</th>
        <td>${{ isset( $service->service_fee) ?  $service->service_fee : '' }}</td>
    </tr>
    <tr>
        <th>Service fee tax</th>
        <td>${{ isset( $service->service_fee_tax) ?  $service->service_fee_tax : '' }}</td>
    </tr>
    <tr>
        <th>Legal fee</th>
        <td>${{ isset( $service->legal_fee) ?  $service->legal_fee : '' }}</td>
    </tr>
    <tr>
        <th>Legal fee tax</th>
        <td>${{ isset( $service->legal_fee_tax) ?  $service->legal_fee_tax : '' }}</td>
    </tr>
    <tr>
        <th>Lawyer fee</th>
        <td>${{ isset( $lawyer->lawyer_fee) ?  $lawyer->lawyer_fee : '' }}</td>
    </tr>
    <tr>
        <th>Lawyer fee tax</th>
        <td>${{ isset( $lawyer->lawyer_fee_tax) ?  $lawyer->lawyer_fee_tax : '' }}</td>
    </tr>
    <tr>
        <th>Amount Paid</th>
        <td>${{ isset($payments->price) ? $payments->price : '' }}</td>
    </tr>
    <tr>
        <th>Commission (20%)</th>
        <td>${{ isset($payments->price) ? $payments->price * 0.2 : '' }}</td>
    </tr>
    <tr>
        <th>Total</th>
        @php

        $total = $service->price + $service->service_fee + $service->service_fee_tax + $service->legal_fee + $service->legal_fee_tax +
        $lawyer->lawyer_fee + $lawyer->lawyer_fee_tax + $payments->price - $payments->price * 0.2 ;

        @endphp
        <td>${{ $total }}</td>
    </tr>
</table>

</body>

</html>--}}

<!DOCTYPE html>

<html lang="en">



<head>

    <title>Appointment</title>

    <style>
        body {

            font-family: Arial, Helvetica, sans-serif;

        }

        table,

        th,

        td {

            border: 1px solid black;

            border-collapse: collapse;

            padding-left: 5px;

        }

        h6 {

            font-family: Arial, Helvetica, sans-serif;

            margin: 0px;

            font-size: 18px;

        }

        h2 {

            margin: 5px 0px 5px 0px;

            font-size: 30px;

        }

        p {

            margin: 0 0 5px 0;

        }

        .row6 div {

            margin-bottom: 20px;

            min-height: 20px;

        }
    </style>

</head>



<body>

    <table style="width:100%">

        <tbody>

            <tr>

                <td colspan="7" style="text-align:center;">

                    <h6>Appointment Detail</h6>

                </td>

            </tr>

            <tr class="row2">

                <td colspan="7" style="text-align:center;padding-bottom: 10px;">

                    <h2>ALLWAYSLEGAL</h2>

                    <p>08 W 36th St, New York</p>

                    <p> NY 10001</p>

                </td>

            </tr>

            <tr class="row3">

                <td rowspan="2" colspan="2" style="width:240px;vertical-align: baseline;">

                    <span style="font-size: 14px;">Name: </span>

                    <p style="font-size: 22px;margin-bottom: 40px; margin-top:10px"><b>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</b>
                    </p>

                    <span style="font-size: 14px;">Area: </span>

                    <p style="font-size: 16px; margin-bottom: 0px;"><b>{{ isset($appointment->area_name) ? $appointment->area_name : '' }}</b></p>

                </td>

                <td rowspan="2" colspan="3" style="vertical-align: baseline;">

                    <span style="font-size: 14px;">Service:</span>

                    <p><b>{{ isset($appointment->service_title) ? $appointment->service_title : '' }}</b><br><br>

                        <span style="font-size: 14px;">Case Title:</span>

                    <p><b>{{ isset($appointment->case_title) ? $appointment->case_title : '' }}</b>


                </td>

                <td style="text-align:center;padding: 15px;">

                    <p style="font-size: 16px;"> Booking Code:</p>

                </td>

                <td style="text-align:center;padding: 15px;">

                    <p style="font-size: 16px;">Dated:</p>

                </td>

            </tr>

            <tr class="row4">

                <td style="text-align:center;padding: 15px 0px;">

                    <p>{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}</p>

                </td>

                <td style="text-align:center;padding: 15px 0px;">

                    <p> {{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
                        {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}
                    </p>

                </td>

            </tr>

            <tr class="row3">

                <th colspan="5" style="text-align: left; width:250px; ">

                    <div style="width:240px">Details</div>

                </th>

                <th>

                    <div>Rate</div>

                </th>

                <th>

                    <div style="padding:10px;">Amount</div>

                </th>

            </tr>

            <tr class="row6">

                <th colspan="5" style="text-align: left; height: 400px;">

                    <div>Service Amount</div>

                    <div>Lawyer Fee </div>

                    <div>Lawyer Fee Tax</div>

                    <div>Amount Paid</div>

                    <div>Commission</div>

                </th>

                <td style="text-align:center;">

                    <div style="height: 20px"> </div>

                    <div style="height: 20px"></div>

                    <div style="height: 20px"></div>

                    <div style="height: 20px"></div>

                    <div style="height: 20px">20%</div>

                </td>


                <td style="text-align:center;">

                    <div style="height: 20px">${{ isset( $service->price) ?  $service->price : '' }} </div>

                    <div style="height: 20px">${{ isset( $lawyer->lawyer_fee) ?  $lawyer->lawyer_fee : '' }}</div>

                    <div style="height: 20px">${{ isset( $lawyer->lawyer_fee_tax) ?  $lawyer->lawyer_fee_tax : '' }}</div>

                    <div style="height: 20px">${{ isset($payments->price) ? $payments->price  : '' }}</div>

                    <div style="height: 20px">${{ isset($payments->price) ? $payments->price * 0.2 : '' }}</div>

                </td>

            </tr>

            <tr class="row7">

                <td colspan="6">

                    <div><b>Total </b></div>
                    @php

                    $total = $service->price + $lawyer->lawyer_fee + $lawyer->lawyer_fee_tax + $payments->price - $payments->price * 0.2 ;

                    @endphp
                </td>

                <td style="text-align:center;">
                    <div>${{ $total}} </div>
                </td>

            </tr>

            <tr class="row8">

                <td colspan="2">

                    <div style="margin-bottom: 10px;font-size: 14px;">Amount Chargeable (in words)</div>

                    <div style="font-size: 14px;"><b>Company's PAN:</b></div>

                </td>

                <td></td>

                <td></td>

                <td></td>

                <td colspan="2" style="padding: 10px 0; text-align: center;">

                    <div style="font-size: 14px;"><b>For Allwayslegal </b></div>

                    <div style="font-size: 14px;">Authorised Signatory</div>

                </td>

            </tr>

            <tr class="row9">

                <td colspan="7">
                    <div style="padding: 10px 0px;"></div>
                </td>

            </tr>



        </tbody>

    </table>

</body>

</html>