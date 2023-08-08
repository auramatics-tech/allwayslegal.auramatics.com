<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Appointment;

use App\Models\Lawyer;

use App\Models\Payment;

use App\Models\Message;

use App\Models\Service;

use App\Models\Payouts;

use Auth;

use DB;

use PDF;

use Mail;

use App\Models\RoleUser;

use App\Models\User;

use Carbon;

class AppointmentController extends Controller

{
    public function index(Request $request)
    {
        $appointments = Appointment::when(isset($request->q), function ($query) use ($request) {

            $query->whereRaw("(service_title LIKE '%" . $request->q . "%' or area_name LIKE '%" . $request->q . "%' or lawyer_name LIKE '%" . $request->q . "%' or client_name LIKE '%" . $request->q . "%' or case_title LIKE '%" . $request->q . "%' or lawyer_name LIKE '%" . $request->q . "%' or booking_code LIKE '%" . $request->q . "%'  )");
        })->orderby('id', 'desc')->paginate(12);

        return view('admin.appointments.index', compact('appointments'));
    }
    public function details($id)
    {
        $appointment = Appointment::where(['id' => Auth::user()->id, 'id' => $id])->first();

        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
            $service = Service::where('id', $appointment->service_id)->first();
        }
        $appointment->service_price = $service->price;
        $appointment->lawyer_fee = $lawyer->lawyer_fee;
        $appointment->lawyer_fee_tax = $lawyer->lawyer_fee_tax;
        // echo "<pre>";print_r($appointment);die;
        return view('admin.appointments.details', compact('appointment'));
    }

    public function save_approve(Request $request)
    {
        $appointment = Appointment::find($request->appt_id);
  // echo"<pre>";print_r($lawyer);die;
        $lawyer = Lawyer::find($appointment->lawyer_id);
        if (isset($lawyer->paypal_email_id)) {
            $service = Service::where('id', $appointment->service_id)->first();

            $admin_id = RoleUser::where('role_id', 1)->pluck('user_id')->toArray();
            $admin_emails = User::whereIn('id', $admin_id)->pluck('email')->toArray();
            $data = Appointment::find($request->appt_id);
            $data->payment_release = 2;

            $payments = Payment::where('lawyer_id', $appointment->lawyer_id)->first();
            $payouts = $this->payout($appointment,$lawyer, $payments);
            if(isset( $payouts)){
                $pdf = PDF::loadView('admin.invoice.payment_commission', compact('appointment', 'payments', 'lawyer', 'service'));
                $pdf_path = public_path('invoice/commission-invoice-000' . $data->id . '.pdf');
                $pdf->save($pdf_path);

                // Update the invoice_pdf field in the $data object
                $name = 'commission-invoice-000' . $data->id . '.pdf';
                $data->invoice_pdf = $name;
                $data->save();
                // Get the PDF attachment path
                $pdf_attach = public_path('invoice/' . $data->invoice_pdf);

                // Send email to the client with the attached PDF
                Mail::send('mail.commission', compact('data', 'appointment'), function ($message) use ($data, $pdf_attach) {
                    $message->to($data->client_email)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                        ->subject('You have received a payout!')
                        ->attach($pdf_attach);
                });
                    Mail::send('mail.commission', compact('appointment'), function ($message) use ($pdf_attach) {
                        $message->to(env('MAIL_TO_ADMIN'))
                            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->subject('Payout sent to lawyer!')->attach($pdf_attach);
                    });
                return redirect()->back()->with('success', 'Approved and Money transferred successfully');
            }else{
                return redirect()->back()->with('error', 'Money not transferred!');
            }
            // echo "<pre>";print_r($payouts);die;
        } else {
            return redirect()->back()->with('error', 'Lawyer Paypal Email Not found!');
        }
    }
    public function payout($appointment ,$lawyer, $payments)
    {

        // $adminPayPalEmail = env('PAYPAL_EMAIL');
        $lawyerPayPalEmail = $lawyer->paypal_email_id;
        // echo "<pre>";print_r($lawyerPayPalEmail);die;
        $amount = $payments->price;
        $admin_commision = $amount * 0.8;

        $currency = 'USD';

        // PayPal API endpoint (sandbox or live)
        $apiEndpoint =  env('PAYPAL_URL') . '/v1/payments/payouts';

        // PayPal API credentials
        $clientId = env('PAYPAL_API_CLIENT_ID');
        $secret = env('PAYPAL_API_CLIENT_SECRET');
        $uniqueBatchId = "Payouts_" . date('YmdHisu') . '_' . $appointment->id;

        // Create a cURL resource
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "items"=> [
              [
                "receiver"=> $lawyerPayPalEmail,
                "amount"=> [
                  "currency"=> $currency,
                  "value"=> $admin_commision
                ],
                "recipient_type"=> "EMAIL",
                "note"=> "Thanks for your patronage!",
                "sender_item_id"=> date('Ymd',strtotime($appointment->created_at)).$appointment->id,
                "recipient_wallet"=> "PAYPAL"
                ]
            ],
            "sender_batch_header"=> [
              "sender_batch_id"=> $uniqueBatchId,
              "email_subject"=> "You have a payout!",
              "email_message"=> "You have received a payout! Thanks for using our service!"
              ]
          ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD, "{$clientId}:{$secret}");

        // Execute the cURL request
        $response = curl_exec($ch);
        // echo "<pre>";print_r( $response);die;
        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle the error here
            $errorMessage = curl_error($ch);
            curl_close($ch);
            return response()->json(['success' => false, 'message' => "cURL Error: {$errorMessage}"]);
        }
        curl_close($ch);
        $responseData = json_decode($response, true);
        // echo "<pre>";print_r($responseData);die;
        if(isset($responseData['batch_header']['payout_batch_id'])){
            $payouts =  new Payouts();
                $payouts->lawyer_id =  $appointment->lawyer_id;
                $payouts->appointments_id =  $appointment->id;
                $payouts->client_id =  $appointment->client_id;
                $payouts->payout_batch_id = $responseData['batch_header']['payout_batch_id'];
                $payouts->batch_status = $responseData['batch_header']['batch_status'];
                $payouts->sender_batch_id = $responseData['batch_header']['sender_batch_header']['sender_batch_id'];
                $payouts->total_amount =   $amount;
                $payouts->paid_amount =   $admin_commision;
                $payouts->save();
        }
        return $response;


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

    public function save_disapprove(Request $request)
    {
        $this->validate(request(), [
            'comment' => 'required',
        ],   [
            'comment.required' => 'The comment field is required.',
        ]);

        $data = Appointment::find($request->appt_id);
        // echo "<pre>";print_r($request->all());die;
        $data->comment = $request->comment;
        $data->payment_release = 3;
        $data->save();
        return redirect()->back()->with('success', 'Comment submitted Successfully!');
    }

    public function chat($id)
    {

        $data = Appointment::find($id);

        // echo"<pre>";print_r($data);die;
        $chat =  Message::where('appointment_id', $id)->orderBy('id', 'desc')->get();
        //  echo"<pre>";print_r($chat);die;
        if (!empty($chat) && count($chat)) {
            foreach ($chat as $c) {
                $c->seen = 0;
                $c->save();
            }
        }
        $messages = Message::select('messages.*', DB::raw("(select users.name from users where users.id = messages.sender_id) as user_name"))->where('appointment_id', $data->id)->get();
        return view('admin.appointments.view_chat', compact('data', 'messages'));
    }

    public function send_message(Request $request)
    {
        $chat = new Message();
        $chat->body = $request->msg_box;
        $chat->appointment_id = $request->appointment_id;
        $chat->seen = 1;
        $chat->sender_id = Auth::id();

        if ($request->image) {
            $chat->type = 'image';
        } else {
            $chat->type = 'text';
        }
        if (isset($request->image)) {
            $videoFile = $request->file('image');
            $extension = strtolower($videoFile->getClientOriginalExtension());
            $chat_image_name = substr(uniqid(), 4) . '_' . $videoFile->getClientOriginalName();
            $videoFile->move(public_path('query_image'), $chat_image_name);
            $chat->body = $chat_image_name;
        }

        $chat->save();

        $msg = '<div class="row no-gutters" >
        <div class="col-xl-5 col-lg-5 col-md-8 col-11 ms-auto send">
            <div class="chat-bubble chat-bubble--right">
                <p class="user_name">' . ucfirst(Auth::user()->name) . '</p>';

        if ($chat->type == 'text') {
            $msg .=  $chat->body;
        } else {
            $msg .= '<a href="' . asset('query_image/' . $chat->body) . '" target="_blank" class="card p-1"><i class="o mr-1" aria-hidden="true"></i>' . $chat->body . '</a>';
        }

        $msg .= '<br><br>
                <span>' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $chat->created_at, 'UTC')->setTimezone('Asia/Kolkata')->format('H:i') . '</span>
            </div>
        </div>
    </div>';

        return response()->json(['msg' => $msg, 'last_msg_id' => $chat->id]);
    }


    public function fetch_message(Request $request)
    {
        $messages = Message::select('messages.*', DB::raw("(select users.name from users where users.id = messages.sender_id) as user_name"))
            ->when(isset($request->last_msg), function ($query) use ($request) {
                $query->where('id', '>', $request->last_msg); })
                ->where('appointment_id', $request->appointment_id)->where('sender_id','!=',Auth::id())->get();

        $msg = '';
        if (count($messages)) {
            foreach ($messages as $message) {
                $msg .= '<div class="row no-gutters" data-msg-id="' . $message->id . '">
                    <div class="col-xl-5 col-lg-5 col-md-8 col-11 ' . (($message->sender_id == Auth::id()) ? 'ms-auto send' : 'me-auto receive') . '">
                        <div class="chat-bubble  ' . (($message->sender_id == Auth::id()) ? 'chat-bubble--right' : 'chat-bubble--left') . '">
                            <p class="user_name">' . ucfirst($message->user_name) . '</p>';

                if ($message->type == 'text') {
                    $msg .= $message->body;
                } else {
                    $msg .= '<a href="' . asset('query_image/' . $message->body) . '" target="_blank" class="card p-1"><i class="o mr-1" aria-hidden="true"></i>' . $message->body . '</a>';
                }

                $msg .= '<br><br>
                        <span>' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at, 'UTC')->setTimezone('Asia/Kolkata')->format('H:i') . '</span>
                    </div>
                </div>
            </div>';
            }
        }

        return response(['msg' => $msg, 'last_msg_id' => isset($messages->last()->id) ? $messages->last()->id : $request->last_msg]);
    }
}
