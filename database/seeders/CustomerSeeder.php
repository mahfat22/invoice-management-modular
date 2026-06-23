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
                'name' => 'Ahmed Ali',
                'phone' => '01000000001', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohamed Hassan',
                'phone' => '01000000002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omar Samir',
                'phone' => '01000000003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mahmoud Adel',
                'phone' => '01000000004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khaled Mostafa',
                'phone' => '01000000005',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
