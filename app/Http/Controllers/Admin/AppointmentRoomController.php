<?php

namespace App\Http\Controllers\Admin;
use App\Models\Rooms;
use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use App\Models\Doctors;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentRoomController extends Controller
{
    public function __construct()
    {

        $appointments = Appointments::where('is_approve',0)->orWhere('is_approve',1)->get();

        foreach ($appointments as $appointment) {
            if (Carbon::now('Asia/Manila')->gt(Carbon::parse($appointment->start_date_at, 'Asia/Manila')->addHour())) {
                    Appointments::where('id',$appointment->id)
                    ->where(function($approve){
                        $approve->where('is_approve',0)
                        ->orWhere('is_approve',1);
                    })
                    ->update([
                        'is_approve'=>4
                    ]);
                   // AppointmentsRooms::where('appointment_id',$appointment->id)->delete();
                }
            }
    }
    /**
     * Display a listing of the resource.
     */
    public function list(Rooms $appointment){

            $rooms = Rooms::where('id', $appointment->id)
            ->with(['appointmentRooms' => function ($query) {
                $query->where('status', 0);
            }])
            ->withCount(['appointmentRooms as count_room' => function ($query) {
                $query->where('status', 0);
            }])
            ->with('appointments') // Include the 'appointments' relationship
            ->first();

        // Create a new array with a similar structure
        $newArray = [
            'id' => $rooms->id,
            'name' => $rooms->name,
            'number' => $rooms->number,
            // Add other properties from the $rooms object as needed

            'appointmentRooms' => $rooms->appointmentRooms->map(function ($appointmentRoom) {
                $matchingDates = $appointmentRoom->appointments->pluck('start_date_at')
                    ->filter(function ($startDate) use ($appointmentRoom) {
                        return \Carbon\Carbon::parse($startDate)->format('Y-m-d') === \Carbon\Carbon::parse($appointmentRoom->scheduled_at)->format('Y-m-d');
                    })
                    ->toArray();

                return [
                    'id' => $appointmentRoom->id,
                    'status' => $appointmentRoom->status,
                    'scheduled_at' => $appointmentRoom->scheduled_at,
                    'matching_dates' => $matchingDates,
                    'matching_dates_count' =>collect($matchingDates)->count(),
                    // Add other properties from the $appointmentRoom object as needed
                ];
            }),

            'count_room' => $rooms->count_room,
        ];
      // return $newArray;
        return view('admin.appointmentroom.list',['rooms'=>$newArray]);
    }

    public function history(Rooms $appointment){
        $currentDate = Carbon::now()->toDateString();
         $rooms = Rooms::where('id',$appointment->id)->with(['appointmentRooms'=>function($query){
              $query->where('status',1);
         }])
         ->withCount(['appointmentRooms as count_room'=>function($query){
          $query->where('status',1);
          }])
         ->first();
         $rooms->appointmentRooms = $rooms->appointmentRooms
         ->filter(function ($appointment) use ($currentDate) {
             return $appointment['scheduled_at'] >= $currentDate;
         })
         ->values()
         ->all();
         return view('admin.appointmentroom.list',['rooms'=>$rooms]);
     }

    public function user(AppointmentsRooms $appointment){
         $rooms = Rooms::where('id',$appointment->room_id)->with(['appointmentRoom'=>function($query) use($appointment){
            $query->whereDate('scheduled_at',$appointment->scheduled_at)
            ->with(['appointments'=>function($q) use($appointment){
                $q->whereDate('start_date_at',$appointment->scheduled_at)
                ->with('patient');
            }]);
            ;
        }])->first();
        return view('admin.appointmentroom.user',['rooms'=>$rooms]);
    }


    public function index()
    {
        $rooms = Rooms::with(['appointmentRooms'])
        ->withCount(['appointmentRooms as count_active'=>function($query){
            $query->where('status',0);
            }])
        ->withCount(['appointmentRooms as count_inactive'=>function($query){
            $query->where('status',1);
            }])
        ->get();
        return view('admin.appointmentroom.index',['rooms'=>$rooms]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $assignroom)
    {

       // return $assignroom;
        $appointment = Appointments::where('id',$assignroom->id)
        ->with(['room','service','doctor','patient'])
        ->first();

        //  return $room = Rooms::where('id', $assignroom->id)
        //   ->with(['appointmentRooms' => function ($query) {
        //         $query->whereHas('appointment',function($approve){
        //             $approve->where('is_approve',5)
        //             ->orWhere('is_approve',1)
        //             ->orderBy('line_number','desc');
        //         })
        //         ->with('appointment.patient','appointment.doctor','appointment.service');
        //   }])
        //   ->first();

        return view('admin.appointmentroom.show',['appointment'=>$appointment]);
    }

    public function appointment(Appointments $appointment){

        $appointment = Appointments::where('id',$appointment->id)
       ->with(['service','doctor','patient','room.appointmentroom'=>function($query) use($appointment){
             $query->whereDate('scheduled_at',date('Y-m-d',strtotime($appointment->start_date_at)));
       }])
       ->first();

        return view('admin.appointmentroom.appointment',[
            'appointment'=>$appointment,
            'doctors'=>Doctors::all(),
            'services'=>Services::all(),
            'rooms'=>Services::all()
        ]);
    }

    public function end(Request $request , AppointmentsRooms $appointment)
    {
         $appointment = AppointmentsRooms::where('id',$appointment->id)->first();

        $appointment->update(['status'=>1]);
        // Appointments::where('start_date_at',$appointment->scheduled_at)->update([
        //     'status'=>''
        // ]);

        return redirect()->back()->with('success','Appointment Schedule has been Ended');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppointmentsRooms $appointmentsRooms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppointmentsRooms $appointmentsRooms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentsRooms $appointmentsRooms)
    {
        //
    }



    // public function index()
    // {
    //        $rooms = Rooms::with(['appointmentRooms'])->get();
        // return $appointments = AppointmentsRooms::with(['room.appointments'=>function($query){
        //     $query->whereDate(DB::raw('DATE(appointments.start_date_at)'),'2023-12-04');
        // }])->get();

        // return $appointments = AppointmentsRooms::with(['room','appointments'=>function($query){
        //     $query->whereDate(DB::raw('DATE(appointments.start_date_at)'),'2023-12-04');
        // }])->get();


        // return $appointments = AppointmentsRooms::with(['room', 'appointments' => function ($query) {
        //     $query->join('appointments_rooms', 'appointments_rooms.room_id', '=', 'appointments.room_id')
        //           ->whereDate('appointments.start_date_at', '=', DB::raw('DATE(appointments_rooms.scheduled_at)'));
        // }])->get();

        // return $appointments = AppointmentsRooms::with(['room', 'appointments' => function ($query) {
        //     $query->join('appointments_rooms', 'appointments_rooms.room_id', '=', 'appointments.room_id')
        //           ->whereDate('appointments.start_date_at', '=', DB::raw('DATE(appointments_rooms.scheduled_at)'));
        // }])->get();

           // return $roomsWithAppointments = Rooms::with(['appointments' => function ($query) {
        //     $query->join('appointments_rooms', 'appointments_rooms.room_id', '=', 'rooms.id')
        //           ->whereDate('appointments_rooms.start_date_at', '=', DB::raw('DATE(rooms.scheduled_at)'));
        // }])->get();

        // return $roomsWithAppointments = Rooms::with(['appointments' => function ($query) {
        // $query->whereDate('start_date_at', '=', 'appointments_rooms.scheduled_at');
        // }])->get();

        // return $rooms = Rooms::orderBy('number','asc')
        // ->with(['appointmentRooms' => function ($query) {
        //     $query->whereHas('appointment',function($approve){
        //         $approve->where('is_approve',5)->orWhere('is_approve',1);
        //     })
        //     ->with('appointment.patient','appointment.doctor','appointment.service');
        //     }])
        // ->get();
    //     return view('admin.appointmentroom.index',['rooms'=>$rooms]);
    // }

}
