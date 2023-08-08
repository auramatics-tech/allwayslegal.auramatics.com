<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ContactUs;
use Auth;
class AdminController extends Controller
{

    public function index()
    {
        $admin =Auth:: user();
        return view('admin.edit_profile',compact('admin'));
    }

    public function change_password(Request $request)
    {
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
    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if(isset($request->profile_photo_path)){
            $file = $request->file('profile_photo_path');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('user_profile/'), $imageName);
            $user->profile_photo_path = $imageName;
        }  
        
            // $user->phone_no = $request->phone_no;
            // $user->address = $request->address;
            // $user->city = $request->city;
            // $user->state = $request->state;
            // $user->country = $request->country;
            // $user->zip_code = $request->zip_code;
        $user->save();
        return redirect()->back()->with('success', 'Data updated successfully.'); 
    }
    public function contact_us_listing(Request $request)
    {
        $contacts = ContactUs::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(email LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);

        return view('admin.contacts.index',compact('contacts'));
        
    }
    public function contact_udetail($id)
    {
        $contact = ContactUs::Find($id);
        return view('admin.contacts.detail', compact('contact'));
    }
    public function delete_contact($id)
    {
        $contact = ContactUs::Find($id);
        $contact->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}