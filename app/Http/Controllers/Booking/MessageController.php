<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\Message;
use Auth;
use DB;
use Carbon;


class MessageController extends Controller
{
    // public function index()
    // {   
    //     if(!empty(Auth::user()->lawyer->id)){
    //         $data = Appointment::where('lawyer_id', Auth::user()->lawyer->id)->where('status','!=',1)->get();
    //     }else{
    //         $data = Appointment::where('client_id', Auth::user()->client->id)->where('status','!=',1)->get();
    //     }
    //     return view('booking.messages.index', compact('data'));
    // }


    public function index()
    {

        if (!empty(Auth::user()->lawyer->id)) {
            $appointments = Appointment::where('lawyer_id', Auth::user()->lawyer->id)->where('status', '!=', 1)->orderByDesc('created_at')->paginate(10);
        } else {
            $appointments = Appointment::where('client_id', Auth::user()->client->id)->where('status', '!=', 1)->orderByDesc('created_at')->paginate(10);
        }
        return view('booking.messages.index', compact('appointments'));
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
        return view('booking.messages.chat', compact('data', 'messages'));
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
