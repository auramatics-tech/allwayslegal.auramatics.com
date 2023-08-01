<!DOCTYPE html>
<html>
<head>
    <title>Appointment Status Change</title>
</head>
<body>
    <h1>Appointment Resheduled</h1>

    @if(isset($client_data) && $client_data == 1)
    <p>Dear <b>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</b>,</p>
    @elseif(isset($lawyer_data) && $lawyer_data == 1)
        <p>Dear <b>{{ isset($appointment->lawyer_name) ? $appointment->lawyer_name : '' }}</b>,</p>
    @endif


    <p>Appointment detail: </p>
    <table>
        @if((isset($client_data) && $client_data == 1))
        <tr>
            <th>Lawyer:</th>
            <td>{{isset($appointment->lawyer_name)? $appointment->lawyer_name :'' }}</td>
        </tr>
        @endif
        @if((isset($lawyer_data) && $lawyer_data == 1))
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
            <th>Date and Time:</th>
            <td>{{ isset($appointment->date) ? date('D, M d', strtotime($appointment->date)) : '' }}
                {{ isset($appointment->start_time) ? date('h:i A', strtotime($appointment->start_time)) : '' }}</td>
        </tr>
    </table>

    <p>Thank you!</p>
</body>
</html>
