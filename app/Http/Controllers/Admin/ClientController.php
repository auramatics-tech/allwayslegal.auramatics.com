<?php



namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Client;

use App\Models\User;

use DB;


class ClientController extends Controller

{

    public function index(Request $request){

        $clients = Client::select('clients.*',  DB::raw("(select cities.name from `cities` where `cities`.`id` = clients.city) as city_name"),
        DB::raw("(select countries.name from `countries` where `countries`.`id` = clients.country) as country_name"))
        ->when(isset($request->q), function ($query) use ($request) {

            $query->havingRaw("(first_name LIKE '%" . $request->q . "%' or last_name LIKE '%" . $request->q . "%' or  city_name  LIKE '%" . $request->q . "%' or country_name  LIKE '%" . $request->q . "%' or address LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
// echo "<pre>";print_r($clients);die;

         return view('admin.client.index',compact('clients'));

    }

    public function client_detail (Request $request){

        $client = Client::select('clients.*',  DB::raw("(select users.email from `users` where `users`.`id` = clients.user_id) as email"),
        )->where('id', $request->id)->first();
        // echo "<pre>";print_r($client);die;
        return view('admin.client.detail',compact('client'));
    }
}

