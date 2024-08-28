<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ServicesSeeder::class,
            RoomSeeder::class,
            PatientSeeder::class,
            DoctorSeeder::class,
            // AppointmentApproveSeeder::class,
            // AppointmentPendingSeeder::class,
        ]);

        /**---------------------***/

        $this->call([
            TestAppointmentDateSeeder::class
        ]);

        // $this->call([
        //     PatientSeeder::class,
        //      AdminSeeder::class,
        //      DoctorSeeder::class,
        //      ServicesSeeder::class,
        //      RoomSeeder::class,
        //      AppointmentApproveSeeder::class,
        //      AppointmentPendingSeeder::class,
        //      AppointmentDoneSeeder::class,
        //      AppointmentDeclineSeeder::class,
        //      AppointmentRoomSeeder::class,
        //      BillsSeeder::class
        //  ]);
    }
}