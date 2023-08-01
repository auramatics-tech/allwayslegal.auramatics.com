<!DOCTYPE html>
<html>
<head>
    <title>Appointment Status Change</title>
</head>
<body>
    <h1>Appointment Status Change</h1>

    @if(isset($client_data) && $client_data == 1)
    <p>Dear <b>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</b>,</p>
    @elseif(isset($lawyer_data) && $lawyer_data == 1)
        <p>Dear <b>{{ isset($appointment->lawyer_name) ? $appointment->lawyer_name : '' }}</b>,</p>
    @elseif(isset($admin_data) && $admin_data == 1)
        <p>Dear <b>Admin</b>,</p>
    @endif


    <p>Your appointment status has been changed to 
        <b>  
            @if (isset($appointment->status) && $appointment->status == 2)
            Request Accepted
            @endif
        </b>.
    </p>

    <p>Thank you!</p>
</body>
</html>
