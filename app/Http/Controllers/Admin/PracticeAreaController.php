<?php



namespace App\Http\Controllers\Admin;



use foo\bar;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Response;

use Hash;

use App\Models\Area;

use Auth;

use Helper;



class PracticeAreaController extends Controller

{



    public function index(Request $request)

    {

        $areas = Area::when(isset($request->q), function ($query) use ($request) {

            $query->whereRaw("(name LIKE '%" . $request->q . "%')");

        })->orderby('id', 'asc')->paginate(12);

        return view('admin.areas.index', compact('areas'));

    }

    public function create_area()

    {

        return view('admin.areas.create');

    }

    public function edit_area($id)

    {

        $area = Area::Find($id);

        return view('admin.areas.create', compact('area'));

    }

    public function store_area(Request $request)

    {

        $this->validate($request, [

            'name' => ['required', 'string', 'max:255']

        ]);

        if (isset($request->id)) {

            $area = Area::Find($request->id);

        } else {

            $area = new Area();

        }

        if(isset($request->image)){

            $file = $request->file('image');

            $imageName = time() . '.' . $file->extension();

            $file->move(public_path('practice_area_images/'), $imageName);

            $area->image = $imageName;

        }   

        $area->name = $request->name;

        $area->save();

        return redirect()->route('admin.practice_area')->with('success', 'Data updated successfully');

    }

    public function delete_area($id)

    {

        $area = Area::Find($id);

        $area->delete();

        return back()->with('success', 'Data deleted successfully');

    }

}

