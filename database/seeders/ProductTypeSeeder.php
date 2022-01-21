<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
            ['type_name' => 'ဖာ', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'လုံး', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ချောင်း', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'အိတ်', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'မယ်', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'လိတ်', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'တွဲ', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ဖာတွဲ', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'တန်', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ချပ်', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ပြား', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ပုံး', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['type_name' => 'ခု', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]
       ];
        ProductType::insert($data);

        $role = [
            ['role_name' => 'Admin', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['role_name' => '', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ['role_name' => 'Driver', 'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
        ];

    }
}
    