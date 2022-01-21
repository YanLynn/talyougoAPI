<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Profile;
use App\Models\Township;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityOfDeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;  
        return [
            'profile_id' =>  $order++,
            'city_sr_pcode' => City::all()->random()->sr_pcode,
            'township_tw_code' => Township::all()->random()->tw_code,
           
        ];
    }
}
