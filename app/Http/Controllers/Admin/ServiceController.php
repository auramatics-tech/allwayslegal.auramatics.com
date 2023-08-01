<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Service;
use App\Models\Area;
use Auth;
use Helper;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $services = Service::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(title LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        
       
    //   $areaIds =[];
    //   foreach($services as $key => $service){
    //       $areaIds[$key] = json_decode($service->practice_area_id);   
    //   }
     
        // $areaNames = Area::whereIn('id', $areaIds)->pluck('name');
        //   echo"<pre>";
        // print_r($areaNames);
        // die;
        return view('admin.services.index', compact('services'));
    }
    public function create_service()
    {
        $practice_areas = Area::all();
        return view('admin.services.create', compact('practice_areas'));
    }
    public function edit_service($id)
    {
        $service = Service::Find($id);
        // echo "<pre>";print_r($service);die;
        $practice_areas = Area::all();
        return view('admin.services.create', compact('service','practice_areas'));
    }
    public function store_service(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255']
        ]);
        if (isset($request->id)) {
            $service = Service::Find($request->id);
        } else {
            $service = new Service();
        }
        $service->title = $request->title;
        $service->price = $request->price;
        $service->service_fee = $request->service_fee;
        $service->service_fee_tax = $request->service_fee_tax;
        $service->legal_fee = $request->legal_fee;
        $service->legal_fee_tax = $request->legal_fee_tax;
        if(isset($request->practice_areas)){
            $service->practice_area_id = json_encode($request->practice_areas);
            $service->is_all = 0;
        }else{
            $service->practice_area_id = Null;
            $service->is_all = 1;
        }
        
        $service->description = $request->description;
        $service->save();

        return redirect()->route('admin.service')->with('success', 'Data updated successfully');
    }
    public function delete_service($id)
    {
        $service = Service::Find($id);
        $service->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
