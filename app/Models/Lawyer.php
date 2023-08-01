<?php

namespace App\Models;

use App\Models\Schedule;
use App\Models\Service;

use App\Bookings\TimeSlotGenerator;
use App\Bookings\Filters\AppointmentFilter;
use App\Bookings\Filters\UnavailabilityFilter;
use App\Bookings\Filters\SlotsPassedTodayFilter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name', 
        'last_name',      
        'phone', 'gender',
        'country','address',
        'city', 'province',
        'postal', 'languages',
        'law_firm_name',
        'law_firm_reg_no',
        'story',
        'enrolment_year',
        'position',
        'specialized_at',
        'lawyer_fee',
        'lawyer_fee_tax'
    ];

    public function availableTimeSlots(Schedule $schedule, Service $service)
    {
        return $slots = (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
            
        //   new SlotsPassedTodayFilter(),
            new UnavailabilityFilter($schedule->unavailabilities, $this->appointmentsForDate($schedule->date)),
            // new AppointmentFilter($appointments)
            
            ])
            ->get();
    }

    public function appointmentsForDate(Carbon $date)
    {
        return $this->appointments()->notCancelled()->whereDate('date', $date)->get();
    }

    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = Hash::make($password);
    // }

    public function areas() 
    {
        return $this->belongsToMany(Area::class);
    }
        public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }


    public function services() 
    {
        return $this->belongsToMany(Service::class);
    }

    public function schedules() 
    {
        return $this->hasMany(Schedule::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function get_country()
    {
        return $this->belongsTo(Country::class, 'country');
    }
    public function get_province()
    {
        return $this->belongsTo(State::class, 'province');
    }
    public function get_city()
    {
        return $this->belongsTo(City::class, 'city');
    }

}
