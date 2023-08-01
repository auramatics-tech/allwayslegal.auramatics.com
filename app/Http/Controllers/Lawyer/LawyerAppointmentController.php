<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Lawyer;
use App\Models\User;
use App\Models\Time;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\RoleUser;
use Auth;
use Mail;
use Carbon\Carbon;
use App\Traits\SlotTrait;

class LawyerAppointmentController extends Controller
{

    use SlotTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::where('lawyer_id', Auth::user()->lawyer->id)->orderByDesc('created_at')->paginate(10);

        //requested appointment count
        $app_count = Appointment::where('lawyer_id', Auth::user()->lawyer->id)
            ->where('status', 1)
            ->whereNull('cancelled_at')
            ->count();

        foreach ($appointments as $appointment) {

            $appointmentStartTime = $appointment->start_time;
            $appointment->appointmentTimestamp = strtotime($appointmentStartTime);

            $currentDateTime = date('Y-m-d H:i:s');
            $appointment->currentTimestamp = strtotime($currentDateTime);

            $payment = Payment::where('appointment_id', $appointment->id)->select('refund_id')->first();

            if ($payment) {
                $appointment->refund_id = $payment->refund_id;
            } else {
                $appointment->refund_id = null; // or any default value you prefer
            }
        }

        return view('lawyer.appointments.index', compact('appointments', 'app_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lawyer.appointments.create');
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
    }
    public function detail($id)
    {
        $appointment = Appointment::where(['lawyer_id' => Auth::user()->lawyer->id, 'id' => $id])->first();
        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
            $service = Service::where('id', $appointment->service_id)->first();
        }
        $appointment->service_price = $service->price;
        $appointment->lawyer_fee = $lawyer->lawyer_fee;
        $appointment->lawyer_fee_tax = $lawyer->lawyer_fee_tax;
        return view('lawyer.appointments.detail', compact('appointment'));
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
    public function cancel_request($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return back()->with('success', 'Request Declined!');
    }

    public function destroy($id)
    {
    }

    public function update_status(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)
            ->where('lawyer_id', Auth::user()->lawyer->id)
            ->first();


        if ($appointment) {
            $appointment->status = $request->status;
            $appointment->save();

            //client booking status mail
            Mail::send('mail.booking_status_mail', ['appointment' => $appointment, 'client_data' => 1], function ($m) use ($appointment) {
                $m->to($appointment->client_email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Appointment Request Accepted'));
            });
            $lawyerId = $appointment->lawyer_id;
            $lawyer = Lawyer::find($lawyerId);
            $lawyerUser = User::where('id', $lawyer->user_id)->first();


            //lawyer booking status mail
            Mail::send('mail.booking_status_mail', ['appointment' => $appointment, 'lawyer_data' => 1], function ($m) use ($lawyerUser) {
                $m->to($lawyerUser->email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Appointment Booked Accepted'));
            });

            //Admin booking mail
            Mail::send('mail.booking_status_mail', ['appointment' => $appointment, 'admin_data' => 1], function ($m) use ($appointment) {
                $m->to(env('MAIL_TO_ADMIN'))
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Appointment Booked Accepted'));
            });

            return redirect('lawyer/appointment')->with('success', 'Appointment status updated successfully');
        } else {
            return redirect('lawyer/appointment')->with('error', 'Failed to update appointment status');
        }
    }

    public function check(Request $request)
    {
        $date = $request->date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $lawyer_id = $request->lawyer_id;

        $lawyerExistSlot = Schedule::where('date', $date)->where('lawyer_id', $lawyer_id)->first();

        if (!$lawyerExistSlot) {
            return redirect()->route('lawyer.appointment.index')->with('error', 'No slot available for this date');
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

                    $appointment->date = $request->date;
                    $appointment->start_time = $startTime;
                    $appointment->end_time =  $endTime;
                    if ($appointment->reshedule_status == 1) {
                        $appointment->reshedule_status = 2;
                        $appointment->status = 6;
                    }
                    $appointment->save();

                    Mail::send('mail.booking_reschedule_mail', ['appointment' => $appointment, 'client_data' => 1], function ($m) use ($appointment) {
                        $m->to($appointment->client_email)
                            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                            ->subject(__('Appointment rescheduled'));
                    });
                    $lawyerId = $appointment->lawyer_id;
                    $lawyer = Lawyer::find($lawyerId);
                    $lawyerUser = User::where('id', $lawyer->user_id)->first();

                    Mail::send('mail.booking_reschedule_mail', ['appointment' => $appointment, 'lawyer_data' => 1], function ($m) use ($lawyerUser) {
                        $m->to($lawyerUser->email)
                            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                            ->subject(__('Appointment rescheduled'));
                    });
                    return redirect()->back()->with('success', 'Appointment Resheduled!');
                }
            } else {
                return redirect()->route('lawyer.appointment.index')->with('error', 'Appointment already exist for this slot');
            }
        }
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
        return redirect()->route('lawyer.appointments.index')
            ->with('success', 'Time slots successfully updated!');
    }
    public function get_reschedule($id)
    {

        $time = Time::where('appointment_id', $id)->latest()->first();
        return response($time);
    }
    public function reschedule_reject(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $appointment = Appointment::findOrFail($request->id);
        $appointment->cancelled_at = Carbon::now();
        $appointment->save();
    }

    public function send_invoice(Request $request,$id)
    {
        $appointment = Appointment::find($id);
        $admin_id = RoleUser::where('role_id', 1)->pluck('user_id')->toArray();
        $admin_emails = User::whereIn('id', $admin_id)->pluck('email')->toArray();

        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
            $service = Service::where('id', $appointment->service_id)->first();
        }

        $appointment->service_price = $service->price;
        $appointment->lawyer_fee = $lawyer->lawyer_fee;
        $appointment->lawyer_fee_tax = $lawyer->lawyer_fee_tax;

        //payment_release
        $data = Appointment::find($id);
        $data->payment_release = 1;
        $data->save();

        
        // Send email to the client
        Mail::send('mail.send_invoice', ['appointment' => $appointment], function ($m) use ($appointment) {
            $m->to($appointment->client_email)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                ->subject(__('Invoice'));
        });

        // Send email to admins
        foreach ($admin_emails as $admin_email) {
            // echo"<pre>";print_r($admin_email);die;
            Mail::send('mail.send_invoice_to_admin', ['appointment' => $appointment], function ($m) use ($admin_email) {
                $m->to($admin_email)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject(__('Invoice'));
            });
        }

        return redirect()->back()->with('success', 'Invoice Sent Successfully!');
    }
}
