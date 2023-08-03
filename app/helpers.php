<?php

use App\Models\Appointment;
use App\Models\Enquiry;
use App\Models\Message;
use App\Models\TicketChat;
use App\Models\RoleUser;
use App\Models\TicketMessageView;
use App\Models\MessageView;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Log;

function getAppointmentsCount()
{
    $app_count = 0;

    if (Auth::user()->lawyer) {
        $app_count = Appointment::where('lawyer_id', Auth::user()->lawyer->id)
            ->where('status', 1)
            ->whereNull('cancelled_at')
            ->count();
    } elseif (Auth::user()->client) {
        $app_count = Appointment::where('client_id', Auth::user()->client->id)
            ->where('status', 1)
            ->whereNull('cancelled_at')
            ->count();
    }

    return $app_count;
}
function getMessageCount($id)
{
    $view = MessageView::where('appointment_id', $id)->pluck('msg_id')->toArray();
    $chat =  Message::whereNotIn('id', $view)->where('appointment_id', $id)->where('sender_id', '!=', Auth::id())->count();
    return $chat;
}

function getTotalMessageCount()
{
    $user = Auth::user();
    $message_appointments = Message::where('sender_id', '!=', $user->id)->pluck('appointment_id')->toArray();
    $unique_appointments = array_unique($message_appointments);
    $total_msg_count = 0;

    foreach ($unique_appointments as $appointment_id) {
        $view = MessageView::where('appointment_id', $appointment_id)->pluck('msg_id')->toArray();
        $chat_count = Message::whereNotIn('id', $view)
            ->where('appointment_id', $appointment_id)
            ->where('sender_id', '!=', $user->id)
            ->count();

        $total_msg_count += $chat_count;
    }

    return $total_msg_count;
}

function getTicketMessageCount($id)
{

    $view = TicketMessageView::where('ticket_id', $id)->pluck('msg_id')->toArray();
    $chat =  TicketChat::whereNotIn('id', $view)->where('ticket_id', $id)->where('user_id', '!=', Auth::id())->count();

    return $chat;
}

function getTotalTicketMessageCount()
{
    $user_id = Auth::id();
    $tickets = Enquiry::where('user_id', $user_id)->pluck('id')->toArray();
    $message_tickets = TicketChat::where('user_id', '!=', $user_id)->whereIn('ticket_id',$tickets)->pluck('ticket_id')->toArray();
    $unique_tickets = array_unique($message_tickets);
    $total_msg_count = 0;

    foreach ($unique_tickets as $ticket_id) {
        $view = TicketMessageView::where('ticket_id', $ticket_id)->pluck('msg_id')->toArray();
        $chat_count = TicketChat::whereNotIn('id', $view)
            ->where('ticket_id', $ticket_id)
            ->where('user_id', '!=', $user_id)
            ->count();
  
        $total_msg_count += $chat_count;
        // echo "<pre>";print_r($total_msg_count);die;
    }

    return $total_msg_count;
}





function create_meeting($topic, $agenda, $start_time, $duration, $zoom_key, $zoom_secret, $zoom_account_id)
{

    $token = "Bearer " . getAccessToken($zoom_key, $zoom_secret, $zoom_account_id);
    $users = getUsers($zoom_key, $zoom_secret, $zoom_account_id, $token);

    $zoom_user_id = $users[0]['id'];
    // echo "<pre>";print_r($zoom_user_id);die;
    // try {
    $meeting = [
        'topic' => $topic,
        'type' => '2',
        'start_time' => toZoomTimeFormat($start_time),
        'duration' => isset($duration) ? $duration : 45,
        'agenda' => $agenda,
        "close_registration" => false,
        'settings' => [
            'host_video' => false,
            'participant_video' => false,
            "approval_type" => 0,
            'waiting_room' => true,
        ]
    ];

    $postData = json_encode($meeting);

    // Set cURL options
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.zoom.us/v2/users/{$zoom_user_id}/meetings");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization:' . $token,
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    curl_close($ch);

    // Handle the response
    $responseData = json_decode($response, true);


    return [
        'success' => true,
        'data' => $responseData,
    ];

    // } catch (\Throwable $th) {
    //     Log::info($th);
    //     return false;
    // }

    return [
        'success' => $response->status() === 201,
        'data' => json_decode($response->body(), true),
    ];
}

function getUsers($zoom_key, $zoom_secret, $zoom_account_id, $token)
{
    $apiEndpoint = "https://api.zoom.us/v2/users";

    $headers = [
        'Authorization:' . $token,
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['users'])) {
        return $responseData['users'];
    } else {
        throw new Exception("Zoom API request failed: " . $responseData['message']);
    }
}


function getAccessToken($zoom_key, $zoom_secret, $zoom_account_id)
{
    $apiEndpoint = "https://zoom.us/oauth/token";

    $credentials = base64_encode($zoom_key . ':' . $zoom_secret);

    $headers = [
        'Authorization: Basic ' . $credentials,
        'Content-Type: application/x-www-form-urlencoded',
    ];

    $queryParameters = 'grant_type=account_credentials&account_id=' . $zoom_account_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $queryParameters);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    return $responseData['access_token'];
}


function toZoomTimeFormat(string $dateTime)
{
    try {
        $date = new \DateTime($dateTime);
        return $date->format('Y-m-d\TH:i:s');
    } catch (\Exception $e) {
        Log::error('toZoomTimeFormat : ' . $e->getMessage());
        return '';
    }
}
