<!DOCTYPE html>
<html>
<head>
    <title>Appointment Detail</title>
    <style>

    </style>
</head>
<body>
    <h1>Appointment Detail</h1>

    <p>Dear {{isset($appointment->client_name) ? $appointment->client_name : '' }},</p>

    <p>Here is your Appointment Details!</p>
    
    <p>Should you have any questions or need further assistance, please don't hesitate to reach out.</p>
    <p>Thank you!</p>
    </body>
</html>