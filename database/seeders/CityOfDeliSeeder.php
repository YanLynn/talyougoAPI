<?php

namespace Database\Seeders;

use App\Models\CityOfDelivery;
use Illuminate\Database\Seeder;

class CityOfDeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CityOfDelivery::factory()->count(50)->create();
    }
}
