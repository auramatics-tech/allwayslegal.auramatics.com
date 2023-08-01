<?php



namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Lawyer;

use App\Models\User;

use App\Models\Appointment;

use DB;


class LawyerController extends Controller

{

    public function index(Request $request)
    {
  
        
        $lawyers = Lawyer::select(
            'lawyers.*',
            DB::raw("(select cities.name from `cities` where `cities`.`id` = lawyers.city) as city_name"),
            DB::raw("(select countries.name from `countries` where `countries`.`id` = lawyers.country) as country_name"),
    
        )
            ->when(isset($request->q), function ($query) use ($request) {
                $query->havingRaw("(first_name LIKE '%" . $request->q . "%' or last_name LIKE '%" . $request->q . "%' or city_name LIKE '%" . $request->q . "%' or country_name LIKE '%" . $request->q . "%' or address LIKE '%" . $request->q . "%'  or law_firm_name LIKE '%" . $request->q . "%'  or law_firm_reg_no LIKE '%" . $request->q . "%')");
            })->orderby('id', 'desc')->paginate(10);


        return view('admin.lawyer.index', compact('lawyers'));
    }

    public function lawyer_detail(Request $request)
    {


        $lawyer = Lawyer::select('lawyers.*',  DB::raw("(select users.email from `users` where `users`.`id` = lawyers.user_id) as email"))->where('id', $request->id)->first();

        return view('admin.lawyer.detail', compact('lawyer'));
    }

    public function lawyer_bookings(Request $request)
    {

        $booking = Appointment::where('lawyer_id', $request->id)
            ->when(isset($request->q), function ($query) use ($request) {
                $query->whereRaw("(service_title LIKE '%" . $request->q . "%' or area_name LIKE '%" . $request->q . "%'  or client_name LIKE '%" . $request->q . "%' or case_title LIKE '%" . $request->q . "%'  or booking_code LIKE '%" . $request->q . "%' )");
            })
            ->orderBy('id', 'desc')
            ->paginate(12);



        return view('admin.lawyer.booking', compact('booking'));
    }

    public function lawyer_upcoming_bookings(Request $request)
    {

        $upcoming_bookings = Appointment::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(service_title LIKE '%" . $request->q . "%' or area_name LIKE '%" . $request->q . "%'  or client_name LIKE '%" . $request->q . "%' or case_title LIKE '%" . $request->q . "%'  or booking_code LIKE '%" . $request->q . "%' )");
        })->where('lawyer_id', $request->id)->whereDate('date', '>', now())
            ->orderBy('id', 'desc')
            ->paginate(12);

        // echo "<pre>";print_r($upcoming_bookings);die;


        return view('admin.lawyer.upcoming_booking', compact('upcoming_bookings'));
    }
    public function change_status($id)
    {

        $lawyers = Lawyer::select('lawyers.*',  DB::raw("(select users.status from `users` where `users`.`id` = lawyers.user_id) as user_status")
        ,  DB::raw("(select users.id from `users` where `users`.`id` = lawyers.user_id) as userid"))->where('id',$id)->first();
        // echo "<pre>";print_r($lawyers);die;
        $lawyer = User::where('status', $lawyers->user_status)->where('id', $lawyers->userid)->first();

        if ($lawyer->status == 0) {
            $lawyer->status = 1;
            $msg = 'Approved';
            $lawyer->save();
            return back()->with('success', 'Lawyer ' . $msg . ' successfully.');
        } else {
            $lawyer->status = 0;
            $msg = 'Pending';
            $lawyer->save();
            return back()->with('error', 'Lawyer ' . $msg . ' successfully.');
        }
    }
}
