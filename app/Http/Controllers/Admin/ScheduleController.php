<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Schedule;

use DB;



class ScheduleController extends Controller

{

    public function index()
    {
        return view('admin.schedules.calendar');
    }

    public function fullcalender_getdata(Request $request)
    {

        $data = Schedule::select(
            'lawyer_id',
            'date',
            DB::raw("GROUP_CONCAT(DISTINCT lawyers.first_name SEPARATOR ' ') as lawyer_firstname"),
            DB::raw("GROUP_CONCAT(DISTINCT lawyers.last_name SEPARATOR ' ') as lawyer_lastname")
        )
        ->join('lawyers', 'lawyers.id', '=', 'schedules.lawyer_id')
        ->whereDate('date', '>=', $request->start)->whereDate('date', '<=', $request->end)
        ->groupBy('lawyer_id', 'date')
        ->get();
        

        $slots = array();
        if (count($data)) {
            foreach ($data as $key => $val) {
                $slots[$key]['id'] = $val->id;
                $slots[$key]['title'] = $val->lawyer_firstname  .  $val->lawyer_lastname;
                $slots[$key]['start'] = $val->date;
            }
        }
        return response()->json($slots);
    }

    public function getBookingDetails($bookingid = 0)
    {

        $bookings = Schedule::find($bookingid);
          $start_time =  $bookings->start_time->format('H:i');
          $end_time = $bookings->end_time->format('H:i');
          $html = "<div class='app-time'>
        <div>
          <p><b>Timings</b></p>
          <p> $start_time  to   $end_time   </p>
          </div>
          </div>";

        $response['html'] = $html;

        return response()->json($response);
    }
}
