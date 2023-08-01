<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Time;
use App\Models\Service;
use App\Models\Lawyer;
use App\Models\Payment;
use App\Models\User;
use App\Models\Schedule;
use Auth;
use App\Traits\SlotTrait;
use Mail;
// require_once app_path('helpers.php');
class ClientAppointmentController extends Controller
{

    use SlotTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::where('client_id', Auth::user()->client->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        //requested appointment count
        $app_count = Appointment::where('client_id', Auth::user()->client->id)
            ->where('status', 1)
            ->whereNull('cancelled_at')
            ->count();

        foreach ($appointments as $appointment) {

            $payment = Payment::where('appointment_id', $appointment->id)->select('refund_id')->first();

            if ($payment) {
                $appointment->refund_id = $payment->refund_id;
            } else {
                $appointment->refund_id = null; // or any default value you prefer
            }
        }

        return view('client.appointments.index', compact('appointments', 'app_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.appointments.create');
    }
    public function check(Request $request)
    {
        $date = $request->date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $lawyer_id = $request->lawyer_id;

        $lawyerExistSlot = Schedule::where('date', $date)->where('lawyer_id', $lawyer_id)->first();

        if (!$lawyerExistSlot) {
            return redirect()->route('client.appointment.index')->with('error', 'No slot available for this date');
        } else {
            $existingSlot = $this->existSlot($lawyer_id, $date,  $startTime, $endTime);
            if (!$existingSlot) {
                $appointment = Appointment::where('id', $request->id)->first();

                $currentDateTime = date('Y-m-d H:i:s');
                $appointmentStartTime = $appointment->start_time;

                // Convert appointment start time and current date time to Unix timestamps
                $appointmentTimestamp = strtotime($appointmentStartTime);
                $currentTimestamp = strtotime($currentDateTime);

                $payment = Payment::where('appointment_id', $appointment->id)->select('refund_id')->first();

                if ($currentTimestamp < $appointmentTimestamp && !isset($payment->refund_id)) {

                        $appointment->reshedule_status = 1;
                        $appointment->status = 5;
                        $appointment->save();

                        $time = new Time();
                        $time->date = $request->date;
                        $time->start_time = $startTime;
                        $time->end_time =  $endTime;
                        $time->appointment_id =  $appointment->id;
                        $time->save();

                        Mail::send('mail.booking_reschedule_client_mail', ['appointment' => $appointment, 'client_data' => 1], function ($m) use ($appointment) {
                            $m->to($appointment->client_email)
                                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                                ->subject(__('Appointment reschedule Initiated'));
                        });
                        $lawyerId = $appointment->lawyer_id;
                        $lawyer = Lawyer::find($lawyerId);
                        $lawyerUser = User::where('id', $lawyer->user_id)->first();

                        Mail::send('mail.booking_reschedule_client_mail', ['appointment' => $appointment, 'lawyer_data' => 1], function ($m) use ($lawyerUser) {
                            $m->to($lawyerUser->email)
                                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                                ->subject(__('Appointment reschedule Initiated'));
                        });
                        return redirect()->back()->with('success', 'Appointment reshedule request sent wait for lawyer approvel!');
                }
            } else {
                return redirect()->route('client.appointment.index')->with('error', 'Appointment already exist for this slot');
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => '
                required|unique:appointments,date,NULL,id,user_id,' . \Auth::id(),
            'time' => 'required'
        ]);
        $appointment = Appointment::create([
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time
            ]);
        }

        $request->session()->flash(
            'success',
            'Time slots created for' . " " . $request->date
        );

        return redirect('lawyer/appointment');

        // $request->session()->flash('success', 'Appointment created for'. $request->date);

        // return redirect('lawyer/appointment');

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
    public function detail($id)
    {
        $appointment = Appointment::where(['client_id' => Auth::user()->client->id, 'id' => $id])->first();
        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
            $service = Service::where('id', $appointment->service_id)->first();
        }
        $appointment->service_price = $service->price;
        $appointment->lawyer_fee = $lawyer->lawyer_fee;
        $appointment->lawyer_fee_tax = $lawyer->lawyer_fee_tax;
        return view('client.appointments.detail', compact('appointment'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function cancel_request($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return back()->with('success', 'Request Declined!');
    }


    public function updateSlots(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = Time::where('appointment_id', $appointmentId)->delete();
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time,
                'status' => 0
            ]);
        }
        return redirect()->route('client.appointments.index')
            ->with('success', 'Time slots successfully updated!');
    }
}
