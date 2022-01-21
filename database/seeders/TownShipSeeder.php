<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class TownShipSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->file = base_path('database/seeders/csv/tbl_town.csv');
        $this->tablename = 'townships';
        $this->timestamps = true;
        $this->delimiter = ',';
    }
    public function run()
    {

        parent::run();
    }
}
