<?php

namespace Database\Seeders;

use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Rooms;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AppointmentApproveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        $startDate = now()->subDays(1);

        for ($i=1; $i <=10 ; $i++) {

            $currentDate = $startDate->addDay();
           // $doctor = Doctors::all()->random()->id;
            $doctor = Doctors::inRandomOrder()->first();
            $service = Services::all()->random()->id;

            for ($j=1; $j <=10 ; $j++) {
                $recordCount = Appointments::where('is_approve',1)
                ->whereDate('start_date_at',$currentDate)->count();
                $room = Rooms::where('id',$j)->first();
                $roomtenth = Rooms::where('id',$i)->first();


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
                    'service_id'=>$doctor->service_id,
                    'room_id'=>$room->id,
                    'message'=>fake()->paragraph(6),
                    'concern'=>fake()->paragraph(3),
                    'appointed'=>fake()->randomElement(['guardian','self']),
                    'is_approve'=>1,
                    'line_number'=>$recordCount+1,
                    'start_date_at'=>$currentDate,
                ]);

                AppointmentsRooms::create([
                    'room_id'=>$j,
                    'scheduled_at'=>$currentDate,
                ]);
            }

        }
    }
}
