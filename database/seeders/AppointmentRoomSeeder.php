<?php

namespace Database\Seeders;

use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {




        // foreach (Rooms::all() as $room) {
        //     $startDate = now()->subDays(1); // Set the starting date
        //     for ($i=1; $i <=5 ; $i++) {
        //             AppointmentsRooms::create([
        //                 'room_id'=>$room->id,
        //                 'appointment_id'=>null,
        //                 'scheduled_at'=>$startDate->addDay(),
        //             ]);
        //     }

        // }
        foreach (Rooms::all() as $room) {
          $startDate = now()->subDays(1);
            for ($i=1; $i <=10 ; $i++) {
                $currentDate = $startDate->addDay();
                    AppointmentsRooms::create([
                        'room_id'=>$room->id,
                        'appointment_id'=>null,
                        'scheduled_at'=>$currentDate,
                    ]);
            }

        }
        //     // $room = Rooms::inRandomOrder()->pluck('id')->first();


        //     // $existingAssignmentCount = AppointmentsRooms::where('appointment_id', $appointment->id)
        //     //     ->where('room_id', $room)
        //     //     ->count();


        //     // if ($existingAssignmentCount == 0) {
        //     //     AppointmentsRooms::create([
        //     //         'appointment_id' => $appointment->id,
        //     //         'room_id' => $room,
        //     //         'status' => 1
        //     //     ]);
        //     // }
        // }

        }
        // foreach (Appointments::where('is_approve', 1)->get() as $key => $appointment) {

        //     $room = Rooms::inRandomOrder()->pluck('id')->first();


        //     $existingAssignmentCount = AppointmentsRooms::where('appointment_id', $appointment->id)
        //         ->where('room_id', $room)
        //         ->count();


        //     if ($existingAssignmentCount == 0) {
        //         AppointmentsRooms::create([
        //             'appointment_id' => $appointment->id,
        //             'room_id' => $room,
        //             'status' => 1
        //         ]);
        //     }
        // }

}
