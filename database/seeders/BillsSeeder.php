<?php

namespace Database\Seeders;

use App\Models\Appointments;
use App\Models\Bills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       for ($i=1; $i <100 ; $i++) {
            Bills::create([
                'appointment_id'=>Appointments::all()->random()->id,
                'paid_at_date'=>fake()->dateTimeBetween('-9 months','now'),
                'total_cost'=>fake()->numberBetween(000,999)
            ]);
       }
    }
}
