<!DOCTYPE html>

<html>

<head>

    <title>Appointment Confirmed</title>

    <style>

        table {

            border-collapse: collapse;

        }

        th, td {

            padding: 8px;

            text-align: left;

            border-bottom: 1px solid #ddd;

        }

    </style>

</head>

<body>

    <h1>Appointment Confirmed</h1>

    @if(isset($client_data) && $client_data == 1)
    <p>Dear <b>{{ isset($appointment->client_name)? $appointment->client_name :'' }}</b>,</p>
    <p>Thank you for booking an appointment!</p>
    @elseif(isset($lawyer_data) && $lawyer_data == 1)
    <p>Dear <b>{{ isset($appointment->lawyer_name)? $appointment->lawyer_name :'' }}</b>,</p>
    @else
    <p>Dear <b>Admin</b>,</p>
    @endif

    <table>
        @if((isset($client_data) && $client_data == 1) || (isset($admin_data) && $admin_data == 1))
        <tr>
            <th>Lawyer:</th>
            <td>{{isset($appointment->lawyer_name)? $appointment->lawyer_name :'' }}</td>
        </tr>
        @endif
        @if((isset($lawyer_data) && $lawyer_data == 1)  ||  (isset($admin_data) && $admin_data == 1))
        <tr>
            <th>Client:</th>
            <td>{{isset($appointment->client_name)? $appointment->client_name :'' }}</td>
        </tr>
        @endif
        <tr>
            <th>Service:</th>
            <td>{{isset($appointment->service_title)?$appointment->service_title :''}}</td>
        </tr>
        <tr>
            <th>Service Price:</th>
            <td>${{ isset($amount) ? $amount: '' }}</td>
        </tr>
        <tr>
            <th>Date and Time:</th>
            <td>{{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
                {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}</td>
        </tr>
    </table>

    <p>Should you have any questions or need further assistance, please don't hesitate to reach out.</p>
    <p>Thank you!</p>

</body>

</html>

