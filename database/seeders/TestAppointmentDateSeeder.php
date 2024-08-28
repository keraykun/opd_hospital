<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointments;
use App\Models\Patients;
use Illuminate\Support\Carbon;
class TestAppointmentDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specificDate = Carbon::parse('2024-2-6 11:30:30');

        Appointments::create([
            'patient_id'=>Patients::all()->random()->id,
            'doctor_id'=>null,
            'service_id'=>null,
            'room_id'=>1,
            'message'=>fake()->paragraph(6),
            'concern'=>fake()->paragraph(3),
            'appointed'=>fake()->randomElement(['guardian','self']),
            'is_approve'=>0,
            'start_date_at'=>$specificDate,
        ]);
    }
}