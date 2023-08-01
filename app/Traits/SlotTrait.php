<?php

namespace App\Traits;
use App\Models\Appointment;
use Auth;

trait SlotTrait
{
    public function existSlot($id, $date , $start_time, $end_time)
    {
        $data = Appointment::where('lawyer_id', $id)
        ->where('date', $date)
        ->where('start_time', $start_time)
        ->where('end_time', $end_time)
        ->first();
        // echo "<pre>";
        // print_r($data);
        // die;
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    public function existSlotAuthUser($date , $start_time, $end_time)
    {
        $data = Appointment::where('date', $date)
        ->where('start_time', $start_time)
        ->where('end_time', $end_time)
        ->where('client_id', Auth::user()->client->id)
        ->first();

        if($data) {
            return true;
        } else {
            return false;
        }
    }
}
