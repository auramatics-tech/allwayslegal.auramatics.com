<!DOCTYPE html>

<html>

<head>

    <title>Invoice</title>

    <style>
        table {

            border-collapse: collapse;

        }

        th,
        td {

            padding: 8px;

            text-align: left;

            border-bottom: 1px solid #ddd;

        }
    </style>

</head>

<body>

    <h1>Appointment Detail </h1>
   
    <p>Dear Admin<b>
           
        </b>,</p>

    <p>Here is your Appointment Details!</p>

    <table>

        <tr>
            <th>Booking ID:</th>
            <td>{{isset($appointment->booking_code)? $appointment->booking_code :'' }}</td>
        </tr>

        <tr>
            <th> Client:</th>
            <td>{{isset($appointment->client_name)? $appointment->client_name :'' }}</td>
        </tr>

        <tr>
            <th> Practice Area:</th>
            <td>{{ isset($appointment->area_name) ? $appointment->area_name : '' }}</td>
        </tr>
        <tr>
            <th>Service :</th>
            <td>{{ isset($appointment->service_title) ? $appointment->service_title : '' }}</td>
        </tr>
        <tr>
            <th>Date and Time:</th>
            <td>{{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
                {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}
            </td>
        </tr>
        <tr>
            <th> Case Title: </th>
            <td>
                {{ isset($appointment->case_title) ? $appointment->case_title : '' }}
            </td>
        </tr>
        <tr>
            <th> Case Note</th>
            <td>{{ isset($appointment->case_note) ? $appointment->case_note : '' }}</td>
        </tr>
        <tr>

            <th> Case File</th>
            <td>
                <div>
                    <a href="{{ asset('public/'.isset($appointment->case_file) ? $appointment->case_file : '')}}" target="_blank" rel="noopener noreferrer">view</a>

                </div>
            </td>
        </tr>
        <tr>

            <th> Created On</th>
            <td>{{ isset($appointment->created_at) ? date_format($appointment->created_at, 'd/m/Y H:i:s') : '' }}
            </td>
        </tr>
        <tr>

            <th> Status</th>
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
        </tbody>
    </table>
    @if (isset($appointment->status) && $appointment->status == 3)
    <div>
        <h4>Payment Detail</h4>
    </div>

    <table>
        <tbody>
            <tr>

                <th>Service amount</th>
                <td>${{ isset($appointment->service_price) ? $appointment->service_price : '0' }}</td>
            </tr>
            <tr>

                <th>Lawyer fee</th>
                <td>${{ isset($appointment->lawyer_fee) ? $appointment->lawyer_fee : '0' }}</td>
            </tr>
            <tr>

                <th>Lawyer fee tax</th>
                <td>${{ isset($appointment->lawyer_fee_tax) ? $appointment->lawyer_fee_tax : '0' }}</td>
            </tr>
            <tr>
                <th></th>
                <th>Total</th>
                @php
                if(!empty($appointment))
                $total = $appointment->service_price + $appointment->lawyer_fee + $appointment->lawyer_fee_tax ;
                else
                $total = 0;

                @endphp
                <td>${{ $total }}</td>
            </tr>
    </table>
    @endif
    <p>Should you have any questions or need further assistance, please don't hesitate to reach out.</p>
    <p>Thank you!</p>

</body>

</html>