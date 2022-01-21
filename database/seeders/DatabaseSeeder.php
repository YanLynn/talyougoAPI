<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitySeeder::class);
        $this->call(TownShipSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(RoleSeeder::class);
        //for DB Testing
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(CityOfDeliSeeder::class);
        $this->call(OrderSeeder::class);
       
    }
}
