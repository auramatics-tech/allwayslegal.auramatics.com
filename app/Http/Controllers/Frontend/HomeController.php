<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }
    public function agency()
    {
        return view('frontend.agency');
    }
    public function contact_us()
    {
        return view('frontend.contact_us');
    }
    public function find_legal_help()
    {
        return view('frontend.find_legal_help');
    }
    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }
    public function services()
    {
        return view('frontend.services');
    }
    public function term_of_use()
    {
        return view('frontend.term_of_use');
    }
    public function save_contact_us(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,id'],
        ]);
        $user = new ContactUs();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->message = $request->message;
        $user->save();

        return redirect()->route('contact_us')->with('success', 'Data send successfully');
    }
    public function subscribe_us(Request $request)
    {
         $this->validate($request, [
               'subscribers' => ['required', 'string', 'email', 'max:255'],
            ]);
        // echo "<prE>";print_r($request->all());die;
        $user = User::where('email',$request->subscribers)->first();
        if(empty($user)){
           
            $user = new User();
            $user->email = $request->subscribers;
            $user->password = Hash::make('123456');
            $user->is_subscriber = 1;
            $user->save();
        }
        
        $apiKey = env('MAILCHIMP_API_KEY');
        $listId = env('MAILCHIMP_LIST_ID');

        $memberId = md5(strtolower($user['subscribers']));
    $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

    $json = json_encode([
        'email_address' => $user->email,
        'status'    => 'subscribed',
    ]);
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // echo "<pre>";print_r($result);die;

    return back()->with('success', 'Subscribed successfully');
}

       
    } 

