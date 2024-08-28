<?php

namespace Database\Seeders;

use App\Models\Doctors;
use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->faker = Faker::create();

        $user = User::create([
            'email' => 'doctor@mailer.com',
            'is_role'=>'doctor',
            'email_verified_at' => now(),
            'password' =>Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        Doctors::create([
            'user_id'=>$user->id,
            'firstname'=>'doctor fname',
            'middlename'=>'doctor mname',
            'lastname'=>'doctor lname',
            'contact' =>fake()->randomElement(['091'.$this->faker->numberBetween(00000000,99999999)]),
            'birthdate'=>fake()->dateTimeBetween('-5 years','now'),
            'service_id'=> Services::all()->random()->id,
            'gender' => fake()->randomElement(['male','female']),
        ]);

        for ($i=1; $i <=2 ; $i++) {
                $user = User::create([
                    'email' => fake()->unique()->safeEmail(),
                    'is_role'=>'doctor',
                    'email_verified_at' => now(),
                    'password' =>Hash::make('password'),
                    'remember_token' => Str::random(10),
                ]);
                Doctors::create([
                    'user_id'=>$user->id,
                    'firstname'=>fake()->firstName(),
                    'middlename'=>fake()->lastName(),
                    'lastname'=>fake()->lastName(),
                    'contact' =>fake()->randomElement(['091'.$this->faker->numberBetween(00000000,99999999)]),
                    'birthdate'=>fake()->dateTimeBetween('-5 years','now'),
                    'service_id'=> Services::all()->random()->id,
                    'gender' => fake()->randomElement(['male','female']),
                ]);

        }


    }
}
