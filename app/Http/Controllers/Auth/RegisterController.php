<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Area;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Lawyer;
use App\Models\Client;
use App\Models\LawyerArea;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       
       
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'province' => $data['province'],
            'city' => $data['city'],
            'address' => $data['address'],
            'postal' => $data['postal'],
        ]);

        if(isset( $user)){

            $user_role = new RoleUser;
            $user_role->user_id = $user->id;
            $user_role->role_id = $data['role'];
            $user_role->save();
        }

        $name                   =      $data['name'];
        $name                   =       explode(" ", $name);
        $first_name             =       $name[0];
        $last_name              =       "";
        if(isset($name[1])) {
            $last_name          =       $name[1];
        }

        if( $data['role'] == 3){
     
            $client = new Client;
            $client->user_id  = $user->id;
            $client->first_name = $first_name;
            $client->last_name = $last_name;
            $client->country = $data['country'];
            $client->province = $data['province'];
            $client->city = $data['city'];
            $client->address = $data['address'];
            $client->postal = $data['postal'];
            $client->save();
        }

       if( $data['role'] == 2){
            $lawyer = new Lawyer;
            $lawyer->user_id  = $user->id;
            $lawyer->first_name = $first_name;
            $lawyer->last_name = $last_name;
            $lawyer->country = $data['country'];
            $lawyer->province = $data['province'];
            $lawyer->city = $data['city'];
            $lawyer->address = $data['address'];
            $lawyer->postal = $data['postal'];
            $lawyer->law_firm_reg_no = $data['law_firm_reg_no'];
            $lawyer->enrolment_year = $data['enrolment_year'];
            $lawyer->story = $data['story'];
            $lawyer->save();

            $area = new LawyerArea;
            $area->area_id  = $data['area_id'];
            $area->lawyer_id = $lawyer->id;
            $area->save();
        }
        return $user;
    }

    public function show_register()
    {
        $areas = Area::all();
        $countries = Country::all();
        return view('auth.register', compact('areas','countries'));
    }
    public function get_register_data(Request $request)
    {

        if($request->country_id)
        {
            $data = State::where('country_id', $request->country_id)->get(); 
        }
        else if($request->state_id)
        {
            $data = City::where('state_id', $request->state_id)->get(); 
        }

        return response($data);
    }

}
