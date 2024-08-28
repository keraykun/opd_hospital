<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Mail\EmailDone;
use App\Models\Appointments;
use App\Models\AppointmentsRooms;
use App\Models\Bills;
use App\Models\Doctors;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
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
                  //  AppointmentsRooms::where('appointment_id',$appointment->id)->delete();
                }
            }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


      $doctor = Doctors::where('user_id',Auth::id())
        ->with(['appointments'=>function($query){
            $query->where(function($approve){
                $approve->where('is_approve',1)
                ->orWhere('is_approve',5);
            })
            ->with(['patient','service','room']);
        }])
        ->first();
        return view('doctor.appointment.index',['doctor'=>$doctor]);
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
    public function show(Appointments $appointment)
    {

         $appointment = Appointments::where('id',$appointment->id)
        ->with(['patient','service','doctor','room'])->first();
        return view('doctor.appointment.show',[
            'appointment'=>$appointment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function going(Appointments $appointment)
    {

        $user = Auth::user()->doctor->id;
        Appointments::where('id',$appointment->id)
        ->where('doctor_id',$user)
        ->update([
            'is_approve'=>5,
            'notification'=>1
        ]);

        return redirect()->back()->with('success','Sucessfully Patient Appointment has been start');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointment)
    {

        $user = Auth::user()->doctor->id;
        $data = $appointment->where('id',$appointment->id)
       ->with(['service','room'])->first();

       $total = [
        500,
        $appointment->service->cost,
        $appointment->room->cost
       ];
       $total = collect($total)->sum();
         Appointments::where('id',$appointment->id)
         ->where('doctor_id',$user)
        ->update([
            'is_approve'=>3, //done
            'notification'=>0
        ]);
        Bills::create([
            'appointment_id'=>$data->id,
            'paid_at_date'=>now(),
            'total_cost'=>$total,
            'service_id'=> $appointment->service->id,
            'room_id'=> $appointment->room->cost,
            'patient_id'=>$data->patient_id,
        ]);

        $appointment->with(['user','patient'])->first();
        $email = $appointment->user->email;
        $contact =  $appointment->patient->contact;
        $name = $appointment->patient->firstname.' '.$appointment->patient->middlename.' '.$appointment->patient->lastname;

        Mail::to($email)->send(new EmailDone($email,$contact,$name));
       // AppointmentsRooms::where('id',$appointment->appointmentroom->id)->delete();


        // $basic  = new \Vonage\Client\Credentials\Basic("6ed780eb", "7EQGEftQtyixCj9p");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("639483236898", 'KIBAWE OPD HOSPITAL', 'Hello this is from KIBAWE OPD HOSPITAL your appointment has been done thank you for visiting us!')
        // );
        // $response->current();
        return redirect()->back()->with('success','Sucessfully Patient Appointment has been Done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'hello';
    }
}
