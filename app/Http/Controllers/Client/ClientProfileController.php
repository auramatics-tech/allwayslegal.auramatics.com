<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
;
use App\Models\Client;
use App\Models\User;
use Auth;
use App\Traits\AddressTrait;

class ClientProfileController extends Controller
{
    use AddressTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.profile.index', [
            'client' => Auth::user()->client,
            'index' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $request)
    {
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $client = Client::where('user_id', $id)->first();

        $countries =  $this->getCountries();
        $provinces = $this->getStates();
        $cities = $this->getCities();

        return view('client.profile.edit',compact('client','countries', 'provinces' ,'cities' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
       
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required'],
            'country' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
        ]);

       $client = Client::findOrFail($id);
    
       $client->update($request->except(['_token']));

        return redirect('client/dashboard')->with('success', 'Data updated successfully');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function upload_profile(Request $request)
    {
        $this->validate($request, [
            'profile_photo_path' => ['required'],
        ]);

        $user = User::Find(Auth::user()->id);

        if(isset($request->profile_photo_path)){

            $file = $request->file('profile_photo_path');

            $imageName = time() . '.' . $file->extension();

            $file->move(public_path('user_profile/'), $imageName);

            $user->profile_photo_path = $imageName;

        }   
        $user->save();
            
        return back()->with('success', 'Profile image updated successfuly');
    }
}
