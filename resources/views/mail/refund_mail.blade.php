<!DOCTYPE html>

<html>

<head>

    <title>Refund Confirmation</title>

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

    <h1>Refund Confirmation</h1>

    @if (isset($client_data) && $client_data == 1)
        <p>Dear <b>{{ isset($appointment->client_name) ? $appointment->client_name : '' }}</b>,</p>
    @elseif(isset($lawyer_data) && $lawyer_data == 1)
        <p>Dear <b>{{ isset($appointment->lawyer_name) ? $appointment->lawyer_name : '' }}</b>,</p>
    @else
        <p>Dear <b>Admin</b>,</p>
    @endif

    <p>We hope this email finds you well. We are writing to inform you that the refund for your recent order has been
        successfully initiated. The details of the refund are as follows:</p>
    <table>
        {{-- @if ((isset($client_data) && $client_data == 1) || (isset($admin_data) && $admin_data == 1)) --}}
            <tr>
                <th>Order Number:</th>
                <td>#{{ isset($appointment->booking_code) ? $appointment->booking_code : '' }}</td>
            </tr>
        {{-- @endif
        @if ((isset($lawyer_data) && $lawyer_data == 1) || (isset($admin_data) && $admin_data == 1)) --}}
            <tr>
                <th>Refund Amount: </th>
                <td>${{ isset($payment->price) ? $payment->price : '' }}</td>
            </tr>
        {{-- @endif --}}
        <tr>
            <th>Refund Method: </th>
            <td>PayPal</td>
        </tr>
        <tr>
            <th>Refund Transaction ID: </th>
            <td>{{ isset($payment->refund_id) ? $payment->refund_id : '' }}</td>
        </tr>

    </table>
    <p>Please note that it may take a few business days for the refund to reflect in your account, depending on your bank or payment provider.</p>
    <p>If you have any further questions or concerns regarding this refund, please don't hesitate to contact our customer support team at <b>contact@Faq.com</b>. We'll be happy to assist you.</p>

    <p>Thank you for your understanding and patience throughout this process.</p>
    <p>Best regards,</p>
    <p><b>AllwaysLegal</b></p>

</body>

</html>
