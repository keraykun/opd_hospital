<?php

namespace Database\Seeders;

use App\Models\Appointments;
use App\Models\Patients;
use App\Models\User;
use App\Models\Doctors;
use App\Models\Rooms;
use App\Models\Services;
use App\Models\AppointmentsRooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AppointmentDoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        for ($i=0; $i <=20 ; $i++) {

            $doctor = Doctors::inRandomOrder()->first();

            $dateTime = fake()->dateTimeBetween('now','+10 days');
            $formattedDate = $dateTime->format('Y-m-d');
            $recordCount = Appointments::where('is_approve',3)
            ->whereDate('start_date_at',$formattedDate)->count();

            $user = User::create([
                'email' => fake()->unique()->safeEmail(),
                'is_role'=>'patient',
                'email_verified_at' => now(),
                'password' =>Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
            $patient = Patients::create([
                'user_id'=>$user->id,
                'firstname'=>fake()->firstName(),
                'middlename'=>fake()->lastName(),
                'lastname'=>fake()->lastName(),
                'contact' =>fake()->randomElement(['091'.$this->faker->numberBetween(00000000,99999999)]),
                'birthdate'=>fake()->dateTimeBetween('-5 years','now'),
                'gender' => fake()->randomElement(['male','female']),
            ]);
            $appointment = Appointments::create([
                'patient_id'=>$patient->id,
                'doctor_id'=>$doctor->id,
                'service_id'=>$doctor->service->id,
                'message'=>fake()->paragraph(6),
                'concern'=>fake()->paragraph(3),
                'appointed'=>fake()->randomElement(['guardian','self']),
                'line_number'=>$recordCount+1,
                'start_date_at'=>$formattedDate,
            ]);

            // AppointmentsRooms::create([
            //     'appointment_id'=>$appointment->id,
            //     'room_id'=>Rooms::all()->random()->id,
            // ]);
        }
    }
}
