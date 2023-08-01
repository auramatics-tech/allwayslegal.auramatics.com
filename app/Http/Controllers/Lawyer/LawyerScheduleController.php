<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Requests\StoreScheduleRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Str;

use App\Models\Schedule;

use Auth;


class LawyerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::latest()->where('lawyer_id', Auth::user()->lawyer->id)->paginate(5);

        return view('lawyer.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $validatedData = $request->validated();
        // echo"<pre>";
        // print_r($request->all());
        // die;

        $existingSlot = Schedule::where(function ($query) use ($request) {
            $query->where('date', $request->date)
                ->where('start_time', $request->start_time)
                ->where('end_time', $request->end_time);
        })
            ->orWhere(function ($query) use ($request) {
                $query->where('date', $request->date)
                    ->where('start_time', '<=', $request->start_time)
                    ->where('end_time', '>', $request->end_time);
            })->where('lawyer_id', Auth::user()->lawyer->id)
            ->first();

        if ($existingSlot) {
            if (!isset($request->id) || (isset($request->id) && $request->id != $existingSlot->id)) {

                // Slot already exists, return a message or handle it accordingly
                return redirect(route('lawyer.schedules'))->with('error', 'Slot already exists in the database.');
            }
        }


        if (isset($request->id)) {
            $schedule = Schedule::Find($request->id);
        } else {
            $schedule = new Schedule();
        }
        $schedule->lawyer_id = $request->lawyer_id;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->save();

        if (isset($request->id)) {
            return redirect(route('lawyer.schedules'))->with('success', 'You have successfully created a service');
        } else {
            return redirect(route('lawyer.schedules'))->with('success', 'You have successfully update a service');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Schedule::Find($id);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Schedule::destroy($id);

        // $request->session()->flash('success', 'you have successfully deleted the schedule');

        return redirect(route('lawyer.schedules'))->with('success', 'You have successfully deleted the schedule');
    }
}
