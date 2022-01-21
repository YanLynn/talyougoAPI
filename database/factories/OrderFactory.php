<?php

namespace Database\Factories;

use App\Models\CityOfDelivery;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1; 
        static $add = 1;   
        return [
            'user_id' =>  $order++,
            'profile_id' =>  $add++,
            'invoice_number' => Profile::all()->random()->invoice_name .'-'. rand(0000,9999),
            'receiver_name' => $this->faker->name(),
            'sender_name' => $this->faker->name(), 
            'vip_customer' => rand(0,1),
            'city_of_deli_id' => CityOfDelivery::all()->random()->id,
            'phone_num' => $this->faker->regexify('09[0-9]{9}'),
            'date' => now(),
            'address' => $this->faker->address,
            'cash_status' => rand(0,1),
            'total_price' => rand(0000,9999),
            'labour' => rand(0000,9999),
            'invest_price' => rand(000,999),
            'remark' => Str::random(5),
            
        ];
    }
}
