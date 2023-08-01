<?php



namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Enquiry;

use App\Models\TicketChat;

use Carbon;

use Auth;

use DB;

class TicketController extends Controller

{

    public function index(Request $request)
    {
        $data = Enquiry::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(title LIKE '%" . $request->q . "%' or description LIKE '%" . $request->q . "%' )");
        })
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('admin.ticket.index', compact('data'));
    }

    public function changestatus(Request $request)
    {
        $leads = Enquiry::find($request->id);
        $leads->status = $request->status;
        $leads->save();
        return response()->json(['success' => true]);
    }

    public function join_chat($id)
    {
        $enquiry = Enquiry::Find(base64_decode($id));
        $messages = TicketChat::select('ticket_chat.*', DB::raw("(select users.name from users where users.id = ticket_chat.user_id) as user_name"))->where('ticket_id', $enquiry->id)->get();
        //    echo"<pre>";
        //    print_r(  $enquiry);
        //    die;
        return view('admin.ticket.ticket_chat', compact('enquiry', 'messages'));
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
            $msg .= $chat->message;
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
            })->where('ticket_id', $request->ticket_id)->where('user_id','!=',Auth::id())->get();

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
