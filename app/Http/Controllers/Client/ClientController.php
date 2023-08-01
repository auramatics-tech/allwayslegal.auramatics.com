<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Lawyer;
use Auth;
use Carbon\Carbon;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::all();
        $appointments = Appointment::where('client_id', Auth::user()->client->id)->where('status',3)
        ->orderByDesc('created_at')
        ->get();

        $lawyers = [];
        foreach ($appointments as $appointment) {
            $lawyer = Lawyer::where('id', $appointment->lawyer_id)->first();
            if ($lawyer) {
                $lawyers[] = $lawyer;
            }
        }
        $ongoing_appointments = Appointment::where('client_id', Auth::user()->client->id)
        ->whereDate('date', '>=', Carbon::now()->toDateString())
        ->where('status','!=',1)
        ->get();

        $today = Carbon::now();
        $ongoing_appointments->transform(function ($appointment) use ($today) {
            $appointmentDate = Carbon::parse($appointment->date);
            $daysUntilAppointment = $today->diffInDays($appointmentDate, false); // Get the difference in days

            $appointment->days_until_appointment = $daysUntilAppointment;
            return $appointment;
        });
      
        return view('client.index' , compact('services','lawyers','ongoing_appointments'));
    }
}
