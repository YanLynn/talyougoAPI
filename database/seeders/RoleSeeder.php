<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [['role_name' => 'Admin','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')], 
            ['role_name' => 'Supervisor','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')], 
            ['role_name' => 'Deli User','created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],];
        Role::insert($data);

    }
}
