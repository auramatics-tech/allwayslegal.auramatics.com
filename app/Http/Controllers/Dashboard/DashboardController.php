<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\User;
use Auth;
use Hash;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = RoleUser::where('user_id',Auth::user()->id)->first();
        if($role->role_id == 2){
            return redirect()->route('lawyer.dashboard');
        }elseif($role->role_id == 3){
            return redirect()->route('client.dashboard');
        }
    }
    public function show(){
        return view('booking.change_password');
    }

    public function change_password_save(Request $request)

    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|max:8',
            'confirm_password' => 'required|string|min:6|max:8',
        ]);

        $data = $request->except('_token');
        $check = Hash::check($data['current_password'], auth()->user()->password);
        if(!$check)
        {
            return redirect()->back()->with('error', 'Your current password is wrong.'); 
        }

        if($data['new_password'] != $data['confirm_password'])
        {
            return redirect()->back()->with('error', 'New password and confirm password does not match.');  
        }

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Password successfully changed.'); 

    }
}
