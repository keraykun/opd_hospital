<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->faker = Faker::create();
        $user = User::create([
            'email' => 'admin@mailer.com',
            'is_role'=>'admin',
            'email_verified_at' => now(),
            'password' =>Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        Admins::create([
            'user_id'=>$user->id,
            'firstname'=>fake()->firstName(),
            'middlename'=>fake()->lastName(),
            'lastname'=>fake()->lastName(),
            'contact' =>fake()->randomElement(['091'.$this->faker->numberBetween(00000000,99999999)]),
        ]);
    }
}
