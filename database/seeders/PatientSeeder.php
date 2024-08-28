<?php

namespace Database\Seeders;


use App\Models\Appointments;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        $user = User::create([
            'email' => 'patient@mailer.com',
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
        Appointments::create([
            'patient_id'=>$patient->id,
            'doctor_id'=>null,
            'service_id'=>null,
            'message'=>fake()->paragraph(6),
            'concern'=>fake()->paragraph(3),
            'appointed'=>fake()->randomElement(['guardian','self']),
            'is_approve'=>0,
            'start_date_at'=>fake()->dateTimeBetween('now','+5 days'),
        ]);

        $user = User::create([
            'email' => 'patient2@mailer.com',
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
        Appointments::create([
            'patient_id'=>$patient->id,
            'doctor_id'=>null,
            'service_id'=>null,
            'message'=>fake()->paragraph(6),
            'concern'=>fake()->paragraph(3),
            'appointed'=>fake()->randomElement(['guardian','self']),
            'is_approve'=>2,
            'start_date_at'=>fake()->dateTimeBetween('now','+5 days'),
        ]);


    }
}
