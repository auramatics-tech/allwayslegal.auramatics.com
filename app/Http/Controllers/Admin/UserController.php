<?php



namespace App\Http\Controllers\Admin;



use foo\bar;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Role;

use App\Models\User;

use App\Models\Lawyer;

use App\Models\Client;

use App\Models\RoleUser;

use Response;

use Hash;

use Auth;

use Helper;



class UserController extends Controller

{



    public function index(Request $request)

    {
        $role_user = RoleUser::where('role_id',1)->pluck('user_id')->toarray();

        $users = User::when(isset($request->q), function ($query) use ($request) {

            $query->whereRaw("(name LIKE '%" . $request->q . "%' or email LIKE '%" . $request->q . "%')");
        })->whereIn('id',$role_user)->orderby('id', 'desc')->paginate(10);

        $roles = Role::all();
// echo"<pre>";print_r($roles);die;
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create_user()

    {

        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function edit_user($id)

    {

        $user = User::Find($id);

        $roles = Role::all();

        return view('admin.users.create', compact('user', 'roles'));
    }

    public function store_user(Request $request)

    {

        // if (isset($request->id)) {

        //     $user = User::Find($request->id);

        //     $user->update($request->except(['_token', 'roles']));

        // } else {

        //     $user = User::create($request->except(['_token', 'roles']));

        // }

        // $user->roles()->sync($request->roles);



        if (isset($request->id)) {

            $user = User::Find($request->id);



            $this->validate($request, [

                'roles' => ['required'],

                'name' => ['required', 'string', 'max:255'],

                'email' => ['required'],

            ]);
        } else {

            $this->validate($request, [

                'roles' => ['required'],

                'name' => ['required', 'string', 'max:255'],

                'password' => ['required', 'string', 'min:4'],

                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,id'],

            ]);

            $user = new User();
        }

        $user->name = $request->name;

        $user->email = $request->email;

        if (isset($request->password)) {

            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->roles()->sync($request->roles);

        if (isset($request->id)) {
        return redirect()->route('admin.user')->with('success', 'User updated successfully');
        }
        else{
        return redirect()->route('admin.user')->with('success', 'User created successfully');

        }
    }

    public function delete_user($id)

    {

        $user = User::Find($id);

        $user->delete();

        return back()->with('success', 'Data deleted successfully');
    }

    public function user_details($id)
    {

        $users = User::find($id);
      
        return view('admin.users.detail', compact('users'));
    }
}
