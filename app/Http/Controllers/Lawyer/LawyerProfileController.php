<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Requests\StoreLawyerProfileRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Models\Area;
use App\Models\Lawyer;
use Auth;
use App\Traits\AddressTrait;

class LawyerProfileController extends Controller
{
    use AddressTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lawyer.profile.index', [
            'lawyer' => Auth::user()->lawyer,
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
        return view('lawyer.profile.create', ['areas' => Area::all()]);
    }

    /**
     * Store a newly created resource in storage.StoreLawyerProfileRequest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    echo"<pre>";
    //    print_r($request->all());
    //    die;
        // $validatedData = $request->validated();
        // if($validatedData){
            $this->validate($request, [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'phone' => ['required'],
                'gender' => ['required'],
                'country' => ['required'],
                'province' => ['required'],
                'city' => ['required'],
                'law_firm_name' => ['required'],
                'law_firm_reg_no' => ['required'],
            ]);
            $lawyer = Lawyer::create($request->except(['_token', 'areas']));
        // }
        return redirect(route('lawyer.dashboard', [ 'lawyer' => Lawyer::find( $lawyer->id) ]));
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
         
        $areas = Area::all();
        $lawyer = Lawyer::where('user_id', $id)->first();

        $countries =  $this->getCountries();
        $provinces = $this->getStates();
        $cities = $this->getCities();

        return view('lawyer.profile.edit',compact('areas','lawyer','countries', 'provinces' ,'cities' ));
        
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
            'gender' => ['required'],
            'country' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'law_firm_name' => ['required'],
            'law_firm_reg_no' => ['required'],
        ]);

       $lawyer = Lawyer::findOrFail($id);
    
       $lawyer->update($request->except(['_token', 'areas']));

        return redirect('lawyer/profile')->with('success', 'Data updated successfully');

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
