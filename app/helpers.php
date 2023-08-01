<?php

use App\Models\Appointment;
use App\Models\Message;
use App\Models\TicketChat;
use Illuminate\Support\Facades\Auth;
use Log;

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
    $msg_count = 0;

    if (Auth::user()->lawyer) {
        $msg_count = Message::where('appointment_id',$id)
            ->where('seen', 1)->where('sender_id',Auth::id())
            ->count();
            // echo"<pre>";print_r($msg_count);die;
    } elseif (Auth::user()->client) {
        $msg_count = Message::where('appointment_id',$id)
            ->where('seen', 1)->where('sender_id',Auth::id())
            ->count();
    }
    return $msg_count;
}
function getTicketMessageCount()
{
    $ticketmsg_count = 0;

    if (Auth::user()->lawyer) {
        $ticketmsg_count = TicketChat::where('user_id', Auth::user()->lawyer->id)
            ->where('seen', 1)
            ->count();
    }
    return $ticketmsg_count;
}
function create_meeting($topic, $agenda, $start_time, $duration, $zoom_key, $zoom_secret, $zoom_account_id)
{

    $token = "Bearer " .getAccessToken($zoom_key, $zoom_secret ,$zoom_account_id);      
    $users = getUsers($zoom_key, $zoom_secret, $zoom_account_id ,$token);

    $zoom_user_id =$users[0]['id'];
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
        'Authorization:'.$token,
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
