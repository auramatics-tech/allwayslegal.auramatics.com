<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Service;
use App\Models\LawyerService;
use App\Models\Lawyer;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Payment;
use App\Models\Time;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;
use Mail;
use Hash;
use App\Traits\SlotTrait;

class BookingController extends Controller
{
    use SlotTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $areas = Area::all();
        return view('booking.index', compact('areas'));
    }
    public function get_services(Request $request)
    {
        $services = Service::where(function ($query) use ($request) {
            $query->whereJsonContains('practice_area_id', $request->area_id)
                ->orWhereNull('practice_area_id');
        })->get();

        return response($services);
    }
    public function choose_lawyer(Request $request)
    {

        $lawyers = LawyerService::where('service_id', $request->id)->get();

        // Retrieve the lawyer details
        $lawyerIds = $lawyers->pluck('lawyer_id');
        $lawyerDetails = Lawyer::whereIn('id', $lawyerIds)->whereNotNull('lawyer_fee')->get();

        $currentDate = Carbon::now()->toDateString();

        foreach ($lawyerDetails as $lawyerDetail) {
            $slot = Schedule::where('lawyer_id', $lawyerDetail->id)
                ->whereDate('date', '>=', $currentDate)
                ->orderBy('date', 'desc')
                ->orderBy('start_time', 'desc')
                ->first();

            if ($slot) {
                $lawyerDetail->available_slot = $slot->date;
            } else {
                $lawyerDetail->available_slot = null;
            }
        }

        $html = view('booking.includes.choose_lawyer', compact('lawyerDetails'))->render();

        return response($html);
    }
    public function schedule_time(Request $request)
    {
        $appointment = Appointment::find($request->id);
        $lawyer = null;
        $slots = [];
        $availableDates = [];
    
        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
    
            $currentDate = Carbon::now()->toDateString();
    
            // Retrieve all available dates for the lawyer from the database
            $availableDates = Schedule::where('lawyer_id', $lawyer->id)
                ->whereDate('date', '>=', $currentDate)
                ->pluck('date')
                ->unique()
                ->toArray();
    
            // Process slots for the current date
            $schedules = Schedule::where('lawyer_id', $lawyer->id)
                ->whereDate('date', $currentDate)
                ->orderBy('start_time')
                ->get();
    
            foreach ($schedules as $schedule) {
                $startTime = strtotime($schedule->start_time);
                $endTime = strtotime($schedule->end_time);
    
                while ($startTime < $endTime) {
                    $formattedSlot = [
                        'date' => date('D, M d', strtotime($schedule->date)),
                        'start_time' => date('h:i A', $startTime),
                        'end_time' => date('h:i A', strtotime('+1 hour', $startTime))
                    ];
    
                    $existingSlot = $this->existSlot($lawyer->id, $schedule->date, date('H:i:s', $startTime), date('H:i:s', strtotime('+1 hour', $startTime)));
    
                    if (!$existingSlot) {
                        $slots[] = $formattedSlot;
                    }
    
                    $existingSlotAuthUser = $this->existSlotAuthUser($lawyer->id, $schedule->date, date('H:i:s', $startTime), date('H:i:s', strtotime('+1 hour', $startTime)));
    
                    if ($existingSlotAuthUser && $request->step == 4) {
                        $formattedSlot['active'] = 1;
                        $slots[] = $formattedSlot;
                    }
    
                    $startTime = strtotime('+1 hour', $startTime);
                }
            }
        }
        return view('booking.schedule_time', compact('lawyer', 'slots', 'availableDates','appointment'));
    }
    


    public function get_slots(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date_d));

        $slots = Schedule::where('lawyer_id', $request->lawyer_id)
            ->whereDate('date', '=', $date)
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();


        $formattedSlots = [];

        foreach ($slots as $slot) {
            $startTime = strtotime($slot->start_time);
            $endTime = strtotime($slot->end_time);

            while ($startTime < $endTime) {
                $formattedSlot = [
                    'datet' => date('D, M d', strtotime($slot->date)),
                    'start_timet' => date('h:i A', $startTime),
                    'end_timet' => date('h:i A', strtotime('+1 hour', $startTime))
                ];
                $existingSlot = $this->existSlot($request->lawyer_id, $slot->date, date('H:i:s', $startTime), date('H:i:s', strtotime('+1 hour', $startTime)));

                if (!$existingSlot) {
                    $formattedSlots[] = $formattedSlot;
                }
                $existingSlotAuthUser = $this->existSlotAuthUser($slot->date, date('H:i:s', $startTime), date('H:i:s', strtotime('+1 hour', $startTime)));

                if ($existingSlotAuthUser && $request->step == 4) {

                    $formattedSlot['active'] = 1;
                    $formattedSlots[] = $formattedSlot;
                }
                $startTime = strtotime('+1 hour', $startTime);
            }
        }

        return response($formattedSlots);
    }

    public function save_slots(Request $request)
    {

        $appointment = Appointment::find($request->appointment_id);
        if ($appointment) {
            $appointment->date = $request->date;
            $appointment->start_time = $request->start_time;
            $appointment->end_time = $request->end_time;
            $appointment->save();
        }
        return redirect()->route('confirmation', ['id' =>  $appointment->id])->with('success', 'Data updated successfully');
    }
    
    public function reschedule_slots(Request $request)
    {
        $date = Carbon::createFromFormat('D, M d', $request->date)->format('Y-m-d');
        $startTime =  Carbon::createFromFormat('h:i A', $request->start_time)->format('H:i:s');
        $endTime = Carbon::createFromFormat('h:i A', $request->end_time)->format('H:i:s');

        $appointment = Appointment::where('id', $request->appointment_id)->first();

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
            $time->date = $date;
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
            
            return redirect()->route('client.appointment.index')->with('success', 'Appointment reshedule request sent wait for lawyer approvel!');
        }
       
    }
    public function save_booking_data(Request $request)
    {

        $this->validate($request, [
            'client_name' => ['required'],
            'client_email' => ['required'],
            'case_title' => ['required'],
            'case_note' => ['required']
        ]);

        if (isset($request->case_file)) {
            $file = $request->file('case_file');
            $imageName = time() . '.' . $file->extension();
            $userFolder = 'case_file/';
            $file->move(public_path($userFolder), $imageName);
        }

        if ($request->lawyer_id) {
            $user = User::where('email', $request->client_email)->first();

            if (!$user) {
                // Client does not exist, register the client
                $password = Str::random(10); // Generate a random password

                $user = new User();
                $user->name = $request->client_name;
                $user->email = $request->client_email;
                $user->password = Hash::make($password);
                $user->save();

                $name                   =     $request->client_name;
                $name                   =       explode(" ", $name);
                $first_name             =       $name[0];
                $last_name              =       "";
                if (isset($name[1])) {
                    $last_name          =       $name[1];
                }

                $client = new Client();
                $client->user_id  = $user->id;
                $client->first_name = $first_name;
                $client->last_name = $last_name;
                $client->save();

                if (isset($user)) {

                    $user_role = new RoleUser;
                    $user_role->user_id = $user->id;
                    $user_role->role_id = 3;
                    $user_role->save();
                }

                $data = [
                    'name' => $request->client_name,
                    'email' => $request->client_email,
                    'password' => $password,
                ];

                Mail::send('mail.register_mail', $data, function ($m) use ($request) {
                    $m->to($request->client_email)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                        ->subject(__('Register Successfully'));
                });
                Auth::login($user);
            }

            $lawyers = $request->lawyer_id;
            $lawyerNames = $request->lawyer_name;

            foreach ($lawyers as $key => $lawyer) {
                $booking = new Appointment();
                // Step 1
                $booking->case_note = $request->case_note;
                if (!$user) {
                    $booking->client_id = $client->id;
                } else {
                    $booking->client_id =  Auth::user()->client->id;
                }
                $booking->client_name = $request->client_name;
                $booking->client_email = $request->client_email;
                $booking->case_title = $request->case_title;
                $booking->case_file = $userFolder . $imageName;


                // Step 2
                $booking->lawyer_id = $lawyer;
                $booking->lawyer_name = $lawyerNames[$key];
                $booking->area_id = $request->area_id;
                $booking->area_name = $request->area_name;
                $booking->service_id = $request->service_id;
                $booking->service_title = $request->service_title;

                $booking->save();

                $booking_data = Appointment::find($booking->id);
                 // Generate and set the booking code
                 $bookingCode = 'AL-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT);
                 $booking_data->booking_code = $bookingCode;
                 $booking_data->save();
            }
        }


        return redirect()->route('client.appointment.index')->with('success', 'Data updated successfully');
    }
    public function confirmation(Request $request)
    {
        $appointment = Appointment::find($request->id);

        if ($appointment) {
            $lawyer = Lawyer::find($appointment->lawyer_id);
            $service = Service::where('id', $appointment->service_id)->first();
        }


        return view('booking.confirmation', compact('lawyer', 'appointment', 'service'));
    }
    public function detail_review(Request $request)
    {

        $lawyerDetail = Lawyer::find($request->id);

        $html = view('booking.detail_review', compact('lawyerDetail'))->render();
        return response($html);
    }
}
