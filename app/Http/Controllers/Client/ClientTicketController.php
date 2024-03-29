<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Models\Enquiry;

use App\Models\TicketChat;

use App\Models\TicketMessageView;

use Illuminate\Http\Request;

use Carbon;

use Auth;

use DB;


class ClientTicketController extends Controller
{
    public function index()
    {

        $data = Enquiry::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(12);
        return view('client.ticket-enquiry.index', compact('data'));
    }


    public function create()
    {
        return view('client.ticket-enquiry.create');
    }

    public function save(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
        ]);

        $data = new Enquiry();
        $data->user_id = Auth::user()->id;
        $data->user_name = Auth::user()->client->first_name . ' ' . Auth::user()->client->last_name;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();
        $data->ticket_id = base64_encode($data->created_at . $data->id);
        $data->save();

        return redirect('/client/ticket-enquiry')->with('success', 'Ticket Enquiry submitted successfully');
    }
    public function join_chat($id)
    {

        $enquiry = Enquiry::Find(base64_decode($id));
        $view = TicketMessageView::where('ticket_id',base64_decode($id))->pluck('msg_id')->toArray();
        $chat =  TicketChat::whereNotIn('id',$view)->where('ticket_id',base64_decode($id))->where('user_id', '!=',Auth::id())->get();
        if (!empty($chat) && count($chat)) {
            foreach ($chat as $c) {
                $c_view = new TicketMessageView();
                $c_view->ticket_id = base64_decode($id);
                $c_view->msg_id = $c->id;
                $c_view->user_id = Auth::id();
                $c_view->save();
            }
        }
        $messages = TicketChat::select('ticket_chat.*', DB::raw("(select users.name from users where users.id = ticket_chat.user_id) as user_name"))->where('ticket_id', $enquiry->id)->get();
        return view('client.ticket-enquiry.ticket_chat', compact('enquiry', 'messages'));
    }

    public function send_msg(Request $request)
    {
        $chat = new TicketChat();
        $chat->message = $request->msg_box;
        $chat->ticket_id = $request->ticket_id;
       
        $chat->user_id = Auth::id();
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
            $chat->message = $chat_image_name;
        }

        $chat->save();

        $msg = '<div class="row no-gutters" style="margin: 10px;">
        <div class="col-xl-5 col-lg-5 col-md-8 col-11 ms-auto send">
            <div class="chat-bubble chat-bubble--right">
                <p class="user_name">' . ucfirst(Auth::user()->name) . '</p>';

        if ($chat->type == 'text') {
            $msg .=  $chat->message;
        } else {
            $msg .= '<a href="' . asset('query_image/' . $chat->message) . '" target="_blank" class="card p-1"><i class="o mr-1" aria-hidden="true"></i>' . $chat->message . '</a>';
        }

        $msg .= '<br><br>
                <span>' . Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $chat->created_at, 'UTC')->setTimezone('Asia/Kolkata')->format('H:i') . '</span>
            </div>
        </div>
    </div>';


        return response()->json(['msg' => $msg, 'last_msg_id' => $chat->id]);
    }

    public function fetch_msg(Request $request)
    {

        $messages = TicketChat::select('ticket_chat.*', DB::raw("(select users.name from users where users.id = ticket_chat.user_id) as user_name"))
            ->when(isset($request->last_msg), function ($query) use ($request) {
                $query->where('id', '>', $request->last_msg);
            })->where('ticket_id', $request->ticket_id)->where('user_id', '!=', Auth::id())->get();

        $msg = '';
        if (count($messages)) {
            foreach ($messages as $message) {
                $msg .= '<div class="row no-gutters" data-msg-id="' . $message->id . '" style="margin: 10px;">
                    <div class="col-xl-5 col-lg-5 col-md-8 col-11 ' . (($message->user_id == Auth::id()) ? 'ms-auto send' : 'me-auto receive') . '">
                        <div class="chat-bubble  ' . (($message->user_id == Auth::id()) ? 'chat-bubble--right' : 'chat-bubble--left') . '">
                            <p class="user_name">' . ucfirst($message->user_name) . '</p>';

                if ($message->type == 'text') {
                    $msg .= $message->message;
                } else {
                    $msg .= '<a href="' . asset('query_image/' . $message->message) . '" target="_blank" class="card p-1"><i class="o mr-1" aria-hidden="true"></i>' . $message->message . '</a>';
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
