<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

trait AddressTrait
{
    public function getCountries()
    {
        return Country::all();
    }
    public function getStates()
    {
        return State::all();
    }

    public function getCities()
    {
        return City::all();
    }
}
