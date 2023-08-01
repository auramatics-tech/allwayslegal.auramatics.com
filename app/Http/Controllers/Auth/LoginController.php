<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\RoleUser;
use App\Models\User;

use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    public function user_login(Request $request){
       
        $input = $request->all();
       $this->validate($request, [
           'email' => 'required',
           'password' => 'required',
       ]);
 
       $fieldType = User::where('email', $input['email'])->first();
      
       if (isset($fieldType->id)) {
           $role = RoleUser::where('user_id',$fieldType->id)->first();
 
           if(isset($role->role_id) && $role->role_id != 1){
                if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
                {
                    if($role->role_id == 2){
                        return redirect()->route('lawyer.dashboard');
                    }elseif($role->role_id == 3){
                        return redirect()->route('client.dashboard');
                    }
                }else{
                return redirect()->route('login')->with('error','Invalid Email or password.');
    
                }
            }
            else{
                return redirect()->route('login')->with('error','Invalid Email or password.');
    
            }
        }else{
                return redirect()->route('login')->with('error','Invalid Email or password.');
    
        } 
    }
}
