<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\User;

use Mail;
require_once app_path('helpers.php');
class PayPalPaymentController extends Controller

{

    /**

     * Responds with a welcome message with instructions

     *

     * @return \Illuminate\Http\Response

     */



    public function payment(Request $request)

    {

        $clientID = env('PAYPAL_API_CLIENT_ID');

        $clientSecret = env('PAYPAL_API_CLIENT_SECRET');

        $apiEndpoint = env('PAYPAL_URL');



        $accessToken = $this->getAccessToken($clientID, $clientSecret, $apiEndpoint);



        $orderID = $request->input('paymentID');

        $appointmentID = $request->input('appointment_id');

        $lawyerID = $request->input('lawyer_id');

        $clientID = $request->input('client_id');



        // Get order details using the order ID

        $orderDetails = $this->getOrderDetails($orderID, $accessToken, $apiEndpoint);
        // echo "<pre>";
        // print_r($orderDetails['purchase_units'][0]['payments']['captures'][0]['id']);
        // die;

        if ($orderDetails) {

            $paymentStatus = $orderDetails['status'];

            $this->saveOrderDetails($orderDetails, $orderID, $appointmentID, $lawyerID, $clientID);



            if ($paymentStatus === 'COMPLETED') {

                $appointment = Appointment::find($appointmentID);

                $appointment->status = 3;

                $appointment->save();



                $payment_status = 0;

                header("HTTP/1.1 200 OK");
            } elseif ($paymentStatus === 'PENDING') {

                $payment_status = 1;

                header("HTTP/1.1 200 OK");
            } else {

                $payment_status = 1;

                header("HTTP/1.1 200 OK");
            }

            $payment = Payment::where('paypal_id', $orderID)->first();

            $payment->status = $payment_status;

            $payment->save();
        }

        //send mail for booking confirmation

        $amount = $orderDetails['purchase_units'][0]['amount']['value'];

        $appointment = Appointment::find($appointmentID);

        //Client booking mail
        Mail::send('mail.booking_mail', ['appointment' => $appointment, 'amount' => $amount, 'client_data' => 1], function ($m) use ($appointment) {

            $m->to($appointment->client_email)

                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))

                ->subject(__('Appointment Booked Successfully'));
        });
        $lawyerId = $appointment->lawyer_id;
        $lawyer = Lawyer::find($lawyerId);
        $lawyerUser = User::where('id', $lawyer->user_id)->first();


        //lawyer booking mail
        Mail::send('mail.booking_mail', ['appointment' => $appointment, 'amount' => $amount, 'lawyer_data' => 1], function ($m) use ($lawyerUser) {

            $m->to($lawyerUser->email)

                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))

                ->subject(__('Appointment Booked Successfully'));
        });

        //Admin booking mail
        Mail::send('mail.booking_mail', ['appointment' => $appointment, 'amount' => $amount, 'admin_data' => 1], function ($m) use ($appointment) {

            $m->to(env('MAIL_TO_ADMIN'))

                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))

                ->subject(__('Appointment Booked Successfully'));
        });


        return response($orderDetails);
    }



    /**

     * Retrieves an access token from PayPal API

     */

    private function getAccessToken($clientID, $clientSecret, $apiEndpoint)

    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiEndpoint . '/v1/oauth2/token');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_USERPWD, $clientID . ':' . $clientSecret);

        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');



        $response = curl_exec($ch);

        curl_close($ch);



        $responseData = json_decode($response, true);

        return $responseData['access_token'];
    }



    /**

     * Retrieves the order details from PayPal API

     */

    private function getOrderDetails($orderID, $accessToken, $apiEndpoint)

    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiEndpoint . '/v2/checkout/orders/' . $orderID);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(

            'Authorization: Bearer ' . $accessToken,

            'Accept: application/json',

            'Content-Type: application/json'

        ));



        $response = curl_exec($ch);

        curl_close($ch);



        return json_decode($response, true);
    }



    /**

     * Example function to save the order details in your database

     */

    private function saveOrderDetails($orderDetails, $orderID, $appointmentID, $lawyerID, $clientID)

    {

        $amount = $orderDetails['purchase_units'][0]['amount']['value'];
        $captureID = $orderDetails['purchase_units'][0]['payments']['captures'][0]['id'];

        $create_time = $orderDetails['create_time'];

        $update_time = $orderDetails['update_time'];

        $paymentStatus = $orderDetails['status'];

        $currency = $orderDetails['purchase_units'][0]['amount']['currency_code'];

        $receiver_email = $orderDetails['payment_source']['paypal']['email_address'];

        $payer_email = $orderDetails['payer']['email_address'];


        // Save the order details to your database

        $payment = new Payment();

        $payment->paypal_id = $orderID;

        $payment->capture_id = $captureID;

        $payment->payer_id = $payer_email;

        $payment->appointment_id = $appointmentID;

        $payment->lawyer_id = $lawyerID;

        $payment->client_id = $clientID;

        $payment->price = $amount;

        $payment->status = $paymentStatus;

        $payment->created_at = $create_time;

        $payment->updated_at = $update_time;

        $payment->save();



        $appointment = Appointment::find($appointmentID);

        $appointment->payment_id = $orderID;

        $appointment->save();
    }


    public function booking_summary($id)

    {
        $appointment = Appointment::find($id);

        $topic ="Case Discussion";
        $start_time =$appointment->start_time;
        $zoom_key = env('ZOOM_KEY');
        $zoom_secret = env('ZOOM_SECRET');
        $zoom_account_id = env('ZOOM_ACCOUNT_ID');
        $meeting = create_meeting($topic, $topic, $start_time, 45, $zoom_key, $zoom_secret ,$zoom_account_id);


        $appointment->uuid = $meeting['data']['uuid'];
        $appointment->zoom_id = $meeting['data']['id'];
        $appointment->start_url = $meeting['data']['start_url'];
        $appointment->join_url = $meeting['data']['join_url'];
        $appointment->save();

        // echo "<pre>";
        // print_r( $appointment);
        // die;

        return view('booking.booking_successful', compact('appointment'));
    }

    public function appointment_cancel(Request $request)

    {
        $appointment = Appointment::where('id', $request->id)->first();

        $currentDateTime = date('Y-m-d H:i:s');
        $appointmentStartTime = $appointment->start_time;

        // Convert appointment start time and current date time to Unix timestamps
        $appointmentTimestamp = strtotime($appointmentStartTime);
        $currentTimestamp = strtotime($currentDateTime);


        if ($currentTimestamp < $appointmentTimestamp) {
            $payment = Payment::where('appointment_id', $request->id)->first();

            $orderID =  $payment->paypal_id;
            $orderPrice =  $payment->price;
            $captureID =  $payment->capture_id;

            $orderRefund = $this->getRefundPayment($orderID, $orderPrice, $captureID);

            //  Process and use the refund details
            $refundID = $orderRefund['id'];
            $refundStatus = $orderRefund['status'];

            $payment = Payment::where('paypal_id', $orderID)->first();
            $payment->refund_id = $refundID;
            $payment->refund_status = $refundStatus;
            $payment->save();

            if ($appointment->status == 3 || $appointment->status == 5) {
                $appointment->status = 4;
                $appointment->save();
            }

            //Client refund mail
            Mail::send('mail.refund_mail', ['appointment' => $appointment,'payment' => $payment, 'client_data' => 1], function ($m) use ($appointment) {
                $m->to($appointment->client_email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Refund Confirmation - Order #'.$appointment->booking_code));
            });

            $lawyerId = $appointment->lawyer_id;
            $lawyer = Lawyer::find($lawyerId);
            $lawyerUser = User::where('id', $lawyer->user_id)->first();

            //lawyer refund mail
            Mail::send('mail.refund_mail', ['appointment' => $appointment,'payment' => $payment, 'lawyer_data' => 1], function ($m) use ($lawyerUser, $appointment) {
                $m->to($lawyerUser->email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Refund Confirmation - Order #'.$appointment->booking_code));
            });

            //Admin refund mail
            Mail::send('mail.refund_mail', ['appointment' => $appointment,'payment' => $payment, 'admin_data' => 1], function ($m) use ($appointment) {
                $m->to(env('MAIL_TO_ADMIN'))
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Refund Confirmation - Order #'.$appointment->booking_code));
            });

            return redirect()->back()->with('success', 'Refund initiated successfully.');

        } else {

            return redirect()->back()->with('error', 'Appointment time has expired; therefore, no refunds are available.');

        }
    }

    public function getRefundPayment($orderID, $orderPrice, $captureID)
    {

        $clientID = env('PAYPAL_API_CLIENT_ID');
        $clientSecret = env('PAYPAL_API_CLIENT_SECRET');
        $apiEndpoint = env('PAYPAL_URL');

        // Get access token
        $accessToken = $this->getAccessToken($clientID, $clientSecret, $apiEndpoint);

        // Prepare the refund request payload
        $requestData = array(
            'amount' => array(
                'value' => $orderPrice,
                'currency_code' => 'USD'
            )
        );


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiEndpoint . '/v2/payments/captures/' . $captureID . '/refund');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            $json['error'] = $error;
            return $this->response->setOutput(json_encode($json));
        } else {
            $result = json_decode($response, true);
            curl_close($ch);
            return $result;
        }
    }

    // public function refund_success()
    // {
    //     return view('booking.refund_success');
    // }
}
