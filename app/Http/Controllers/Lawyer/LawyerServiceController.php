<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Lawyer;
use App\Models\LawyerArea;
use Auth;

class LawyerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('lawyer.services.index', 
        
        ['services' => Service::paginate(8)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->route('lawyer.services.index')->with('success', 'Data updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lawyer = Lawyer::where('user_id', $id)->first();

        if ($lawyer) {
            $areas = $lawyer->areas;
        
            // Retrieve the lawyer details
            $areaIds = $areas->pluck('id');
            $services = Service::where(function ($query) use ($areaIds) {
                foreach ($areaIds as $areaId) {
                    $query->orWhere('practice_area_id', 'LIKE', '%"'.$areaId.'"%');
                }
                $query->orWhereNull('practice_area_id');
            })->get();
        }
       
        return view('lawyer.services.update', compact('services','lawyer' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lawyer = Lawyer::findOrFail($id);

        $lawyer->update($request->except(['services']));

        $lawyer->services()->sync($request->services);

        return redirect()->route('lawyer.services.index')->with('success', 'Data updated successfully');
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
}
