<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::insert([
            [
                'name' => 'أحمد علي',
                'phone' => '01000000001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد حسن',
                'phone' => '01000000002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'عمر سمير',
                'phone' => '01000000003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'خالد مصطفي',
                'phone' => '01000000005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
