<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Township;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProfileFactory extends Factory
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
            'user_id' =>  $order++,
            'company_logo' => Str::random(10),
            'company_name' => Str::random(10),
            'invoice_name' => Str::random(2),
            'company_email' => $this->faker->unique()->safeEmail(), // password
            'company_phone' => $this->faker->regexify('09[0-9]{9}'),
            'company_reg_number' => rand(00000000,99999999),
            'city_sr_pcode' => City::all()->random()->sr_pcode,
            'township_tw_code' => Township::all()->random()->tw_code,
            'company_address' => $this->faker->address,
           
            
        ];
    }
}
