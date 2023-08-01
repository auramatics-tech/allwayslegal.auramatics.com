<?php



namespace App\Http\Controllers\Admin;



use foo\bar;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Role;

use App\Models\User;

use App\Models\Lawyer;

use App\Models\Client;

use App\Models\RoleUser;

use Response;

use Hash;

use Auth;

use Helper;





class PaymentController extends Controller
{
    public function transferMoney()
    {
        // Sample data - you should replace these with your actual data
        $adminPayPalEmail = 'mailto:admin@example.com';
        $supplierPayPalEmail = 'mailto:supplier@example.com';
        $amount = '100.00';
        $currency = 'USD';
        // PayPal API endpoint (sandbox or live)
        $apiEndpoint = 'https://api.sandbox.paypal.com/v1/payments/payouts';
        // PayPal API credentials
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');

        // Create a cURL resource
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'sender_batch_header' => [
                'sender_batch_id' => uniqid(),
                'email_subject' => 'Payment from Admin to Lawyer',
            ],
            'items' => [
                [
                    'recipient_type' => 'EMAIL',
                    'amount' => [
                        'value' => $amount,
                        'currency' => $currency,
                    ],
                    'receiver' => $supplierPayPalEmail,
                ],
            ],
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "{$clientId}:{$secret}");

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle the error here
            $errorMessage = curl_error($ch);
            curl_close($ch);
            return response()->json(['success' => false, 'message' => "cURL Error: {$errorMessage}"]);
        }

        // Close cURL resource
        curl_close($ch);

        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Check the response status
        if (isset($responseData['batch_header']['batch_status']) && $responseData['batch_header']['batch_status'] === 'SUCCESS') {
            // The payout was successful - add your success handling logic here
            return response()->json(['success' => true, 'message' => 'Money transferred successfully']);
        } else {
            // Something went wrong with the payout - add your error handling logic here
            $errorMessage = $responseData['message'] ?? 'Unknown error';
            return response()->json(['success' => false, 'message' => "Payment Error: {$errorMessage}"]);
        }
    }
}
