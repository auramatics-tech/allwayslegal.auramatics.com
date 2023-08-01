<?php

namespace App\Http\Controllers\Lawyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\Appointment;
use App\Models\LawyerService;
use App\Models\LawyerArea;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
class LawyerController extends Controller
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
        $client_count = Appointment::where('status', '!=', 1)->where('lawyer_id',Auth::user()->lawyer->id)->count();
        $service_count = LawyerService::where('lawyer_id',Auth::user()->lawyer->id)->count();
        $area_count = LawyerArea::where('lawyer_id',Auth::user()->lawyer->id)->count();
        $appointment_count = Appointment::where('lawyer_id',Auth::user()->lawyer->id)->count();
        $appointment = Appointment::where('lawyer_id',Auth::user()->lawyer->id)->first();
        $lawyerFee = Lawyer::where('id', Auth::user()->lawyer->id)
        ->pluck('lawyer_fee')
        ->first();

        $total_payment = Payment::where('lawyer_id',Auth::user()->lawyer->id)->where('status','COMPLETED')->sum('price');

        return view('lawyer.index', compact('client_count','service_count','area_count','appointment_count','total_payment','lawyerFee'));
    }
    public function get_hourly_rate()
    {
        $lawyerId = Auth::user()->lawyer->id;
        
        $lawyer = DB::table('lawyers')
            ->select('lawyer_fee', 'lawyer_fee_tax')
            ->where('id', $lawyerId)
            ->first();

        return view('lawyer.profile.hourly_rate' ,compact('lawyer'));
    }
    public function save_hourly_rate(Request $request)
    {
    //    echo"<pre>";print_r($request->all());die;
        $this->validate($request, [
            'lawyer_fee' => ['required'],
            'lawyer_fee_tax' => ['required'],
            'paypal_email_id' => ['required'],
        ]);
       
       $lawyer = Lawyer::findOrFail($request->lawyer_id);
       $lawyer->lawyer_fee = $request->lawyer_fee;
       $lawyer->lawyer_fee_tax = $request->lawyer_fee_tax;
       $lawyer->paypal_email_id = $request->paypal_email_id;
       $lawyer->save();

        return redirect()->route('lawyer.dashboard')->with('success', 'Data updated successfully');
    }

   
}
