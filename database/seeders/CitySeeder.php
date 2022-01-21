<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use Carbon\Carbon;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CitySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = base_path('database/seeders/csv/tbl_city.csv');
        $this->tablename = 'cities';
        $this->timestamps = true;
        $this->delimiter = ',';
    }
    public function run()
    {

        parent::run();
    }
}
