<?php



namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Client;

use App\Models\User;

use App\Models\RoleUser;

use DB;


class ClientController extends Controller

{

    public function index(Request $request)
    {
        $role_user = RoleUser::where('role_id', 3)->pluck('user_id')->toarray();

        $clients = User::when(isset($request->q), function ($query) use ($request) {

            $query->whereRaw("(name LIKE '%" . $request->q . "%' or email LIKE '%" . $request->q . "%')");
        })->whereIn('id', $role_user)->orderby('id', 'desc')->paginate(10);

        // $clients = Client::select(
        //     'clients.*',
        //     "cities.name as city_name",
        //     "countries.name as country_name"
        // )->LeftJoin('cities', 'cities.id', 'clients.city')->LeftJoin('countries', 'countries.id', 'clients.country')->when(isset($request->q), function ($query) use ($request) {
        //     $query->whereRaw("(first_name LIKE '%" . $request->q . "%' or last_name LIKE '%" . $request->q . "%' or  cities.name  LIKE '%" . $request->q . "%' or countries.name  LIKE '%" . $request->q . "%' or address LIKE '%" . $request->q . "%')");
        // })->orderby('id', 'desc')->paginate(10);

        return view('admin.client.index', compact('clients'));
    }

    public function client_detail(Request $request)
    {
        $client = User::select('users.*',  'phone', 'business','position')
        ->leftJoin('clients', 'clients.user_id', 'users.id')
        ->where('users.id', $request->id)
        ->first();

        // $client = Client::select(
        //     'clients.*',
        //     DB::raw("(select users.email from `users` where `users`.`id` = clients.user_id) as email"),
        // )->where('id', $request->id)->first();
        // echo "<pre>";print_r($client);die;
        return view('admin.client.detail', compact('client'));
    }

    public function delete_client($id)

    {

        $client = Client::Find($id);

        $client->delete();

        return back()->with('success', 'Data deleted successfully');

    }
}
